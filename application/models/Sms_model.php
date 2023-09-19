<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms_model extends CI_Model
{

    public $table = 'sms_log';
    public $table_ewallet = 'sms_ewallet';
    public $table_smspayment = 'sms_payment';
    public $id = 'sms_id';
    public $sgid = 'sg_id';
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

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by id
    function get_sms_gateway($id)
    {
        $this->db->where($this->sgid, $id);
        return $this->db->get('sms_gateway')->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('sms_id', $q);
	$this->db->or_like('userid', $q);
	$this->db->or_like('phone', $q);
	$this->db->or_like('sms_code', $q);
    $this->db->or_like('sms_desc', $q);
    $this->db->or_like('sms_cost', $q);
	$this->db->or_like('message', $q);
	$this->db->or_like('createDtm', $q);
	$this->db->or_like('createdBy', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('sms_id', $q);
	$this->db->or_like('userid', $q);
	$this->db->or_like('phone', $q);
	$this->db->or_like('sms_code', $q);
    $this->db->or_like('sms_desc', $q);
    $this->db->or_like('sms_cost', $q);
	$this->db->or_like('message', $q);
	$this->db->or_like('createDtm', $q);
	$this->db->or_like('createdBy', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    /*
    function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->select('Wam.sms_id, Wam.userid, Wam.phone, Wam.sms_code, Wam.message, Wam.createDtm, Wam.createdBy, Usr.userid, Usr.name');
        $this->db->from('sms_message as Wam');
        $this->db->join('tbl_users as Usr', 'Usr.userId = Wam.userid','left');

    $this->db->order_by($this->id, $this->order);
    $this->db->like('Wam.sms_id', $q);
    $this->db->or_like('Usr.userid', $q);
    $this->db->or_like('Usr.name', $q);
    $this->db->or_like('Wam.phone', $q);
    $this->db->or_like('Wam.sms_code', $q);
    $this->db->or_like('Wam.message', $q);
    $this->db->or_like('Wam.createDtm', $q);
    $this->db->or_like('Wam.createdBy', $q);
    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    */
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // insert data
    function insert_ewallet($data)
    {
        $this->db->insert($this->table_ewallet, $data);
    }

    // insert data
    function insert_smspayment($data)
    {
        $this->db->insert($this->table_smspayment, $data);
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

    function get_credits($ewtype){

        $this->db->select_sum('ew_credit');
        $this->db->where("ew_type",$ewtype);
        $result = $this->db->get('sms_ewallet')->row();  
        return $result->ew_credit; 
    }

    function get_sms_sent($smscode)
    {
        
        $this->db->select('*');
        $this->db->from('sms_log');
        $this->db->where('sms_code', $smscode);
        $query = $this->db->get();
        return $query->num_rows(); 
    }
        
    function getLatestSMS()
    {
        $this->db->select_max('sms_id');
        $this->db->from('sms_log');
        $query = $this->db->get();
     
         if ($query->num_rows() == 1) {
            return $query->row('sms_id');
          } else {
            return 0;
          }  
    }

    function getLatestSMSPayment()
    {
        $this->db->select_max('smsp_id');
        $this->db->from('sms_payment');
        $query = $this->db->get();
     
         if ($query->num_rows() == 1) {
            return $query->row('smsp_id');
          } else {
            return 0;
          }  
    }

    function getSmsPaymentRecord()
    {
        $this->db->select('a.smsp_id,a.smsp_date,a.userid,a.amaun,a.status,a.pg_billcode,a.pg_msg,a.catatan,a.createDtm,b.name');
        $this->db->from('sms_payment a');
        $this->db->join('tbl_users b','b.userId=a.userid','inner');
        $this->db->order_by('a.smsp_date', 'DESC');

        $query=$this->db->get()->result();
        return $query;
    }

    function generateOTP($digits) {
        $numbers = '0123456789';
        $OTP = '';
        for ($i = 0; $i < $digits; $i++) {
            $OTP .= $numbers[rand(0, 9)];
        }
        return $OTP;
    }
       


    /*
    //Sms Call Me Bot
    // get data by id
    function get_wa_id($wid)
    {
        $this->db->where('wa_id', $wid);
        return $this->db->get('wa_callmebot')->row();
    }

    //Sms Wamessengger
    // get data by id
    function get_sms_id($wid)
    {
        $this->db->where('w_id', $wid);
        return $this->db->get('sms_host')->row();
    }

    // insert data
    function insert_sms($data)
    {
        $this->db->insert('sms_message', $data);
    }
    */
}

/* End of file Sms_model.php */
/* Location: ./application/models/Sms_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-03-27 00:45:13 */
/* http://harviacode.com */