<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kadar_family_model extends CI_Model
{

    public $table = 'tbl_kadar_yuran_family';
    public $id = 'yf_id';
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
    function get_family()
    {
        $this->db->where('yf_id !=',1); // 1=AHLI
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('yf_id', $q);
	$this->db->or_like('yf_name', $q);
	$this->db->or_like('yf_agelimit', $q);
	$this->db->or_like('yf_desc', $q);
	$this->db->or_like('yf_jumlah', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('yf_id', $q);
	$this->db->or_like('yf_name', $q);
	$this->db->or_like('yf_agelimit', $q);
	$this->db->or_like('yf_desc', $q);
	$this->db->or_like('yf_jumlah', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

/* End of file Kadar_family_model.php */
/* Location: ./application/models/Kadar_family_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-10 10:06:38 */
/* http://harviacode.com */