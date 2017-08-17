<?php

/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 3/24/2017
 * Time: 6:01 PM
 */
class MY_Controller extends CI_Controller
{
    public $data = array();//gui du lieu sang view

     function __construct()
    {
        //ke thua tu ci controller
        parent::__construct();//de su dung thu vien trong CI khi chay MY_Controller


        $controller = $this->uri->segment(1);
        switch ($controller) {
            case 'admin': {
                $this->load->helper('admin');
                $this->_check_login();
                $admin_id = $this->session->userdata('admin_id');
                $this->data['user_id_login'] = $admin_id;
                if($admin_id){
                    $this->load->model('Admin_model');
                    $user_infor  = $this->Admin_model->get_infor($admin_id);
                    $this->data['user_infor'] = $user_infor;
                }
                break;
            }
            default: {
                //xu ly du lieu o trang client
                //1. lay danh sach danh muc san pham
                $this->load->model('Category_model');
                $input = array();
                $input['where'] = array('parent_id'=> 0);
                $category_list = $this->Category_model->get_list($input);
                foreach ($category_list as $row){
                    $input['where'] = array('parent_id'=> $row->id);
                    $sub = $this->Category_model->get_list($input);
                    $row->sub = $sub;
                }
                $this->data['category_list'] = $category_list;

                //kiem tra user dang nhap
                $user_id_login = $this->session->userdata('user_id_login');
                $this->data['user_id_login'] = $user_id_login;
                if($user_id_login){
                    $this->load->model('User_model');
                    $user_infor  = $this->User_model->get_infor($user_id_login);
                    $this->data['user_infor'] = $user_infor;
                }
                //pre($category_list);
                $this->load->library('cart');
                $this->data['total_items'] = $this->cart->total_items();
            }
        }
    }

    //kiem tra trang thai dang nhap cua admin
    private function _check_login()
    {
        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);

        $login = $this->session->userdata('login');
        if(!$login && $controller != 'login'){
            redirect(admin_url('login'));
        }
        if($login && $controller == 'login'){
            redirect(admin_url('home'));
        }
        elseif (!in_array($controller, array('login', 'home'))){
            $admin_id = $this->session->userdata('admin_id');
            $admin_root = $this->config->item('root_admin');

            if($admin_id != $admin_root) {
                //kiem tra quyen
                $permission_admin = $this->session->userdata('permission');
                $controller = $this->uri->rsegment(1);
                $action = $this->uri->rsegment(2);
                $check = true;
                if(!isset($permission_admin->{$controller})){
                    $check = false;
                }
                $permission_act = $permission_admin->{$controller};
                if(!in_array($action, $permission_act)){
                    $check = false;
                }
                if($check==false){
                    $this->session->set_flashdata('message', 'Bạn không có quyền truy cập!');
                    redirect(base_url('admin'));
                }
            }
        }
    }
}

?>