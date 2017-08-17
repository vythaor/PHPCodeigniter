<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 5/19/2017
 * Time: 3:41 PM
 */
//goi thu vien
include('class.smtp.php');
include "class.phpmailer.php";
$nFrom = "CarrotShop";    //mail duoc gui tu dau, thuong de ten cong ty ban
$mFrom = '';  //dia chi email cua ban
$mPass = '';       //mat khau email cua ban
$nTo = 'Thao'; //Ten nguoi nhan
$mTo = '0h00trangtron@gmail.com';   //dia chi nhan mail
$mail = new PHPMailer();
$body = 'test mail auto';   // Noi dung email
$title = 'Thông báo đơn hàng';   //Tieu de gui mail
$mail->IsSMTP();
$mail->CharSet = "utf-8";
$mail->SMTPDebug = 0;   // enables SMTP debug information (for testing)
$mail->SMTPAuth = true;    // enable SMTP authentication
$mail->SMTPSecure = "ssl";   // sets the prefix to the servier
$mail->Host = "smtp.gmail.com";    // sever gui mail.
$mail->Port = 465;         // cong gui mail de nguyen
// xong phan cau hinh bat dau phan gui mail
$mail->Username = $mFrom;  // khai bao dia chi email
$mail->Password = $mPass;              // khai bao mat khau
$mail->SetFrom($mFrom, $nFrom);
$mail->AddReplyTo('vythao219@gmail.com', 'Vy Thao'); //khi nguoi dung phan hoi se duoc gui den email nay
$mail->Subject = $title;// tieu de email
$mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
$mail->AddAddress($mTo, $nTo);
// thuc thi lenh gui mail
if (!$mail->Send()) {
    echo 'Co loi!';

} else {

    echo 'mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả. ';
}
?>