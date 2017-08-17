<?php
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 4/17/2017
 * Time: 4:21 PM
 * @$time : int thoi gian muon hien thi ngay
 * @$full_time : lay h,m,s
 */
function get_date($time, $full_time= true){
    $fomart = '%d-%m-%Y';
    if($full_time){
        $fomart = $fomart.' - %H:%i:%s';
    }
    $date = mdate($fomart, $time);
    return $date;
}
/*
 * lay thong tin thoi gian*/
function get_time_infor($time = ''){
    $time = (!time) ? now() : $time;

    $infor = array();
    $infor['d'] = intval(mdate('%d', $time));
    $infor['m'] = intval(mdate('%m', $time));
    $infor['y'] = intval(mdate('%Y', $time));
    $infor['h'] = intval(mdate('%H', $time));
    $infor['mi'] = intval(mdate('%i', $time));
    $infor['s'] = intval(mdate('%s', $time));

    return $infor;
}
//tinh thoi gian quy ra giay tu ngay thang nam
function get_time_between($date, $type =''){
    if(!$date){
        return FALSE;
    }
    $time = explode('-', $date);
    if(count($time) < 3){
        return FALSE;
    }
    $d = $time[0];
    $m = $time[1];
    $y = $time[2];
    if($type == ''){
        $time_start = mktime(0,0,0,$m, $d, $y);
        $time_end = mktime(24, 0, 0,$m, $d, $y);
    }
    else{
        $time_start = mktime(0, 0,0,$m, 1, $y);//lay thoi gian bat dau trong thang do
        if($m == '12'){
            $m = 0;
            $y = $y + 1;
        }
        $time_end = mktime(0,0,0, $m+1, 1, $y);//lay tg ket thuc trong thang do
    }
    $data = array('start' => $time_start, 'end' => $time_end);
    return $data;
}
function get_time_between_day($date, $date1 = ''){
    if(!$date1){
        $date1 = $date;
    }
    //lay ngay bat dau
    $time  = explode('-', $date);
    if(count($time) < 3){
        return FALSE;
    }
    $d = $time[0];
    $m = $time[1];
    $y = $time[2];
    //lay ngay ket thuc
    $time1 = explode('-', $date1);
    if(count($time1) < 3){
        return FALSE;
    }
    $d1 = $time1[0];
    $m1 = $time1[1];
    $y1 = $time1[2];

    $time_start = mktime(0,0,0, $m, $d, $y);
    $time_end = mktime(24, 0,0, $m1, $d1, $y1);

    $data = array('start' => $time_start, 'end' => $time_end);
    return $data;
}