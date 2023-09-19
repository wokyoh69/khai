<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//print_();
require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Home extends CI_Controller
{

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('General_model');
        $this->load->model('News_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        //$generalid = 1;
        //$row = $this->General_model->get_by_id($generalid); 

        //if ($row) {
            /*
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
            );
            */
            //Session control
            if (empty($this->session->userdata('tempUser'))){
                $tempSession = uniqid(rand(), TRUE);
                $this->load->library('session');
                $this->session->set_userdata('tempUser',$tempSession);
            } else {
                $regId = $this->session->userdata('tempUser');
            }
            /*
            $this->global['pageTitle'] = $row->g_home_title; 
            $this->global['g_home_title'] = $row->g_home_title;
            $this->global['g_home_desc'] = $row->g_home_desc;
            $this->global['g_email'] = $row->g_email;
            $this->global['g_phone'] = $row->g_phone;
            $this->global['g_bankname'] = $row->g_bankname;
            $this->global['g_bankaccount'] = $row->g_bankaccount;*/
            
            $rec = $this->user_model->getMonthlyReg2();
            $surau = [];
            foreach($rec as $rows) {
                $surau[] = array(
                    'surauName'   => $rows->SurauName,
                    'regNumber' => floatval($rows->regNumber)
                );
            }
            
            $data['surau'] = ($surau); 

            $data['record_data'] = $this->News_model->get_all_active();
            $generalid = 1;
            $data['generalinfo'] = $this->General_model->get_by_id_array($generalid);

            //$this->load->view('home', $this->global, $data, NULL);

            $this->load->view('home',$data);

                   ///$dataInfo = $this->News_model->get_all_active();
            /*
            if(!empty($dataInfo)){
            foreach ($dataInfo as $new)
              {
                 echo "test".$new->news_headline;
              }
            }*/
            
        //echo "test";


        //$this->load->view('home', $this->global, $data, NULL);
        //$this->loadViews('home', $this->global, $data, NULL); /*tambah*/
        // }
        //$this->load->view('home', $this->global, $data);
        //$this->load->view('checkname.php');
    }

    public function policy()
    {
    
            //Session control
            if (empty($this->session->userdata('tempUser'))){
                $tempSession = uniqid(rand(), TRUE);
                $this->load->library('session');
                $this->session->set_userdata('tempUser',$tempSession);
            } else {
                $regId = $this->session->userdata('tempUser');
            }

            //$data['record_data'] = $this->News_model->get_all_active();
            $generalid = 1;
            $data['generalinfo'] = $this->General_model->get_by_id_array($generalid);

            //$this->load->view('home', $this->global, $data, NULL);

            $this->load->view('policy',$data);
    }
   
    
    
}

?>