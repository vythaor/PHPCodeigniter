<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/17/2017
 * Time: 2:04 AM
 */
Class Upload_library{
    var $CI = '';
    function __construct()
    {
        $this->CI = & get_instance();
    }
    /*
     * @$upload_path : duong dan luu file
     * @$file_name : ten the input upload file
     * */
    function upload($upload_path = '', $file_name = ''){
        $config = $this->config($upload_path);
        $this->CI->load->library('upload', $config);
        //thuc hien upload
        if($this->CI->upload->do_upload($file_name)){
            $data = $this->CI->upload->data();
        }
        else{
            $data = $this->CI->upload->display_errors();
        }
        return $data;
    }
    /*upload nhieu file*/
    function upload_file($upload_path = '', $file_name ='')
    {
        //lay thong tin cau hinh upload
        $config = $this->config($upload_path);
        //luu bien moi truong khi thuc hien upload
        $file = $_FILES['image_list'];
        $count = count($file['name']);
        $image_list = array();//luu ten file anh up thanh cong
        for ($i=0; $i<=$count-1;$i++){
            $_FILES['userfile']['name'] = $file['name'][$i];
            $_FILES['userfile']['type'] = $file['type'][$i];
            $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i];
            $_FILES['userfile']['error'] = $file['error'][$i];
            $_FILES['userfile']['size'] = $file['size'][$i];
            //load thu vien va cau hinh
            $this->CI->load->library('upload', $config);
            //thuc hien load tung file
            if ($this->CI->upload->do_upload()){
                //upload thanh cong luu du lieu
                $data = $this->CI->upload->data();
                $image_list[] = $data['file_name'];
            }
        }
        return $image_list;
    }
    function config($upload_path = ''){
        //khai bao bien cau hinh
        $config = array();
        //thu muc chua file
        $config['upload_path'] = $upload_path;
        //dinh dang duoc phep tai
        $config['allowed_types'] = 'jpg|png|gif';
        //max size
        $config['max_size'] = '1200';
        //chieu rong max
        $config['max_width'] = '1028';
        //chieu cao max
        $config['max_height'] = '1028';

        return $config;
    }

}