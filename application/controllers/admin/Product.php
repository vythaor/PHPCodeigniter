<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/15/2017
 * Time: 4:12 PM
 */
Class Product extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }
    function index()
    {
        //lay tong tat ca san pham
        $total_rows = $this->Product_model->get_total();
        $this->data['total_rows'] = $total_rows;
        //load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;
        $config['base_url'] = admin_url('product/index');
        $config['per_page'] = 10;// so luong sp moi trang
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
        $input = array();
        $input['limit'] =array($config['per_page'], $segment);

        //kiem tra co thuc hien loc du lieu hay khong
        $id= $this->input->get('id');
        $id = intval($id);
        //loc theo ma id
        $input['where'] =array();
        if ($id>0){
            $input['where']['id'] = $id;
        }
        //loc theo ten
        $name = $this->input->get('name');
        if($name){
            $input['like'] = array('name', $name);
        }
        //loc theo category
        $category_id = $this->input->get('category');
        $category_id = intval($category_id);
        if($category_id > 0)
        {
            $input['where']['category_id'] = $category_id;
        }
        //lay danh sach sp
        $list = $this->Product_model->get_list($input);
        $this->data['list'] = $list;

        //lay ds danh muc sp
        $this->load->model('Category_model');
        $input = array();
        $input['where'] = array('parent_id'=>0);
        $category = $this->Category_model->get_list($input);
        foreach ($category as $row){
            $input['where'] = array('parent_id'=>$row->id);
            $sub = $this->Category_model->get_list($input);
            $row->sub = $sub;
        }
        $this->data['category'] = $category;
        //lay noi dung bien message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/product/index';
        $this->load->view('admin/adminlayout_master', $this->data);
    }
    /*them sp moi*/
    function add(){
        $this->load->model('Category_model');
        $input = array();
        $input['where'] = array('parent_id'=>0);
        $category = $this->Category_model->get_list($input);
        foreach ($category as $row){
            $input['where'] = array('parent_id'=>$row->id);
            $sub = $this->Category_model->get_list($input);
            $row->sub = $sub;
        }
        $this->data['category'] = $category;

        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên danh mục', 'required');
            $this->form_validation->set_rules('category', 'Thể loại', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');


            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $category_id = $this->input->post('category');
                $price = $this->input->post('price');
                $price = str_replace(',', '',$price);

                $discount = $this->input->post('discount');
                $discount = str_replace(',','',$discount);

                //lay ten file anh dc upload len
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path, 'image');

                $image_link = '';
                if (isset($upload_data['file_name'])){
                    $image_link = $upload_data['file_name'];
                }
                //upload anh kem theo
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                $image_list = json_encode($image_list);

                //luu du lieu can them
                $data = array(
                    'name' => $name,
                    'category_id' => $category_id,
                    'price' => $price,
                    'image_link' => $image_link,
                    'image_list' => $image_list,
                    'discount' =>$discount,
                    'description' => $this->input->post('description'),
                    'created' => now()
                );
                //them vao csdl
                if ($this->Product_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                } else {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
                }
                redirect(admin_url('product'));
            }
        }

        $this->data['temp'] = 'admin/product/add';
        $this->load->view('admin/adminlayout_master', $this->data);
    }
    function edit(){
        $id = $this->uri->rsegment('3');
        $product  = $this->Product_model->get_infor($id);
        if (!$product){
            $this->session->set_flashdata('message', 'Sản phẩm không tồn tại.');
            redirect(admin_url('product'));
        }
        $this->data['product'] =$product;

        $this->load->model('Category_model');
        $input = array();
        $input['where'] = array('parent_id'=>0);
        $category = $this->Category_model->get_list($input);
        foreach ($category as $row){
            $input['where'] = array('parent_id'=>$row->id);
            $sub = $this->Category_model->get_list($input);
            $row->sub = $sub;
        }
        $this->data['category'] = $category;
        //thu vien validate du lieu
        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên danh mục', 'required');
            $this->form_validation->set_rules('category', 'Thể loại', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');

            //qua vong validate
            if ($this->form_validation->run()) {
                $name        = $this->input->post('name');
                $category_id = $this->input->post('category');
                $price       = $this->input->post('price');
                $price       = str_replace(',', '',$price);

                $discount    = $this->input->post('discount');
                $discount    = str_replace(',','',$discount);

                //lay ten file anh dc upload len
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path, 'image');

                $image_link = '';
                if (isset($upload_data['file_name'])){
                    $image_link = $upload_data['file_name'];
                }
                //upload anh kem theo
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                $image_list_json = json_encode($image_list);

                //luu du lieu can them
                $data = array(
                    'name' => $name,
                    'category_id' => $category_id,
                    'price' => $price,

                    'discount' => $discount,
                    'description' => $this->input->post('description')
                );
                if($image_link!=''){
                    $data['image_link'] = $image_link;
                }
                if(!empty($image_list)){
                    $data['image_list'] = $image_list_json;
                }
                //them vao csdl
                if ($this->Product_model->update($product->id, $data)) {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                } else {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
                }
                redirect(admin_url('product'));
            }
        }

        $this->data['temp'] = 'admin/product/edit';
        $this->load->view('admin/adminlayout_master', $this->data);
    }
    //xoa 1 sp
    function delete(){
        $id = $this->uri->rsegment(3);
        $this->_del($id);

        $this->session->set_flashdata('message', 'Xóa sản phẩm thành công');
        redirect(admin_url('product'));
    }
    //xoa nhieu sp
    function delete_all(){
        $ids = $this->input->post('ids');
        foreach ($ids as $id){
            $this->_del($id);
        }
    }
    //xoa sp
    private function _del($id){
        $product = $this->Product_model->get_infor($id);
        if(!$product){
            $this->session->set_flashdata('message', 'Sản phẩm không tồn tại');
            redirect(admin_url('product'));
        }
        //thuc hien xoa
        $this->Product_model->delete($id);
        //xoa anh sp
        $image_link = './upload/product'.$product->image_link;
        if(file_exists($image_link)){
            unlink($image_link);
        }
        //xoa cac anh kem theo
        $image_list = json_decode($product->image_list);
        if(is_array($image_list)){
            foreach ($image_list as $img){
                $image_link = './upload/product/'.$img;
                if(file_exists($image_link)){
                    unlink($image_link);
                }
            }
        }
    }
}