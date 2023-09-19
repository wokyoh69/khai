<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Khairat_model extends CI_Model
{

    public $table = 'khairat';
    public $id = 'k_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function getKhairatRecord($userid)
    {
        //$this->db->where('userid', $userid);
        //$this->db->order_by($this->id, $this->order);
        //return $this->db->get($this->table)->result();

        /*$this->db->select('a.p_id,a.p_date,a.userid,a.yid,a.amaun,a.catatan, a.status, a.attachment,b.yid,b.y_title,b.y_tahun');
        $this->db->from('payment a');
        $this->db->join('tbl_kadar_yuran b','a.yid=b.yid','inner');
        $this->db->where('a.userid', $userid);
        $this->db->order_by('a.p_id', 'DESC');*/

        $this->db->select('Kh.k_id, Kh.k_date, Kh.userid, Kh.k_catatan, Kh.k_jenis, Kh.k_amaun, Kh.updatedBy, Kh.updatedDtm, Usr.userId, Usr.name,');
        $this->db->from('khairat Kh');
        $this->db->join('tbl_users Usr','Kh.userid=Usr.userId','inner');
        $this->db->where('Kh.userid', $userid);
        $this->db->order_by('Kh.k_date', 'DESC');


        $query=$this->db->get()->result();
        return $query;
    }

    function getKhairatCount($userId)
    {
        $this->db->select('*');
        $this->db->from('khairat');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        return $query->num_rows(); 
        
        return $query->result();
    }

    /*function get_all_join()
    {
        $this->db->select('Kh.k_id, Kh.k_date, Kh.userid, Kh.k_catatan, Kh.k_amaun, Usr.userId, Usr.name, Usr.icno, Usr.status');
        $this->db->from('khairat as Kh');
        $this->db->join('tbl_users Usr','Kh.userid=Usr.userId','left');
        $this->db->where('Usr.status =', "Aktif");
        $this->db->order_by('Kh.k_date','DESC');
        //$this->db->select('tbl_user.username,tbl_user.userid,tbl_usercategory.type');
        //$this->db->from('tbl_user');
        //$this->db->join('tbl_usercategory','tbl_usercategory.usercategoryid=tbl_user.usercategoryid','inner');
        $query=$this->db->get()->result();
        return $query;
    }*/

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->select('Kh.k_id, Kh.k_date, Kh.userid, Kh.k_catatan, Kh.k_jenis, Kh.k_amaun, Usr.userId, Usr.name, Usr.icno, Usr.status');
        $this->db->from('khairat as Kh');
        $this->db->join('tbl_users as Usr', 'Kh.userid = Usr.userId','left');
        $this->db->where('Usr.isDeleted', 0);
        $this->db->where('Usr.userId !=', 0); //pentadbir sistem
        $this->db->where('Usr.status =', "Aktif");
        $this->db->order_by('Kh.k_date','DESC');

        //$this->db->order_by($this->id, $this->order);
        $this->db->like('Usr.name', $q);
        //$this->db->like('k_id', $q);
        //$this->db->or_like('k_date', $q);
        //$this->db->or_like('userid', $q);
        //$this->db->or_like('k_amaun', $q);
        $this->db->or_like('Kh.k_catatan', $q);
        $query = $this->db->get();
        return $query->num_rows();

        /*$this->db->like('k_id', $q);
    	$this->db->or_like('k_date', $q);
    	$this->db->or_like('userid', $q);
    	$this->db->or_like('k_amaun', $q);
    	$this->db->or_like('k_catatan', $q);
    	$this->db->or_like('updatedBy', $q);
    	$this->db->or_like('updatedDtm', $q);
    	$this->db->from($this->table);
        return $this->db->count_all_results();*/
        
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {

        $this->db->select('Kh.k_id, Kh.k_date, Kh.userid, Kh.k_jenis, Kh.k_catatan, Kh.k_jenis, Kh.k_amaun, Usr.userId, Usr.name, Usr.icno, Usr.status');
        $this->db->from('khairat as Kh');
        $this->db->join('tbl_users as Usr', 'Kh.userid = Usr.userId','left');
        $this->db->where('Usr.isDeleted', 0);
        $this->db->where('Usr.userId !=', 0); //pentadbir sistem
        $this->db->where('Usr.status =', "Aktif");
        $this->db->order_by('Kh.k_date','DESC');

        //$this->db->order_by($this->id, $this->order);
        $this->db->like('Usr.name', $q);
        //$this->db->like('k_id', $q);
    	//$this->db->or_like('k_date', $q);
    	//$this->db->or_like('userid', $q);
    	//$this->db->or_like('k_amaun', $q);
    	$this->db->or_like('Kh.k_catatan', $q);
    	//$this->db->or_like('updatedBy', $q);
    	//$this->db->or_like('updatedDtm', $q);
    	$this->db->limit($limit, $start);
        //return $this->db->get($this->table)->result();

        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Khairat_model.php */
/* Location: ./application/models/Khairat_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-04 15:58:08 */
/* http://harviacode.com */