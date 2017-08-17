<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 5/4/2017
 * Time: 5:03 PM
 */
Class User extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');//ham load model cho tat ca cac ham duoi
    }

    //lay danh sach thanh vien
    function index()
    {
        $where = array();

        $user = $this->input->get('province');
        if ($user) {
            $where['province'] = $user;
        }
        $input = array();
        //loc theo ma id
        $input['where'] = array();

        $input['where'] = $where;

        $list = $this->User_model->get_list($input);
        $this->data['list'] = $list;

        $total = $this->User_model->get_total();
        $this->data['total'] = $total;

        //lay noi dung bien message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/user/index';
        $this->load->view('admin/adminlayout_master', $this->data);
    }


    /*Xoa du lieu*/
    function delete(){
        $id = $this->uri->rsegment('3');
        $id = intval($id);

        $info = $this->User_model->get_infor($id);
        if (!$info) {
            $this->session->set_flashdata('message', 'Không tồn tại khách hàng');
            redirect(admin_url('user'));
        }
        //thuc hien xoa
        $this->User_model->delete($id);
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('user'));
    }
}