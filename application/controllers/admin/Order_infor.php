<?php

/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/26/2017
 * Time: 4:23 AM
 */
Class Order_infor extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Order_infor_model');
        /*$this->load->helper('MY_date_helper');*/
    }

    //hien thi ds giao dich
    function index()
    {
        //lay tong so giao dich
        $total_rows = $this->Order_infor_model->get_total();
        $this->data['total_rows'] = $total_rows;
        //load thu vien phan trang
        /*$this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;
        $config['base_url'] = admin_url('Order_infor/index');
        $config['per_page'] = 10;// so luong sp moi trang
        $config['uri_segment'] = 4;//phan doan hien thi so trang tren url
        $config['next_link'] = 'Trang sau';
        $config['prev_link'] = 'Trang trước';
        $config['first_link'] = 'Đầu';
        $config['last_link'] = 'Cuối';
        $config['cur_tag_open'] = '<span class="pagination-current">';
        $config['cur_tag_close'] = '</span>';
        $config['num_links'] = '2';

        //khoi tao cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);
        $segment = intval($segment);

        $input = array();
        $input['limit'] = array($config['per_page'], $segment);*/

        //kiem tra co thuc hien loc du lieu hay khong

        $where = array();
        //loc theo ma id
        $input['where'] = array();
        $id = $this->input->get('id');
        $id = intval($id);
        if ($id > 0) {
            $where['id'] = $id;
        }
        //loc theo thanh vien
        $user = $this->input->get('user');
        if ($user) {
            $where['user_name'] = $user;
        }
        //loc theo cong thanh toan
        $payment = $this->input->get('payment');
        if ($payment) {
            $where['payment'] = $payment;
        }
        //loc theo trang thai thanh toan
        $status = $this->input->get('status');
        if ($status != '') {
            $where['status'] = $status;
        }
        //loc theo thoi gian
        $created_to = $this->input->get('created_to');
        $created = $this->input->get('created');
        if ($created && $created_to) {
            //tim kiem tu ngay x->y
           /* $time = get_time_between_day($created, $created_to);
            if (is_array($time)) {
                $where['created >='] = $time['start'];
                $where['created <='] = $time['end'];
            }*/
            // way 1:start
            $start_date =  $created;
            $end_date =  $created_to;
            $sTime = strtotime($start_date); // Start as time
            $eTime = strtotime($end_date); // End as time
            $where['created >='] = $sTime;
            $where['created <='] = $eTime;
            //$day = 86400; // Day in seconds
            //$format = 'Y-m-d'; // Output format (see PHP date funciton)

            //$numDays = round(($eTime - $sTime) / $day) + 1;
            //$days = array();
           /* for ($d = 0; $d < $numDays; $d++) {
                $days[] = date($format, ($sTime + ($d * $day)));
            }*/
            //$days['start'] = date('d-m-Y', strtotime($day['0']));
            //$days['end'] = date('d-m-Y', strtotime($day['0']));
            //du lieu tra ve hop le
        }
        //gan cac dieu kien loc
        $input['where'] = $where;
        //pre($where);
        //lay danh sach gd
        $list = $this->Order_infor_model->get_list($input);
        $this->data['list'] = $list;
        //pre($list);
        $total_rows = $this->Order_infor_model->get_total();

        $this->data['filter'] = $input['where'];
        $this->data['created_to'] = $created_to;
        $this->data['created'] = $created;

        //lay noi dung bien message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        //lay thong tin order_detail
        //lay id cua giao dịch
       /* $id = $this->uri->rsegment('3');
        //lay thong tin cua giao dịch
        $info = $this->Order_infor_model->get_infor($id);
        $this->load->model('Order_detail_model');
        $detail = $this->Order_detail_model->get_infor($info->orderinfor_id);
        $this->data['detail'] = $detail;*/

        $this->data['temp'] = 'admin/order_infor/index';
        $this->load->view('admin/adminlayout_master', $this->data);
    }

    function view()
    {
        //lay id cua giao dịch ma ta muon xoa
        $id = $this->uri->rsegment('3');
        //lay thong tin cua giao dịch
        $infor = $this->Order_infor_model->get_infor($id);
        if (!$infor) {
            return false;
        }
        $infor->_amount = number_format($infor->amount);
        if ($infor->status == 0) {
            $infor->_status = 'pending';//đợi xử lý
        } elseif ($infor->status == 1) {
            $infor->_status = 'completed';//hoàn thành
        } elseif ($infor->status == 2) {
            $infor->_status = 'cancel';//hủy bỏ
        }
        //lấy danh sách đơn hàng  của giao dịch này
        $this->load->model('Order_detail_model');
        $input = array();
        $input['where'] = array('orderinfor_id' => $id);
        $orders = $this->Order_detail_model->get_list($input);
        if (!$orders) {
            return false;
        }
        //load model sản phẩm product_model
        $this->load->model('Product_model');
        foreach ($orders as $row) {
            //thông tin sản phẩm
            $product = $this->Product_model->get_infor($row->product_id);
            $product->image = base_url('upload/product/' . $product->image_link);
            $product->_url_view = site_url('product/view/' . $product->id);

            $row->_price = number_format($product->price);
            $row->_amount = number_format($row->amount);
            $row->product = $product;
            $row->_can_active = true;//có thể thực hiện kích hoạt đơn hàng này hay không
            $row->_can_cancel = TRUE;//có thể hủy đơn hàng hay không

            if ($row->status == 0) {
                $row->_status = 'Đang xử lý';//đợi xử lý
            } elseif ($row->status == 1) {
                $row->_status = 'Đã giao hàng';//Đã giao hàng
                $row->_can_active = false;//không thể kích hoạt
            } elseif ($row->status == 2) {
                $row->_status = 'Đã hủy';//hủy bỏ
                $row->_can_cancel = false;//không thể kích hoạt
            }
            //link hủy bỏ đơn hàng
            $row->_url_cancel = admin_url('order_infor/cancel/' . $row->id);
            $row->_url_active = admin_url('order_infor/active/' . $row->id);//link kích hoạt đơn hàng
        }

        $this->data['infor'] = $infor;
        $this->data['orders'] = $orders;
        // Tai file thanh phan
        $this->data['temp'] = 'admin/order_infor/view';
        //$this->load->view('admin/order_infor/view', $this->data);
        $this->load->view('admin/adminlayout_master', $this->data);

    }
  /*  private function getDatesFromRange($start, $end, $format='d-m-Y') {
        return array_map(function($timestamp) use($format) {
            return date($format, $timestamp);
        },
            range(strtotime($start) + ($start < $end ? 4000 : 8000), strtotime($end) + ($start < $end ? 8000 : 4000), 86400));
    }*/
    /*
     * xac nhan giao dich*/
    function active(){
        $this->load->model('Order_detail_model');
        //lay id cua don hang muon kich hoat
        $id = $this->uri->rsegment('3');
        //lay thong tin cua giao dich
        $infor = $this->Order_detail_model->get_infor($id);
        if(!$infor){
            $this->session->set_flashdata('message', "Không tồn tại đơn hàng này");
            redirect(admin_url('order_infor'));
        }
        //cap nhat trang thai giao hang
        $data = array();
        $data['status'] = 1;//da gui hang
        $this->Order_detail_model->update($id, $data);

        $this->load->model('Order_infor_model');
        $order = $this->Order_infor_model->get_infor($infor->orderinfor_id);
        $data = array();
        $data['status'] = 1;
        $this->Order_infor_model->update($order->id, $data);
        //tru di so luong san pham da chuyen cho khach
        //cong so luong sp da ban
        $this->load->model('Product_model');
        $product = $this->Product_model->get_infor($infor->product_id);
        $data = array();
        $data['count_buy'] = $product->count_buy + $infor->quantity;
        $this->Product_model->update($product->id, $data);
        //thong bao
        $this->session->set_flashdata('message', 'Cập nhật đơn hàng thành công');
        redirect(admin_url('order_infor'));
    }

//xoa 1 gd
    function delete()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);

        $this->session->set_flashdata('message', 'Xóa sản phẩm thành công');
        redirect(admin_url('Order_infor'));
    }

//xoa nhieu sp
    function delete_all()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $this->_del($id);
        }
    }

//xoa sp
    private
    function _del($id)
    {
        $Order_infor = $this->Order_infor_model->get_infor($id);
        if (!$Order_infor) {
            $this->session->set_flashdata('message', 'Giao dịch không tồn tại');
            redirect(admin_url('Order_infor'));
        }
        //thuc hien xoa
        $this->Order_infor_model->delete($id);
    }
    /*xuat file excel*/
    public function export(){
        //lay toan bo giao dich
        $list = array();
        $list = $this->Order_infor_model->get_list();
        foreach ($list as $row){
            $row->_amount = number_format($row->amount);
            if($row->status == 0){
                $row->_status = 'pending';
            }
            elseif ($row->status == 1){
                $row->_status = 'completed';
            }
            elseif ($row->status == 2){
                $row->_status = 'cancel';
            }
        }
        $this->data['list'] = $list;
        $this->load->view('admin/order_infor/export', $this->data);
    }
}