<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class General extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('General_model');
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

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'general/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'general/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'general/index.html';
            $config['first_url'] = base_url() . 'general/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->General_model->total_rows($q);
        $general = $this->General_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'general_data' => $general,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->global['pageTitle'] = 'general'; /*tambah*/
        $this->loadViews('general/general_list', $this->global, $data, NULL); /*tambah*/

        }
    }

    public function read($id) 
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

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
		'g_facebook' => $row->g_facebook,
		'g_bankname' => $row->g_bankname,
        'g_bankaccount' => $row->g_bankaccount,
        'g_balance' => $row->g_balance,
		'g_policy' => $row->g_policy,
        'g_weburl' => $row->g_weburl,
        'g_info_1' => $row->g_info_1,
        'g_info_2' => $row->g_info_2,
        'g_info_3' => $row->g_info_3,
        'g_registration' => $row->g_registration,
        'g_payment' => $row->g_payment,
	    );
            $this->global['pageTitle'] = 'general'; /*tambah*/
            $this->loadViews('general/general_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('general'));
        }

        }
    }

    public function create() 
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

        $data = array(
            'button' => 'Create',
            'action' => site_url('general/create_action'),
	    'g_id' => set_value('g_id'),
	   
	    'g_home_title' => set_value('g_home_title'),
	    'g_home_desc' => set_value('g_home_desc'),
	    'g_contact_info' => set_value('g_contact_info'),
	    'g_address' => set_value('g_address'),
	    'g_email' => set_value('g_email'),
	    'g_phone' => set_value('g_phone'),
	    'g_facebook' => set_value('g_facebook'),
	    'g_bankname' => set_value('g_bankname'),
         'g_bankaccount' => set_value('g_bankaccount'),
         'g_balance' => set_value('g_balance'),
	    'g_policy' => set_value('g_policy'),
        'g_weburl' => set_value('g_weburl'),
        'g_info_1' => set_value('g_info_1'),
        'g_info_2' => set_value('g_info_2'),
        'g_info_3' => set_value('g_info_3'),
        'g_registration' => set_value('g_registration'),
        'g_payment' => set_value('g_payment'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('general/general_form', $this->global, $data, NULL); /*tambah*/

        }
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		
		'g_home_title' => $this->input->post('g_home_title',TRUE),
		'g_home_desc' => $this->input->post('g_home_desc',TRUE),
		'g_contact_info' => $this->input->post('g_contact_info',TRUE),
		'g_address' => $this->input->post('g_address',TRUE),
		'g_email' => $this->input->post('g_email',TRUE),
		'g_phone' => $this->input->post('g_phone',TRUE),
		'g_facebook' => $this->input->post('g_facebook',TRUE),
		'g_bankname' => $this->input->post('g_bankname',TRUE),
        'g_bankaccount' => $this->input->post('g_bankaccount',TRUE),
        'g_balance' => $this->input->post('g_balance',TRUE),
		'g_policy' => $this->input->post('g_policy',TRUE),
        'g_weburl' => $this->input->post('g_weburl',TRUE),
        'g_info_1' => $this->input->post('g_info_1',TRUE),
        'g_info_2' => $this->input->post('g_info_2',TRUE),
        'g_info_3' => $this->input->post('g_info_3',TRUE),
        'g_registration' => $this->input->post('g_registration',TRUE),
        'g_payment' => $this->input->post('g_payment',TRUE),
	    );

            $this->General_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('general'));
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

        $row = $this->General_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('general/update_action'),
		'g_id' => set_value('g_id', $row->g_id),
		
		'g_home_title' => set_value('g_home_title', $row->g_home_title),
		'g_home_desc' => set_value('g_home_desc', $row->g_home_desc),
		'g_contact_info' => set_value('g_contact_info', $row->g_contact_info),
		'g_address' => set_value('g_address', $row->g_address),
		'g_email' => set_value('g_email', $row->g_email),
		'g_phone' => set_value('g_phone', $row->g_phone),
		'g_facebook' => set_value('g_facebook', $row->g_facebook),
		'g_bankname' => set_value('g_bankname', $row->g_bankname),
        'g_bankaccount' => set_value('g_bankaccount', $row->g_bankaccount),
        'g_balance' => set_value('g_balance', $row->g_balance),
		'g_policy' => set_value('g_policy', $row->g_policy),
        'g_weburl' => set_value('g_weburl', $row->g_weburl),
        'g_icon_1' => set_value('g_icon_1', $row->g_icon_1),
        'g_title_1' => set_value('g_title_1', $row->g_title_1),
        'g_info_1' => set_value('g_info_1', $row->g_info_1),
        'g_icon_2' => set_value('g_icon_2', $row->g_icon_2),
        'g_title_2' => set_value('g_title_2', $row->g_title_2),
        'g_info_2' => set_value('g_info_2', $row->g_info_2),
        'g_icon_3' => set_value('g_icon_3', $row->g_icon_3),
        'g_title_3' => set_value('g_title_3', $row->g_title_3),
        'g_info_3' => set_value('g_info_3', $row->g_info_3),

        'g_registration' => set_value('g_registration', $row->g_registration),
        'g_registration_text' => set_value('g_registration_text', $row->g_registration_text),
        'g_payment' => set_value('g_payment', $row->g_payment),
        'g_payment_text' => set_value('g_payment_text', $row->g_payment_text),
	    );
            $this->global['pageTitle'] = 'Update'; /*tambah*/
            $this->loadViews('general/general_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('general'));
        }

        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('g_id', TRUE));
            //print_r($_POST);
            //exit();
        } else {
            $data = array(
	
		'g_home_title' => $this->input->post('g_home_title',TRUE),
		'g_home_desc' => $this->input->post('g_home_desc',TRUE),
		'g_contact_info' => $this->input->post('g_contact_info',TRUE),
		'g_address' => $this->input->post('g_address',TRUE),
		'g_email' => $this->input->post('g_email',TRUE),
		'g_phone' => $this->input->post('g_phone',TRUE),
		'g_facebook' => $this->input->post('g_facebook',TRUE),
		'g_bankname' => $this->input->post('g_bankname',TRUE),
        'g_bankaccount' => $this->input->post('g_bankaccount',TRUE),
        'g_balance' => $this->input->post('g_balance',TRUE),
		'g_policy' => $this->input->post('g_policy',TRUE),
        'g_weburl' => $this->input->post('g_weburl',TRUE),
        'g_icon_1' => $this->input->post('g_icon_1',TRUE),
        'g_title_1' => $this->input->post('g_title_1',TRUE),
        'g_info_1' => $this->input->post('g_info_1',TRUE),
        'g_icon_2' => $this->input->post('g_icon_2',TRUE),
        'g_title_2' => $this->input->post('g_title_2',TRUE),
        'g_info_2' => $this->input->post('g_info_2',TRUE),
        'g_icon_3' => $this->input->post('g_icon_3',TRUE),
        'g_title_3' => $this->input->post('g_title_3',TRUE),
        'g_info_3' => $this->input->post('g_info_3',TRUE),
        'g_registration' => $this->input->post('g_registration',TRUE),
        'g_registration_text' => $this->input->post('g_registration_text',TRUE),
        'g_payment' => $this->input->post('g_payment',TRUE),
        'g_payment_text' => $this->input->post('g_payment_text',TRUE),
	    );

            $this->General_model->update($this->input->post('g_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('general'));
        }
    }
    
    public function delete($id) 
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

        $row = $this->General_model->get_by_id($id);

        if ($row) {
            $this->General_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('general'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('general'));
        }

        }
    }

    public function _rules() 
    {
	
	$this->form_validation->set_rules('g_home_title', 'home title', 'trim|required');
	$this->form_validation->set_rules('g_home_desc', 'home desc', 'trim|required');
	$this->form_validation->set_rules('g_contact_info', 'contact info', 'trim|required');
	$this->form_validation->set_rules('g_address', 'address', 'trim|required');
	$this->form_validation->set_rules('g_email', 'email', 'trim|required');
	$this->form_validation->set_rules('g_phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('g_facebook', 'Facebook', 'trim|required');
    $this->form_validation->set_rules('g_weburl', 'Web URL', 'trim|required');
	$this->form_validation->set_rules('g_bankname', 'Bank Name', 'trim|required');
    $this->form_validation->set_rules('g_bankaccount', 'Bank Account', 'trim|required');
    $this->form_validation->set_rules('g_balance', 'Account Balance', 'trim|required');
    $this->form_validation->set_rules('g_info_1', 'Web Info 1', 'trim|required');
    $this->form_validation->set_rules('g_info_2', 'Web Info 2', 'trim|required');
    $this->form_validation->set_rules('g_info_3', 'Web Info 3', 'trim|required');
	//$this->form_validation->set_rules('g_status', 'g status', 'trim|required');

	$this->form_validation->set_rules('g_id', 'g_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


}

/* End of file General.php */
/* Location: ./application/controllers/General.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-03 18:03:55 */
/* http://harviacode.com */