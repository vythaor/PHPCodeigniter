<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/19/2017
 * Time: 2:04 AM
 */
Class Cart extends MY_Controller{
    function __construct()
    {
        parent::__construct();
    }
    /*them vao gio hang*/
    function add(){
        //lay ra sp muon them vao gio hang
        $this->load->model('Product_model');
        $id = $this->uri->rsegment(3);
        $product = $this->Product_model->get_infor($id);
        if(!$product){
            redirect();
        }
        $qty = 1; //so sp mua
        $price = $product->price;
        //giam gia thanh vien
        $user_id = 0;
        $user = '';
        if ($this->session->userdata('user_id_login')) {
            $user_id = $this->session->userdata('user_id_login');
            $user = $this->User_model->get_infor($user_id);
        }
        if($user){
            $product->discount+=3;
        }
        if($product->discount>0){
            $price =  $product->price-($product->price*$product->discount/100);
        }
        //thong tin them vao gio hang
        $data = array();
        $data['id'] = $product->id;
        $data['qty'] = $qty;
        $data['name'] = url_title($product->name);//codeigniter cart libraly khong luu utf-8
        $data['image_link'] = $product->image_link;
        $data['price'] = $price;

        $this->cart->insert($data);

        redirect(base_url('cart'));

    }
    /*ds sp trong gio hang*/
    function index(){
        //thong tin gio hang
        $carts = $this->cart->contents();
        //xem sp trong gio hang
        $total_items = $this->cart->total_items();

        $this->data['carts'] = $carts;
        $this->data['total_items'] = $total_items;

        $this->data['temp'] = 'site/cart/index';
        $this->load->view('site/layout_master', $this->data);
    }
    //xem gio hang sau khi dat hang
    function view(){
        //thong tin gio hang
        $carts = $this->cart->contents();
        //xem sp trong gio hang
        $total_items = $this->cart->total_items();

        $this->data['carts'] = $carts;
        $this->data['total_items'] = $total_items;

        $this->data['temp'] = 'site/cart/view';
        $this->load->view('site/layout_master', $this->data);
    }
    /*Cap nhat gio hang*/
    function update(){
        //thong tin gio hang
        $carts = $this->cart->contents();
        foreach ($carts as $key => $row){
            $total_qty = $this->input->post('qty_'.$row['id']);
            $data = array();
            $data['rowid'] = $key;
            $data['qty'] = $total_qty;
            $this->cart->update($data);
        }
        redirect(base_url('cart'));
    }
    /*xoa sp trong cart*/
    function del(){
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        //xoa 1 san pham
        if($id>0){
            $carts = $this->cart->contents();
            foreach ($carts as $key => $row)
            {
                if($row['id'] == $id) {
                    $data = array();
                    $data['rowid'] = $key;
                    $data['qty'] = 0;
                    $this->cart->update($data);
                }
            }
        }
        //xoa toan bo gio hang
        else{
            $this->cart->destroy();
        }
        redirect(base_url('cart'));
    }
}