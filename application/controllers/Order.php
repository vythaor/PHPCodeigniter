<?php

/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/26/2017
 * Time: 2:10 AM
 */
/*require('PHPMailerAutoload.php');
require_once ('class.smtp.php');*/
require_once ('class.phpmailer.php');
Class Order extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /*lay thong tin khach hang*/
    function checkout()
    {
        //thong tin gio hang
        $carts = $this->cart->contents();
        $total_items = $this->cart->total_items();
        if ($total_items <= 0) {
            redirect();
        }
        $total_amount = 0;
        foreach ($carts as $row) {
            $total_amount += $row['subtotal'];
        }
        $this->data['total_amount'] = $total_amount;
        //neu thanh vien da dang nhap, lay thong tin
        $user_id = 0;
        $user = '';
        if ($this->session->userdata('user_id_login')) {
            $user_id = $this->session->userdata('user_id_login');
            $user = $this->User_model->get_infor($user_id);
        }
        $this->data['user'] = $user;

        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('username', 'Tên', 'required|min_length[3]');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'required');
            $this->form_validation->set_rules('payment', 'Cổng thanh toán', 'required');
            if ($this->form_validation->run()) {
                $payment = $this->input->post('payment');
                //them vao csdl
                $data = array(
                    'status' => 0, //trang thai chua thanh toan
                    'customer_id' => $user_id, //id thanh vien neu da dang nhap
                    'user_email' => $this->input->post('email'),
                    'user_name' => $this->input->post('username'),
                    'user_phone' => $this->input->post('phone'),
                    'user_address' => $this->input->post('address'),
                    'amount' => $total_amount, //tong so tien thanh toan
                    'payment' => $payment, //cong thanh toan
                    'created' => now('Asia/Ho_Chi_Minh'),
                );
                $useremail = $data['user_email'];
                $this->load->model('Order_infor_model');
                $this->Order_infor_model->create($data);
                $orderinfor_id = $this->db->insert_id();//lay ra id cua giao dich vua them vao

                //them vao bang order detail
                $this->load->model('Order_detail_model');
                foreach ($carts as $row) {
                    $data = array(
                        'orderinfor_id' => $orderinfor_id,
                        'product_id' => $row['id'],
                        'quantity' => $row['qty'],
                        'amount' => $row['subtotal'],
                        'status' => 0,
                        //$count_buy = $count_buy + 1,
                    );
                    $this->Order_detail_model->create($data);
                }
                $this->cart->destroy();
                //xoa gio hang
                if ($payment == 'shipcod') {
                    $this->session->set_flashdata('message', 'Đặt hàng thành công. Bạn có thể check email để kiểm tra đơn hàng.');
                    echo '<script language="javascript">';
                    echo 'alert("Đặt hàng thành công")';
                    echo '</script>';
                    //gui email cho khach hang
                    $mail = new PHPMailer();
                    $mail->SMTPDebug = 2; // enables SMTP debug information (for testing)
                    // 1 = errors and messages
                    // 2 = messages only
                    $mail->SMTPAuth = true; // Sử dụng đăng nhập vào account
                    $mail->Host = "mail.iosia.net"; // Thiết lập thông tin của SMPT theo dòng Outgoing của bước 1
                    $mail->Port = 465; // Thiết lập cổng gửi email của máyv theo dòng Sever của bước 1
                    $mail->Username = "carrotshop@iosia.net"; // SMTP account username mà bạn đã tạo trên host cPanel
                    $mail->Password = "vythao2109!@#"; // SMTP account password mà bạn đã tạo trên host cPanel
                    //Thiet lap thong tin nguoi gui va email nguoi gui
                    $mail->setFrom("carrotshop@iosia.net", "CarrotShop");
                    //Thiết lập thông tin người nhận
                    $mail->addAddress($useremail, "Xin chào!");
                    //Thiết lập email nhận email hồi đáp
                    //nếu người nhận nhấn nút Reply
                    $mail->AddReplyTo("carrotshop@iosia.net","Customer Feedback");
                    /*=====================================
                    * THIET LAP NOI DUNG EMAIL
                    *=====================================*/
                    //Thiết lập tiêu đề
                    $mail->Subject = "CarrotShop đã nhận đơn hàng";
                    //Thiết lập định dạng font chữ
                    $mail->CharSet = "utf-8";
                    //Thiết lập nội dung chính của email
                    $body = "Đơn hàng #".$data['orderinfor_id']." đặt thành công.
                    ----------
                    Bạn sẽ nhận được hàng trong thời gian sớm nhất.
                    
                    Cảm ơn bạn đã mua hàng của CarrotShop. 
                    
                    Hẹn gặp lại!.
                        
                    Xem chi tiết: "."http://iosia.net/product/view/".$data['product_id'];
                    $mail->Body = $body;
                    if (!$mail->send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo();
                    } else {
                        echo "Message sent!";
                    }
                    redirect(site_url());
                } //thanh toan bang cong thanh toan
                elseif (in_array($payment, array('nganluong', 'baokim'))) {
                    $this->load->library('payment/' . $payment . '_payment');
                    //chuyen sang cong thanh toan
                    $this->{$payment . '_payment'}->payment($orderinfor_id, $total_amount);
                }
            }
        }
        $this->data['temp'] = 'site/order/checkout';
        $this->load->view('site/layout_master', $this->data);
    }

    //nhan ket qua tu cong thanh toan
    function result()
    {
        $this->load->library('payment/Baokim_payment');
        $this->load->model('Order_infor_model');

        //id cua giao dich
        $tran_id = $this->input->post('order_id');
        //lay thong tin giao dich
        $order = $this->Order_infor_model->get_infor($tran_id);
        if (!$order) {
            redirect();
        }
        $status = $this->Baokim_payment->result($tran_id, $order->ammount);
        if ($status == true) {
            //cap nhat don hang da thanh toan
            $data = array();
            $data['status'] = 1;
            $this->Order_infor_model->update($tran_id, $data);
        } elseif ($status == false) {
            //cap nhat don hang la ko thanh toan that bai
            $data = array();
            $data['status'] = 2;
            $this->Order_infor_model->update($tran_id, $data);
        }
    }

    function emailphp()
    {

    }
}