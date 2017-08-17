<?php if(!defined('BASEPATH')) exit('error!!?');
/**
 * Created by PhpStorm.
 * User: vy_Thao
 * Date: 3/29/2017
 * Time: 2:41 AM
 */
Class MY_Model extends CI_Model{
    //ten bang
    var $table ='';
    //khoa chinh cua bang
    var $key ='id';
    //sap xep
    var $order = '';
    //cot du lieu can lay cho ham get_list
    var $select ='';

    //them moi du lieu (theo row), data: du lieu can them
    function create($data = array()){
        if($this->db->insert($this->table, $data)){ //db trong thu vien
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    //cap nhat theo id
    function update($id, $data){
        if (!$id){
            return FALSE;
        }
        $where = array();//dieu kien thuc hien
        $where[$this->key] = $id; //khoa chinh = khoa chinh truyen vao
        $this->update_rule($where, $data);

        return TRUE;
    }
    //where: dieu kien
    function update_rule($where, $data){
        if (!$where){
            return FALSE;
        }
        $this->db->where($where);
        $this->db->update($this->table, $data);

        return TRUE;
    }
    function delete($id){
        if(!$id){
            return FALSE;
        }
        if(is_numeric($id)){
            $where = array($this->key=>$id);
        }else
        {
            $where = $this->key . " IN (".$id.")";// xoa nhieu, 1 chuoi du lieu
        }
        $this->del_rule($where);
        return TRUE;
    }
    //xoa theo dieu kien
    function del_rule($where){
        if(!$where){
            return FALSE;
        }
        $this->db->where($where);
        $this->db->delete($this->table);

        return TRUE;
    }
    //doi voi cac cau truy van phuc tap
    function query($sql){
        $row = $this->db->query($sql);
        return $row->result;
    }
    //select data
    //id can lay thong tin
    //field cot du lieu can lay
    function get_infor($id, $field=''){
        if(!$id){
            return FALSE;
        }
        $where = array();
        $where[$this->key] = $id;

        return $this->get_infor_rule($where, $field);
    }
    function get_infor_rule($where = array(), $field=''){
        if($field){
            $this->db->select($field);
        }
        $this->db->where($where);
        $query = $this->db->get($this->table);
        if($query->num_rows()){
            return $query->row();
        }
        return FALSE;
    }
    //lay tong so
    function get_total($input = array()){
        $this->get_list_set_input($input);

        $query = $this->db->get($this->table);

        return $query->num_rows();
    }

    /**
     * Lay tong so
     * $field: cot muon tinh tong
     */
    function get_sum($field, $where = array())
    {
        $this->db->select_sum($field);//tinh rong
        $this->db->where($where);//dieu kien
        $this->db->from($this->table);

        $row = $this->db->get()->row();
        foreach ($row as $f => $v)
        {
            $sum = $v;
        }
        return $sum;
    }

    /**
     * Lay 1 row
     */
    function get_row($input = array()){
        $this->get_list_set_input($input);

        $query = $this->db->get($this->table);

        return $query->row();
    }

    /**
     * Lay danh sach
     * $input : mang cac du lieu dau vao
     */
    function get_list($input = array())
    {
        //xu ly ca du lieu dau vao
        $this->get_list_set_input($input);

        //thuc hien truy van du lieu
        $query = $this->db->get($this->table);
        //echo $this->db->last_query();
        return $query->result();
    }

    /**
     * Gan cac thuoc tinh trong input khi lay danh sach
     * $input : mang du lieu dau vao
     */

    protected function get_list_set_input($input = array())
    {

        // Thêm điều kiện cho câu truy vấn truyền qua biến $input['where']
        //(vi du: $input['where'] = array('email' => 'hocphp@gmail.com'))
        if ((isset($input['where'])) && $input['where'])
        {
            $this->db->where($input['where']);
        }

        //tim kiem like
        // $input['like'] = array('name' => 'abc');
        if ((isset($input['like'])) && $input['like'])
        {
            $this->db->like($input['like'][0], $input['like'][1]);
        }

        // Thêm sắp xếp dữ liệu thông qua biến $input['order']
        //(ví dụ $input['order'] = array('id','DESC'))
        if (isset($input['order'][0]) && isset($input['order'][1]))
        {
            $this->db->order_by($input['order'][0], $input['order'][1]);
        }
        else
        {
            //mặc định sẽ sắp xếp theo id giảm dần
            $order = ($this->order == '') ? array($this->table.'.'.$this->key, 'desc') : $this->order;
            $this->db->order_by($order[0], $order[1]);
        }

        // Thêm điều kiện limit cho câu truy vấn thông qua biến $input['limit']
        //(ví dụ $input['limit'] = array('10' ,'0'))
        if (isset($input['limit'][0]) && isset($input['limit'][1]))
        {
            $this->db->limit($input['limit'][0], $input['limit'][1]);
        }

    }

    /**
     * kiểm tra sự tồn tại của dữ liệu theo 1 điều kiện nào đó
     * $where : mang du lieu dieu kien
     */
    function check_exists($where = array())
    {
        $this->db->where($where);
        //thuc hien cau truy van lay du lieu
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}