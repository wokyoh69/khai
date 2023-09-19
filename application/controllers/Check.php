<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//print_();
require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Check extends CI_Controller
{

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('check_model');
        $this->load->model('user_model');
        $this->load->model('payment_model');
        $this->load->model('check_model');
        $this->load->model('General_model');
        $this->load->model('Surau_model');
        $this->load->model('Toyyibpay_model');
    }
    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $generalid = 1;
        $row = $this->General_model->get_by_id($generalid); 

        if ($row) {
            $data = array(
            'g_id' => $row->g_id,
            'g_home_title' => $row->g_home_title,
            'g_home_desc' => $row->g_home_desc,
            'g_contact_info' => $row->g_contact_info,
            'g_address' => $row->g_address,
            'g_email' => $row->g_email,
            'g_phone' => $row->g_phone,
            'g_facebook' => $row->g_facebook,
            'g_bankname' => $row->g_bankname,
            'g_bankaccount' => $row->g_bankaccount,
        'g_icon_1' => $row->g_icon_1,'g_title_1' => $row->g_title_1,'g_info_1' => $row->g_info_1, 
        'g_icon_2' => $row->g_icon_2,'g_title_2' => $row->g_title_2,'g_info_2' => $row->g_info_2, 
        'g_icon_3' => $row->g_icon_3,'g_title_3' => $row->g_title_3,'g_info_3' => $row->g_info_3,
            'g_logo_url' => $row->g_logo_url,
            );


            $this->global['pageTitle'] = $row->g_home_title; 
            /*$this->global['g_home_title'] = $row->g_home_title;
            $this->global['g_home_desc'] = $row->g_home_desc;
            $this->global['g_email'] = $row->g_email;
            $this->global['g_phone'] = $row->g_phone;
            $this->global['g_bankname'] = $row->g_bankname;
            $this->global['g_bankaccount'] = $row->g_bankaccount;
            $this->global['g_info_1'] = $row->g_info_1;
            $this->global['g_info_2'] = $row->g_info_2;
            $this->global['g_info_3'] = $row->g_info_3;
            $this->global['g_logo_url'] = $row->g_logo_url;*/

            $name = "";
            $data['search_data'] = $this->user_model->userSearch($name);
            //$this->load->view('checkname', $this->global, $data, NULL);
            $this->load->view('checkname', $data, NULL);
        }
        //$this->load->view('checkname.php');
    }

     
    public function checkMe()
    {
        //print_r($_POST);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Name', 'required|max_length[100]');
    
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
        $name = $this->input->post('nama');
        $jeniscarian = $this->input->post('jeniscarian');

        $logsearch = $name."-".$jeniscarian;


        $data = array(
        'name' => $name,
        'jeniscarian' => $jeniscarian,
        );

        //log all check input
        $checkInfo = array('log_search'=>$logsearch, 'log_ipaddress'=>$ip_address = $_SERVER['REMOTE_ADDR'], 'log_datetime'=>date('Y-m-d H:i:s'));
        $this->load->model('check_model');
        $result = $this->check_model->addCheck($checkInfo); 

        if ($jeniscarian == "AHLI") {
            //search
            $count = $this->user_model->userSearchCount($name);
            $data['rows'] = $count;
            $data['search_data'] = $this->user_model->userSearch($name);
            //$this->global['pageTitle'] = "Carian Nama"; 
        } else {
            //echo "TANGGUNGAN";
            //exit();
            $count = $this->user_model->familySearchCount($name);
            $data['rows'] = $count;
            $data['search_data'] = $this->user_model->familySearch($name);
        }

        $generalid = 1;
        $data['generalinfo'] = $this->General_model->get_by_id_array($generalid);
        if ($count = 0) {     
            //echo "tak da";      
            $data['messages'] = $this->session->set_flashdata('error', 'Tiada Maklumat'); 
        } else {
            $data['messages'] = $this->session->set_flashdata('success', 'Success');
            //echo "ada";
        }

        $this->load->view('checkname',$data);
        //$this->load->view('checkname', $this->global, $data, NULL);
        //$this->load->view('checkname', $this->global, $data, NULL);
        //$this->load->view('checkname',$data);
    
        }
        
    }

    public function checkDetail()
    {
        
        //echo $id;
        //$this->load->view('checkname_detail'); 
        //echo "masak";
        $id = $this->input->post('id');
        $data['user_data'] = $this->user_model->getUserInfo($id); 
        $data['paymentrecord'] = $this->payment_model->getPaymentRecord($id);
        $generalid = 1;
        $data['generalinfo'] = $this->General_model->get_by_id_array($generalid);
        $data['surauInfo'] = $this->Surau_model->get_all();
        $data['roles'] = $this->user_model->getUserRolesRegister();
        $this->load->view('checkname_detail',$data); 

        /*
        $row = $this->user_model->getUserInfo($id); 

        if ($row) {
            $data = array(
        'userId' => $row->userId,
        'name' => $row->name,
        'status' => $row->status,
        'email' => $row->email,
        );
            $this->load->view('checkname',$data); 
        } */

       // exit();
        
    }

    public function FPXPayment() //public payment without login
    {
        //print_r($_POST); exit();
        if(!empty($this->input->post('userid'))){
            $userid = $this->input->post('userid');
            $generalid = 1;

            $row = $this->General_model->get_by_id($generalid); 
            if ($row) {
                $data = array(
                    'g_id' => $row->g_id,
                    'g_home_title' => $row->g_home_title,
                    'g_home_desc' => $row->g_home_desc,
                    'g_contact_info' => $row->g_contact_info,
                    'g_address' => $row->g_address,
                    'g_email' => $row->g_email,
                    'g_phone' => $row->g_phone,
                    'g_facebook' => $row->g_facebook,
                    'g_bankname' => $row->g_bankname,
                    'g_bankaccount' => $row->g_bankaccount,
        'g_icon_1' => $row->g_icon_1,'g_title_1' => $row->g_title_1,'g_info_1' => $row->g_info_1, 
        'g_icon_2' => $row->g_icon_2,'g_title_2' => $row->g_title_2,'g_info_2' => $row->g_info_2, 
        'g_icon_3' => $row->g_icon_3,'g_title_3' => $row->g_title_3,'g_info_3' => $row->g_info_3, 
                    'g_logo_url' => $row->g_logo_url,
                    'userid' => $userid,
                    );

            }
            $data['user_data'] = $this->user_model->getUserInfo($userid); 
            $data['paymentrecord'] = $this->payment_model->getPaymentRecord_fpx($userid);
            $data['surauInfo'] = $this->Surau_model->get_all();

            $this->load->view('toyyibpay/fpx_payment', $data);

        }
    }

    public function FPXprocess() 
    {
        //print_r($_POST); exit();
        //1. Get user name. assign email and phone filled in
        $user_id = $this->input->post('userId');
        $row = $this->user_model->getUserInfoById($user_id);
            if ($row) {
                $name = $row->name;
                $phone = $this->input->post('phone',TRUE);
                $email = $this->input->post('email',TRUE);
            }

        //2. Assign value desc and group payment id
        $billdesc = "";
        $p_id = "";
        if($this->input->post('pmid'))
        {
           $id = $this->input->post('pmid');
           for($count = 0; $count < count($id); $count++)
           {
            $billdesc .= $this->payment_model->getYuranTitle($id[$count]).",";
            //$pid .= $id[$count]."-";
            $p_id = join('-', $id);
           }
        }
        //echo $p_id;
        $fpxamount = $this->input->post('totalprice');
        ///stop here
        //exit();
        $this->paymentGateway($user_id, $p_id, $name, $phone, $email, $fpxamount, $billdesc);
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
            //$pg_returnurl = $row->pg_returnurl; //logged user
            $pg_returnurl_public = $row->pg_returnurl_public; //unlogged user
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
            $billdesc = "Bayaran khairat Badan Kebajikan Kariah Masjid Tareq Bin Ziyad";
        }

        $api_data = array(
            'userSecretKey'=> $pg_secretkey,
            'categoryCode'=> $pg_catcode,
            'billName'=> $pg_billname,
            'billDescription'=> $billdesc,
            'billPriceSetting'=>1,
            'billPayorInfo'=>1,
            'billAmount'=>$rmx100,
            //'billReturnUrl'=>$pg_returnurl,
            'billReturnUrl'=>$pg_returnurl_public,
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
    
    public function FPXstatus()
    {

        //print_r($_GET);
        $status_id  = $this->input->get('status_id',TRUE);
        $billcode  = $this->input->get('billcode',TRUE);
        $p_id  = $this->input->get('order_id',TRUE);
        $msg  = $this->input->get('msg',TRUE);
        $transaction_id  = $this->input->get('transaction_id',TRUE);

        //exit();
        
        
        /*$status = array(
            'status' =>  $status,
        );*/

        if($status_id == 1){
            $status = "Selesai";
            $catatan = "FPX";

            $data = array(
                'p_date' => date('Y-m-d'),
                'status' => $status,
                'catatan' => $catatan,
                'pg_billcode' => $billcode,
                'pg_transactionid' => $transaction_id,
                'pg_msg' => $msg,
                'updatedBy'=>0,
                'updatedDtm'=>date('Y-m-d H:i:s'),
            );

            $status = array(
                'status' =>  $status,
                'catatan' => $catatan,
            );

            //Update payment status and redirect page
            $p_id  = $this->input->get('order_id',TRUE);
            $p_id_list = explode('-', $p_id);

            foreach($p_id_list as $p_id) {    
                //echo '"'.$p_id.'"<br/>';  
                $this->payment_model->update($p_id, $data);
                $this->payment_model->updateDetails($p_id, $status);  
            }

            $row = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($row) {
                $pg_id = $row->pg_id;
                $pg_url = $row->pg_url;
            }
            $receipt = $pg_url.$billcode;
            $this->session->set_flashdata('success', '<b>Bayaran telah berjaya. Terima Kasih</b>');
            //redirect($receipt);
            $fpxstatus = "<b>Alhamdulillah bayaran telah diterima. Login untuk kemaskini maklumat keahlian.<br> Terima Kasih.</b>";
            $row = $this->General_model->get_by_id(1); 
            if ($row) {
                $data = array(
                    'g_id' => $row->g_id,
                    'g_home_title' => $row->g_home_title,
                    'g_home_desc' => $row->g_home_desc,
                    'g_contact_info' => $row->g_contact_info,
                    'g_address' => $row->g_address,
                    'g_email' => $row->g_email,
                    'g_phone' => $row->g_phone,
                    'g_facebook' => $row->g_facebook,
                    'g_bankname' => $row->g_bankname,
                    'g_bankaccount' => $row->g_bankaccount,
        'g_icon_1' => $row->g_icon_1,'g_title_1' => $row->g_title_1,'g_info_1' => $row->g_info_1, 
        'g_icon_2' => $row->g_icon_2,'g_title_2' => $row->g_title_2,'g_info_2' => $row->g_info_2, 
        'g_icon_3' => $row->g_icon_3,'g_title_3' => $row->g_title_3,'g_info_3' => $row->g_info_3, 
                    'g_logo_url' => $row->g_logo_url,
                    'fpxstatus' => $fpxstatus,
                    'receipt' => $receipt,
                    );
            }
            //check if user have logged session 
            $isLoggedIn = $this->session->userdata('isLoggedIn');
            if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
            {
                
                $this->load->view('toyyibpay/fpx_status', $data);
            }
            else
            {
                $this->session->set_flashdata('success', '<b>Bayaran telah berjaya. Terima Kasih</b>');
                redirect('/dashboard');
            }
        } else {
            $status = "Belum Selesai"; 
            $fpxstatus = "<b>Bayaran TIDAK berjaya! Sila cuba lagi.</b>";

            $row = $this->General_model->get_by_id(1); 
            if ($row) {
                $data = array(
                    'g_id' => $row->g_id,
                    'g_home_title' => $row->g_home_title,
                    'g_home_desc' => $row->g_home_desc,
                    'g_contact_info' => $row->g_contact_info,
                    'g_address' => $row->g_address,
                    'g_email' => $row->g_email,
                    'g_phone' => $row->g_phone,
                    'g_facebook' => $row->g_facebook,
                    'g_bankname' => $row->g_bankname,
                    'g_bankaccount' => $row->g_bankaccount,
        'g_icon_1' => $row->g_icon_1,'g_title_1' => $row->g_title_1,'g_info_1' => $row->g_info_1, 
        'g_icon_2' => $row->g_icon_2,'g_title_2' => $row->g_title_2,'g_info_2' => $row->g_info_2, 
        'g_icon_3' => $row->g_icon_3,'g_title_3' => $row->g_title_3,'g_info_3' => $row->g_info_3, 
                    'g_logo_url' => $row->g_logo_url,
                    'fpxstatus' => $fpxstatus,
                    );

            }
            //check if user have logged session 
            $isLoggedIn = $this->session->userdata('isLoggedIn');
            if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
            {
                
                $this->load->view('toyyibpay/fpx_status', $data);
            }
            else
            {
                $this->session->set_flashdata('error', '<b>Bayaran TIDAK berjaya! Sila cuba lagi.</b>');
                redirect('/dashboard');
            }
            //$this->load->view('toyyibpay/fpx_status', $data);
        }

    }
    
}

?>