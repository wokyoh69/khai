<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


//require APPPATH . '/libraries/BaseController.php'; /*tambah*/
require APPPATH . '/views/functions.php';

class Register extends CI_Controller
{

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->model('user_model');
        $this->load->model('General_model');
        $this->load->model('Kadar_model');
        $this->load->model('Kadar_family_model');
        $this->load->model('Surau_model');
        $this->load->model('Whatsapp_model');
    }
    /**
     * Index Page for this controller.
     */
    public function index()
    {  
        //$this->loadViews("registration", $this->global, $data, NULL);
        //$this->load->view('registration');
        //$data['generalinfo'] =  $this->General_model->get_all(); 
        

        $id = 1;
        $row = $this->General_model->get_by_id($id); 
        if ($row) {
        $data = array(
        'g_id' => $row->g_id,
        'g_home_title' => $row->g_home_title,
        'g_home_desc' => $row->g_home_desc,
        'g_contact_info' => $row->g_contact_info,
        'g_address' => $row->g_address,
        'g_email' => $row->g_email,
        'g_phone' => $row->g_phone, 
        'g_info_1' => $row->g_info_1, 
        'g_info_2' => $row->g_info_2, 
        'g_info_3' => $row->g_info_3, 
        'g_logo_url' => $row->g_logo_url,
        'g_facebook' => $row->g_facebook,
        'g_bankname' => $row->g_bankname,
        'g_bankaccount' => $row->g_bankaccount,
        'g_icon_1' => $row->g_icon_1,'g_title_1' => $row->g_title_1,'g_info_1' => $row->g_info_1, 
        'g_icon_2' => $row->g_icon_2,'g_title_2' => $row->g_title_2,'g_info_2' => $row->g_info_2, 
        'g_icon_3' => $row->g_icon_3,'g_title_3' => $row->g_title_3,'g_info_3' => $row->g_info_3, 
        );

        //$this->global['pageTitle'] = $row->g_home_title; 
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

        //Session control
        if (empty($this->session->userdata('tempUser'))){
            $tempSession = uniqid(rand(), TRUE);
            $this->load->library('session');
            $this->session->set_userdata('tempUser',$tempSession);
        } else {
            $regId = $this->session->userdata('tempUser');
            //$data['regFamilylist'] = $this->register_model->getFamilyList();
            //$regFamilylist = $this->register_model->getFamilyList();
            //$data['roles'] = $this->user_model->getUserRolesRegister();
            //$data['surauInfo'] = $this->Surau_model->get_all();
            $data['getUserInfo'] = $this->register_model->getUserInfo($regId);
            $data['regFamilylist'] = $this->register_model->getFamilyList($regId);
        }

        $data['roles'] = $this->user_model->getUserRolesRegister();
        $data['surauInfo'] = $this->Surau_model->get_all();
        //$this->load->view('registration', $this->global, $data, NULL);
        //$this->load->view('register/registration',$data);
        //$data["title"] = "Check Email availibility using Ajax";  
        //$this->load->view("email_availibility", $data); 

        if ($row->g_registration == "Y") {
            $this->load->view('register/registration',$data);
        } else {
            $warning_register = $this->session->set_flashdata('warning_register', $row->g_registration_text);
            $this->load->view('register/registration_off',$data);
        }

        }
    }

    
    public function check_icno_avalibility()  
      {  
        
        $this->load->library('form_validation');
        $no_ic = $_POST["icno"]; //800411 08 5631

        $hari = substr($no_ic,4,2);
        $bulan = substr($no_ic,2,2);
        $tahun = substr($no_ic,0,2);
        $error = "";

        if (($hari <= 31) && ($bulan <= 12) && ($tahun <= 99)) {
            if($this->user_model->is_icno_available($no_ic))  
            { 
             //echo 'No. KP telah didaftarkan'; 
             echo $error = "No. KP telah didaftarkan";
             //$this->session->set_flashdata("error","No. KP telah didaftarkan"); 
             //echo '<label class="text-danger">No. KP telah didaftarkan</label>';
            }  

        } else {
            echo $error = "No. KP tidak sah !";
            //$this->session->set_flashdata("error","No. KP tidak sah !"); 
           //echo '<label class="text-danger">No. KP tidak sah !</label>';
        }

        //if($this->user_model->is_icno_available($noic))  
        //{  
         //    echo '<label class="text-danger">No. KP telah didaftarkan</label>';  
        //}  
        //else  
        //{  
        //     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> IC No Available</label>';  
        //}  
             
      }    



    /**
     * This function used to logged in user
     */
    public function registerMe()
    {
       
        $this->load->library('form_validation');
        
        //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]|trim');
        $this->form_validation->set_rules('icno', 'Kad Pengenalan', 'required|max_length[12]');
        //$this->form_validation->set_rules('phone', 'Telefon Bimbit', 'required|max_length[12]');

        if($this->form_validation->run() == FALSE)
        {
            $this->index();

            $name = $this->session->set_flashdata('name');
            $icno = $this->session->set_flashdata('icno');
            $phone = $this->session->set_flashdata('phone');
            $email = $this->session->set_flashdata('email');
            $address = $this->session->set_flashdata('address');

        }
        else
        {

        //$nama = $this->input->post('name');
        //$noic = $this->input->post('icno');
        //$phone = $this->input->post('phone');
    
        $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
        $phone = $this->input->post('phone');
        $noic = $this->input->post('icno');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        if(!empty($email)){
            $email = $this->security->xss_clean($this->input->post('email')); 
        } else{
            $email = "new@mail.com";
        }
        //exit();
        $password = "password"; //default password
        $roleId = "2"; //ahli biasa
        $createdId = 0;
        $regDate = date("Y-m-d");

        //check IC Number already registered as members
         $checkIc = $this->user_model->checkIcExisted($noic);
         $checkIcApply = $this->user_model->checkIcApplyExisted($noic);

            if(!empty($checkIc))
            {
                //echo telah ic wujud sebagai ahli";
                $error_register = $this->session->set_flashdata('error_register', 'Harap Maaf! Nombor Kad Pengenalan <b>'.$noic.'</b> telah didaftarkan sebagai ahli.');
           
            } else if(!empty($checkIcApply)){

                $warning_register = $this->session->set_flashdata('warning_register', 'Pendaftaran dengan No. KP <b>'.$noic.'</b> telah diterima namun pentadbir masih belum aktifkan. Harap Bersabar.');

            }else{
                //ic x wujud, teruskan pendaftaran
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($phone), 
                        'roleId'=>$roleId, 'name'=> $name,'phone'=>$phone, 'icno'=>$noic,'address'=>$address, 'regdate'=>$regDate,
                        'createdBy'=>$createdId, 'createdDtm'=>date('Y-m-d H:i:s'));
                $result = $this->user_model->addNewUserApply($userInfo);
                if($result){
                   $success_register = $this->session->set_flashdata('success_register', 'Pendaftaran berjaya. Pihak pentadbir akan menghubungi anda untuk pengesahan.!');
                   //send email to admin and applicant
                   $this->send_mail($email, $name, $phone);
                }
            }

        //exit();
        //$this->load->view('registration.php');
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
        'g_info_1' => $row->g_info_1,
        'g_info_2' => $row->g_info_2,
        'g_info_3' => $row->g_info_3,
        );


        $this->global['pageTitle'] = $row->g_home_title; 
        $this->global['g_home_title'] = $row->g_home_title;
        $this->global['g_home_desc'] = $row->g_home_desc;
        $this->global['g_email'] = $row->g_email;
        $this->global['g_phone'] = $row->g_phone;
        $this->global['g_info_1'] = $row->g_info_1;
        $this->global['g_info_2'] = $row->g_info_2;
        $this->global['g_info_3'] = $row->g_info_3;
        $this->load->view('register/registration', $this->global, $data, NULL);
        }


         }
        
    }

     /*Whatsapp TEXTMEBOT*/
    public function send_whatsapp_notification($wa_admin,$phonenumber,$namaPemohon){
        //echo "https://api.textmebot.com/send.php?recipient=+60139080721&apikey=tsraHfkqAAx5&text=This%20is%20a%20test";

        $row = $this->Whatsapp_model->get_wa_id($wa_admin); //default host textmebot
        if ($row) {
            $phone = $row->wa_host;  // host phone
            $adminphone = $row->wa_phone;  //admin phone
            $apikey =$row->wa_apikey;  
            $link =$row->wa_url; 
            $client =$row->wa_client; 
        }
        $message = "*".$client."*. ".date('d-m-Y h:i:s A')." - Permohonan ahli baru *".$namaPemohon."*(".$phonenumber.") telah diterima. Terima Kasih";
    
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

            $data = array(
                'userid' => 0,
                'phone' => $adminphone,
                'messageid' => $status,
                'message' =>  $html.$message,
                'createdBy' =>  0,
                );
            $this->Whatsapp_model->insert_whatsapp($data);

            return (int) $status;
        }
        else
        {
            //echo "Whatsapps Not Sent! #:" . $err;
            echo $status = "Whatsapps Not Sent!";
            return false;
        }
        
    }

    public function send_mail($email, $name, $phone) { 
         //$data['generalinfo'] = $this->General_model->get_by_id_array($generalid);
        $generalid = 1;
        $row = $this->General_model->get_by_id($generalid); 
         $from_email = $row->g_email; 
         $phone;
          $to_email = $email; 
          $subject = "Pendaftaran Ahli ".$name;
   
        //exit();
         //Load email library 
         $this->load->library('email'); 
         $this->email->from($from_email, $row->g_contact_info); 

         $kadarid = 1;
         echo $registration_fee = $this->Kadar_model->get_amount($kadarid);

         //exit();

         $data = array(
            'userName'=> $name,
            'email'=> $email,
            'phone'=> $phone,
            'reg_fee' => $registration_fee,
         );

         $this->email->to($to_email);
         $this->email->cc($from_email);
         $this->email->subject($subject); 
         //$this->email->message('Testing the email class.'); 
         $data['generalinfo'] = $this->General_model->get_by_id_array($generalid);
   
         $body = $this->load->view('email/register_message.php',$data,TRUE);
         $this->email->message($body); 

         //Send mail 
         if($this->email->send()) 
            $this->session->set_flashdata("email_sent","Email sent successfully."); 
         else 
            $this->session->set_flashdata("email_sent","Error in sending Email."); 
            //$this->load->view('email_form'); 
    } 

    public function registerDetail()
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
        'g_policy' => $row->g_policy,
        'g_info_1' => $row->g_info_1,
        'g_info_2' => $row->g_info_2,
        'g_info_3' => $row->g_info_3,
        );


        $this->global['pageTitle'] = $row->g_home_title; 
        $this->global['g_home_title'] = $row->g_home_title;
        $this->global['g_home_desc'] = $row->g_home_desc;
        $this->global['g_email'] = $row->g_email;
        $this->global['g_phone'] = $row->g_phone;
        $this->global['g_policy'] = $row->g_policy;
        $this->global['g_info_1'] = $row->g_info_1;
        $this->global['g_info_2'] = $row->g_info_2;
        $this->global['g_info_3'] = $row->g_info_3;
        $this->load->view('register/registration_detail', $this->global, $data, NULL);
        }

        //$this->load->view('registration_detail'); 

    }

    public function regFamily()
    {
        /*$generalid = 1;
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
        'g_policy' => $row->g_policy,
        );

        $this->global['pageTitle'] = $row->g_home_title; 
        $this->global['g_home_title'] = $row->g_home_title;
        $this->global['g_home_desc'] = $row->g_home_desc;
        $this->global['g_email'] = $row->g_email;
        $this->global['g_phone'] = $row->g_phone;
        $this->global['g_policy'] = $row->g_policy;
        $this->load->view('register/registration_family', $this->global, $data, NULL);
        }
        */
        $data['pertalian'] = $this->Kadar_family_model->get_family();
        $this->load->view('register/registration_family',$data); 

    }



     public function regUser()
    {

        /*
        $endDate = strtotime(date('Y-m-d', strtotime('2022-09-31') ) );
        $currentDate = strtotime(date('Y-m-d'));
       
        if($currentDate < $endDate) {
            echo "available";
        } else {
            echo "not available";
        }

        exit();
        */

        /// Set Time allow registration for 2023
        //$endDate = strtotime(date('Y-m-d', strtotime('2022-12-31') ) );
        //$currentDate = strtotime(date('Y-m-d'));

                $regId = $this->input->post('regId');
                $id = 1;
                $row = $this->General_model->get_by_id($id); 
                $pakej = $this->input->post('pakej');
                $ahli_khairat = $this->input->post('ahli_khairat');

                if($pakej == "Keluarga") { 
                    if($ahli_khairat == "N") { 
                        $jumlah_daftar = 0;
                        $title_yuran = "Yuran Tahunan 2023";
                        $jumlah_yuran = 0;
                    } else { 
                        $jumlah_daftar = $this->Kadar_model->get_amount_daftar(1,"y_jumlah","tbl_kadar_yuran");
                        $title_yuran = "Yuran Tahunan ".date('Y');
                        $jumlah_yuran = $this->Kadar_model->get_amount_pakej(date('Y'),"y_jumlah","tbl_kadar_yuran");
                    }
                } else if($pakej == "Bujang"){
                    if($ahli_khairat == "N") { 
                        $jumlah_daftar = 0;
                        $title_yuran = "Yuran Tahunan 2023";
                        $jumlah_yuran = 0;
                    } else { 
                        $jumlah_daftar = $this->Kadar_model->get_amount_daftar(1,"y_jumlah_bujang","tbl_kadar_yuran");
                        $title_yuran = "Yuran Tahunan ".date('Y');
                        $jumlah_yuran = $this->Kadar_model->get_amount_pakej(date('Y'),"y_jumlah_bujang","tbl_kadar_yuran");
                    }
                }

                //exit();
                //$id_daftar = 1; //tbl_kadar_yuran -> yuran pendaftaran
                //penentuan yuran ahli biasa atau yuran ahli seumur hidup
                //$roleType = $this->register_model->getRegRoleId($regId,"roleId","tbl_reg_users");
                //$roleType = 2; //ahli biasa
                //if($roleType == 2) { //ahli biasa
                 //   if($currentDate < $endDate) { // setting time new registration from today until 2023 only
                //        $title_yuran = "Yuran Tahunan 2023";
                //        $jumlah_yuran = $this->Kadar_model->get_amount_current_year(2023); //yuran tahun semasa
                  //  } else { 
                 //       $title_yuran = "Yuran Tahunan ".date('Y');
                  //      $jumlah_yuran = $this->Kadar_model->get_amount_current_year(date('Y')); //yuran tahun semasa
                 //   }
                //} else if($roleType == 4) { //ahli seumur hidup
                //    $title_yuran = "Yuran Seumur Hidup";
                //    $jumlah_yuran = $this->Kadar_model->get_amount_lifetime(2); //2 - yuran seumur hidup
                //}
                //$jumlah_tahun_semasa = $this->Kadar_model->get_amount_current_year(date('Y'));

                if ($row) {
                    $data = array(
                    'g_id' => $row->g_id,
                    'g_home_title' => $row->g_home_title,
                    'g_home_desc' => $row->g_home_desc,
                    'g_contact_info' => $row->g_contact_info,
                    'g_address' => $row->g_address,
                    'g_email' => $row->g_email,
                    'g_info_1' => $row->g_info_1, 
                    'g_info_2' => $row->g_info_2, 
                    'g_info_3' => $row->g_info_3,
                    'g_phone' => $row->g_phone,
                    'g_facebook' => $row->g_facebook,
                    'g_bankname' => $row->g_bankname,
                    'g_bankaccount' => $row->g_bankaccount, 
        'g_icon_1' => $row->g_icon_1,'g_title_1' => $row->g_title_1,'g_info_1' => $row->g_info_1, 
        'g_icon_2' => $row->g_icon_2,'g_title_2' => $row->g_title_2,'g_info_2' => $row->g_info_2, 
        'g_icon_3' => $row->g_icon_3,'g_title_3' => $row->g_title_3,'g_info_3' => $row->g_info_3, 
                    'g_logo_url' => $row->g_logo_url,
                    'yuran_pendaftaran' => $jumlah_daftar, 
                    'jumlah_yuran' => $jumlah_yuran,
                    'title_yuran' => $title_yuran,
                    );

                    //$this->global['pageTitle'] = $row->g_home_title; 
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
                }
                    
                    $roleid = 2; //ahli biasa
                    $surau = $this->input->post('blok');
                    $name = ucwords(strtoupper($this->security->xss_clean($this->input->post('name'))));
                    $icno = $this->input->post('icno');
                    $phone = $this->input->post('phone');
                    $email = $this->input->post('email');
                    $address = $this->input->post('address');
                 
                    $userInfo = array();
                    if($icno)
                    {
                        $userInfo = array('regId'=>$regId, 'email'=>$email, 'name'=>$name, 'phone'=>$phone, 'icno'=>$icno, 'address'=>$address, 'roleId'=>$roleid, 'surau'=>$surau, 'pakej'=>$pakej, 'ahli_khairat'=>$ahli_khairat, 'regdate'=>date('Y-m-d') );
                    }
                 
                $checkReg = $this->register_model->checkRegUser($regId);
                if(!empty($checkReg))
                {
                    //checked policy box
                    $polisi = $this->input->post('polisi'); 
                    if ($polisi == 'Y') { 

                        // 1- save dalam table user_appy & family_appy.. untuk pengesahan 
                        //$roleId = "2"; //ahli biasa
                        //$roleId = $roleid; 
                        $createdId = 0;
                        $regDate = date("Y-m-d");

                        //masuk maklumat ahli
                        $record = $this->register_model->getRegById($regId);
                            if ($record) {
                                $userData = array(
                            'email'=>$record->email, 'password'=>getHashedPassword($record->phone),
                            'roleId'=>$record->roleId, 'name'=> $record->name,'phone'=>$record->phone, 
                            'icno'=>$record->icno,'address'=>$record->address, 'surau'=>$record->surau, 'pakej'=>$record->pakej,
                            'ahli_khairat'=>$record->ahli_khairat,
                            'regdate'=>$regDate,'createdBy'=>$createdId);
                            $result = $this->user_model->addUserApply($userData);
                            }

                        $userId = $this->user_model->getLatestMemberApply(); //get latest member ID
                        //masuk maklumat tanggungan
                        $record2 = $this->register_model->getFamilyList($regId);
                            foreach ($record2 as $fm){
                                    if($fm->f_pertalian == "PASANGAN"){
                                        $status_pertalian = "Y";
                                    } else {
                                        $status_pertalian = "N";
                                    }
                                     $familyData = array('f_name'=>$fm->f_name, 'userid'=>$userId, 'f_icno'=>$fm->f_icno, 
                                     'f_pertalian'=>$fm->f_pertalian, 'f_pasangan'=>$status_pertalian );
                                    $result2 = $this->user_model->addFamilyApply($familyData, $userId);
                            }
                        
                            if($result){
                             //echo "success";
                             //echo $email;
                             //echo " or ";
                             //echo $record->email;
                              $success_register = $this->session->set_flashdata('success_register', 'Pendaftaran telah diterima. <br>Pihak pentadbir akan membuat semakan dan pengesahan. <br>Sila semak email anda.');
                               //exit();
                            // 2- send email pengesahan penerimaan kepada user & admin 
                               $this->send_mail($record->email, $record->name, $record->phone);
                               $this->send_whatsapp_notification(2,$record->phone,$record->name);
                               //sleep(5); //delay 5 seconds for next whatsapp
                               //$this->send_whatsapp_notification(4,$record->phone,$record->name);


                            // 3- delete current session & delete records at tbl_reg_users & tbl_reg_family
                                unset($_SESSION['tempUser']);
                                $this->register_model->delRegRecord($regId, "tbl_reg_family");
                                $this->register_model->delRegRecord($regId, "tbl_reg_users");

                            // 4- view registration status page.
                                $this->load->view('register/notification',$data);
                            }

                    } else {
                        //Jika regId telah ic wujud, 
                        //- allow to update maklumat ahli 
                        //- preview calculation kos bayaran";
                        $data['roles'] = $this->user_model->getUserRolesRegister();
                        $data['surauInfo'] = $this->Surau_model->get_all();
                        $data['getUserInfo'] = $this->register_model->getUserInfo($regId);
                        $data['regFamilylist'] = $this->register_model->getFamilyList($regId);
                        $data['pertalian'] = $this->Kadar_family_model->get_family();

                        $this->register_model->regUserUpdate($userInfo, $regId);
                        $this->load->view('register/preview',$data);
                    }
                }else{
                    //Jika regId tiada lagi, add new rekod
                    $hari = substr($icno,4,2);
                    $bulan = substr($icno,2,2);
                    $tahun = substr($icno,0,2);
                    //$error = "";

                    if (($hari <= 31) && ($bulan <= 12) && ($tahun <= 99)) {
                        if($this->user_model->is_icno_available($icno))  
                        {  
                            $this->session->set_flashdata("error","No. KP telah didaftarkan"); 
                        } else {
                            $this->register_model->regUser($userInfo);
                            //$this->session->set_flashdata("error","No. KP belum didaftarkan"); 
                        }

                    } else {
                        $this->session->set_flashdata("error","No. KP tidak sah !"); 
                        //$this->register_model->regUser($userInfo);
                    }
                    redirect('register');
                    
                }

         //   }
            //redirect('register');
        
    } 


     public function regFamilyAdd()
    {

            //print_r($_POST);
            //exit();

        $this->load->library('form_validation');
        
        $regId = $this->input->post('regId');
        
        $this->form_validation->set_rules('f_name','Nama Tanggungan','trim|required|max_length[128]');
        $this->form_validation->set_rules('f_icno','Kad Pengenalan','trim|required|numeric');
        
        if($this->form_validation->run() == TRUE)
        {
            $f_name = ucwords(strtoupper($this->security->xss_clean($this->input->post('f_name'))));
            $f_icno= $this->input->post('f_icno');
            $f_pertalian = strtoupper($this->input->post('f_pertalian'));
            $f_catatan = $this->input->post('f_catatan');
            
            $familyInfo = array();
               
            if($f_name)
            {
                $familyInfo = array(
                    'regId'=>$regId, 
                    'f_name'=>$f_name,
                    'f_icno'=>$f_icno, 
                    'f_pertalian'=>$f_pertalian,
                    'f_catatan'=>$f_catatan  
                    );
            }
            
            $hari = substr($f_icno,4,2);
            $bulan = substr($f_icno,2,2);
            $tahun = substr($f_icno,0,2);
                    //$error = "";

            if (($hari <= 31) && ($bulan <= 12) && ($tahun <= 99)) {
                if($this->user_model->is_icno_family_available($icno))  
                {  
                    $this->session->set_flashdata("error","No. KP Tanggungan telah didaftarkan"); 
                } else {
                    $this->register_model->regFamily($familyInfo);
                    //$this->session->set_flashdata("error","No. KP belum didaftarkan"); 
                }

            } else {
                $this->session->set_flashdata("error","No. KP Tanggungan tidak sah !"); 
                //$this->register_model->regUser($userInfo);
            }
            redirect('register');


             //$this->register_model->regFamily($familyInfo);
             //$this->load->view('register');
            //redirect('register');

        }
        
    } 

    public function regFamilyDelete($id)
        {
            
            $this->register_model->delFamilyList($id);
            redirect('register');
            
        } 

    public function regReset()
        {
            
            unset($_SESSION['tempUser']);
            redirect('register');
            
        } 




}

?>