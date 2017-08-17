<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 5/19/2017
 * Time: 3:24 PM
 */
require_once('class.phpmailer.php');

Class Email
{
    function email()
    {
        $mail = new Email();
        $mail->SMTPDebug = 2; // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
        $mail->SMTPAuth = true; // Sử dụng đăng nhập vào account
        $mail->Host = "mail.iosia.net"; // Thiết lập thông tin của SMPT theo dòng Outgoing của bước 1
        $mail->Port = 25; // Thiết lập cổng gửi email của máyv theo dòng Sever của bước 1
        $mail->Username = "carrotshop@iosia.net"; // SMTP account username mà bạn đã tạo trên host cPanel
        $mail->Password = "vythao2109!@#"; // SMTP account password mà bạn đã tạo trên host cPanel
        //Thiet lap thong tin nguoi gui va email nguoi gui
        $mail->SetFrom('carrotshop@iosia.net', 'CarrotShop');
        //Thiết lập thông tin người nhận
        $mail->AddAddress("0h00trangtron@gmail.com", "Admin VPS");
        //Thiết lập email nhận email hồi đáp
        //nếu người nhận nhấn nút Reply
        $mail->AddReplyTo("vythao219@gmail.com","VyThao");
        /*=====================================
        * THIET LAP NOI DUNG EMAIL
        *=====================================*/
        //Thiết lập tiêu đề
        $mail->Subject = "CarrotShop";
        //Thiết lập định dạng font chữ
        $mail->CharSet = "utf-8";
        //Thiết lập nội dung chính của email
        $body = "Chaof";
        $mail->Body = $body;
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
            }
}