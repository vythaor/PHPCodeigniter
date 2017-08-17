<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/18/2017
 * Time: 11:35 PM
 */
Class Product extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }

    //hien thi ds sp theo danh muc
    function category(){
        //lay id cua the loai
        $id = intval($this->uri->rsegment(3));
        //lay ra thong tin cua category
        $this->load->model('Category_model');
        $category = $this->Category_model->get_infor($id);
        if(!$category){
            redirect();
        }
        $this->data['category'] = $category;
        $input = array();
        //kiem tra danh muc con hay cha
        if($category->parent_id == 0){
            $input_cat = array();
            $input_cat['where'] = array('parent_id'=>$id);
            $category_sub = $this->Category_model->get_list($input_cat);
            if(!empty($category_sub)){
                $category_sub_id = array();
                foreach ($category_sub as $sub){
                    $category_sub_id[] = $sub->id;
                }
                $this->db->where_in('category_id', $category_sub_id);
            }else{
                $input['where'] = array('category_id'=>$id);
            }
        }
        else{
            $input['where'] = array('category_id'=>$id);
        }
        //lay thong tin sp thuoc category do
        //lay tong tat ca san pham
        $total_rows = $this->Product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        //load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;
        $config['base_url'] = base_url('product/category/'.$id);//link hien thi ds sp
        $config['per_page'] = 12;// so luong sp moi trang
        $config['uri_segment'] = 4;//phan doan hien thi so trang tren url
        $config['next_link'] = 'Trang sau';
        $config['prev_link'] = 'Trang trước';
        $config['first_link'] = 'Đầu';
        $config['last_link'] = 'Cuối';
        $config['cur_tag_open'] = '<span class="pagination-current">';
        $config['cur_tag_close'] = '</span>';
        $config['num_links'] ='2';
        //khoi tao cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);
        $segment = intval($segment);

        $input['limit'] =array($config['per_page'], $segment);
        //kiem tra dk vao
        if(isset($category_sub_id))
        {
            $this->db->where_in('category_id', $category_sub_id);
        }
        //lay danh sach sp
        $list = $this->Product_model->get_list($input);
        $this->data['list'] = $list;

        //hien thi ra view
        $this->data['temp'] = 'site/product/category';
        $this->load->view('site/layout_master', $this->data);
    }
    /*xem chi tiet sp*/
    function view(){
        //lay id sp muon xem
        $id = $this->uri->rsegment(3);
        $product = $this->Product_model->get_infor($id);
        if(!$product) redirect();
        //lay so diem trung binh danh gia
        $product->raty = ($product->rate_count > 0) ? $product->rate_total/$product->rate_count : 0;
        $this->data['product'] = $product;

        //lay ds anh kem theo
        $image_list = @json_decode($product->image_list);
        $this->data['image_list'] = $image_list;

        //cap nhat luot xem
        $data = array();
        $data['view'] = $product->view + 1;
        $this->Product_model->update($product->id, $data);

        //lay thong tin danh muc sp
        $category = $this->Category_model->get_infor($product->category_id);
        $this->data['category'] = $category;

        //hien thi ra view
        $this->data['temp'] = 'site/product/view';
        $this->load->view('site/layout_master', $this->data);
    }

    /*tim kiem theo ten sp*/
    function search(){
        if($this->uri->rsegment('3') == 1){
            //lay du lieu tu autocomplete
            $key = $this->input->get('term');
        }else {
            $key = $this->input->get('name');
        }
        $this->data['key'] = trim($key);
        $input = array();
        $input['like'] = array('name', $key);
        $total_rows = $this->Product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;

        $list = $this->Product_model->get_list($input);
        $this->data['list'] = $list;

        if($this->uri->rsegment('3') == 1){
            //xu ly autocomplete
            $result = array();
            foreach ($list as $row){
                $item = array();
                $item['id'] = $row->id;
                $item['label'] = $row->name;
                $item['value'] = $row->value;
                $result[] = $item;
            }
            //du lieu tra ve duoi dang json
            die(json_encode($result));
        }else {
            //hien thi ra view
            $this->data['temp'] = 'site/product/search';
            $this->load->view('site/layout_master', $this->data);
        }
    }
    /*tim kiem theo gia*/
    function search_price(){
        $price_from = intval($this->input->get('price_from'));
        $price_to = intval($this->input->get('price_to'));
        $this->data['price_from'] = $price_from;
        $this->data['price_to'] = $price_to;
        //loc theo gia
        $input = array();
        $input['where'] = array(
            'price >= ' => $price_from,
            'price <= ' => $price_to,
        );
        /*$this->load->model('product_model');
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        //load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;
        $config['base_url'] = base_url('product/search_price/');//link hien thi ds sp
        $config['per_page'] = 12;// so luong sp moi trang
        $config['uri_segment'] = 4;//phan doan hien thi so trang tren url
        $config['next_link'] = 'Trang sau';
        $config['prev_link'] = 'Trang trước';
        $config['first_link'] = 'Đầu';
        $config['last_link'] = 'Cuối';
        $config['cur_tag_open'] = '<span class="pagination-current">';
        $config['cur_tag_close'] = '</span>';
        $config['num_links'] ='2';
        //khoi tao cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);
        $segment = intval($segment);

        $input['limit'] =array($config['per_page'], $segment);*/
        $total_rows = $this->Product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;

        $list = $this->Product_model->get_list($input);
        $this->data['list'] = $list;
        // load view
        $this->data['temp'] = 'site/product/search_price';
        $this->load->view('site/layout_master', $this->data);
    }
    /*danh gia san pham*/
    function raty(){
        $result = array();
        //lay thong tin
        $id = $this->input->post('id');
        $id = (!is_numeric($id)) ? 0 : $id;
        $infor = $this->Product_model->get_infor($id);
        if(!$infor){
            exit();
        }
        //kiem tra khach da rate hay chua
        $raty = $this->session->userdata('session_raty');
        $raty = (!is_array($raty)) ? array() : $raty;
        //neu da co id sp trong session rate
        if(isset($raty[$id])){
            $result['msg'] = "Bạn đã đánh giá sản phẩm này.";
            $output  = json_encode($result);
            echo $output;
            exit();
        }
        //cap nhat trang thai binh chon
        $raty[$id] = TRUE;
        $this->session->set_userdata('session_raty', $raty);

        $score = $this->input->post('score');
        $data = array();
        $data['rate_total'] = $infor->rate_total + $score;
        $data['rate_count'] = $infor->rate_count + 1;

        $this->Product_model->update($id, $data);

        $result['complete'] = TRUE;
        $result['msg'] = "Cảm ơn bạn đã đánh giá.";
        $output = json_encode($result);
        echo $output;
        exit();
    }
}