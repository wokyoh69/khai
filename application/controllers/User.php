<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . '/views/functions.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Payment_model');
        $this->load->model('Feedback_model');
        $this->load->model('Khairat_model');
        $this->load->model('kadar_model');
        $this->load->model('Kadar_family_model');
        $this->load->model('General_model');
        $this->load->model('Surau_model');
        $this->load->model('Toyyibpay_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $idUser = $this->vendorId;
        $searchText = "";

        $totalpayment =  $this->Payment_model->get_total_amount_member($idUser);
 //       $totaltunggakan = 30 * $this->Payment_model->get_total_amount_arrears_member($idUser); //RM30.00 yuran setiap tahun bagi setiap ahli
        $totaltunggakan = $this->Payment_model->get_total_amount_arrears_member($idUser); //RM30.00 yuran setiap tahun bagi setiap ahli
        $unpaidcount= $this->Payment_model->countUnpaidPayment($idUser);

        $generalid = 1;
        $ro = $this->General_model->get_by_id($generalid); 
        $bil_tunggakan = 1;
        $g_payment = $ro->g_payment;
        $g_payment_text = $ro->g_payment_text;
       
       if($this->isAdmin() == TRUE)
        {
            $row = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($row) {
                $pg_url = $row->pg_url;
            }

            $addr = $this->user_model->getUserAddress($idUser);

            $data = array(
            'total_payment' => $totalpayment,
            'total_tunggakan' => $totaltunggakan,
            'unpaidcount' => $unpaidcount,
            'userid'=> $idUser,
            'pg_defaulturl'=> $pg_url,
            'tunggakan'=> $bil_tunggakan,
            'norumah'=> $addr->address,
            'namaLorong'=> $addr->namaLorong,
            'namaTaman'=> $addr->namaTaman,
            'namaUser'=> $addr->name,
            'g_payment'=> $g_payment,
            'g_payment_text'=> $g_payment_text,
            'ahli_khairat'=> $addr->ahli_khairat,
            );

            if($this->vendorId)
            {
        
            $data['paymentrecord'] = $this->Payment_model->getPaymentRecord($this->vendorId);
            $data['total_family'] = $this->user_model->getFamilyCount($this->vendorId);
            $data['total_khairat'] = $this->Khairat_model->getKhairatCount($this->vendorId);
            $data['khairatrecord'] = $this->Khairat_model->getKhairatRecord($this->vendorId);
            
            }

        } else {
        //echo "pentadbir";

        $generalid = 1;
        $row = $this->General_model->get_by_id($generalid); 
        
        $totalmembers = $this->user_model->userListingCount($searchText); //semua ahli aktif dan tidak aktif
        $totaltanggungan = $this->user_model->get_total_tanggungan();
        $totallokasi = $this->Surau_model->get_total_lokasi();
        $totalmembers_aktif =  $this->user_model->get_total_members(); //tak termasuk yang meninggal dunia
        //$totalmember_tidak_aktif =  $totalmembers - $totalmembers_aktif;
        $totalmember_tidak_aktif =  $this->user_model->userListingCount_inactive($searchText);

        $totalkhairat = $this->user_model->userKhairatCount($searchText);
        $totalkhairat_tidak_aktif =  $this->user_model->userKhairatCount_inactive($searchText);
        
        $feedback =  $this->Feedback_model->total_rows();

        $totalpayment =  $this->Payment_model->get_total_amount();
        //$totaltunggakan =  30 * $this->Payment_model->get_total_amount_arrears(); //RM30.00 yuran setiap tahun bagi setiap ahli
        $totaltunggakan =  $this->Payment_model->get_total_amount_arrears2(); 
        $totalperbelanjaan =  $this->Payment_model->get_total_amount_arrears3(); 

        $userapply =  $this->user_model->getUserListApply();
        $totalapplicant =  $this->user_model->get_total_members_apply();
        $currentbalance = $row->g_balance + $totalpayment - $totalperbelanjaan;

        $data = array(
            'feedback_number' => $feedback,
            'total_payment' => $totalpayment,
            'total_tunggakan' => $totaltunggakan,
            'total_perbelanjaan' => $totalperbelanjaan,
            'total_members' => $totalmembers,
            'total_tanggungan' => $totaltanggungan,
            'total_lokasi' => $totallokasi,
            'total_members_tidak_aktif' => $totalmember_tidak_aktif,
            'total_applicant' => $totalapplicant,
            'userApply' => $userapply,
            'g_bankname' => $row->g_bankname,
            'g_bankaccount' => $row->g_bankaccount,
            'currentbalance' => $currentbalance,
            'total_khairat' => $totalkhairat,
            'total_khairat_tidak_aktif' => $totalkhairat_tidak_aktif,
            );
       
             //echo(json_encode(array('status'=>'access')));
        }
        
        $data['surauInfo'] = $this->Surau_model->get_all();
        $data['roles'] = $this->user_model->getUserRolesRegister();
        $this->global['pageTitle'] = 'Dashboard';
        
        $this->loadViews("dashboard", $this->global, $data , NULL);
    }

    public function applicantDetail()
    {
        //print_r($_POST);
        $userId = $this->input->post('id');
        //$id_daftar = 1; //tbl_kadar_yuran -> yuran pendaftaran
        //$jumlah_daftar = $this->kadar_model->get_amount($id_daftar);

        /// Set Time allow registration for 2023
        //$endDate = strtotime(date('Y-m-d', strtotime('2022-12-31') ) );
        //$currentDate = strtotime(date('Y-m-d'));

        //$pakej = $this->input->post('pakej');
        $pakej = $this->user_model->getRoleId($userId,"pakej","tbl_apply_users");
        $ahli_khairat = $this->user_model->getRoleId($userId,"ahli_khairat","tbl_apply_users");
        if($pakej == "Keluarga") { 
            if($ahli_khairat =="N") { 
                $jumlah_daftar = 0;
                $title_yuran = "Yuran Tahunan 2023";
                $jumlah_yuran = 0;
            } else { 
                $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah","tbl_kadar_yuran");
                $title_yuran = "Yuran Tahunan ".date('Y');
                $jumlah_yuran = $this->kadar_model->get_amount_pakej(date('Y'),"y_jumlah","tbl_kadar_yuran");
            }
        } else if($pakej == "Bujang"){
            if($ahli_khairat =="Y") { // setting time new registration from today until 2023 only
                $jumlah_daftar = 0;
                $title_yuran = "Yuran Tahunan 2023";
                $jumlah_yuran = 0;
            } else { 
                $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah_bujang","tbl_kadar_yuran");
                $title_yuran = "Yuran Tahunan ".date('Y');
                $jumlah_yuran = $this->kadar_model->get_amount_pakej(date('Y'),"y_jumlah_bujang","tbl_kadar_yuran");
            }
        }


        //penentuan yuran ahli biasa atau yuran ahli seumur hidup
        $roleType = $this->user_model->getRoleId($userId,"roleId","tbl_apply_users");
        //if($roleType == 2) { //ahli biasa
        //    if($currentDate < $endDate) { // setting time new registration from today until 2023 only
        //        $title_yuran = "Yuran Tahunan 2023";
        //        $jumlah_yuran = $this->kadar_model->get_amount_current_year(2023); //yuran tahun semasa
         //   } else { 
         //       $title_yuran = "Yuran Tahunan ".date('Y');
         //       $jumlah_yuran = $this->kadar_model->get_amount_current_year(date('Y')); //yuran tahun semasa
         //   }
        //} else if($roleType == 4) { //ahli seumur hidup
         //   $title_yuran = "Yuran Seumur Hidup";
        //    $jumlah_yuran = $this->kadar_model->get_amount_lifetime(2); //2 - yuran seumur hidup
        //}

         $data = array(
            //'id_yuran_daftar' => $id_daftar,
            'yuran_pendaftaran' => $jumlah_daftar,
            'jumlah_yuran' => $jumlah_yuran,
            'title_yuran' => $title_yuran,
            //'roleType' => $roleType,
            );
         
        $data['applicant_info'] = $this->user_model->getApplicantInfo($userId);
        $data['surauInfo'] = $this->Surau_model->get_all();
        $data['roles'] = $this->user_model->getUserRolesRegister();
        //echo "test";
        $data['apf'] = $this->user_model->getApplicantFamily($userId);
        $this->load->view('register/applicant_detail',$data); 
    }

    public function applicantFamilyDetail()
    {
        $userId = $this->input->post('id');
        //$data['applicant_info'] = $this->user_model->getApplicantInfo($userId);
        //echo "test";
        //$data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
        $data['applicant_family'] = $this->user_model->getApplicantFamily($userId);
        $this->load->view('register/applicant_family_detail',$data); 
    }


    function applicantApprove($id)
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
        //read applicant records
        $this->load->model('user_model');
        $row = $this->user_model->getApplicantInfo($id); 
        foreach ($row as $userr)
          { 
              $display_id =  $userr->userId; $display_nama =  $userr->name; $display_status = $userr->status;
              $display_email =  $userr->email; $display_phone =  $userr->phone; $display_regdate =  $userr->regdate;
              $display_icno =  $userr->icno; $display_address =  $userr->address; $display_surau =  $userr->surau;
              $display_pakej =  $userr->pakej; $khairat =  $userr->ahli_khairat; $display_roleid =  $userr->roleId;
          } 

        $name = ucwords(strtolower($this->security->xss_clean($display_nama)));
        $email = $this->security->xss_clean($display_email);
        $password = $display_phone; //phone as default password
        //$roleId = 2 ; //Ahli Biasa
        $phone = $display_phone;
        $icno = $display_icno ;
        $regDate = $display_regdate;
        $address = $display_address;
        $surau = $display_surau;
        $pakej = $display_pakej;
        $ahli_khairat = $khairat;
        $roleId = $display_roleid;
        
        //move data to tbl_user
        $userInfo = array(
            'email'=>$email, 'password'=>getHashedPassword($password),
            'name'=> $name,'phone'=>$phone, 'icno'=>$icno, 
            'address'=>$address, 'surau'=>$surau, 'pakej'=>$pakej, 'ahli_khairat'=>$ahli_khairat, 'regdate'=>$regDate, 
            'roleId'=>$roleId,'createdBy'=>$this->vendorId  
            );
        $result = $this->user_model->addNewUser($userInfo);

        if ($result > 0) { 
            (json_encode(array('status'=>TRUE)));

            //afterr success copy.. update tbl_user_apply.isDeleted to 1
            $userInfoUpdate = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));    
            $result = $this->user_model->applicantReject($id, $userInfoUpdate);

            //hantar emel notification ke pemohon dan cc pentadbir
            $this->send_mail_success($email, $name, $phone, $icno, $pakej, $surau);

            //Get latest ID memberx
            $user_id = $this->user_model->getLatestMember();

            //Determine pakej
            //$endDate = strtotime(date('Y-m-d', strtotime('2022-12-31') ) );
            //$currentDate = strtotime(date('Y-m-d'));
            if($pakej == "Keluarga") { 
                if($ahli_khairat == "N") { 
                    //$jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah","tbl_kadar_yuran");
                    $jumlah_daftar = 0;
                    $title_yuran = "Yuran Tahunan 2023";
                    $jumlah_yuran = 0;
                    $id_yuran_tahunan = 0;
                } else { 
                    $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah","tbl_kadar_yuran");
                    $title_yuran = "Yuran Tahunan ".date('Y');
                    $jumlah_yuran = $this->kadar_model->get_amount_pakej(date('Y'),"y_jumlah","tbl_kadar_yuran");
                    $id_yuran_tahunan = $this->kadar_model->get_id_by_year(date('Y'));
                }
            } else if($pakej == "Bujang"){
                if($ahli_khairat == "N") { 
                    $jumlah_daftar = 0;
                    $title_yuran = "Yuran Tahunan 2023";
                    $jumlah_yuran = 0;
                    $id_yuran_tahunan = 0;
                } else {
                    $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah_bujang","tbl_kadar_yuran");
                    $title_yuran = "Yuran Tahunan ".date('Y');
                    $jumlah_yuran = $this->kadar_model->get_amount_pakej(date('Y'),"y_jumlah_bujang","tbl_kadar_yuran");
                    $id_yuran_tahunan = $this->kadar_model->get_id_by_year(date('Y'));
                }
            }

            //CREATE YURAN PENDAFTARAN AHLI
            if($ahli_khairat == "Y") {
                $yuran_pendaftaran = array(
                    'userid' => $user_id,
                    'yid' => 1,
                    'total_amaun' =>  $jumlah_daftar,
                    'amaun' =>  $jumlah_daftar);
            if($jumlah_daftar > 0 ){
                $this->Payment_model->insert($yuran_pendaftaran); //yuran pendaftaran
            }

            //CREATE YURAN TAHUN SEMASA 
            //penentuan yuran tahunan pakej bujang atau pakej keluarga
                //$roleType = $this->user_model->getRoleId($user_id,"roleId","tbl_users");
                $yuran_tahun_semasa = array(
                    'userid' => $user_id,
                    'yid' => $id_yuran_tahunan,
                    'amaun' =>  $jumlah_yuran, 
                    'total_amaun' =>  $jumlah_yuran, 
                );
                $this->Payment_model->insert($yuran_tahun_semasa);  //yuran keseluruhan tahun semasa
                $payment_id = $this->user_model->getLatestPayment();

                //payment details yuran ahli
                $umur = umur($icno);
                $yuran = yuran("AHLI", $umur); //*******
                //$jum_yuran_ahli = total_yuran_in_year(date('m'),$yuran);
                //$jumlah_ahli = yuran($userr->f_pertalian, $umur);

                $paymentDetails = array(
                            'p_id'=>$payment_id, 
                            'userid'=>$user_id, 
                            //'amaun'=>$jum_yuran_ahli,  
                            'amaun'=>$yuran, 
                            );
                $this->Payment_model->insert_details($paymentDetails);
            } //end if 


            //masukkan rekod tanggungan ahli
            $checkUser = $this->user_model->checkIdExisted($id,"tbl_apply_family");
            if(!empty($checkUser))
                {
                    $jumlah_ahli = 0;
                    $total = 0;

                    $rowf = $this->user_model->getApplicantFamily($id);
                    foreach ($rowf as $fam)
                      { 
                          /*$userid =  $user_id; 
                          $f_name =  $fam->f_name; 
                          $f_icno = $fam->f_icno;
                          $f_phone =  $fam->f_phone; 
                          $f_jantina =  $fam->f_jantina; 
                          $f_pertalian =  $fam->f_pertalian;
                          $f_pasangan =  $fam->f_pasangan; 
                          $approval =  "Y";*/
                         
                        $familyInfo = array(
                            'f_name'=>$fam->f_name, 
                            'userid'=>$user_id, 
                            'f_icno'=>$fam->f_icno,  
                            'f_pertalian'=>$fam->f_pertalian, 
                            'f_pasangan'=>$fam->f_pasangan, 
                            'approval' => "Y"
                            );
                        $this->user_model->addFamily($familyInfo);
                        $familyInfoUpdate = array('isDeleted'=>1);  
                        $this->user_model->applicantRejectFamily($id, $familyInfoUpdate);

                        $umurF = umur($fam->f_icno);
                        $yuranF = yuran($fam->f_pertalian, $umurF);
                        $total = $total + $yuranF;

                        //insert payment detail setiap ahli tanggungan
                        //Get latest payment ID
                        if($ahli_khairat == "Y") {
                            $f_id = $this->user_model->getLatestFamilyMember();
                            $paymentfamilyInfo = array(
                                'p_id'=>$payment_id,
                                'userid'=>$user_id,  
                                'f_id'=>$f_id, 
                                'amaun'=>$yuranF,  
                                );
                            
                                $this->Payment_model->insert_details($paymentfamilyInfo);
                        }
                      } 

                      //UPDATE PAYMENT (AHLI + TANGGUNGAN)
                      //$payment_id = $this->user_model->getLatestPayment();
                      if($ahli_khairat == "Y") {
                          $jumlah_keseluruhan_yuran = $jumlah_yuran + $yuran + $total;
                          $paymentInfo = array('total_amaun'=>$jumlah_keseluruhan_yuran);
                          $this->Payment_model->updatePayment($payment_id,$paymentInfo);
                      }

                }
                
                //to get prefix members id
                $generalid = 1;
                $rec = $this->General_model->get_by_id($generalid); 
                $prefix = $rec->g_contact_info;
         
                //$no_ahli = date("Y")."-".sprintf('%05d',$user_id);
                $no_ahli = $prefix."-".sprintf('%04d',$user_id);
                $userInfoUpdate = array('noAhli'=>$no_ahli,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));  
                $this->user_model->editUser($userInfoUpdate, $user_id);

        }   else { 
            (json_encode(array('status'=>FALSE))); 
            //redirect('dashboard');
        }
        $this->index();
        //redirect('dashboard');

        }
                
    }

    public function send_mail_success($email, $name, $phone, $icno, $pakej, $surau) { 
        $generalid = 1;
        $row = $this->General_model->get_by_id($generalid); 
         $from_email = $row->g_email;
         $to_email = $email; 
         $subject = "Maklumat Akaun ".$name;
   
         //Load email library 
         $this->load->library('email'); 
         $this->email->from($from_email, $row->g_contact_info); 

         $data = array(

            'userName'=> $name,
            'email'=> $email,
            'phone'=> $phone,
            'icno'=> $icno,
            'surau'=> $surau,
            'pakej'=> $pakej,
         );

         $this->email->to($to_email);
         $this->email->cc($from_email);
         $this->email->subject($subject); 
         //$this->email->message('Testing the email class.'); 
         $data['generalinfo'] = $this->General_model->get_by_id_array($generalid);
   
         $body = $this->load->view('email/success_message.php',$data,TRUE);
         $this->email->message($body); 

         //Send mail 
         if($this->email->send()) 
            $this->session->set_flashdata("email_sent","Email sent successfully."); 
         else 
            $this->session->set_flashdata("email_sent","Error in sending Email."); 
            //$this->load->view('email_form'); 
    } 


    function applicantReject($id)
    {

        //echo "delete user";
        //exit();
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {   

            //Delete User application & his/her family
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            $familyInfo = array('isDeleted'=>1);
            
            $delete = $this->user_model->applicantRejectFamily($id, $familyInfo);
            $result = $this->user_model->applicantReject($id, $userInfo);
            
            if ($result > 0) { 
                (json_encode(array('status'=>TRUE))); 
            } else { 
                (json_encode(array('status'=>FALSE))); 
            }
            //$this->load->view('dashboard'); 
        }

        $this->index();

    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {       

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $surauid = $this->input->post('surau'); 
            $ahli_khairat = $this->input->post('ahli_khairat'); 

            $data['searchText'] = $searchText;
            $data['surau_id'] = $surauid;
            $data['ahlikhairat'] = $ahli_khairat;

            $this->load->library('pagination');            
            $count = $this->user_model->userListingCount($searchText, $surauid, $ahli_khairat);
            $returns = $this->paginationCompress ( "userListing/", $count, 500 );
            $data['userRecords'] = $this->user_model->userListing($searchText, $surauid, $ahli_khairat, $returns["page"], $returns["segment"]);
            
            $data['rows'] = $count;
            $data['unpaidPaymentlist'] = $this->Payment_model->UnpaidPaymentList();
            $data['newFamily'] = $this->user_model->getNewFamily();
            $data['surau'] = $this->Surau_model->get_all();

            $this->global['pageTitle'] = 'Senarai Ahli';
            
            $this->loadViews("users", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the user list
     */
    function userListing_inActive()
    {
        //echo "test";
        //exit();

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {       

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->userListingCount_inactive($searchText);

            $returns = $this->paginationCompress ( "inActive/", $count, 500 );
            
            $data['userRecords'] = $this->user_model->userListing_inactive($searchText, $returns["page"], $returns["segment"]);
            
            $data['rows'] = $count;
            //$data['newFamily'] = $this->user_model->getNewFamily();

            $this->global['pageTitle'] = 'Senarai Ahli Tidak Aktif';
            
            $this->loadViews("users_inactive", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the user list
     */
    function familyListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {       

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->familyListingCount($searchText);

            $returns = $this->paginationCompress ( "familyListing/", $count, 50 );
            
            $data['familyRecords'] = $this->user_model->familyListing($searchText, $returns["page"], $returns["segment"]);
            
            $data['rows'] = $count;
            //$data['newFamily'] = $this->user_model->getNewFamily();

            $this->global['pageTitle'] = 'Senarai Tanggungan';
            
            $this->loadViews("family", $this->global, $data, NULL);
        }
    }



    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');

            
            $data['last_userID'] = $this->user_model->getLatestMember();
            if ($this->vendorId != "0") {
                $data['roles'] = $this->user_model->getUserRoles();
            } else {
                $data['roles'] = $this->user_model->getUserRolesSuperAdmin();
            }
            $data['surau'] = $this->Surau_model->get_all();
            $data['generalinfo'] = $this->General_model->get_by_id_array(1);
            
            $this->global['pageTitle'] = 'Pendaftaran Ahli';

            $this->loadViews("addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {


        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            //$this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = $this->security->xss_clean($this->input->post('email'));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role'); //2-Ahli Biasa, 3-Ahli Asnaf, 4-Ahli Seumur Hidup
                $phone = $this->input->post('phone');
                $icno = $this->input->post('icno');
                $regDate = $this->input->post('regDate');
                $noAhli = $this->input->post('noAhli');
                $address = $this->input->post('address');
                $surau = $this->input->post('surau');
                $pakej = $this->input->post('pakej');
                 //check IC Number existed or not
                 $checkIc = $this->user_model->checkIcExisted($icno);

                $data = array(
                        'fname' => set_value('fname'),
                        'email' => set_value('email'),
                        'icno' => set_value('icno'),
                        'phone' => set_value('phone'),
                        'address' => set_value('address'),
                        'lot' => set_value('lot'),
                        'regDate' => set_value('regDate'),
                        );

                $data['last_userID'] = $this->user_model->getLatestMember();
                $data['roles'] = $this->user_model->getUserRoles();
                $hari = substr($icno,4,2);
                $bulan = substr($icno,2,2);
                $tahun = substr($icno,0,2);
                //$error = "";
                $this->global['pageTitle'] = 'Pendaftaran Ahli';

                if (($hari <= 31) && ($bulan <= 12) && ($tahun <= 99)) {
                    if(!empty($checkIc))
                    {
                        //echo telah ic wujud";
                        $error = $this->session->set_flashdata('error', 'Harap Maaf! Nombor Kad Pengenalan <b>'.$icno.'</b> telah didaftarkan.');
                        $this->loadViews("addNew", $this->global, $data, NULL);

                    }else{
                    
                        $userInfo = array('noAhli'=>$noAhli,'email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'surau'=> $surau, 'pakej'=> $pakej, 'name'=> $name,'phone'=>$phone, 'address'=>$address,'icno'=>$icno,'regdate'=>$regDate,'createdBy'=>$this->vendorId );
                        
                        $this->load->model('user_model');
                        $result = $this->user_model->addNewUser($userInfo);

                            if($result > 0)
                            {
                                //echo $new_memberID = $this->user_model->getLatestMember();
                                //exit();
                                $this->send_mail_success($email, $name, $phone, $icno, $pakej, $surau);
                                $new_memberID = $this->user_model->getLatestMember();

                                //$this->session->set_flashdata('success', 'Pendaftaran Ahli Baru Berjaya. Lihat dan Kemaskini Ahli Baru [<a href="'.base_url().'editUsers/'.$new_memberID.'">'.$new_memberID.'</a>]' );
                                $this->session->set_flashdata('success', 'Pendaftaran Berjaya');
                                $this->editUsers($new_memberID);
                            }
                            else

                            {
                                $this->session->set_flashdata('error', 'Pendaftaran Ahli Gagal');
                                $this->loadViews("addNew", $this->global, $data, NULL);
                            }
                    }
                } else {
                    $this->session->set_flashdata("error","No. KP tidak sah !"); 
                    $this->loadViews("addNew", $this->global, $data, NULL);
                }
                
                //redirect('addNew');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editUsers($userId = NULL)
    {
        $this->load->model('Payment_model');

        if($this->isAdmin() == TRUE || $userId == 0)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }

            $row = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($row) { $pg_url = $row->pg_url;}
            //'pg_defaulturl'=> $pg_url,

            /*$tagsUser = $this->user_model->getTagsList($userId);
            foreach ($tgs as $tagsUser) {
                $checked_arr = explode(",",$tgs->tags_id);
            }*/

            $unpaidcount= $this->Payment_model->countUnpaidPayment($userId);
            $data = array(
            'adminId'=> $this->vendorId,
            'unpaidcount' => $unpaidcount,
            'pg_defaulturl'=> $pg_url,
            //'checked_arr'=> $checked_arr,
            );
            
            $data['tagsInfo'] = $this->user_model->get_all_tags();
            $data['tagsUser'] = $this->user_model->getTagsList($userId);

            $data['surauInfo'] = $this->Surau_model->get_all();
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
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email_acc','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            //$this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editUsers($userId);
            }
            else
            {
                //print_r($_POST['tags']);
                //exit();
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = $this->security->xss_clean($this->input->post('email_acc'));
                   //$email = $this->security->xss_clean($this->input->post('email'));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $phone = $this->input->post('phone');
                $icno = $this->input->post('icno');
                $regdate = $this->input->post('regDate');
                $status = $this->input->post('status');
                $catatan = $this->input->post('catatan');
                $address = $this->input->post('address');
                $noAhli = $this->input->post('noAhli');
                $surau = $this->input->post('surau');
                $pakej = $this->input->post('pakej');
                $ahli_khairat = $this->input->post('ahli_khairat');
                
                $userInfo = array();
                
                /*
                  //check IC Number existed or not
                $checkIc = $this->user_model->checkIcExisted($icno);
                if(!empty($checkIc))
                {
                    //echo telah ic wujud";
                    $error = $this->session->set_flashdata('error', 'Harap Maaf! Nombor Kad Pengenalan <b>'.$icno.'</b> telah didaftarkan.');

                }else{*/
                   
                    if(empty($password))
                    {
                        $userInfo = array('noAhli'=>$noAhli,'email'=>$email, 'roleId'=>$roleId, 'name'=>$name, 'icno'=>$icno, 'regdate'=>$regdate, 'catatan'=>$catatan,'surau'=>$surau, 'pakej'=>$pakej,'ahli_khairat'=>$ahli_khairat,
                                        'status'=>$status, 'phone'=>$phone, 'address'=>$address, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                    }
                    else
                    {
                        $userInfo = array('noAhli'=>$noAhli,'email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'regdate'=>$regdate,'catatan'=>$catatan,'surau'=>$surau, 'pakej'=>$pakej,'ahli_khairat'=>$ahli_khairat,
                            'status'=>$status, 'name'=>ucwords($name), 'icno'=>$icno, 'phone'=>$phone, 'address'=>$address, 'updatedBy'=>$this->vendorId, 
                            'updatedDtm'=>date('Y-m-d H:i:s'));
                    }
                    
                    //update users tags
                    $this->user_model->deleteUserTags($userId); //delete all related too users
                    $checkbox = $this->input->post('tags');
                    if(!empty($checkbox)){
                        for($i=0;$i<count($checkbox);$i++){
                            $tg_id = $checkbox[$i];
                            $tagsInfo = array('userid'=>$userId,'tags_id'=>$tg_id);    
                            $this->user_model->addUserTags($tagsInfo);   //add all tags related to users;                   
                        }
                    }

                    //update users records
                    $result = $this->user_model->editUser($userInfo, $userId);
                    
                    if($result == true)
                    {
                        $this->session->set_flashdata('success', 'Kemaskini Telah Berjaya');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Kemaskini Gagal');
                    }
               /* }  */ 
                    //redirect('userListing');
                    $this->editUsers($userId);
            }
        }
    }


    /**
     * This function is used to edit the user information
     */

    function addFamily()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fy_name','Nama Tanggungan','trim|required|max_length[128]');
            //$this->form_validation->set_rules('fy_icno','Kad Pengenalan','trim|required|numeric');
            //$this->form_validation->set_rules('fy_jantina','Mobile Number','required|min_length[10]');
            $this->form_validation->set_rules('fy_pertalian','Pertalian','trim|required|max_length[25]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editUsers($userId);
            }
            else
            {
                $f_name = ucwords(strtoupper($this->security->xss_clean($this->input->post('fy_name'))));
                $f_icno= $this->input->post('fy_icno');
                //$f_jantina = $this->input->post('fy_jantina');
                $f_pertalian = strtoupper($this->input->post('fy_pertalian'));
                $f_phone = $this->input->post('fy_phone');
                
                //$familyInfo = array();
                //check IC Number Familyexisted or not
                //$totalpayment =  $this->Payment_model->get_total_amount_member($idUser);
                //$id_tahun_daftar = $this->kadar_model->get_id_by_year(date('Y')); 
                $hari = substr($f_icno,4,2);
                $bulan = substr($f_icno,2,2);
                $tahun = substr($f_icno,0,2);
                        //$error = "";
                //$message = "";
                //$message_warning = "";
                //$message_error = "";

                if (($hari <= 31) && ($bulan <= 12) && ($tahun <= 99)) {
                     $checkIcFamily = $this->user_model->checkIcExisted_family($f_icno);
                        if(!empty($checkIcFamily))
                        {
                            //echo telah ic wujud";
                            $error = $this->session->set_flashdata('error', 'Harap Maaf! Nombor KP Tanggungan <b>'.$f_icno.'</b> telah didaftarkan.');
                            //$message_error = "Harap Maaf! Nombor KP Tanggungan <b>".$f_icno."</b> telah didaftarkan.";
                        }else{
                            $umur = umur($f_icno); //get umur 
                    
                            if($f_pertalian == "ANAK"){ //syarat pendaftaran anak
                                //if($umur > 21) {
                                    //$message_warning = "Pendaftaran gagal! Umur anak hendaklah kurang dari 21 tahun";
                                    //$this->session->set_flashdata("error","Pendaftaran gagal! Umur anak hendaklah kurang dari 21 tahun"); 
                                //} else {
                                    $familyInfo = array('
                                        f_name'=>$f_name, 
                                        'userid'=>$userId, 
                                        'f_icno'=>$f_icno, 
                                        //'f_jantina'=>$f_jantina, 
                                        'f_phone'=>$f_phone, 
                                        'f_pertalian'=>$f_pertalian, 
                                        );
                                    $resultA = $this->user_model->addFamily($familyInfo, $userId);
                                    if($resultA == true)
                                    {
                                        $this->session->set_flashdata('success', 'Maklumat anak telah disimpan');
                                        //$message = "Maklumat tanggungan telah disimpan";
                                    }   
                                //}
                            } else { //selain anak
                                    $familyInfo = array('
                                        f_name'=>$f_name, 
                                        'userid'=>$userId, 
                                        'f_icno'=>$f_icno, 
                                        //'f_jantina'=>$f_jantina, 
                                        'f_phone'=>$f_phone, 
                                        'f_pertalian'=>$f_pertalian, 
                                        );
                                    $resultB = $this->user_model->addFamily($familyInfo, $userId);
                                    if($resultB == true)
                                    {
                                        $this->session->set_flashdata('success', 'Maklumat tanggungan telah disimpan');
                                        //$message = "Maklumat tanggungan telah disimpan";
                                    } 
                            }  
                        }  

                } else {
                    $this->session->set_flashdata("error","No. KP tidak sah !"); 
                }
                $this->editUsers($userId);
            }
        }
    }
    

    function addFamilyProfile()
    {
        
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');

            //exit();
            
            $this->form_validation->set_rules('fy_name','Nama Tanggungan','trim|required|max_length[128]');
            //$this->form_validation->set_rules('fy_icno','Kad Pengenalan','trim|required|numeric');
            //$this->form_validation->set_rules('fy_jantina','Mobile Number','required|min_length[10]');
            //$this->form_validation->set_rules('fy_pertalian','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editProfile($userId);
            }
            else
            {
                $f_name = ucwords(strtolower($this->security->xss_clean($this->input->post('fy_name'))));
                $f_icno= $this->input->post('fy_icno');
                //$f_jantina = $this->input->post('fy_jantina');
                $f_pertalian = $this->input->post('fy_pertalian');
                $f_phone = $this->input->post('fy_phone');
                //$f_pasangan = $this->input->post('fy_pasangan');
                if ($f_pertalian == "PASANGAN") { //as define on tbl_kadar_yuran_family
                    $f_pasangan = "Y";
                } else {
                    $f_pasangan = "N";
                }
                
                $familyInfo = array();
                
                /*
                  //check IC Number existed or not
                $checkIc = $this->user_model->checkIcExisted($icno);
                if(!empty($checkIc))
                {
                    //echo telah ic wujud";
                    $error = $this->session->set_flashdata('error', 'Harap Maaf! Nombor Kad Pengenalan <b>'.$icno.'</b> telah didaftarkan.');
                }else{*/
                $hari = substr($f_icno,4,2);
                $bulan = substr($f_icno,2,2);
                $tahun = substr($f_icno,0,2);
                        //$error = "";
                $message = "";
                $message_warning = "";
                $message_error = "";


                if (($hari <= 31) && ($bulan <= 12) && ($tahun <= 99)) {

                    $umur = umur($f_icno); //get umur 
                    
                    if($f_pertalian == "ANAK"){ //syarat pendaftaran anak
                        //if($umur > 21) {
                            //$message_warning = "Pendaftaran gagal! Umur anak hendaklah kurang dari 21 tahun";
                            //$this->session->set_flashdata("warning","Pendaftaran gagal! Umur anak hendaklah kurang dari 21 tahun"); 
                        //} else {
                            $familyInfo = array(
                            'f_name'=>$f_name, 
                            'userid'=>$userId, 
                            'f_icno'=>$f_icno, 
                            //'f_jantina'=>$f_jantina,
                            'f_pasangan'=>$f_pasangan, 
                            'f_phone'=>$f_phone, 
                            'f_pertalian'=>$f_pertalian);
                            $result = $this->user_model->addFamily($familyInfo, $userId);
                            if($result == true)
                            {
                                $message = "Maklumat anak telah disimpan";
                                //$this->session->set_flashdata('success', 'Maklumat anak telah disimpan');
                            }
                        //}
                    } else { //selain anak
                        $familyInfo = array(
                            'f_name'=>$f_name, 
                            'userid'=>$userId, 
                            'f_icno'=>$f_icno, 
                            //'f_jantina'=>$f_jantina,
                            'f_pasangan'=>$f_pasangan, 
                            'f_phone'=>$f_phone, 
                            'f_pertalian'=>$f_pertalian);   
                            $result = $this->user_model->addFamily($familyInfo, $userId);
                            if($result == true)
                            {
                                $message = "Maklumat tanggungan telah disimpan";
                                //$this->session->set_flashdata('success', 'Maklumat tanggungan telah disimpan');
                            }    
                    }
                    
                } else {
                    //$this->session->set_flashdata("error","No. KP tidak sah !"); 
                    $message_error = "No. Kad Pengenalan tidak sah !";
                }
                    
            }
            $this->global['pageTitle'] = 'Kemaskini Ahli';
            $data = array(
                'message'=> $message,
                'message_error'=> $message_error,
                'message_warning'=> $message_warning,
            );
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($this->vendorId);
            $data['familyInfo'] = $this->user_model->getFamilyList($this->vendorId);
            $data['khairatrecord'] = $this->Khairat_model->getKhairatRecord($this->vendorId);
            $data['pertalian'] = $this->Kadar_family_model->get_family();
            $data['documentInfo'] = $this->user_model->getDocumentList($userId);
            $data['yuranlist'] = $this->kadar_model->get_all();
            $data['surauInfo'] = $this->Surau_model->get_all();
            
            $this->loadViews("editProfile", $this->global, $data, NULL);
    }

    function updateFamilyMembers()
        {
            
                //print_r($_POST);
                //exit();
                $userId = $this->input->post('userId');
                $familyId = $this->input->post('familyId');
                $f_icno= $this->input->post('fy_icno');
                $f_pertalian = strtoupper($this->input->post('fy_pertalian'));
                $phone = $this->input->post('phone');
                 if ($f_pertalian == "PASANGAN") { //as define on tbl_kadar_yuran_family
                    $f_pasangan = "Y";
                } else {
                    $f_pasangan = "N";
                }
                
                $familyInfo = array();
                $hari = substr($f_icno,4,2);
                $bulan = substr($f_icno,2,2);
                $tahun = substr($f_icno,0,2);
                $message = "";
                $message_warning = "";
                $message_error = "";
                $checkIcFamily = $this->user_model->checkIcExisted_family($f_icno);
                //if(!empty($checkIcFamily))
                //{
                    //echo "ic wujud";
                    //$this->session->set_flashdata('warning', 'Peringatan. Nombor KP <b>'.$f_icno.'</b> telah didaftarkan.');
                //} else {
                    //echo "tak wujud";
                    if (($hari <= 31) && ($bulan <= 12) && ($tahun <= 99)) {
                        $umur = umur($f_icno); //get umur 
                        if($f_pertalian == "ANAK"){ //syarat pendaftaran anak
                            //if($umur > 21) {
                                //$message_warning = "Pendaftaran gagal! Umur anak hendaklah kurang dari 21 tahun";
                                //$this->session->set_flashdata("warning","Pendaftaran gagal! Umur anak hendaklah kurang dari 21 tahun"); 
                            ///} else {
                                $familyInfo = array('f_icno'=>$f_icno,'f_pertalian'=>$f_pertalian,'f_phone'=>$phone);    
                                $result = $this->user_model->updateFamily($familyId, $familyInfo);
                                 if($result == true)
                                    {
                                        //$this->session->set_flashdata('success', 'Maklumat Tanggungan Telah Dikemaskini');
                                        $message = "Maklumat anak telah dikemaskini";
                                    } 
                            //}
                        } else { //selain anak
                            $familyInfo = array('f_icno'=>$f_icno,'f_pertalian'=>$f_pertalian,'f_phone'=>$phone);    
                            $result = $this->user_model->updateFamily($familyId, $familyInfo);
                             if($result == true)
                                {
                                    //$this->session->set_flashdata('success', 'Maklumat Tanggungan Telah Dikemaskini');
                                    $message = "Maklumat tanggungan telah dikemaskini";
                                } 
                        }
                    } else {
                        //echo "ic wujud";
                        //$this->session->set_flashdata('error', 'Harap Maaf! Nombor KP tidak sah');
                        $message_error = "Harap Maaf! Nombor KP tidak sah";
                    }

                //}
            $this->global['pageTitle'] = 'Kemaskini Ahli';
            $data = array(
                'message'=> $message,
                'message_error'=> $message_error,
                'message_warning'=> $message_warning,
            );
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($this->vendorId);
            $data['familyInfo'] = $this->user_model->getFamilyList($this->vendorId);
            $data['khairatrecord'] = $this->Khairat_model->getKhairatRecord($this->vendorId);
            $data['pertalian'] = $this->Kadar_family_model->get_family();
            $data['documentInfo'] = $this->user_model->getDocumentList($userId);
            $data['yuranlist'] = $this->kadar_model->get_all();
            $data['surauInfo'] = $this->Surau_model->get_all();
            
            $this->loadViews("editProfile", $this->global, $data, NULL);
            
        }


    public function familyDetail()
    {
        
        //echo $id;
        //$this->load->view('checkname_detail'); 
        //echo "masak";
        $id = $this->input->post('id');
        //exit();
        $data['family_data'] = $this->user_model->getFamilyInfo($id); 
        $data['pertalian'] = $this->Kadar_family_model->get_family();
        //$data['paymentrecord'] = $this->payment_model->getPaymentRecord($id);
        $this->load->view('family_detail',$data); 
        
    }

    public function familyDetailMembers()
    {
        
        //echo $id;
        //$this->load->view('checkname_detail'); 
        //echo "masak";
        $id = $this->input->post('id');
        //exit();
        $data['family_data'] = $this->user_model->getFamilyInfo($id); 
        $data['pertalian'] = $this->Kadar_family_model->get_family();
        //$data['paymentrecord'] = $this->payment_model->getPaymentRecord($id);
        $this->load->view('family_detail_members',$data); 
        
    }


    /**
     * This function is used to edit the user information
     */
    function editProfile()
    {
      
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            //exit();
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email_acc','Email','trim|required|valid_email|max_length[128]');
            
            //exit();
            if($this->form_validation->run() == FALSE)
            {
                //echo "ya";
                $this->editProfile($userId);
            }
            else
            {
                //echo "no";
                //exit();

                //$name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = $this->security->xss_clean($this->input->post('email_acc'));
                //$password = $this->input->post('password');
                //$roleId = $this->input->post('role');
                $phone = $this->input->post('phone');
                //$icno = $this->input->post('icno');
                //$regdate = $this->input->post('regDate');
                //$status = $this->input->post('status');
                $surau = $this->input->post('surau');
                $catatan = $this->input->post('catatan');
                $address = $this->input->post('address');
                
                $userInfo = array();
                $userInfo = array('email'=>$email, 'phone'=>$phone, 'address'=>$address, 'surau'=>$surau, 'catatan'=>$catatan, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
              
                    $result = $this->user_model->editUser($userInfo, $userId);

                    //exit();    
                    if($result == true)
                    {
                        $this->session->set_flashdata('success', 'Kemaskini Telah Berjaya');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Kemaskini Gagal');
                    }
               /* }  */ 
                    //redirect('userListing');
                    //$this->editProfile($userId);
                    //$this->loadViews("loadChangeProfile", $this->global, NULL, NULL);
                    $this->global['pageTitle'] = 'Kemaskini Ahli';
                    /*$data = array(
                        'message'=> $message,
                        'message_error'=> $message_error,
                        'message_warning'=> $message_warning,
                    );*/

                    $data['roles'] = $this->user_model->getUserRoles();
                    $data['userInfo'] = $this->user_model->getUserInfo($userId);
                    $data['surauInfo'] = $this->Surau_model->get_all();

                    //echo $this->vendorId;
                    //exit();
                    $data['familyInfo'] = $this->user_model->getFamilyList($userId);
                    $data['pertalian'] = $this->Kadar_family_model->get_family();
                    $data['documentInfo'] = $this->user_model->getDocumentList($userId);
                    
                    $this->loadViews("editProfile", $this->global, $data, NULL);
            }
        
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

     function updateFamily()
        {
            if($this->isAdmin() == TRUE)
            {
                echo(json_encode(array('status'=>'access')));
            }
            else
            {
                //print_r($_POST);
                //exit();
                $userId = $this->input->post('userId');
                $familyId = $this->input->post('familyId');
                $f_name = ucwords(strtoupper($this->security->xss_clean($this->input->post('fy_name'))));
                $f_icno= $this->input->post('fy_icno');
                $f_pertalian = strtoupper($this->input->post('fy_pertalian'));

                $deathStatus = $this->input->post('deathStatus');
                $pasanganStatus = $this->input->post('fy_pasangan');
                $deathDtm = $this->input->post('deathDtm');
                $phone = $this->input->post('phone');
                $approval = $this->input->post('approval');

                //$familyInfo = array();
                //$familyInfo = array('email'=>$email, 'phone'=>$phone, 'address'=>$address, 'catatan'=>$catatan, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                $checkIcFamily = $this->user_model->checkIcExisted_family($f_icno);


                //if(!empty($checkIcFamily))
                //{
                    //echo "ic wujud";
                    //$this->session->set_flashdata('error', 'Harap Maaf! Nombor KP Tanggungan <b>'.$f_icno.'</b> telah didaftarkan.');
                //} else {
                    //echo "tak wujud";
                    $hari = substr($f_icno,4,2);
                    $bulan = substr($f_icno,2,2);
                    $tahun = substr($f_icno,0,2);
                    $error = "";

                    if (($hari <= 31) && ($bulan <= 12) && ($tahun <= 99)) {
                        $familyInfo = array('f_name'=>$f_name,'f_icno'=>$f_icno, 'deathStatus'=>$deathStatus,'f_pertalian'=>$f_pertalian,
                        'f_phone'=>$phone,'deathDtm'=>$deathDtm,'approval'=>$approval );    
                        $result = $this->user_model->updateFamily($familyId, $familyInfo);
                         if($result == true)
                            {
                                $this->session->set_flashdata('success', 'Maklumat Tanggungan Telah Dikemaskini');
                            } 
                    } else {
                        //echo "ic wujud";
                        $this->session->set_flashdata('error', 'Harap Maaf! Nombor KP tidak sah');
                    }

                //}
            
            $row = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($row) { $pg_url = $row->pg_url;}
            //'pg_defaulturl'=> $pg_url,

            $unpaidcount= $this->Payment_model->countUnpaidPayment($userId);
            $data = array(
            'adminId'=> $this->vendorId,
            'unpaidcount' => $unpaidcount,

            );

            $data['tagsInfo'] = $this->user_model->get_all_tags();
            $data['tagsUser'] = $this->user_model->getTagsList($userId);
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            $data['familyInfo'] = $this->user_model->getFamilyList($userId);
            $data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
            $data['khairatrecord'] = $this->Khairat_model->getKhairatRecord($userId);
            $data['pertalian'] = $this->Kadar_family_model->get_family();
            $data['documentInfo'] = $this->user_model->getDocumentList($userId);
            $data['yuranlist'] = $this->kadar_model->get_all();
            $data['surauInfo'] = $this->Surau_model->get_all();


            $this->global['pageTitle'] = 'Kemaskini Ahli';
            
            $this->loadViews("editUsers", $this->global, $data, NULL);
            }
        }


    function deleteFamily()
        {
            if($this->isAdmin() == TRUE)
            {
                echo(json_encode(array('status'=>'access')));
            }
            else
            {
                $userId = $this->input->post('userId');
                
                /*$userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->deleteUser($userId, $userInfo);
                
                if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
                else { echo(json_encode(array('status'=>FALSE))); }

                */
                if($this->input->post('checked_id'))
                {
                   $id = $this->input->post('checked_id');
                   for($count = 0; $count < count($id); $count++)
                   {
                    $result = $this->user_model->deleteFamily($id[$count]);
                    //$id[$count];
                    if($result == true)
                    {
                        $this->session->set_flashdata('success', 'Maklumat telah dihapuskan');
                    }

                   }
                } else {
                    $this->session->set_flashdata('error', 'Tiada pilihan dilakukan !');
                }

            $row = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($row) { $pg_url = $row->pg_url;}
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
            $data['surauInfo'] = $this->Surau_model->get_all();

            $this->global['pageTitle'] = 'Kemaskini Ahli';
            
            $this->loadViews("editUsers", $this->global, $data, NULL);
            }
        }

    function deleteFamilyProfile()
        {
            
                $userId = $this->input->post('userId');
                
                /*$userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->deleteUser($userId, $userInfo);
                
                if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
                else { echo(json_encode(array('status'=>FALSE))); }

                */
                if($this->input->post('checked_id'))
                {
                   $id = $this->input->post('checked_id');
                   for($count = 0; $count < count($id); $count++)
                   {
                    $result = $this->user_model->deleteFamily($id[$count]);
                    //$id[$count];
                    if($result == true)
                    {
                        $this->session->set_flashdata('success', 'Maklumat telah dihapuskan');
                    }

                   }
                } else {
                    $this->session->set_flashdata('error', 'Tiada pilihan dilakukan !');
                }
                
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            $data['familyInfo'] = $this->user_model->getFamilyList($userId);
            $data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
            $data['pertalian'] = $this->Kadar_family_model->get_family();
            $data['documentInfo'] = $this->user_model->getDocumentList($userId);
            $data['yuranlist'] = $this->kadar_model->get_all();
            $data['surauInfo'] = $this->Surau_model->get_all();

            $this->global['pageTitle'] = 'Kemaskini Ahli';
            
            $this->loadViews("editProfile", $this->global, $data, NULL);
            
        }


function addDocument()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('doc_name','Tajuk Dokumen','trim|required|max_length[200]');  
            if($this->form_validation->run() == FALSE)
            {
                $this->editUsers($userId);
            }
            else
            {
                $doc_name = ucwords(strtoupper($this->security->xss_clean($this->input->post('doc_name'))));
                $data = array(
                'doc_title' => $doc_name,
                'userid' => $userId,
                //'attachment' => $file_name,
                'createDtm' => date('Y-m-d H:i:s'),
                'createBy'=>$this->vendorId, //adminID
                );

               

                 if (empty($_FILES['userfile']['name']))
                {
                    $file_name = 'default.jpg';
                    //assign name but no file upload
                } else {
                    $file_type = pathinfo($_FILES['userfile']['name']);
                    $imageFileType = $file_type['extension'];
                    
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" ) {
                        $this->session->set_flashdata('error', 'Maaf! Hanya format fail JPEG,JPG,PNG,GIF dan PDF sahaja diterima');
                    } else {
                       
                         $row_id = $this->user_model->insert_doc_getrowid($data);
                        $user_id = sprintf("%04d", $userId);
                        $file_name = $user_id."_".$row_id.".".$file_type['extension'];  
                        $update_filename = array(
                            'attachment' => $file_name,
                            'createBy'=> $this->vendorId, //adminID
                            //'createDtm'=> date('Y-m-d H:i:s'),
                        );
                        $this->user_model->update_doc($row_id, $update_filename);
                        $this->do_upload($file_name);
                        $this->session->set_flashdata('success', 'Dokumen telah disimpan');
                    }
                }

                ////////////////////////////////////////////////////////////
                    //$this->editUsers($userId);
            }
             $row = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($row) { $pg_url = $row->pg_url;}
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
            $data['surauInfo'] = $this->Surau_model->get_all();

            $this->global['pageTitle'] = 'Kemaskini Ahli';
            
            $this->loadViews("editUsers", $this->global, $data, NULL);
        }
    }

    function addDocumentUser()
    {
        //if($this->isAdmin() == TRUE)
        //{
        //    $this->loadThis();
        //}
        //else
        //{
            $this->load->library('form_validation');
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('doc_name','Tajuk Dokumen','trim|required|max_length[200]');  
            if($this->form_validation->run() == FALSE)
            {
                $this->editUsers($userId);
            }
            else
            {
                $doc_name = ucwords(strtoupper($this->security->xss_clean($this->input->post('doc_name'))));
                $data = array(
                'doc_title' => $doc_name,
                'userid' => $userId,
                //'attachment' => $file_name,
                'createDtm' => date('Y-m-d H:i:s'),
                'createBy'=>$this->vendorId, //adminID
                );

                if (empty($_FILES['userfile']['name']))
                {
                    $file_name = 'default.jpg';
                    //assign name but no file upload
                } else {
                    // Allow certain file formats
                    $file_type = pathinfo($_FILES['userfile']['name']);
                    $imageFileType = $file_type['extension'];
                    
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" ) {
                        $this->session->set_flashdata('error', 'Maaf! Hanya format fail JPEG,JPG,PNG,GIF dan PDF sahaja diterima');
                    } else {
                      //echo "your file successfully uploaded.";
                        $row_id = $this->user_model->insert_doc_getrowid($data);
                        $user_id = sprintf("%04d", $userId);
                        $file_name = $user_id."_".$row_id.".".$file_type['extension'];  
                        $update_filename = array(
                            'attachment' => $file_name,
                            'createBy'=> $this->vendorId, //adminID
                            //'createDtm'=> date('Y-m-d H:i:s'),
                        );
                        
                        $this->user_model->update_doc($row_id, $update_filename);
                        $this->do_upload($file_name); 
                      $this->session->set_flashdata('success', 'Dokumen telah disimpan');
                    }
                        
                    
                }

                ////////////////////////////////////////////////////////////
                    //$this->editUsers($userId);
            }

            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            $data['familyInfo'] = $this->user_model->getFamilyList($userId);
            $data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
            $data['pertalian'] = $this->Kadar_family_model->get_family();
            $data['documentInfo'] = $this->user_model->getDocumentList($userId);
            $data['yuranlist'] = $this->kadar_model->get_all();
            $data['surauInfo'] = $this->Surau_model->get_all();

            $this->global['pageTitle'] = 'Kemaskini Ahli';
            
            $this->loadViews("editProfile", $this->global, $data, NULL);
        //}
    }

    


    public function do_upload($file_name)
    {
        
        if (empty($_FILES['userfile']['name']))
        {
                $file_name = 'default.jpg';//default image
            } else {
                $config['upload_path']      = './documents/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|pdf';
                $config['max_size']         = 12048;
                $config['file_ext_tolower'] = TRUE;
                $config['file_name']        = $file_name;
                $config['overwrite']        = TRUE;

                $this->load->library('upload', $config);
                $this->upload->do_upload('userfile');


                if (!$this->upload->do_upload('userfile')) {
                    $error = ['error' => $this->upload->display_errors()];
                    //$this->load->view('editUsers', $error);
                } else {
                    //$data = array('upload_data' => $this->upload->data());
                    //$this->load->view('upload_success', $data);
                    $this->upload->data();
                }
        }
    }


    function deleteDocument()
        {
            if($this->isAdmin() == TRUE)
            {
                echo(json_encode(array('status'=>'access')));
            }
            else
            {
                $userId = $this->input->post('userId');
                if($this->input->post('checked_id'))
                {
                   $id = $this->input->post('checked_id');
                   for($count = 0; $count < count($id); $count++)
                   {
                    $result = $this->user_model->delete_doc($id[$count]);
                    //$id[$count];
                    if($result == true)
                    {
                        $this->session->set_flashdata('success', 'Maklumat telah dihapuskan');
                    }

                   }
                } else {
                    $this->session->set_flashdata('error', 'Tiada pilihan dilakukan !');
                }
            
            $row = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($row) { $pg_url = $row->pg_url;}
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
            $data['surauInfo'] = $this->Surau_model->get_all();

            $this->global['pageTitle'] = 'Kemaskini Ahli';
            
            $this->loadViews("editUsers", $this->global, $data, NULL);
            }
        }

    function deleteDocumentUser()
        {
            
                $userId = $this->input->post('userId');
                if($this->input->post('checked_id'))
                {
                   $id = $this->input->post('checked_id');
                   for($count = 0; $count < count($id); $count++)
                   {
                    $result = $this->user_model->delete_doc($id[$count]);
                    //$id[$count];
                    if($result == true)
                    {
                        $this->session->set_flashdata('success', 'Maklumat telah dihapuskan');
                    }

                   }
                } else {
                    $this->session->set_flashdata('error', 'Tiada pilihan dilakukan !');
                }
            
             $row = $this->Toyyibpay_model->get_by_id(1);//default value is 1
            if ($row) { $pg_url = $row->pg_url;}
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
            $data['surauInfo'] = $this->Surau_model->get_all();

            $this->global['pageTitle'] = 'Kemaskini Ahli';
            
            $this->loadViews("editProfile", $this->global, $data, NULL);
            
        }

    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'Tukar Katalaluan';
        
        $this->loadViews("changePassword", $this->global, NULL, NULL);
    }

    

    function loadChangeProfile()
    {
        $this->global['pageTitle'] = 'Profil Pengguna';

        $generalid = 1;
        $row = $this->General_model->get_by_id($generalid); 
            if ($row) {
            $data = array(
            'g_id' => $row->g_id,
            'g_ekhairat_id' => $row->g_ekhairat_id,
            'g_package' => $row->g_package,
            'g_home_desc' => $row->g_home_desc,
            'g_address' => $row->g_address,
            'g_phone' => $row->g_phone,
            'g_email' => $row->g_email,
            );
         }

        $data['roles'] = $this->user_model->getUserRoles();
        $data['surauInfo'] = $this->Surau_model->get_all();
        $data['userInfo'] = $this->user_model->getUserInfo($this->vendorId);
        $data['familyInfo'] = $this->user_model->getFamilyList($this->vendorId);
        $data['khairatrecord'] = $this->Khairat_model->getKhairatRecord($this->vendorId);
        $data['pertalian'] = $this->Kadar_family_model->get_family();
        $data['documentInfo'] = $this->user_model->getDocumentList($this->vendorId);
        
        if($this->vendorId == 0){
            $data['invoiceInfo'] = $this->user_model->getInvoiceList();
            $this->loadViews("viewAccount", $this->global, $data, NULL);
        } else { 
            $this->loadViews("editProfile", $this->global, $data, NULL);
        }
    }

    function loadPolicy()
    {
        $this->global['pageTitle'] = 'Polisi Khairat';
        $idUser = $this->vendorId;
        $ahli_khairat = $this->user_model->getRoleId($idUser,"ahli_khairat","tbl_users");  //return Y or N
       
        $generalid = 1;
        $row = $this->General_model->get_by_id($generalid); 
        if ($row) {
        $data = array(
        'g_id' => $row->g_id,
        'g_policy' => $row->g_policy,
        'ahli_khairat' => $ahli_khairat,
        'userId' => $idUser,
        );
        $this->global['g_policy'] = $row->g_policy;
        
        $this->loadViews("policyView", $this->global, $data, NULL);
        }
    }

     /*amaran*/
    public function loadWarning() 
    {
        //echo "test";
        $userid = $this->vendorId;
        //exit();
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
        'total_amaun' => $row->total_amaun,
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
            redirect(site_url('dashboard'));
        }

        
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('loadChangePass');
            }
        }
    }

    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = '404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistory($userId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userId = ($userId == NULL ? $this->session->userdata("userId") : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress ( "login-history/".$userId."/", $count, 25, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Login History';
            
            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }        
    }

    function deleteAllRecords()
        {
            
            $userId = $this->input->post('userId');
            if(!empty($userId))
                {
                    //1. Delete Rekod Bayaran (table = Payment & Payment Details)
                    //2. Delete Rekod Dokumen
                    //3. Delete Rekod Tanggungan
                    //4. Delete Rekod Ahli
                    //5. Redirect page ke Senarai Ahli

                    $result = $this->user_model->deleteAllRecords($userId);
                    if($result == true)
                    {
                        $this->session->set_flashdata('success', 'Maklumat telah dihapuskan');

                    } else {
                        $this->session->set_flashdata('error', 'Maklumat gagal dihapuskan');

                    }
                }
            redirect('userListing');
        }

    function regKhairat()
    {   
        $userid = $this->input->post('userid');
        $polisi = $this->input->post('polisi');
        //read applicant records
        $ahli_khairat = "Y";
        $pakej = $this->user_model->getRoleId($userid,"pakej","tbl_users");
        $icno = $this->user_model->getRoleId($userid,"icno","tbl_users");
        
        //update status module_ekhairat
        $userInfo = array('ahli_khairat'=>$ahli_khairat, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));     
        $result = $this->user_model->editUser($userInfo, $userid);
            if($result == true)
            {
                /*$id_yuran = 1; //tbl_kadar_yuran -> yuran pendaftaran
                $jumlah_daftar = $this->kadar_model->get_amount($id_yuran);
                $data_bayaran_pendaftaran = array('userid' => $id,'yid' => $id_yuran,'amaun' =>  $jumlah_daftar);
                $this->Payment_model->insert($data_bayaran_pendaftaran); //yuran pendaftaran
                $this->session->set_flashdata('success', 'Sila jelaskan Yuran Pendaftaran');*/

                //Determine pakej
                //$endDate = strtotime(date('Y-m-d', strtotime('2022-12-31') ) );
                //$currentDate = strtotime(date('Y-m-d'));

                if($pakej == "Keluarga") { 
                        $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah","tbl_kadar_yuran");
                        $title_yuran = "Yuran Tahunan ".date('Y');
                        $jumlah_yuran = $this->kadar_model->get_amount_pakej(date('Y'),"y_jumlah","tbl_kadar_yuran");
                        $id_yuran_tahunan = $this->kadar_model->get_id_by_year(date('Y'));
                } else if($pakej == "Bujang"){
                        $jumlah_daftar = $this->kadar_model->get_amount_daftar(1,"y_jumlah_bujang","tbl_kadar_yuran");
                        $title_yuran = "Yuran Tahunan ".date('Y');
                        $jumlah_yuran = $this->kadar_model->get_amount_pakej(date('Y'),"y_jumlah_bujang","tbl_kadar_yuran");
                        $id_yuran_tahunan = $this->kadar_model->get_id_by_year(date('Y'));
                }

                //CREATE YURAN PENDAFTARAN AHLI
                
                $yuran_pendaftaran = array(
                    'userid' => $userid,
                    'yid' => 1,
                    'total_amaun' =>  $jumlah_daftar,
                    'amaun' =>  $jumlah_daftar);
                if($jumlah_daftar > 0){
                    $this->Payment_model->insert($yuran_pendaftaran); //yuran pendaftaran
                }

                //CREATE YURAN TAHUN SEMASA 
                //penentuan yuran tahunan pakej bujang atau pakej keluarga
                //$roleType = $this->user_model->getRoleId($user_id,"roleId","tbl_users");
                $yuran_tahun_semasa = array(
                    'userid' => $userid,
                    'yid' => $id_yuran_tahunan,
                    'amaun' =>  $jumlah_yuran, 
                    'total_amaun' =>  $jumlah_yuran, 
                );
                $this->Payment_model->insert($yuran_tahun_semasa);  //yuran keseluruhan tahun semasa
                $payment_id = $this->user_model->getLatestPayment();

                //payment details yuran ahli
                $umur = umur($icno);
                $yuran = yuran("AHLI", $umur); //*******
                //$jum_yuran_ahli = total_yuran_in_year(date('m'),$yuran);
                //$jumlah_ahli = yuran($userr->f_pertalian, $umur);

                $paymentDetails = array(
                            'p_id'=>$payment_id, 
                            'userid'=>$userid, 
                            //'amaun'=>$jum_yuran_ahli,  
                            'amaun'=>$yuran, 
                            );
                $this->Payment_model->insert_details($paymentDetails);
                


                //masukkan rekod tanggungan ahli
                $checkUser = $this->user_model->checkIdExisted($userid,"tbl_users_family");
                if(!empty($checkUser)) {
                    $jumlah_ahli = 0;
                    $total = 0;

                    $rowf = $this->user_model->getFamilyRecords($userid);
                    foreach ($rowf as $fam)
                      {         
                        /*$familyInfo = array(
                            'f_name'=>$fam->f_name, 
                            'userid'=>$user_id, 
                            'f_icno'=>$fam->f_icno,  
                            'f_pertalian'=>$fam->f_pertalian, 
                            'f_pasangan'=>$fam->f_pasangan, 
                            'approval' => "Y"
                            );
                        $this->user_model->addFamily($familyInfo);*/
                        //$familyInfoUpdate = array('isDeleted'=>1);  
                        //$this->user_model->applicantRejectFamily($id, $familyInfoUpdate);

                        $umurF = umur($fam->f_icno);
                        $yuranF = yuran($fam->f_pertalian, $umurF);
                        $total = $total + $yuranF;

                        //insert payment detail setiap ahli tanggungan
                        //Get latest payment ID
                        //if($ahli_khairat == "Y") {
                            //$f_id = $this->user_model->getLatestFamilyMember();
                        $f_id = $fam->f_id;
                        $paymentfamilyInfo = array(
                            'p_id'=>$payment_id,
                            'userid'=>$userid,  
                            'f_id'=>$f_id, 
                            'amaun'=>$yuranF,  
                            );
                        
                        $this->Payment_model->insert_details($paymentfamilyInfo);
                        //}
                      } 

                      //UPDATE PAYMENT (AHLI + TANGGUNGAN)
                      //$payment_id = $this->user_model->getLatestPayment();
                      //if($ahli_khairat == "Y") {
                          $jumlah_keseluruhan_yuran = $jumlah_yuran + $yuran + $total;
                          $paymentInfo = array('total_amaun'=>$jumlah_keseluruhan_yuran);
                          $this->Payment_model->updatePayment($payment_id,$paymentInfo);
                      //}

                }
                $this->session->set_flashdata('success', 'Anda telah menyertai khairat kematian. Sila jelaskan yuran');
            }//end if result
            else
            {
                $this->session->set_flashdata('error', 'Kemaskini Gagal');
            }

        $this->index();
    }

    function addInvoice()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $acc_invoice = $this->input->post('acc_invoice');
            $acc_title = ucwords(strtoupper($this->security->xss_clean($this->input->post('acc_title'))));
            $acc_amaun = $this->input->post('acc_amaun');
            $status = $this->input->post('status');
            $acc_date = $this->input->post('accDtm');
            $acc_expired = date('Y-m-d', strtotime('+1 year', strtotime($acc_date)));

            //exit();
            $passcode = $this->input->post('passcode');

            $generalid = 1;
            $row = $this->General_model->get_by_id($generalid);
            $g_passcode = $row->g_passcode; 
            
            //$this->form_validation->set_rules('acc_title','Tajuk Invois','trim|required|max_length[200]');  
            if($passcode == $g_passcode)
            {
                //$doc_name = $acc_title;
                $data = array(
                'acc_date' => $acc_date,
                'acc_expired' => $acc_expired,
                'acc_invoice' => $acc_invoice,
                'acc_title' => $acc_title,
                'acc_amaun' => $acc_amaun,
                'status' => $status,
                //'createDtm' => date('Y-m-d H:i:s'),
                );

                if (empty($_FILES['userfile']['name']))
                {
                    $file_name = 'default.jpg';
                    //assign name but no file upload
                } else {
                    $file_type = pathinfo($_FILES['userfile']['name']);
                    $imageFileType = $file_type['extension'];
                    
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" ) {
                        $this->session->set_flashdata('error', 'Maaf! Hanya format fail JPEG,JPG,PNG,GIF dan PDF sahaja diterima');
                    } else {
                        //$row_id = $this->user_model->insert_doc_getrowid($data);
                        //$user_id = sprintf("%04d", $userId);
                        $file_name = $acc_invoice.".".$file_type['extension'];  
                        $this->user_model->insertInvoice($data);
                        $this->do_upload($file_name);
                        $this->session->set_flashdata('success', 'Dokumen telah disimpan');
                    }
                }

            } 
            redirect(site_url('loadChangeProfile'));
            //$this->loadChangeProfile();
        }
    }
    
    public function accountInvoice()
    {
        $userId = $this->input->post('id');

        $generalid = 1;
        $row = $this->General_model->get_by_id($generalid); 
        if ($row) {
            $data = array(
            'g_id' => $row->g_id,
            'g_ekhairat_id' => $row->g_ekhairat_id,
            'g_package' => $row->g_package,
            'g_home_desc' => $row->g_home_desc,
            'g_address' => $row->g_address,
            'g_phone' => $row->g_phone,
            'g_email' => $row->g_email,
            );
         }
        //$data['applicant_info'] = $this->user_model->getApplicantInfo($userId);
        //echo "test";
        //$data['paymentrecord'] = $this->Payment_model->getPaymentRecord($userId);
        //$data['applicant_family'] = $this->user_model->getApplicantFamily($userId);
        $this->load->view('viewAccountForm',$data); 
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

?>