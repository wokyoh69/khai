<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_model extends CI_Model
{

    public $table = 'payment';
    public $table_details = 'payment_details';
    public $id = 'p_id';
    public $pfid = 'pf_id';
    public $order = 'DESC';
    public $userid = 'userid';

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
    function get_payment_belum_selesai($userid)
    {
        $this->db->select('Pmt.p_id, Pmt.p_date, Pmt.userid, Pmt.yid, Pmt.catatan, Pmt.amaun, Pmt.status, Yur.yid, Yur.y_title, Yur.y_tahun, Yur.y_jumlah, Yur.status');
        $this->db->from('payment as Pmt');
        //$this->db->join('tbl_users as Usr', 'Pmt.userid = Usr.userId','left');
        $this->db->join('tbl_kadar_yuran as Yur', 'Pmt.yid = Yur.yid','left');
        $this->db->where('Pmt.userid', $userid);
        //$this->db->where('Pmt.status', 'Belum Selesai');
        $this->db->order_by('Pmt.p_id', $this->order);

        $query = $this->db->get();
        return $query->result();
        //echo $query->num_rows();
        //exit();
        //return $this->db->get($this->table)->result();
    }


     
    function paymentListingCount($searchText = '')
    {
        $this->db->select('Pmt.p_id, Pmt.p_date, Pmt.userid, Pmt.yid, Pmt.amaun, Pmt.total_amaun, Pmt.status as statusBayar, Pmt.pg_billcode, Yur.y_tahun, Usr.userId, Usr.name, Usr.icno, Usr.status, Yur.y_title');
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
        //$this->db->where('Usr.isDeleted', 0);
        $this->db->where('Usr.userId !=', 0);
        $this->db->where('Usr.status =', "Aktif");
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function paymentListing($searchText = '', $page, $segment)
    {
        $this->db->select('Pmt.p_id, Pmt.p_date, Pmt.userid, Pmt.yid, Pmt.catatan, Pmt.amaun, Pmt.total_amaun, Pmt.status as statusBayar, Pmt.pg_billcode, Yur.y_tahun, Usr.userId, Usr.name, Usr.icno, Usr.status, Yur.y_title');
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
        //$this->db->where('Usr.isDeleted', 0);
        $this->db->where('Usr.userId !=', 0);
        $this->db->where('Usr.status =', "Aktif");
        $this->db->order_by('statusBayar','DESC');
        $this->db->order_by('Pmt.updatedDtm','DESC');
         $this->db->order_by('Yur.y_tahun','DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

/*
    function paymentListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.phone, BaseTbl.status, Pmt.status');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('payment as Pmt', 'Pmt.userid = BaseTbl.userId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.icno  LIKE '%".$searchText."%'
                            OR  Pmt.status  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status =', "Aktif");
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
*/
     // get all
    function getPaymentRecord($userid)
    {
        //$this->db->where('userid', $userid);
        //$this->db->order_by($this->id, $this->order);
        //return $this->db->get($this->table)->result();

        $this->db->select('a.p_id,a.p_date,a.userid,a.yid,a.amaun,a.total_amaun,a.catatan,a.status,a.updatedBy,a.updatedDtm,a.attachment,a.createDtm,a.pg_billcode,b.yid,b.y_title,b.y_tahun,c.name');
        $this->db->from('payment a');
        $this->db->join('tbl_kadar_yuran b','a.yid=b.yid','inner');
        $this->db->join('tbl_users c','c.userId=a.updatedBy','inner');
        $this->db->where('a.userid', $userid);
        $this->db->order_by('b.y_tahun', 'DESC');
        $this->db->order_by('a.createDtm', 'DESC');

        $query=$this->db->get()->result();
        return $query;
    }

     // get all
    function getPaymentRecord_fpx($userid)
    {
        //$this->db->where('userid', $userid);
        //$this->db->order_by($this->id, $this->order);
        //return $this->db->get($this->table)->result();

        $this->db->select('a.p_id,a.p_date,a.userid,a.yid,a.amaun,a.total_amaun,a.catatan,a.status,a.updatedBy,a.updatedDtm,a.attachment,a.createDtm,a.pg_billcode,b.yid,b.y_title,b.y_tahun,c.name');
        $this->db->from('payment a');
        $this->db->join('tbl_kadar_yuran b','a.yid=b.yid','inner');
        $this->db->join('tbl_users c','c.userId=a.updatedBy','inner');
        $this->db->where('a.userid', $userid);
        $this->db->where('a.status', "Belum Selesai");
        $this->db->order_by('b.y_tahun', 'DESC');
        $this->db->order_by('a.createDtm', 'DESC');

        $query=$this->db->get()->result();
        return $query;
    }

    function gePayment($pid)
    {

        $this->db->select('a.pf_id, a.userid, a.amaun, a.catatan, a.status, a.createDtm');
        $this->db->from('payment_details a');
        $this->db->join('tbl_users b','a.userid=b.userId','inner');
        $this->db->where('a.p_id', $pid);
        //$this->db->where('a.status', "Belum Selesa");
        //$this->db->order_by('b.y_tahun', 'DESC');

        $query=$this->db->get()->result();
        return $query;
    }

    function gePaymentDetail_ahli($pid,$userid)
    {

        $this->db->select('a.pf_id, a.p_id, a.f_id, a.amaun, a.catatan, a.status, a.createDtm, 
            b.name, b.icno');
        $this->db->from('payment_details a');
        $this->db->join('tbl_users b','a.userid=b.userId','inner');
        $this->db->where('a.p_id', $pid);
        $this->db->where('a.userid', $userid);
        $this->db->where('a.f_id', 0);

        $query=$this->db->get()->result();
        return $query;
    }

    function gePaymentDetail($pid)
    {

        $this->db->select('a.pf_id, a.p_id, a.f_id, a.amaun, a.catatan, a.status, a.createDtm, 
            b.f_name, b.f_pertalian, b.approval, b.f_icno');
        $this->db->from('payment_details a');
        $this->db->join('tbl_users_family b','a.f_id=b.f_id','inner');
        $this->db->where('a.p_id', $pid);
        //$this->db->where('a.status', "Belum Selesai");
        //$this->db->order_by('b.y_tahun', 'DESC');

        $query=$this->db->get()->result();
        return $query;
    }

    function gePaymentDetailbyUser($userid)
    {

        $this->db->select('f_id, f_name, f_icno, f_pertalian, createDtm, approval');
        $this->db->from('tbl_users_family');
        $this->db->where('approval', "Y");
        $this->db->where('userid', $userid);
        $this->db->where('f_id NOT IN (SELECT f_id FROM payment_details)');

        $query=$this->db->get()->result();
        return $query;
    }

    //get_latest_amount

    // get inner join()
    function get_all_join()
    {
        $this->db->select('a.p_date,a.userid,a.yid,a.status,b.userId,b.name');
        $this->db->from('payment a');
        $this->db->join('tbl_users b','b.userId=a.userid','inner');

        //$this->db->select('tbl_user.username,tbl_user.userid,tbl_usercategory.type');
        //$this->db->from('tbl_user');
        //$this->db->join('tbl_usercategory','tbl_usercategory.usercategoryid=tbl_user.usercategoryid','inner');
        $query=$this->db->get()->result();
        return $query;
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    function get_by_userid($userid)
    {
        $this->db->where($this->userid, $userid);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('p_id', $q);
	$this->db->or_like('p_date', $q);
	$this->db->or_like('userid', $q);
	$this->db->or_like('yid', $q);
	//$this->db->or_like('attachment', $q);
	$this->db->or_like('status', $q);
	//$this->db->or_like('catatan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        //$this->db->order_by($this->id, $this->order);
        $this->db->order_by('p_date', $this->order);
        $this->db->like('p_id', $q);
	$this->db->or_like('p_date', $q);
	$this->db->or_like('userid', $q);
	$this->db->or_like('yid', $q);
	//$this->db->or_like('attachment', $q);
	$this->db->or_like('status', $q);
	//$this->db->or_like('catatan', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }   

    // insert data
    function insert($data)
    {
        $this->db->set('p_date', 'NOW()', FALSE);
        $this->db->set('createDtm', 'NOW()', FALSE);
        $this->db->set('updatedDtm', 'NOW()', FALSE);
        $this->db->insert($this->table, $data);
    }

    // insert data
    function insert_details($data)
    {
        $this->db->set('createDtm', 'NOW()', FALSE);
        $this->db->insert($this->table_details, $data);
    }

      // insert data
    function insert_getnextid($data)
    {
        $this->db->insert($this->table, $data);
        $insertId = $this->db->insert_id();
        return  $insertId;
    }


    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function updateDetails($id, $data)
    { 
        //$this->db->where($this->f_id, $id);
        $this->db->where('p_id', $id);
        //$this->db->where('f_id', $fid);
        $this->db->update($this->table_details, $data);
    }

    function updatePayment($pid, $paymentInfo)
    {
        $this->db->where('p_id', $pid);
        $this->db->update('payment', $paymentInfo);
        
        return $this->db->affected_rows();
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete data
    function delete_details($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table_details);
    }

    // delete data
    function delete_payment_details($id)
    {
        $this->db->where($this->pfid, $id);
        $this->db->delete($this->table_details);
    }

    function get_next_payment_id() {
         $query = $this->db->query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_NAME ='payment'");
         if ($query->num_rows() == 1) {
            return $query->row('AUTO_INCREMENT');
          } else {
            return 0;
          }  
    }

    // generate data payment from Yuran Page
    function generate_payment($id)
    {
        $this->load->model('kadar_model');
        echo $amount = $this->kadar_model->get_amount($id);
        echo $year = $this->kadar_model->get_year($id);
        //exit();
        ///dapatkan semua id user ahli
        $this->load->model('user_model');

        if($year > 0){
            //$datauser = $this->user_model->getUserActiveSelectedYear($year);
            //$datauser = $this->user_model->getUserActiveByYear($year);
            //echo "Listing members from early untill year ".$year." only";
        //} else {
            $datauser = $this->user_model->getUserActive();
            echo "Listing all members ";
        }
        //exit();
        //$datauser_selected_year = $this->user_model->getUserActiveSelectedYear($year);
        foreach ($datauser as $ul) {
            // $ul->userId;
            //$uid = $ul->userId;
            //$yid = $ul->yid;

            // jika userid & yid belum ada generate payment, jika userid & yid dah ada skip insert.
            if($this->checkPaymentRecord($ul->userId,$id) == 0) { 
        
                $data = array( 
                    'userid'  =>  $ul->userId, 
                    'yid'=>  $id,
                    'amaun'=> $amount, 
                    'createDtm' =>  date("Y-m-d H:i:s")
                );
                
                $this->db->insert('payment', $data);
                //echo $ul->userId.",";
            }

        }//end foreach
        //exit();
        /////insert rekod  dalam table payment untuk semua ahli, by default status 'Belum Selesai'    
    }

    ////chek sama ada y_id dah generate dalam table payment
     function checkYuran($yid)
    {
        //$this->db->distinct();
        $this->db->select("yid");
        $this->db->from("payment");
        $this->db->where("yid", $yid);   
        //$this->db->where("isDeleted", 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }



    ////chek sama ada y_id & userid dah generate dalam table payment
     function checkPaymentRecord($uid,$yid)
    {
        //$this->db->distinct();
        $this->db->select("p_id");
        $this->db->from("payment");
        $this->db->where("userid", $uid);  
        $this->db->where("yid", $yid);   
        //$this->db->where("isDeleted", 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }



    /*countBilYuran*/
    function countPaymentRecord($uid,$yid){
        $this->db->select("p_id");
        $this->db->where("userid",$uid);
        $this->db->where('yid', $yid);
        $query = $this->db->get('payment');        
        return $query->num_rows();
    }

    function get_total_amount(){

        $this->db->select_sum('total_amaun');
        $this->db->where("status",'Selesai');
        $this->db->where('userId !=', 0); //administrator
        $result = $this->db->get('payment')->row();  
        return $result->total_amaun; 
    }


    //SELECT SUM(amaun)as JUM_AMAUN FROM payment_details WHERE p_id = '31' 
    function get_latest_amount($pid){

        $this->db->select_sum('amaun');
        //$this->db->where("status",'Belum Selesai');
        $this->db->where('p_id', $pid); 
        $result = $this->db->get('payment_details')->row();  
        return $result->amaun; 
    }

    function get_userid($pid){

        $this->db->select('userid');
        $this->db->where('p_id', $pid); 
        $result = $this->db->get('payment')->row();  
        return $result->userid; 
    }

    function get_userid_distinct($pid){

        $this->db->distinct();
        $this->db->select('userid');
        $this->db->where('p_id', $pid); 
        //$this->db->where('f_id',0); 
        $result = $this->db->get('payment_details')->row();  
        return $result->userid; 
    }

    function get_total_amount_arrears(){

        $this->db->select("p_id");
        $this->db->where("status",'Belum Selesai');
        $this->db->where('userId !=', 0); //administrator
        //$result = $this->db->get('payment')->row();  
        //return $result->amaun; 

        $query = $this->db->get('payment');        
        return $query->num_rows();
    }

    /*amaran*/
    function countUnpaidPayment($userid){
        //$this->db->select("p_id");
        $this->db->select("p_id");
        $this->db->where("status",'Belum Selesai');
        $this->db->where('userid', $userid); //administrator
        $query = $this->db->get('payment');        
        return $query->num_rows();
    }

    function get_total_amount_arrears2(){

        $this->db->select_sum("total_amaun");
        $this->db->where("status",'Belum Selesai');
        $this->db->where('userId !=', 0); //administrator
        $result = $this->db->get('payment')->row();  
        return $result->total_amaun; 
    }

    function get_total_amount_arrears3(){

        $this->db->select_sum("k_amaun");
        //$this->db->where("status",'Belum Selesai');
        //$this->db->where('userId !=', 0); //administrator
        $result = $this->db->get('khairat')->row();  
        return $result->k_amaun; 
    }

    function get_total_amount_member($id){

        $this->db->select_sum('total_amaun');
        $this->db->where("status",'Selesai');
        $this->db->where('userId =', $id); //administrator
        $result = $this->db->get('payment')->row();  
        return $result->total_amaun; 
    }

    function get_total_amount_arrears_member($id){

        //$this->db->select("p_id");
        $this->db->select_sum('total_amaun');
        $this->db->where("status",'Belum Selesai');
        $this->db->where('userId =', $id); //administrator
        $result = $this->db->get('payment')->row();  
        return $result->total_amaun; 

        //$query = $this->db->get('payment');        
        //return $query->num_rows();
    }

    function getPaymentWarning($userid)
    {
        $this->db->select('Pmt.p_id, Pmt.p_date, Pmt.userid, Pmt.yid, Pmt.catatan, Pmt.amaun,Pmt.total_amaun, Pmt.attachment, Pmt.updatedBy, Pmt.updatedDtm, Pmt.status as statusbayaran, Pmt.isEmailed, Yur.y_tahun, Yur.y_title, Usr.userId, Usr.name, Usr.icno, Usr.status');
        $this->db->from('payment as Pmt');
        $this->db->join('tbl_users as Usr', 'Pmt.userid = Usr.userId','left');
        $this->db->join('tbl_kadar_yuran as Yur', 'Pmt.yid = Yur.yid','left');
        //$this->db->join('tbl_users_family as Fa', 'Yur.f_id = Fa.f_id','left');
        //$this->db->where('Usr.isDeleted', 0);
        $this->db->where('Usr.userId', $userid);
        $this->db->where('Pmt.status', "Belum Selesai");
        $this->db->order_by('Pmt.p_date','DESC');

        //$this->db->where('a.userid', $userid);
        //$this->db->order_by('b.y_tahun', 'DESC');

        $query=$this->db->get()->result();
        return $query;
    }


    function UnpaidPaymentList(){
        $this->db->select("p_id, userid");
        $this->db->where("status",'Belum Selesai');
        $query = $this->db->get('payment');        
        return $query->result();
    }

    function getYuranTitle($pid){

        //$this->db->select("p_id");
        $this->db->select('ky.y_title, ky.yid, pm.p_id, pm.yid');
        $this->db->from('tbl_kadar_yuran as ky');
        $this->db->join('payment as pm', 'ky.yid = pm.yid','left');
        $this->db->where('pm.p_id =', $pid); //administrator
        $result = $this->db->get()->row();  
        return $result->y_title; 

    }


}

/* End of file Payment_model.php */
/* Location: ./application/models/Payment_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-02 03:53:20 */
/* http://harviacode.com */