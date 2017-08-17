<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/15/2017
 * Time: 4:49 AM
 */
Class Category extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');//ham load model cho tat ca cac ham duoi
    }
    function index(){
        $list = $this->Category_model->get_list();
        $this->data['list'] = $list;

        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        //load view
        $this->data['temp'] = 'admin/category/index';
        $this->load->view('admin/adminlayout_master', $this->data);
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên danh mục', 'required');

            if ($this->form_validation->run())
            {
                $name = $this->input->post('name');
                //$sort = $this->input->post('sort');
                $parent_id = $this->input->post('parent_id');
                //luu du lieu can them
                $data = array(
                    'name' => $name,
                    //'sort' => intval($sort),
                    'parent_id' => $parent_id
                );
                //them vao csdl
                if ($this->Category_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                } else {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
                }
                redirect(admin_url('category'));
            }
        }
        //lay danh sach danh muc cha
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $list = $this->Category_model->get_list($input);
        $this->data['list'] = $list;

        $this->data['temp'] = 'admin/category/add';
        $this->load->view('admin/adminlayout_master', $this->data);
    }
    /*cap nhat du lieu*/
    function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $id = $this->uri->rsegment('3');
        $info = $this->Category_model->get_infor($id);
        if(!$info){
            $this->session->set_flashdata('message', 'Không tồn tại danh mục');
            redirect(admin_url('category'));
        }
        $this->data['info'] = $info;

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên danh mục', 'required');
            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $parent_id = $this->input->post('parent_id');
                //$sort = $this->input->post('sort');
                $data = array(
                    'name' => $name,
                    'parent_id' => $parent_id,
                    //'sort' => intval($sort)
                );
                //them vao csdl
                if ($this->Category_model->update($id, $data)) {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                } else {
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
                }
                redirect(admin_url('category'));
            }
        }
        //lay danh sach danh muc cha
        $input = array();
        $input['where'] = array('parent_id'=>0);
        $list = $this->Category_model->get_list($input);
        $this->data['list'] = $list;

        $this->data['temp'] = 'admin/category/edit';
        $this->load->view('admin/adminlayout_master', $this->data);
    }
    function delete(){
        $id = $this->uri->rsegment('3');
        $info = $this->Category_model->get_infor($id);
        if(!$info){
            $this->session->set_flashdata('message', 'Không tồn tại danh mục');
            redirect(admin_url('category'));
        }
        //kiem tra xem danh muc co san pham ko
        $this->load->model('Product_model');
        $product = $this->Product_model->get_infor_rule(array('category_id'=>$id), 'id');
        if($product){
            $this->session->set_flashdata('message', 'Xóa sản phẩm trước khi xóa danh mục!');
            redirect(admin_url('category'));
        }
        //xoa du lieu
        $this->Category_model->delete($id);
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('category'));
    }
}