<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/8/2017
 * Time: 1:58 AM
 */
Class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');//ham load model cho tat ca cac ham duoi
    }

    //lay danh sach admin
    function index()
    {
        $input = array();
        $list = $this->Admin_model->get_list($input);
        $this->data['list'] = $list;

        $total = $this->Admin_model->get_total();
        $this->data['total'] = $total;

        //lay noi dung bien message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/admin/index';
        $this->load->view('admin/adminlayout_master', $this->data);
    }

    function check_username()
    {
        $action = $this->uri->rsegment(2);
        $username = $this->input->post('username');
        $where = array('username' => $username);
        $check = true;
        if($action == 'edit'){
            $info = $this->data['info'];
            if($info->username == $username){
                $check = false;
            }
        }
        //kiem tra username da ton tai hay chua
        if ($check && $this->Admin_model->check_exists($where)) {
            $this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
            return false;
        }
        return true;
    }

    //them 1 quan tri vien
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[6]');
            $this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
            $this->form_validation->set_rules('repass', 'Xác nhận mật khẩu', 'required|matches[password]');

            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $data = array(
                    'name' => $name,
                    'username' => $username,
                    'password' => md5($password)
                );
                $permission = $this->input->post('permission');
                $data['permission'] = json_encode($permission);

                if ($this->Admin_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                } else {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
                }
                redirect(admin_url('admin'));
            }
        }
        $this->config->load('permission' ,true);
        $config_permission = $this->config->item('permission');
        $this->data['config_permission'] = $config_permission;

        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/adminlayout_master', $this->data);
        /* $this->load->model('admin_model');
         $data = array();
         $data['name'] = 'phvthao';
         $data['username'] ='admin';
         $data['password'] ='admin';

         if($this->admin_model->create($data)){
             echo 'suc cmn cess';
         }
         else{
             echo 'dmmm';
         }*/
    }

    /*chinh sua thong tin theo id*/
    function edit()
    {
        $id = $this->uri->rsegment('3');
        $id = intval($id);

        $this->load->library('form_validation');
        $this->load->helper('form');
        //lay thong tin
        $info = $this->Admin_model->get_infor($id);
        if (!$info) {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }
        $info->permission = json_decode($info->permission);
        $this->data['info'] = $info;
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[6]');
            $this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');

            $password = $this->input->post('password');
            if ($password) {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
                $this->form_validation->set_rules('repass', 'Xác nhận mật khẩu', 'required|matches[password]');
            }
            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $username = $this->input->post('username');
                $data = array(
                    'name' => $name,
                    'username' => $username,
                );
                //neu thay doi mat khau thi moi gan du lieu
                if ($password) {
                    $data['password'] = md5($password);
                }
                $permission = $this->input->post('permission');
                $data['permission'] = json_encode($permission);

                if ($this->Admin_model->update($id, $data)) {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                } else {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
                }
                redirect(admin_url('admin'));
            }

        }
        $this->config->load('permission' ,true);
        $config_permission = $this->config->item('permission');
        $this->data['config_permission'] = $config_permission;

        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/adminlayout_master', $this->data);
    }
    /*Xoa du lieu*/
    function delete(){
        $id = $this->uri->rsegment('3');
        $id = intval($id);

        $info = $this->Admin_model->get_infor($id);
        if (!$info) {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }
        //thuc hien xoa
        $this->Admin_model->delete($id);
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('admin'));
    }

}