<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/24/2017
 * Time: 6:37 PM
 */

Class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    function check_email()
    {
        $email = $this->input->post('email');
        $where = array('email' => $email);
        if ($this->User_model->check_exists($where)) {
            $this->form_validation->set_message(__FUNCTION__, 'Email đã đăng ký');
            return false;
        }
        return true;
    }
    /*dang ky thanh vien*/
    function register()
    {
        if($this->session->userdata('user_id_login')){
            redirect(site_url('user'));
        }

        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Tên', 'required|min_length[6]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
            $this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'required|matches[password]');
           $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
            $this->form_validation->set_rules('province', 'Địa chỉ', 'required');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'required');

            if ($this->form_validation->run()) {
                $password = $this->input->post('password');
                $password = md5($password);

                $data = array(
                    'name' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'province' => $this->input->post('province'),
                    'address' => $this->input->post('address'),
                    'password' => $password,
                    'created' => now(),
                );
                if ($this->User_model->create($data)) {
                    $this->session->set_flashdata('message', 'Tạo tài khoản thành công');
                } else {
                    $this->session->set_flashdata('message', 'Tạo tài khoản thất bại');
                }
                redirect(site_url());
            }
        }
        $this->data['temp'] = 'site/user/register';
        $this->load->view('site/layout_master', $this->data);
    }

    /*Kiem tra dang nhap*/
    function login(){
        //neu da dang nhap
        if($this->session->userdata('user_id_login')){
            redirect(site_url('user'));
        }
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post()){
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
            $this->form_validation->set_rules('login','login','callback_check_login');
            if($this->form_validation->run()){
                //lay thong tin thanh vien
                $user = $this->_get_user_infor();
                $this->session->set_userdata('user_id_login', $user->id);

                redirect();
            }
        }

        $this->data['temp'] = 'site/user/login';
        $this->load->view('site/layout_master', $this->data);
    }

    function check_login(){
        $user = $this->_get_user_infor();
        if($user){
            return true;
        }
        $this->form_validation->set_message(__FUNCTION__, 'Đăng nhập không thành công');
        return false;
    }

    function _get_user_infor(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password = md5($password);

        $this->load->model('User_model');
        $where = array('email'=>$email, 'password'=>$password);
        $user = $this->User_model->get_infor_rule($where);
        return $user;
    }

    function edit(){
        if(!$this->session->userdata('user_id_login')){
            redirect(site_url('user/login'));
        }
        //lay thong tin cua thanh vien
        $user_id = $this->session->userdata('user_id_login');
        $user  = $this->User_model->get_infor($user_id);
        if(!$user){
            redirect();
        }
        $this->data['user'] = $user;

        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->input->post()) {
            $password = $this->input->post('password');

            $this->form_validation->set_rules('username', 'Tên', 'required|min_length[3]');
            if($password)
            {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
                $this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'matches[password]');
            }
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
            $this->form_validation->set_rules('province', 'Địa chỉ', 'required');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'required');

            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('username'),
                    'phone' => $this->input->post('phone'),
                    'province' =>$this->input->post('province'),
                    'address' => $this->input->post('address'),
                );
                if($password){
                    $data['password'] = md5($password);
                }
                if ($this->User_model->update($user_id, $data)) {
                    $this->session->set_flashdata('message', 'Cập nhật thành công');
                } else {
                    $this->session->set_flashdata('message', 'Cập nhật thất bại');
                }
                redirect(site_url('user'));
            }
        }

        $this->data['temp'] = 'site/user/edit';
        $this->load->view('site/layout_master', $this->data);
    }

    /*thong tin thanh vien*/
    function index(){
        if(!$this->session->userdata('user_id_login')){
            redirect();
        }
        $user_id = $this->session->userdata('user_id_login');
        $user  = $this->User_model->get_infor($user_id);
        if(!$user){
            redirect();
        }
        $this->data['user'] = $user;

        $this->data['temp'] = 'site/user/index';
        $this->load->view('site/layout_master', $this->data);
    }

    function logout(){
        if($this->session->userdata('user_id_login')){
            $this->session->unset_userdata('user_id_login');
        }
        $this->session->set_flashdata('message', 'Đăng xuất thành công');
        redirect();
    }
}
