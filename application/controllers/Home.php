<?php

/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 3/24/2017
 * Time: 1:27 AM
 * @property Home Optional description
 */
class Home extends MY_Controller
{
    function index(){
        /* $this->load->model('Slide_model');
       $slide_list = $this->Slide_model->get_list();
       $this->data['slide_list'] = $slide_list;*/

        $this->load->model('Product_model');
        $input = array();

        //danh sach sp moi
        $input['limit'] = array(12, 0);
        $product_newest = $this->Product_model->get_list($input);
        $this->data['product_newest'] = $product_newest;

        //sp mua nhieu
        $input['order'] = array('count_buy', 'DESC', 12, 0);
        $product_buy = $this->Product_model->get_list($input);
        $this->data['product_buy'] = $product_buy;

        //giam gia nhieu
        $input['order'] = array('discount', 'DESC', 12, 0);
        $product_sale = $this->Product_model->get_list($input);
        $this->data['product_sale'] = $product_sale;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $data = array();
        $data['temp'] = 'site/Home/index.php';
        $this->load->view('site/layout_master.php',$data);
        //phpinfo();
    }
}
?>