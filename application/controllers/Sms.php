<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Sms extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sms_model');
        $this->load->model('General_model');
        $this->load->model('Payment_model');
        $this->load->model('Toyyibpay_model');
        $this->load->model('Whatsapp_model');
        $this->load->model('Khairat_model');
        $this->load->model('kadar_model');
        $this->load->model('user_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    public function index()
    {
        //echo $this->vendorId;
        //calculate latest credit
        $totaldebit = $this->Sms_model->get_credits("DEBIT");
        $totalcredit = $this->Sms_model->get_credits("CREDIT");
        $credit_balance = $totaldebit - $totalcredit;

        //sms sent
        $totalsmssent = $this->Sms_model->get_sms_sent(200); //code for OK

        $row = $this->Toyyibpay_model->get_by_id(3);//Toyyibpay Amricreative
        if ($row) { $pg_url = $row->pg_url;}

        //exit();
        $data = array(
            'credit_balance' => $credit_balance,
            'total_debit' => $totaldebit,
            'total_credit' => $totalcredit,
            'total_sms_sent' => $totalsmssent,
            'userid' => $this->vendorId,
            'pg_defaulturl'=> $pg_url,
        );
        $data['sms_records'] = $this->Sms_model->get_all();
        //$data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
        $data['smspaymentrecord'] = $this->Sms_model->getSmsPaymentRecord();

        $this->global['pageTitle'] = 'SMS'; /*tambah*/
        $this->loadViews('sms/sms_message_list', $this->global, $data, NULL); /*tambah*/
    }

    public function read($id) 
    {
        $row = $this->Sms_model->get_by_id($id);
        if ($row) {
            $data = array(
		'wm_id' => $row->wm_id,
		'userid' => $row->userid,
		'phone' => $row->phone,
		'messageid' => $row->messageid,
		'message' => $row->message,
		'createDtm' => $row->createDtm,
		'createdBy' => $row->createdBy,
	    );
            $this->global['pageTitle'] = 'SMS'; /*tambah*/
            $this->loadViews('sms/sms_message_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sms'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sms/create_action'),
	    'wm_id' => set_value('wm_id'),
	    'userid' => set_value('userid'),
	    'phone' => set_value('phone'),
	    'messageid' => set_value('messageid'),
	    'message' => set_value('message'),
	    'createDtm' => set_value('createDtm'),
	    'createdBy' => set_value('createdBy'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('sms/sms_message_form', $this->global, $data, NULL); /*tambah*/

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'userid' => $this->input->post('userid',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'messageid' => $this->input->post('messageid',TRUE),
		'message' => $this->input->post('message',TRUE),
		'createDtm' => $this->input->post('createDtm',TRUE),
		'createdBy' => $this->input->post('createdBy',TRUE),
	    );

            $this->Sms_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sms'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Sms_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sms/update_action'),
		'wm_id' => set_value('wm_id', $row->wm_id),
		'userid' => set_value('userid', $row->userid),
		'phone' => set_value('phone', $row->phone),
		'messageid' => set_value('messageid', $row->messageid),
		'message' => set_value('message', $row->message),
		'createDtm' => set_value('createDtm', $row->createDtm),
		'createdBy' => set_value('createdBy', $row->createdBy),
	    );
            $this->global['pageTitle'] = 'Update'; /*tambah*/
            $this->loadViews('sms/sms_message_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sms'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('wm_id', TRUE));
        } else {
            $data = array(
		'userid' => $this->input->post('userid',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'messageid' => $this->input->post('messageid',TRUE),
		'message' => $this->input->post('message',TRUE),
		'createDtm' => $this->input->post('createDtm',TRUE),
		'createdBy' => $this->input->post('createdBy',TRUE),
	    );

            $this->Sms_model->update($this->input->post('wm_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sms'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Sms_model->get_by_id($id);

        if ($row) {
            $this->Sms_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sms'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sms'));
        }
    }

     /*sms*/
    public function smsDetail() 
    {
        $userid = $this->input->post('uid'); //get userid from jquery
        
        //calculate latest credit
        $totaldebit = $this->Sms_model->get_credits("DEBIT");
        $totalcredit = $this->Sms_model->get_credits("CREDIT");
        $credit_balance = $totaldebit - $totalcredit;
        $credit_balance_reminder = "Maaf ! Baki kredit SMS telah habis.";

        $info = $this->General_model->get_by_id("1");
        $row = $this->Payment_model->get_by_userid($userid);
        //exit();
        if ($row) {
            $data = array(
            'p_id' => $row->p_id,
            'p_date' => $row->p_date,
            'userid' => $row->userid,
            'credit_balance' => $credit_balance,
            'credit_balance_reminder' =>$credit_balance_reminder,
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
            'g_phone' => $info->g_phone,
            );
        
            $data['userlist'] = $this->user_model->getUserList();
            $data['yuranlist'] = $this->kadar_model->get_all();
            $data['paymentrecord'] = $this->Payment_model->getPaymentWarning($userid);

            //$this->global['pageTitle'] = 'Surat Peringatan'; /*tambah*/
            //$this->loadViews('payment/payment_warning', $this->global, $data, NULL); /*tambah*/
            $this->load->view('sms/sms_box',$data); 
        } 
        
    }

    public function smsDetail_open() 
    {
        $userid = $this->input->post('uid'); //get userid from jquery
        
        //calculate latest credit
        $totaldebit = $this->Sms_model->get_credits("DEBIT");
        $totalcredit = $this->Sms_model->get_credits("CREDIT");
        $credit_balance = $totaldebit - $totalcredit;
        $credit_balance_reminder = "Maaf ! Baki kredit SMS telah habis.";

        $info = $this->General_model->get_by_id("1");
        //$row = $this->Payment_model->get_by_userid($userid);
        //exit();
        if ($info) {
            $data = array(
            'credit_balance' => $credit_balance,
            'credit_balance_reminder' =>$credit_balance_reminder,
            'g_home_title' => $info->g_home_title,
            'g_home_desc' => $info->g_home_desc,
            'g_address' => $info->g_address,
            'g_weburl' => $info->g_weburl,
            'g_email' => $info->g_email,
            'g_bankname' => $info->g_bankname,
            'g_bankaccount' => $info->g_bankaccount,
            'g_phone' => $info->g_phone,
            );

            $data['adminInfo'] = $this->user_model->getAdminList();
            $this->load->view('sms/sms_box_open',$data); 
        } 
        
    }


    /*sms*/
    public function smsSend() 
    {
        
        //print_r($_POST);
        $userid = $this->input->post('userid'); 
        $phone = $this->input->post('phone'); 
        $message = $this->input->post('message'); 
        $apikey = "80833c37b069380b268cc24b9a951cff";

        /*Load the URL helper*/ 
         $this->load->helper('url'); 
   

        /*OneSMS*/
        //redirect('https://www.oneSMS.my/api/send.php?apiKey=22f277843206d477d3cd4ae1c9220bc3&messageContent=Testing%123&recipients= 6010xxxxxxx&referenceID=ba63ht12opab6')
        redirect('https://www.oneSMS.my/api/send.php?apiKey='.$apikey.'&messageContent='.$message.'&recipients=6'.$phone."&referenceID=".$userid);

        /*Redirect the user to some site*/ 
        //redirect('http://www.wasap.my/+6'.$phone.'/'.$message);

        //echo anchor('http://www.wasap.my/+6'.$phone.'/'.$message.', 'title="Reminder"', array('target' => '_blank', 'class' => 'new_window')); 

        //echo anchor('http://www.wasap.my/+6'.$phone.'/'.$message, 'title="Notis"', array('target' => '_blank', 'class' => 'new_window'));
       
        //$sms = sms($apikey, $to, $from, $msg, $img);    
        //if($sms == 'Success') { echo 'SMS Sent'; } else { echo 'Error Sending SMS: '.$sms; }   
     
    }

    function smsSend_bulk360(){

        $row = $this->Sms_model->get_sms_gateway(1);//1-Bulk360
        if ($row) {
            //$sg_id = $row->sg_id;
            echo $sg_apikey = $row->sg_apikey;
            $sg_secretkey = $row->sg_secretkey;
            $sg_url = $row->sg_url;
            $sg_cost = $row->sg_cost;
            $sg_credit = $row->sg_credit;
            $sg_registered_account = $row->sg_registered_account;
        }

        //exit();
        //$url    = "https://sms.360.my/gw/bulk360/v3_0/send.php";
        //$user = urlencode("4y1aK5JdQG"); //API KEY
        //$pass = urlencode("EHV69FpJDCBMOWYrZMbQeJn3hsk3Nh1eIvykRand"); //API SECRET
        $url    = $sg_url;
        $user = urlencode($sg_apikey); //API KEY
        $pass = urlencode($sg_secretkey); //API SECRET 

        $userid = $this->input->post('userid'); 
        $phone = $this->input->post('phone'); 
        $to = "6".$phone;
        $from   = "66688";
        $message = $this->input->post('message'); 
        if($userid > 0){
            $url_response = site_url('payment/warning/'.$userid);
        } else {
            $url_response = site_url('sms');
        }


        $url  = $url."?user=$user&pass=$pass&from=$from";
        $url = $url . "&to=".$to."&text=".rawurlencode($message);
        //exit();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $sentResult = curl_exec($ch);
        if ($sentResult == FALSE) {
            echo 'Curl failed for sending sms to crm.. '.curl_error($ch);
        }
        curl_close($ch);

        $obj = json_decode($sentResult); //decode json bulk360
         $codeStatus = $obj->code; //code 200 if ok
         $descStatus = $obj->desc;

        if ($codeStatus == "200") {
            $this->session->set_flashdata('success', $descStatus." - SMS berjaya dihantar!");
            $sgcredit = $sg_credit;
            $sgcost = 0.20;

            //masukkan dalam table perbelanjaan khairat
            $data = array(
                'k_date' => date('Y-m-d H:i:s'),
                'userid' => 0,
                'k_amaun' => $sgcost,
                'k_catatan' => $message,
                'k_jenis' => "SMS",
                'updatedBy'=> $this->vendorId, //adminID
                'updatedDtm'=> date('Y-m-d H:i:s'),
                );
            $this->Khairat_model->insert($data);

        } else {
            $this->session->set_flashdata('error', $descStatus." - SMS gagal dihantar (".$sentResult.")");
            $sgcredit = 0;
            $sgcost = 0.00;
        }

        //add rekod to history
         $sms_data = array(
                'userid' => $userid,
                'phone' => $to,
                'sms_code' => $codeStatus,
                'sms_desc' => $descStatus,
                'message' =>  $message,
                'sms_cost' =>  $sgcost,
                'sms_credit' =>  $sgcredit,
                'createdBy' =>  0,
                );
        $this->Sms_model->insert($sms_data);

        //get latest id sms_log if success & credit 1 per SMS
        if ($sgcredit > 0) {
            $credittype = "CREDIT";
            $smsid = $this->Sms_model->getLatestSMS();
            $credit_data = array(
                        'ew_type'=>$credittype, 
                        'ew_credit'=>$sgcredit, 
                        'sms_id'=>$smsid,  
                        );
            $this->Sms_model->insert_ewallet($credit_data);
        }
        redirect($url_response);
    }

    public function smsEwalletDetail()
    {
        
        $userid = $this->input->post('id');
        $data['user_data'] = $this->user_model->getUserInfo($userid);
        //exit();
        //$data['paymentrecord'] = $this->payment_model->getPaymentRecord($id);
        //$generalid = 1;
       // $data['generalinfo'] = $this->General_model->get_by_id_array($generalid);
        //$data['surauInfo'] = $this->Surau_model->get_all();
        //$data['roles'] = $this->user_model->getUserRolesRegister();
        $this->load->view('sms/sms_ewallet_detail',$data); 
        
    }

    public function paymentSms() 
    {   
        //print_r($_POST);
        $row = $this->Sms_model->get_sms_gateway(1);//1-Bulk360
        if ($row) {
            $sg_id = $row->sg_id;
            $sg_cost = $row->sg_cost;
            $sg_credit = $row->sg_credit;
        }

        $user_id = $this->input->post('userid');
        $smscredit = $this->input->post('smscredit');
        $row = $this->user_model->getUserInfoById($user_id);
            if ($row) {
                $name = $row->name;
                $phone = $this->input->post('phone',TRUE);
                $email = $this->input->post('email',TRUE);
            }

        //$p_id = $this->input->post('p_id',TRUE);
        $fpxamount = $smscredit * $sg_cost;
        $billdesc = "e-Khairat : Tambahan ".$smscredit." Kredit SMS";
        //exit();
        $this->paymentGateway($user_id, $smscredit, $name, $phone, $email, $fpxamount, $billdesc);
    }

    public function paymentGateway($user_id, $smscredit, $name, $phone, $email, $fpxamount, $billdesc){

    //1. get api references record
        $row = $this->Toyyibpay_model->get_by_id(3); //pay to amricreative
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
        //$paymentid = $p_id;
        //$smsgatewayid = $sg_id;
        $harga = $fpxamount;
        $rmx100=($harga*100);
        if ($billdesc == ""){
            $billdesc = "e-Khairat : Tambahan ".$smscredit." Kredit SMS";
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
            'billExternalReferenceNo'=>$smscredit,
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

          redirect($pg_url.$billcode);
    }

    public function smsStatus()
    {
        $status_id  = $this->input->get('status_id',TRUE);
        $billcode  = $this->input->get('billcode',TRUE);
        $smscredit  = $this->input->get('order_id',TRUE);
        $transaction_id  = $this->input->get('transaction_id',TRUE);

        //1. get api references record
        $row = $this->Toyyibpay_model->get_by_id(3); //pay to amricreative
        if ($row) {
            $getBillTransactions = $row->pg_callbackurl;
        }

        //2. Toyyibpay Get bill Transactions
        $some_data = array(
            'billCode' => $billcode,
            'billpaymentStatus' => $status_id
        );  
        $curl = curl_init();
          curl_setopt($curl, CURLOPT_POST, 1);
          curl_setopt($curl, CURLOPT_URL, $getBillTransactions);  
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

          $result = curl_exec($curl);
          $info = curl_getinfo($curl);  
          curl_close($curl);

          $obj = json_decode($result,true); //billtransactionstatus
          //$billpaymentStatus=$obj[0]['billpaymentStatus'];
          $billDescription=$obj[0]['billDescription'];

        //echo $result;
        //3. Insert payment status into table sms_payment & insert credit into table sms_ewallet
          if($status_id == 1){
                $status = "Selesai";
                $msg = "FPX";
                $smspaymentdata = array(
                    'smsp_date' => date('Y-m-d'),
                    'userid' => $this->vendorId,
                    'amaun' => $obj[0]['billpaymentAmount'],
                    'status' => $status,
                    'pg_billcode' => $billcode,
                    'pg_transactionid' => $transaction_id,
                    'pg_msg' =>$msg,
                    'catatan'=>$billDescription,
                    'createDtm'=>date('Y-m-d H:i:s'),
                    );
                $this->Sms_model->insert_smspayment($smspaymentdata);

                $credittype = "DEBIT";
                $smsp_id = $this->Sms_model->getLatestSMSPayment();
                $credit_data = array(
                        'ew_type'=>$credittype, 
                        'ew_credit'=>$smscredit, 
                        'smsp_id'=>$smsp_id,
                        );
                $this->Sms_model->insert_ewallet($credit_data);
                $this->send_whatsapp_notification($billDescription);//send to amricreative
                $this->session->set_flashdata('success', $billDescription.' <b>telah berjaya </b>. Terima Kasih</b>');
            } else {
                $this->session->set_flashdata('error', $billDescription.'<b> tidak berjaya!</b> Sila cuba lagi.</b>');
            }
            redirect('/sms');
    }

    public function send_whatsapp_notification($billDescription){
        //echo "https://api.textmebot.com/send.php?recipient=+60139080721&apikey=tsraHfkqAAx5&text=This%20is%20a%20test";

        $row = $this->Whatsapp_model->get_wa_id(3); //send to amricreative
        if ($row) {
            $phone = $row->wa_host;  // host phone
            $adminphone = $row->wa_phone;  //admin phone
            $apikey =$row->wa_apikey;  
            $link =$row->wa_url; 
            $client =$row->wa_client; 
        }
        //$message = "*".$client."*. ".date('d-m-Y h:i:s A')." - Permohonan ahli baru *".$namaPemohon."*(".$phonenumber.") telah diterima. Terima Kasih";
        $message = "*".$client."*. ".date('d-m-Y h:i:s A')." - ".$billDescription.".Alhamdulillah";
    
        $url=$link.'recipient=+6'.$adminphone.'&apikey='.$apikey.'&text='.urlencode($message);
        //exit();
        
        if($ch = curl_init($url))
        {
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $html = curl_exec($ch);
            $err = curl_error($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            //echo "Output:".$html;  // you can print the output for troubleshooting
            curl_close($ch);

            /*$data = array(
                'userid' => 0,
                'phone' => $adminphone,
                'messageid' => $status,
                'message' =>  $html.$message,
                'createdBy' =>  0,
                );
            $this->Whatsapp_model->insert_whatsapp($data);*/

            return (int) $status;
        }
        else
        {
            //echo "Whatsapps Not Sent! #:" . $err;
            echo $status = "Whatsapps Not Sent!";
            return false;
        }
        
    }


   /* function sms($apikey, $to, $from, $msg, $img) 
    {                 
        $params = array(
            'to'        => $to,
            'from'   => $from,
            'msg'      => $msg,
            'attach'      => $img,
            'key'      => $apikey
        );
        $ch = curl_init('https://smsarc.com/endpoint/sendsms/');    
        curl_setopt ($ch, CURLOPT_POST, true);  
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HEADER, false);    
        //curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2); //optional
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $response = curl_exec($ch); 
        curl_close($session);   
        return $response;       
    }   
    */

    public function _rules() 
    {
	$this->form_validation->set_rules('userid', 'userid', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('messageid', 'messageid', 'trim|required');
	$this->form_validation->set_rules('message', 'message', 'trim|required');
	$this->form_validation->set_rules('createDtm', 'createdtm', 'trim|required');
	$this->form_validation->set_rules('createdBy', 'createdby', 'trim|required');

	$this->form_validation->set_rules('wm_id', 'wm_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Sms.php */
/* Location: ./application/controllers/Sms.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-03-27 00:45:13 */
/* http://harviacode.com */