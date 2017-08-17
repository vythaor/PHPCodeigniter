<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/8/2017
 * Time: 12:40 AM
 */
Class Home extends MY_Controller {
    function index(){
        //tong so giao dich
        $this->load->model('Order_infor_model');
        $total_rows = $this->Order_infor_model->get_total();
        $this->data['total_rows'] = $total_rows;

        //tong so khach hang
        $this->load->model('User_model');
        $total_user = $this->User_model->get_total();
        $this->data['total_user'] = $total_user;

        //tong so san pham
        $this->load->model('Product_model');
        $total_product = $this->Product_model->get_total();
        $this->data['total_product'] = $total_product;

        //tong thu nhap
        /*$where = array();
        $this->load->model('Order_detail_model');
        $status = $this->input->get('status');
        if ($status != '') {
            $where['status'] = 1;
        }*/
        //$input = array();
        //$input['where'] = array('status' => 1);
        //pre($where);
        //$order_paid = $this->Order_detail_model->get_list($input);
        $this->load->model('Order_detail_model');
        $input = array('status' => 1);
        //$orders = $this->Order_detail_model->get_list($input);
        //$query = mysqli_query("SELECT amount FROM dbshopphp.order_detail WHERE status = 1");
        //pre($query);
        $total_amount = $this->Order_detail_model->get_sum('amount', $input);
        //pre($total_amount);
        $this->data['total_amount'] = $total_amount;

        //danh sach giao dich
        $input['limit'] = array(8, 0);
        $list = $this->Order_infor_model->get_list($input);
        $this->data['list'] = $list;

        $this->data['temp'] = 'admin/home/index';
        $this->load->view('admin/adminlayout_master', $this->data);
    }
    /*dang xuat*/
    function logout(){
        if($this->session->userdata('login')){
            $this->session->unset_userdata('login');
        }
        redirect(admin_url('login'));
    }

}