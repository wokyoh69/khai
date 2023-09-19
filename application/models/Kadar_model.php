<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kadar_model extends CI_Model
{

    public $table = 'tbl_kadar_yuran';
    public $id = 'yid';
    public $order = 'ASC';

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

    // get all
    function get_all_active()
    {
        $this->db->where('status',"Aktif");
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // get all
    function get_all_status($status)
    {
        $this->db->where("status", $status); 
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get id by year
    function get_id_by_year($year)
    {
        $this->db->select('yid');
        $this->db->where("y_tahun", $year);
        $result = $this->db->get('tbl_kadar_yuran')->row();  
        return $result->yid;
    }


    function get_amount($id)
    {
        $this->db->select('y_jumlah');
        $this->db->where($this->id, $id); //administrator
        $result = $this->db->get('tbl_kadar_yuran')->row();  
        return $result->y_jumlah; 
    }

    function get_amount_current_year($year)
    {
        $this->db->select('y_jumlah');
        $this->db->where('y_tahun', $year); //administrator
        $result = $this->db->get('tbl_kadar_yuran')->row();  
        return $result->y_jumlah; 
    }

    function get_amount_daftar($yid,$column,$table)
    {
        $this->db->select($column);
        $this->db->from($table);
        $this->db->where('yid', $yid);
        return $this->db->get()->row()->$column;
    }

    function get_amount_pakej($year,$column,$table)
    {
        $this->db->select($column);
        $this->db->from($table);
        $this->db->where('y_tahun', $year);
        return $this->db->get()->row()->$column;
    }

    function get_amount_lifetime($yid)
    {
        $this->db->select('y_jumlah');
        $this->db->where('yid', $yid); //id seumur hidup
        $result = $this->db->get('tbl_kadar_yuran')->row();  
        return $result->y_jumlah; 
    }

     function get_year($id)
    {
        $this->db->select('y_tahun');
        $this->db->where($this->id, $id); //administrator
        $result = $this->db->get('tbl_kadar_yuran')->row();  
        return $result->y_tahun; 
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('yid', $q);
        $this->db->or_like('y_title', $q);
	$this->db->or_like('y_tahun', $q);
	$this->db->or_like('y_jumlah', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('yid', $q);
	$this->db->or_like('y_tahun', $q);
	$this->db->or_like('y_jumlah', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function checkYearExist($year)
    {
        $this->db->select("y_tahun");
        $this->db->from("tbl_kadar_yuran");
        $this->db->where("y_tahun", $year);   
        $query = $this->db->get();
        //return $query->result();
        //$query = $this->db->get();
        if ($query->num_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
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

    function exportList($yid) 
    {
        $this->db->select(array('Pmt.p_id', 'Pmt.p_date', 'Pmt.userid', 'Pmt.yid', 'Pmt.catatan', 'Pmt.amaun', 'Pmt.total_amaun', 'Pmt.status as statusbayaran', 'Yur.y_tahun', 'Usr.userId', 'Usr.name','Usr.noAhli', 'Usr.icno', 'Usr.status', 'Usr.ahli_khairat','Yur.y_title'));
        $this->db->from('payment as Pmt');
        $this->db->join('tbl_users as Usr', 'Pmt.userid = Usr.userId','left');
        $this->db->join('tbl_kadar_yuran as Yur', 'Pmt.yid = Yur.yid','left');
        $this->db->where('Pmt.yid', $yid);
        $this->db->order_by('Usr.name','ASC');

        $query = $this->db->get();
        return $query->result();
    }
/*
    function get_year($yid){

        $this->db->select('y_tahun');
        $this->db->where('y_id', $yid); 
        $result = $this->db->get('tbl_kadar_yuran')->row();  
        return $result->y_tahun; 
    }


    function paymentListing($searchText = '', $page, $segment)
    {
        $this->db->select('Pmt.p_id, Pmt.p_date, Pmt.userid, Pmt.yid, Pmt.catatan, Pmt.amaun, Pmt.status as statusBayar, Yur.y_tahun, Usr.userId, Usr.name, Usr.icno, Usr.status, Yur.y_title');
        $this->db->from('payment as Pmt');
        $this->db->join('tbl_users as Usr', 'Pmt.userid = Usr.userId','left');
        $this->db->join('tbl_kadar_yuran as Yur', 'Pmt.yid = Yur.yid','left');
        if(!empty($searchText)) {
            $likeCriteria = "(Pmt.status  LIKE '%".$searchText."%'
                            OR  Usr.name  LIKE '%".$searchText."%'
                            OR  Usr.icno  LIKE '%".$searchText."%'
                            OR  Yur.y_tahun  LIKE '%".$searchText."%'
                            OR  Pmt.status  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('Usr.isDeleted', 0);
        $this->db->where('Usr.userId !=', 0);
        $this->db->where('Usr.status =', "Aktif");
        $this->db->order_by('Pmt.p_date','DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    */

}

/* End of file Kadar_model.php */
/* Location: ./application/models/Kadar_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-01 18:12:55 */
/* http://harviacode.com */