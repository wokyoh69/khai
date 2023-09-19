<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/
require APPPATH . '/views/functions.php';

class Payment extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('General_model');
        $this->load->model('Payment_model');
        $this->load->model('Khairat_model');
        $this->load->model('kadar_model');
        $this->load->model('Kadar_family_model');
        $this->load->model('user_model');
        $this->load->model('Toyyibpay_model');
        $this->load->library('form_validation');


        $this->isLoggedIn();
    }

    public function index()
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
       
        $data['totalmembers'] =  $this->user_model->get_total_members();

        $this->global['pageTitle'] = 'Bayaran'; 
        $this->loadViews('payment/payment_list', $this->global, $data, NULL);
        }
    }

    /*
    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'payment/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'payment/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'payment/index.html';
            $config['first_url'] = base_url() . 'payment/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Payment_model->total_rows($q);
        $payment = $this->Payment_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->load->model('kadar_model');
        $yuran = $this->kadar_model->get_all();

        $this->load->model('user_model');
        $ahli = $this->user_model->getUserList();


        $data = array(
            'payment_data' => $payment,
            'yuran_data' => $yuran,
            'user_data' => $ahli,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->global['pageTitle'] = 'Senarai Bayaran'; 
        $this->loadViews('payment/payment_list', $this->global, $data, NULL); 
    }
    */

    function paymentListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {       
            $pg = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($pg) { $pg_url = $pg->pg_url;}
            $data = array(
                'pg_defaulturl'=> $pg_url,     
             );

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->Payment_model->paymentListingCount($searchText);

            $returns = $this->paginationCompress ( "payment/payment_list", $count, 150 );
            
            $data['paymentRecords'] = $this->Payment_model->paymentListing($searchText, $returns["page"], $returns["segment"]);
            
            $data['rows'] = $count;

            $this->global['pageTitle'] = 'Bayaran';
            
            $this->loadViews("payment/payment_list", $this->global, $data, NULL);
        }
    }

    public function read($id) 
    {
   
        $info = $this->General_model->get_by_id("1");

       $pg = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($pg) { $pg_url = $pg->pg_url;}
            //'pg_defaulturl'=> $pg_url,
        //'pg_billcode'=> $row->pg_billcode,

        $row = $this->Payment_model->get_by_id($id);
        if ($row) {
            $data = array(
		'p_id' => $row->p_id,
		'p_date' => $row->p_date,
		'userid' => $row->userid,
		'yid' => $row->yid,
        'amaun' => $row->amaun,
        'total_amaun' => $row->total_amaun,
		'attachment' => $row->attachment,
		'status' => $row->status,
		'catatan' => $row->catatan,
        'pg_defaulturl'=> $pg_url,
        'pg_billcode'=> $row->pg_billcode,
        'g_home_title' => $info->g_home_title,
        'g_home_desc' => $info->g_home_desc,
        'g_address' => $info->g_address,
        'g_weburl' => $info->g_weburl,
        'g_email' => $info->g_email,
        'g_bankname' => $info->g_bankname,
        'g_bankaccount' => $info->g_bankaccount,
        'checkyuran' => $this->Payment_model->checkPaymentRecord($row->userid,$row->yid),// check id yuran dah ada @ belum
        'countyuran' => $this->Payment_model->countPaymentRecord($row->userid,$row->yid), //
	    );
            $this->load->model('kadar_model');
            $this->load->model('user_model');
        
            $data['userlist'] = $this->user_model->getUserList();
            $data['yuranlist'] = $this->kadar_model->get_all();

            $data['payment'] = $this->Payment_model->gePayment($id);
            $data['paymentdetail'] = $this->Payment_model->gePaymentDetail($id);

            //jika tiada payment detail id dalam table payment_detail (id yuran tahunan)
            if (!empty($this->Payment_model->gePaymentDetail($id))) { 
                $id_ahli = $this->Payment_model->get_userid_distinct($id);
                $data['paymentdetail_ahli'] = $this->Payment_model->gePaymentDetail_ahli($id,$id_ahli);
            }


            $this->global['pageTitle'] = 'Resit Bayaran'; /*tambah*/
            $this->loadViews('payment/payment_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paymentListing'));
        }

        
    }

    /*amaran*/
    public function warning($userid) 
    {
        $info = $this->General_model->get_by_id("1");

        $row = $this->Payment_model->get_by_userid($userid);
        //exit();
        if ($row) {
            $data = array(
        'p_id' => $row->p_id,
        'p_date' => $row->p_date,
        'userid' => $row->userid,
        //'address' => $row->address,
        'yid' => $row->yid,
        'amaun' => $row->amaun,
        'status' => $row->status,
        'catatan' => $row->catatan,
        'g_home_title' => $info->g_home_title,
        'g_home_desc' => $info->g_home_desc,
        'g_address' => $info->g_address,
        'g_weburl' => $info->g_weburl,
        'g_email' => $info->g_email,
        'g_bankname' => $info->g_bankname,
        'g_bankaccount' => $info->g_bankaccount,
        );
        
            $data['userlist'] = $this->user_model->getUserList();
            $data['yuranlist'] = $this->kadar_model->get_all();
            $data['paymentrecord'] = $this->Payment_model->getPaymentWarning($userid);

            $this->global['pageTitle'] = 'Surat Peringatan'; /*tambah*/
            $this->loadViews('payment/payment_warning', $this->global, $data, NULL); /*tambah*/
        } else {
            //$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paymentListing'));
        }

        
    }

   
