<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');
        $this->load->model('General_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
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
                'g_info_1' => $row->g_info_1, 
                'g_info_2' => $row->g_info_2, 
                'g_info_3' => $row->g_info_3,
                );


                $this->global['pageTitle'] = $row->g_home_title; 
                $this->global['g_home_title'] = $row->g_home_title;
                $this->global['g_home_desc'] = $row->g_home_desc;
                $this->global['g_email'] = $row->g_email;
                $this->global['g_phone'] = $row->g_phone;
                $this->global['g_bankname'] = $row->g_bankname;
                $this->global['g_bankaccount'] = $row->g_bankaccount;
                $this->global['g_info_1'] = $row->g_info_1;
                $this->global['g_info_2'] = $row->g_info_2;
                $this->global['g_info_3'] = $row->g_info_3;
                $this->load->view('login', $this->global, $data, NULL);
                }
            //$this->load->view('login');
        }
        else
        {
            redirect('/dashboard');
        }
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        $this->load->library('form_validation');
        
        //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('icno', 'IC No', 'required|required|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            //$email = $this->security->xss_clean($this->input->post('email'));
            $icno = $this->security->xss_clean($this->input->post('icno'));
            $password = $this->input->post('password');
            
            //$result = $this->login_model->loginMe($email, $password);
            $result = $this->login_model->loginMe($icno, $password);
            
            if(!empty($result))
            {
                $lastLogin = $this->login_model->lastLoginInfo($result->userId);

                if(!empty($lastLogin))
                {
                    $sessionArray = array('userId'=>$result->userId,                    
                                            'role'=>$result->roleId,
                                            'roleText'=>$result->role,
                                            'name'=>$result->name,
                                            'lastLogin'=> $lastLogin->createdDtm,
                                            'isLoggedIn' => TRUE
                                    );

                    $this->session->set_userdata($sessionArray);
                    unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);
                } else {
                    $sessionArray = array('userId'=>$result->userId,                    
                                            'role'=>$result->roleId,
                                            'roleText'=>$result->role,
                                            'name'=>$result->name,
                                            //'lastLogin'=> $lastLogin->createdDtm,
                                            'isLoggedIn' => TRUE
                                    );
                    $this->session->set_userdata($sessionArray);
                }

                $loginInfo = array("userId"=>$result->userId, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());

                $this->login_model->lastLogin($loginInfo);

                //if($result->userId < 1){
                    redirect('/dashboard');
                //} else {
                    //echo "home";
                    //exit();
                   // redirect('/home');
               // }
                
                
            }
            else
            {
                $this->session->set_flashdata('error', 'No Kad Pengenalan @ Password Salah!');
                
                redirect('/login');
            }
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forget()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $generalid = 1;
            $data['generalinfo'] = $this->General_model->get_by_id_array($generalid);
            $this->load->view('forgotPassword',$data);
           // $this->load->view('forgotPassword');
            //$this->load->view('login');
        }
        else
        {
            redirect('/dashboard');
        }
    }

    public function forgetMe()
    {
        //print_r($_POST);
        //exit();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('icno', 'No Kad Pengenalan', 'required|max_length[12]');
    
        if($this->form_validation->run() == FALSE)
        {
            //$this->index();
            $this->forget();
        }
        else
        {
        $icno = $this->input->post('icno');
        $data = array('icno' => $icno);

            if(!empty($this->user_model->checkIcExisted($icno)))
            {
               $emailadd = $this->login_model->checkEmailByIcno($icno);
               if($emailadd != "")
                {
                    $row = $this->user_model->getApplicantInfoByIcno($icno); 
                    foreach ($row as $userr)
                      { 
                          $userId =  $userr->userId; 
                          $name =  $userr->name; 
                          $email =  $userr->email; 
                          $phone =  $userr->phone; 
                          $icno =  $userr->icno; 
                      } 
                    getHashedPassword($phone);

                    $usersData = array('password'=>getHashedPassword($phone), 'updatedDtm'=>date('Y-m-d H:i:s'));
                    $result = $this->user_model->changePassword($userId, $usersData);
                    if($result > 0) { 
                        $this->send_mail($email, $name, $phone);
                        $data['success'] = $this->session->set_flashdata('success', 'Katalaluan baru telah dihantar ke '.$email.'. Terima Kasih'); 
                    } 

                } else {
                    $data['error'] = $this->session->set_flashdata('error', 'Email anda tidak dikemaskini, Sila hubungi pentadbir sistem');
                }

            }else{
                $data['error'] = $this->session->set_flashdata('error', 'Maaf ! No. Kad Pengenalan tidak wujud atau tidak aktif.'); 
            }
   

        //search
        //$count = $this->user_model->userSearchCount($name);
        //$data['rows'] = $count;
        $data['search_data'] = $this->user_model->getApplicantInfoByIcno($icno); 
        $generalid = 1;
        $data['generalinfo'] = $this->General_model->get_by_id_array($generalid);
        //$this->global['pageTitle'] = "Carian Nama"; 

        $this->load->view('forgotPassword',$data);
        //$this->load->view('checkname', $this->global, $data, NULL);
        //$this->load->view('checkname', $this->global, $data, NULL);
        //$this->load->view('checkname',$data);
    
        }
        //$this->load->view('forgotPassword',$data);
        
    }

    /**
     * This function used to load forgot password view
     */
    public function registration()
    {
    
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('registration');
        }
        else
        {
            redirect('/dashboard');
        }
    }

    
    
    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('login_email','Email','trim|required|valid_email');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $email = $this->security->xss_clean($this->input->post('login_email'));
            
            if($this->login_model->checkEmailExist($email))
            {
                $encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();
                
                $save = $this->login_model->resetPasswordUser($data);                
                
                if($save)
                {
                    $data1['reset_link'] = base_url() . "resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);

                    if(!empty($userInfo)){
                        $data1["name"] = $userInfo[0]->name;
                        $data1["email"] = $userInfo[0]->email;
                        $data1["message"] = "Reset Your Password";
                    }

                    $sendStatus = resetPasswordEmail($data1);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email has been failed, try again.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "This email is not registered with us.");
            }
            redirect('/forgotPassword');
        }
    }

    /**
     * This function used to reset the password 
     * @param string $activation_id : This is unique id
     * @param string $email : This is user email
     */
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('/login');
        }
    }
    
    /**
     * This function used to create new password for user
     */
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = $this->input->post("email");
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->login_model->createPasswordUser($email, $password);
                
                $status = 'success';
                $message = 'Password changed successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password changed failed';
            }
            
            setFlashData($status, $message);

            redirect("/login");
        }
    }

    public function send_mail($email, $name, $phone) { 
         //$data['generalinfo'] = $this->General_model->get_by_id_array($generalid);
        $generalid = 1;
        $row = $this->General_model->get_by_id($generalid); 
         $from_email = $row->g_email; 
         $to_email = $email; 
         $subject = "Reset Katalaluan ".$name;
   
         //Load email library 
         $this->load->library('email'); 
         $this->email->from($from_email, $row->g_contact_info); 

         //$kadarid = 1;
         //$registration_fee = $this->Kadar_model->get_amount($kadarid);

         //exit();

         $data = array(

            'userName'=> $name,
            'email'=> $email,
            'phone'=> $phone,
            'g_home_desc' => $row->g_home_desc
         );

         $this->email->to($to_email);
         $this->email->cc($from_email);
         $this->email->subject($subject); 
         //$this->email->message('Testing the email class.'); 
         //$data['generalinfo'] = $this->General_model->get_by_id_array($generalid);
   
         $body = $this->load->view('email/reset_message.php',$data,TRUE);
         $this->email->message($body); 

         //Send mail 
         if($this->email->send()) 
            $this->session->set_flashdata("email_sent","Email sent successfully."); 
         else 
            $this->session->set_flashdata("email_sent","Error in sending Email."); 
            //$this->load->view('email_form'); 
    } 
}

?>