/*
    public function create() 
    {

        $data = array(
            'button' => 'Create',
            'action' => site_url('payment/create_action'),
	    'p_id' => set_value('p_id'),
	    'p_date' => set_value('p_date'),
	    'userid' => set_value('userid'),
	    'yid' => set_value('yid'),
        'amaun' => set_value('amaun'),
	    'attachment' => set_value('attachment'),
	    'status' => set_value('status'),
	    'catatan' => set_value('catatan'),
	);
        $this->load->model('user_model');
        $data['userlist'] = $this->user_model->getUserList();

        $this->load->model('kadar_model');
        $data['yuranlist'] = $this->kadar_model->get_all_status("Aktif");

        $this->global['pageTitle'] = 'Bayaran';
        $this->loadViews('payment/payment_form', $this->global, $data, NULL); 

    }/*tambah*/ /*tambah*/

     public function create($id) 
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

        $user_id = $id;
        $data = array(
            'button' => 'Create',
            'action' => site_url('payment/create_action'),
            'p_id' => set_value('p_id'),
            'p_date' => set_value('p_date'),
            'userid' => $user_id,
            'yid' => set_value('yid'),
            'amaun' => set_value('amaun'),
            'attachment' => set_value('attachment'),
            'status' => set_value('status'),
            'catatan' => set_value('catatan'),
    );
        $this->load->model('user_model');
        $data['userlist'] = $this->user_model->getUserList();

        $this->load->model('kadar_model');
        $data['yuranlist'] = $this->kadar_model->get_all_status("Aktif");
        //$data['yuranlist'] = $this->Payment_model->get_payment_belum_selesai($user_id);
        //$checkNewApprovedMembers = $this->user_model->checkNewApprovedMembers($user_id);
        //if(!empty($checkNewApprovedMembers))
         //   {
        $data['newMembers'] = $this->Payment_model->gePaymentDetailbyUser($user_id);
        $data['familyInfo'] = $this->user_model->getFamilyList($user_id);
        //    }
       


        $this->global['pageTitle'] = 'Bayaran'; /*tambah*/
        $this->loadViews('payment/payment_form_add', $this->global, $data, NULL); /*tambah*/

        }

    }
    
    public function create_action() 
    {

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $data = array(
                'p_date' => $this->input->post('payDate',TRUE),
                'userid' => $this->input->post('userid',TRUE),
                'yid' => $this->input->post('yid',TRUE),
                'amaun' => $this->input->post('amaun',TRUE),
                //'attachment' => $image_name,
                'status' => $this->input->post('status',TRUE),
                'catatan' => $this->input->post('catatan',TRUE),
                'createDtm' => date('Y-m-d H:i:s'),
                'updatedBy'=>$this->vendorId, //adminID
                'updatedDtm'=>date('Y-m-d H:i:s'),
                );
            $yid = $this->input->post('yid',TRUE);


           //if ($yid > 0) { 
            //if($this->Payment_model->checkPaymentRecord($this->input->post('userid'),$yid) == 0) { 
                $next_id = $this->Payment_model->insert_getnextid($data);
                $this->session->set_flashdata('success', 'Rekod bayaran telah dikemaskini');

                if (empty($_FILES['userfile']['name']))
                {
                    $image_name = 'default.jpg';
                    //assign name but no file upload
                } else {
                    $file_type = pathinfo($_FILES['userfile']['name']);
                    $user_id = sprintf("%04d", $this->input->post('userid'));
                    $this->load->model('payment_model'); 
                    //echo $next_id = $this->payment_model->get_next_payment_id();
                    //exit();
                    //$next_id = sprintf("%03d", $next_id);
                    $image_name = $user_id."_".$next_id.".".$file_type['extension'];  
                    ///exit();
                    $update_filename = array(
                        'attachment' => $image_name,
                        'updatedBy'=> $this->vendorId, //adminID
                        'updatedDtm'=> date('Y-m-d H:i:s'),
                    );
                    $this->Payment_model->update($next_id, $update_filename);
                    $this->do_upload($image_name); 
                }

                
                 //$p_id = $this->input->post('p_id',TRUE);
                    //$status = array(
                       // 'status' =>  $this->input->post('status',TRUE),
                    //);

                    //$this->Payment_model->update($p_id, $data);
                    $fid = $this->input->post('checked_fid');
                    if($fid)
                        {
                           for($count = 0; $count < count($fid); $count++)
                           {
                            //$this->Payment_model->updateDetails($p_id, $fid[$count], $status);
                            $umurF = umur($this->user_model->getFamilyDetails($fid[$count],"f_icno"));
                            $yuranF = yuran($this->user_model->getFamilyDetails($fid[$count],"f_pertalian"), $umurF);
                            $jumlah_ahli = total_yuran_in_year(date('m'),$yuranF);
                            
                            $paymentfamilyInfo = array(
                            'p_id'=>$next_id, 
                            'f_id'=>$fid[$count], 
                            'amaun'=>$jumlah_ahli,  
                            'status' =>  $this->input->post('status',TRUE),
                            'createDtm'=>date('Y-m-d H:i:s')
                            );
                            $this->Payment_model->insert_details($paymentfamilyInfo);
                            

                            //$id[$count];
                           }
                        } 
                

           // } else {
           //     $this->session->set_flashdata('error', 'Maaf ! Rekod bayaran telah wujud');
           //}
            
            //redirect(site_url('paymentListing'));

            //if($userId == null)
            //{
            //    redirect('userListing');
            //} 
            $userId = $this->input->post('userid',TRUE);

            $pg = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($pg) { $pg_url = $pg->pg_url;}
            //'pg_defaulturl'=> $pg_url,

            $unpaidcount= $this->Payment_model->countUnpaidPayment($userId);
            $data = array(
            'adminId'=> $this->vendorId,
            'unpaidcount' => $unpaidcount,
            'pg_defaulturl'=> $pg_url,
            );

            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            $data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
            $data['familyInfo'] = $this->user_model->getFamilyList($userId);
            $data['khairatrecord'] = $this->Khairat_model->getKhairatRecord($userId);
            $data['yuranlist'] = $this->kadar_model->get_all();

            $this->load->model('user_model');
            $data['userlist'] = $this->user_model->getUserList();

            $this->global['pageTitle'] = 'Kemaskini Ahli';
            
            $this->loadViews("editUsers", $this->global, $data, NULL);
        }
    }


    public function addPayment() 
    {
        $userId = $this->input->post('userId',TRUE);
        $yid = $this->input->post('yid',TRUE);
        $pakej = $this->input->post('pakej',TRUE);
        $jumlah_daftar = 0;
        $jumlah_yuran = 0;

        if($pakej == "Keluarga") { 
            if($yid == 1) { 
                $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah","tbl_kadar_yuran");
            } else {
                $jumlah_yuran = $this->kadar_model->get_amount_daftar($yid,"y_jumlah","tbl_kadar_yuran");
            }
                
        } else if($pakej == "Bujang"){
            if($yid == 1) { 
                $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah_bujang","tbl_kadar_yuran");
            } else {
                $jumlah_yuran = $this->kadar_model->get_amount_daftar($yid,"y_jumlah_bujang","tbl_kadar_yuran");
            }
        }

        //YURAN PENDAFTARAN
        if($yid == 1){
            $data = array(
                'userid' => $userId,
                'yid' => $yid,
                'amaun' =>  $jumlah_daftar,
                'total_amaun' =>  $jumlah_daftar,
            );
            $this->Payment_model->insert($data);
        } else {
        //SELAIN YURAN PENDAFTARAN
            //CEK JIKA YURAN TAHUNAN TELAH WUJUD
            if($this->Payment_model->checkPaymentRecord($userId,$yid)){ 
                $jumlah_yuran = 0;
            } 
                //YURAN TAHUNAN
                $userinfo = $this->user_model->getUserInfo($userId); 
                foreach ($userinfo as $usr)
                  { 
                      $icno =  $usr->icno; 
                  } 

                //YURAN TAHUNAN AHLI
                $umur = umur($icno);
                $yuran = yuran("AHLI", $umur);
                //$jumlah_tahunan = total_renew_yuran_in_year($yuran); //renewal ahli setahun
                $data = array(
                    'userid' => $userId,
                    'yid' => $yid,
                    'amaun' =>  $jumlah_yuran, 
                );
                $this->Payment_model->insert($data); 

                $payment_id = $this->user_model->getLatestPayment();
                $paymentDetails = array(
                            'p_id'=>$payment_id, 
                            'userid'=>$userId, 
                            'amaun'=>$yuran,  
                            );
                $this->Payment_model->insert_details($paymentDetails);


                //YURAN TAHUNAN FAMILY
                $total = 0;
                $rowf = $this->user_model->getFamilyListAlive($userId);
                foreach ($rowf as $fam)
                  { 
                    $familyInfo = array(
                        'f_name'=>$fam->f_name, 
                        'userid'=>$userId, 
                        'f_icno'=>$fam->f_icno,  
                        'f_pertalian'=>$fam->f_pertalian, 
                        'f_pasangan'=>$fam->f_pasangan, 
                        'approval' => "Y",
                        );

                    $umurF = umur($fam->f_icno);
                    $yuranF = yuran($fam->f_pertalian, $umurF);
                    //$jumlah_tahunanF = total_yuran_in_year(date('m'),$yuranF);
                    //$jumlah_tahunanF = total_renew_yuran_in_year($yuranF); //renewal ahli setahun
                    $total = $total + $yuranF;

                    //insert payment detail setiap ahli tanggungan
                    $paymentfamilyInfo = array(
                        'p_id'=>$payment_id, 
                        'f_id'=>$fam->f_id,
                        'userid'=>$userId, 
                        'amaun'=>$yuranF,
                        //'total_amaun'=>$jumlah_tahunanF,  
                        );
                    $this->Payment_model->insert_details($paymentfamilyInfo);
                  } 

                  //UPDATE PAYMENT (AHLI + TANGGUNGAN)
                  $jumlah_keseluruhan_yuran = $jumlah_yuran + $yuran + $total;
                  $paymentInfo = array('total_amaun'=>$jumlah_keseluruhan_yuran);
                  $this->Payment_model->updatePayment($payment_id,$paymentInfo);

        }
        
            $pg = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($pg) { $pg_url = $pg->pg_url;}
            //'pg_defaulturl'=> $pg_url,

            $unpaidcount= $this->Payment_model->countUnpaidPayment($userId);
            $data = array(
            'adminId'=> $this->vendorId,
            'unpaidcount' => $unpaidcount,
            'pg_defaulturl'=> $pg_url,
            );
                
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            $data['familyInfo'] = $this->user_model->getFamilyList($userId);
            $data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
            $data['khairatrecord'] = $this->Khairat_model->getKhairatRecord($userId);
            $data['pertalian'] = $this->Kadar_family_model->get_family();
            $data['documentInfo'] = $this->user_model->getDocumentList($userId);
            $data['yuranlist'] = $this->kadar_model->get_all();

            $this->global['pageTitle'] = 'Kemaskini Ahli';
            
            $this->loadViews("editUsers", $this->global, $data, NULL);
        
    }
    
    public function do_upload($image_name)
    {
        
        if (empty($_FILES['userfile']['name']))
        {
                $image_name = 'default.jpg';//default image
            } else {
                $config['upload_path']      = './upload/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']         = 12048;
                //$config['max_width']        = 11024;
                //$config['max_height']       = 1024;
                $config['file_ext_tolower'] = TRUE;
                $config['file_name']        = $image_name;
                $config['overwrite']        = TRUE;

                $this->load->library('upload', $config);
                $this->upload->do_upload('userfile');


                if (!$this->upload->do_upload('userfile')) {
                    $error = ['error' => $this->upload->display_errors()];
                    $this->load->view('editUsers', $error);
                } else {
                    //$data = array('upload_data' => $this->upload->data());
                    //$this->load->view('upload_success', $data);
                    $this->upload->data();
                }
        }
    }

    public function update($id) 
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
        //echo $id;
        $info = $this->General_model->get_by_id("1");
        $row = $this->Payment_model->get_by_id($id);
        //exit();

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('payment/update_action'),
        		'p_id' => set_value('p_id', $row->p_id),
        		'p_date' => set_value('p_date', $row->p_date),
        		'userid' => set_value('userid', $row->userid),
        		'yid' => set_value('yid', $row->yid),
                'amaun' => set_value('amaun', $row->amaun),
                'total_amaun' => set_value('amaun', $row->total_amaun),
        		'attachment' => set_value('attachment', $row->attachment),
        		'status' => set_value('status', $row->status),
        		'catatan' => set_value('catatan', $row->catatan),
                'createDtm' => set_value('createDtm', $row->createDtm),
                'g_home_title' => $info->g_home_title,
                'g_home_desc' => $info->g_home_desc,
                'g_address' => $info->g_address,
                'g_weburl' => $info->g_weburl,
                'g_email' => $info->g_email,
                'g_bankname' => $info->g_bankname,
                'g_bankaccount' => $info->g_bankaccount,
                'checkyuran' => $this->Payment_model->checkPaymentRecord($row->userid,$row->yid),// check id yuran dah ada @ belum
                'countyuran' => $this->Payment_model->countPaymentRecord($row->userid,$row->yid), //
        	    );

            $data['userlist'] = $this->user_model->getUserList();
            //$data['yuranlist'] = $this->kadar_model->get_all_active();
            //$data['yuranlist'] = $this->payment_model->get_payment_belum_selesai($row->userid);
            $data['payment'] = $this->Payment_model->gePayment($id);
            $data['paymentdetail'] = $this->Payment_model->gePaymentDetail($id);
            $data['yuranlist'] = $this->kadar_model->get_all();
            //$data['checkyuran'] = $this->Payment_model->checkPaymentRecord($row->userid,$row->yid); // check id yuran dah ada @ belum

            //jika tiada payment detail id dalam table payment_detail (id yuran tahunan)
            if (!empty($this->Payment_model->gePaymentDetail($id))) { 
                $id_ahli = $this->Payment_model->get_userid_distinct($id);
                $data['paymentdetail_ahli'] = $this->Payment_model->gePaymentDetail_ahli($id,$id_ahli);
            }
            
            $this->global['pageTitle'] = 'Kemaskini Bayaran'; /*tambah*/
            $this->loadViews('payment/payment_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paymentListing'));
        }

        }
    }

    public function paymentUser() 
    {
        //print_r($_POST);
        //exit();
        if(!empty($this->input->post('p_id'))){

            //echo $this->input->post('email',TRUE);
           //echo $this->input->post('phone',TRUE);

            //echo "proceed to fpx payment";
            $user_id = $this->input->post('userid');
            $row = $this->user_model->getUserInfoById($user_id);
                if ($row) {
                    $name = $row->name;
                    $phone = $this->input->post('phone',TRUE);
                    $email = $this->input->post('email',TRUE);
                }

            $p_id = $this->input->post('p_id',TRUE);
            $fpxamount = $this->input->post('amaun');
            $billdesc = $this->input->post('yurandesc')." - ".$name;
            $this->paymentGateway($user_id, $p_id, $name, $phone, $email, $fpxamount, $billdesc);
        }
    }

    public function paymentGateway($user_id, $p_id, $name, $phone, $email, $fpxamount, $billdesc){

    //1. get api references record
        $row = $this->Toyyibpay_model->get_by_id(1);//default value is 1
        if ($row) {
            $pg_id = $row->pg_id;
            $pg_url = $row->pg_url;
            $pg_secretkey = $row->pg_secretkey;
            $pg_catcode = $row->pg_catcode;
            $pg_billname = $row->pg_billname;
            $pg_returnurl = $row->pg_returnurl;
            $pg_callbackurl = $row->pg_callbackurl;
            $pg_createbill = $row->pg_createbill;
        }

      //2. get parameter values
        $nama = $name;
        $email = $email;
        $telefon = $phone;
        $paymentid = $p_id;
        $harga = $fpxamount;
        $rmx100=($harga*100);
        if ($billdesc == ""){
            $billdesc = "Bayaran yuran khairat Badan Kebajikan Kariah Masjid Tareq Bin Ziyad";
        }

        $api_data = array(
            'userSecretKey'=> $pg_secretkey,
            'categoryCode'=> $pg_catcode,
            'billName'=> $pg_billname,
            'billDescription'=> $billdesc,
            'billPriceSetting'=>1,
            'billPayorInfo'=>1,
            'billAmount'=>$rmx100,
            'billReturnUrl'=>$pg_returnurl,
            'billCallbackUrl'=>$pg_callbackurl,
            'billExternalReferenceNo'=>$paymentid,
            'billTo'=>$nama,
            'billEmail'=>$email,
            'billPhone'=>$telefon,
            'billSplitPayment'=>0,
            'billSplitPaymentArgs'=>'',
            'billPaymentChannel'=>0,
            'billContentEmail'=>'Terima Kasih!',
          );  
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_POST, 1);
          curl_setopt($curl, CURLOPT_URL, $pg_createbill);  
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $api_data);
          $result = curl_exec($curl);
          $info = curl_getinfo($curl);  
          curl_close($curl);
          $obj = json_decode($result,true);
          $billcode=$obj[0]['BillCode'];

          //redirect('https://dev.toyyibpay.com/'.$billcode);
          redirect($pg_url.$billcode);
        //exit();
    }

    public function paymentStatus()
    {

        //print_r($_GET);
        $status_id  = $this->input->get('status_id',TRUE);
            if($status_id == 1){
                $status = "Selesai";
                $catatan = "FPX";
                $this->session->set_flashdata('success', '<b>Bayaran telah berjaya. Terima Kasih</b>');
            } else {
                $status = "Belum Selesai"; 
                $this->session->set_flashdata('error', '<b>Bayaran TIDAK berjaya! Sila cuba lagi.</b>');
            }

        $billcode  = $this->input->get('billcode',TRUE);
        $p_id  = $this->input->get('order_id',TRUE);
        $msg  = $this->input->get('msg',TRUE);
        $transaction_id  = $this->input->get('transaction_id',TRUE);

        //exit();
        $data = array(
            'p_date' => date('Y-m-d'),
            'status' => $status,
            'catatan' => $catatan,
            'pg_billcode' => $billcode,
            'pg_transactionid' => $transaction_id,
            'pg_msg' => $msg,
            'updatedBy'=>$this->vendorId,
            'updatedDtm'=>date('Y-m-d H:i:s'),
            );
        
        $status = array(
            'status' =>  $status,
            'catatan' => $catatan,
        );

        //Update payment status and redirect page
         if($this->vendorId != 0)
          {
            //payment status logged user back to dashboard
            $this->Payment_model->update($p_id, $data);
            $this->Payment_model->updateDetails($p_id, $status);
            //$this->isLoggedIn();
            redirect('/dashboard');

          } else {
            //payment status unlogin user back to toyyibpay payment receipt
            $p_id  = $this->input->get('order_id',TRUE);
            $p_id_list = explode('-', $p_id);

            foreach($p_id_list as $p_id) {    
                //echo '"'.$p_id.'"<br/>';  
                $this->Payment_model->update($p_id, $data);
                $this->Payment_model->updateDetails($p_id, $status);  
            }

            $row = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($row) {
                $pg_id = $row->pg_id;
                $pg_url = $row->pg_url;
            }
            $receipt = $pg_url.$billcode;
            redirect($receipt);
          }

     /*
      //sample return status - SUCCESS
      https://www.e-khairat.com/bakit/?status_id=1&billcode=07qabpdn&order_id=&msg=ok&transaction_id=TP130495469180701180722

      //sample return status - FAILED
      https://www.e-khairat.com/bakit/?status_id=3&billcode=f0p5y7r9&order_id=&msg=ok&transaction_id=TP130496466501401180722
      */
    }
    
    public function update_action() 
    {
        $this->_rules();

        //print_r($_POST);
        //exit();
        if(!empty($this->input->post('fpx'))){

            //echo "proceed to fpx payment";
            $user_id = $this->input->post('userid');
            $row = $this->user_model->getUserInfoById($user_id);
                if ($row) {
                    $name = $row->name;
                    $phone = $row->phone;
                    $email = $row->email;
                }

            $p_id = $this->input->post('p_id',TRUE);
            $fpxamount = $this->input->post('fpx');
            $this->paymentGateway($user_id, $p_id, $name, $phone, $email, $fpxamount);

        } else {

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('p_id', TRUE));
            } else {
                ///////upload////
                if (empty($_FILES['userfile']['name']))
                {
                    $image_name = $this->input->post('attachment', TRUE);
                    //assign name but no file upload
                } else {           
                    $file_type = pathinfo($_FILES['userfile']['name']);
                    $user_id = sprintf("%04d", $this->input->post('userid'));
                    $current_id = $this->input->post('p_id', TRUE);
                    $image_name = $user_id."_".$current_id.".".$file_type['extension'];  
                    $this->do_upload($image_name); 
                }
                ///////end upload////

                $data = array(
            		'p_date' => $this->input->post('payDate',TRUE),
            		'userid' => $this->input->post('userid',TRUE),
            		'yid' => $this->input->post('yid',TRUE),
                    'total_amaun' => $this->input->post('total_amaun',TRUE),
            		'attachment' => $image_name,
            		'status' => $this->input->post('status',TRUE),
            		'catatan' => $this->input->post('catatan',TRUE),
                    'updatedBy'=>$this->vendorId, //adminID
                    'updatedDtm'=>date('Y-m-d H:i:s'),
            	    );

            
            $p_id = $this->input->post('p_id',TRUE);
            $status = array(
                'status' =>  $this->input->post('status',TRUE),
            );

                $this->Payment_model->update($p_id, $data);
                $this->Payment_model->updateDetails($p_id, $status);
                /*if($this->input->post('checked_fid'))
                    {
                       $fid = $this->input->post('checked_fid');
                       for($count = 0; $count < count($fid); $count++)
                       {
                        //$result = $this->user_model->deleteFamily($id[$count]);
                        $this->Payment_model->updateDetails($p_id, $fid[$count], $status);
                        //$id[$count];
                       }
                    } 
                */

                $this->session->set_flashdata('message', '<b>Kemaskini Telah Berjaya</b>');
                //redirect(site_url('paymentListing'));

                $userId = $this->input->post('userid',TRUE);

                $pg = $this->Toyyibpay_model->get_by_id(1);//default value is 1
                if ($pg) { $pg_url = $pg->pg_url;}
                 //'pg_defaulturl'=> $pg_url,

                /*amaran*/
                $unpaidcount= $this->Payment_model->countUnpaidPayment($userId);
                $data = array(
                'adminId'=> $this->vendorId,
                'unpaidcount' => $unpaidcount,
                'pg_defaulturl'=> $pg_url,
                );

                $data['roles'] = $this->user_model->getUserRoles();
                $data['userInfo'] = $this->user_model->getUserInfo($userId);
                $data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
                $data['familyInfo'] = $this->user_model->getFamilyList($userId);
                $data['khairatrecord'] = $this->Khairat_model->getKhairatRecord($userId);
                $data['documentInfo'] = $this->user_model->getDocumentList($userId);
                $data['pertalian'] = $this->Kadar_family_model->get_family();
                 $data['yuranlist'] = $this->kadar_model->get_all();

                $this->global['pageTitle'] = 'Kemaskini Ahli';
                
                $this->loadViews("editUsers", $this->global, $data, NULL);

            }
        }
    }

    public function update_attachment($id) 
    {
         $userId = $this->Payment_model->get_userid($id);
         $p_id = $id;
         $data = array(
                'attachment' => "", 
                'updatedBy'=>$this->vendorId, //adminID
                'updatedDtm'=>date('Y-m-d H:i:s'),
                );

         $this->Payment_model->update($p_id, $data);

         $pg = $this->Toyyibpay_model->get_by_id(1);//default value is 1
        if ($pg) { $pg_url = $pg->pg_url;}
         //'pg_defaulturl'=> $pg_url,

         /*amaran*/
            $unpaidcount= $this->Payment_model->countUnpaidPayment($userId);
            $data = array(
            'adminId'=> $this->vendorId,
            'unpaidcount' => $unpaidcount,
            'pg_defaulturl'=> $pg_url,
            );

         $data['roles'] = $this->user_model->getUserRoles();
         $data['userInfo'] = $this->user_model->getUserInfo($userId);
         $data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
         $data['familyInfo'] = $this->user_model->getFamilyList($userId);
         $data['khairatrecord'] = $this->Khairat_model->getKhairatRecord($userId);
         $data['documentInfo'] = $this->user_model->getDocumentList($userId);
          $data['yuranlist'] = $this->kadar_model->get_all();

         $this->global['pageTitle'] = 'Kemaskini Ahli';
            
         $this->loadViews("editUsers", $this->global, $data, NULL);
         //read($p_id);
    }
    
    public function delete($id) 
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

        $row = $this->Payment_model->get_by_id($id);
        $userId = $this->Payment_model->get_userid($id);

        //exit();

        if ($row) {
            $this->Payment_model->delete($id);
            $this->Payment_model->delete_details($id);
            $this->session->set_flashdata('message', 'Delete Record Success');

            $pg = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($pg) { $pg_url = $pg->pg_url;}
             //'pg_defaulturl'=> $pg_url,

            /*amaran*/
            $unpaidcount= $this->Payment_model->countUnpaidPayment($userId);
            $data = array(
            'adminId'=> $this->vendorId,
            'unpaidcount' => $unpaidcount,
            'pg_defaulturl'=> $pg_url,
            );

            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            $data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
            $data['familyInfo'] = $this->user_model->getFamilyList($userId);
            $data['khairatrecord'] = $this->Khairat_model->getKhairatRecord($userId);
            $data['pertalian'] = $this->Kadar_family_model->get_family();
            $data['documentInfo'] = $this->user_model->getDocumentList($userId);
            $data['yuranlist'] = $this->kadar_model->get_all();

            $this->global['pageTitle'] = 'Kemaskini Ahli';
            
            $this->loadViews("editUsers", $this->global, $data, NULL);
            //redirect(site_url('paymentListing'));
            //redirect(site_url('editUsers/'));

        //} else {
        //    $this->session->set_flashdata('message', 'Record Not Found');
         //   redirect(site_url('paymentListing'));
        }

        }
    }

    public function deletePaymentDetail($id,$pf_id) 
    {

    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

        $row = $this->Payment_model->get_by_id($id);
        $userId = $this->Payment_model->get_userid($id);

        if ($row) {
            //$this->Payment_model->delete($id);
            $this->Payment_model->delete_payment_details($pf_id);
            //$this->session->set_flashdata('message', 'Delete Record Success');

        }

         //UPDATE PAYMENT (jumlah yuran terkini)
          $jumlah_yuran_terkini = $this->Payment_model->get_latest_amount($id);
          $paymentInfo = array('total_amaun'=>$jumlah_yuran_terkini);
          $this->Payment_model->updatePayment($id,$paymentInfo);

        redirect(site_url('paymentUpdate/'.$id));

        }
    }

    public function paymentDetail()
    {
        //print_r($_POST);
        //exit();
        //echo $this->vendorId;
        $id = $this->input->post('id'); //payment Id

        $info = $this->General_model->get_by_id("1");
        $row = $this->Payment_model->get_by_id($id);
        //exit();
        $pg = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($pg) {
                $pg_url = $pg->pg_url;
            }

        if ($row) {
            $data = array(
                //'button' => 'Update',
                //'action' => site_url('payment/update_action'),
                'p_id' => set_value('p_id', $row->p_id),
                'p_date' => set_value('p_date', $row->p_date),
                'userid' => set_value('userid', $row->userid),
                'yid' => set_value('yid', $row->yid),
                'amaun' => set_value('amaun', $row->amaun),
                'attachment' => set_value('attachment', $row->attachment),
                'status' => set_value('status', $row->status),
                'catatan' => set_value('catatan', $row->catatan),
                'createDtm' => set_value('createDtm', $row->createDtm),
                'pg_defaulturl'=> $pg_url,
                'pg_billcode'=> $row->pg_billcode,
                'g_home_title' => $info->g_home_title,
                'g_home_desc' => $info->g_home_desc,
                'g_address' => $info->g_address,
                'g_weburl' => $info->g_weburl,
                'g_email' => $info->g_email,
                'g_bankname' => $info->g_bankname,
                'g_bankaccount' => $info->g_bankaccount,
                'role_user' => $this->role,
                );

            $data['userlist'] = $this->user_model->getUserList();
            $data['yuranlist'] = $this->kadar_model->get_all_active();
            $data['payment'] = $this->Payment_model->gePayment($id);
            $data['paymentdetail'] = $this->Payment_model->gePaymentDetail($id);

            //jika tiada payment detail id dalam table payment_detail (id yuran tahunan)
            if (!empty($this->Payment_model->gePaymentDetail($id))) { 
                $id_ahli = $this->Payment_model->get_userid_distinct($id);
                $data['paymentdetail_ahli'] = $this->Payment_model->gePaymentDetail_ahli($id,$id_ahli);
            }
            
            //$data['yuranlist'] = $this->kadar_model->get_all();
            
            $this->global['pageTitle'] = 'Perincian Yuran'; /*tambah*/
            //$this->loadViews('payment/loadPaymentDetail', $this->global, $data, NULL); /*tambah*/
            $this->load->view('payment/loadPaymentDetail',$data); 
        } else {
            //$this->session->set_flashdata('message', 'Record Not Found');
            //redirect(site_url('paymentListing'));
            echo "Page Error";
        }

        /*
        $id_daftar = 1; //tbl_kadar_yuran -> yuran pendaftaran
        $jumlah_daftar = $this->kadar_model->get_amount($id_daftar);
         $data = array(
            'id_yuran_daftar' => $id_daftar,
            'yuran_pendaftaran' => $jumlah_daftar,
            );
         
        $data['applicant_info'] = $this->user_model->getApplicantInfo($userId);
        //echo "test";
        $data['apf'] = $this->user_model->getApplicantFamily($userId);
        $this->load->view('register/applicant_detail',$data); 
        */
    }


    public function _rules() 
    {
	$this->form_validation->set_rules('payDate', 'payDate', 'trim|required');
	//$this->form_validation->set_rules('userid', 'userid', 'trim|required');
	//$this->form_validation->set_rules('yid', 'yid', 'trim|required');
	//$this->form_validation->set_rules('attachment', 'attachment', 'trim|required');
	//$this->form_validation->set_rules('status', 'status', 'trim|required');
	//$this->form_validation->set_rules('catatan', 'catatan', 'trim|required');

	$this->form_validation->set_rules('p_id', 'p_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "payment.xls";
        $judul = "payment";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "P Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Userid");
	xlsWriteLabel($tablehead, $kolomhead++, "Yid");
	xlsWriteLabel($tablehead, $kolomhead++, "Attachment");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Catatan");

	foreach ($this->Payment_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->p_date);
	    xlsWriteNumber($tablebody, $kolombody++, $data->userid);
	    xlsWriteNumber($tablebody, $kolombody++, $data->yid);
	    xlsWriteLabel($tablebody, $kolombody++, $data->attachment);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->catatan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

/*
function umur($noic) 
    {
    //$no_ic = 800211085631; //CONTOH NO IC   871118077020
        $no_ic = $noic;

        $tmp_hari = substr($no_ic,4,2);
        $tmp_bulan = substr($no_ic,2,2);
        $tmp_tahun = substr($no_ic,0,2);
        $tmp_negeri = substr($no_ic,6,2);
        $tmp_jantina = substr($no_ic,11,1);
        
        //TARIKH LAHIR//////////////////////////////////////
        if($tmp_tahun >= 00 && $tmp_tahun <= 30) {
            $tmp_tahun = 2000+$tmp_tahun;
        }
        
        if($tmp_tahun >= 31 && $tmp_tahun <= 99) {
            $tmp_tahun = 1900+$tmp_tahun;
        }
        
        $tarikh_lahir = $tmp_hari."/".$tmp_bulan."/".$tmp_tahun;
        
        //UMUR//////////////////////////////////////
        $tmp_tarikh_lahir = $tmp_tahun."-".$tmp_bulan."-".$tmp_hari;;
        $umur = date_create($tmp_tarikh_lahir)->diff(date_create('today'))->y;

        return $umur;
    }

    function yuran($pertalian, $umur) 
    {
        if(($pertalian == "ISTERI") || ($pertalian == "SUAMI")){
           $yuran = 0;
        } else if ($pertalian == "AHLI"){
            $yuran = 10;
        } else {
            if($umur > 21) {
              $yuran = 5;                                        
            } else {
              $yuran = 0;
            }
        }
        return number_format($yuran,2);
    }

    function total_yuran_in_year($month,$yuran) 
    {

        $month_left = 13 - $month;
        $total_amount = $yuran * $month_left;

        return number_format($total_amount,2);
    }
    */

}

/* End of file Payment.php */
/* Location: ./application/controllers/Payment.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-02 03:53:20 */
/* http://harviacode.com */