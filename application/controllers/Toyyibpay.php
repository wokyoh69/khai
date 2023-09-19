<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Toyyibpay extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Toyyibpay_model');
        $this->load->library('form_validation');
        
        $this->isLoggedIn();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'toyyibpay/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'toyyibpay/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'toyyibpay/index.html';
            $config['first_url'] = base_url() . 'toyyibpay/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Toyyibpay_model->total_rows($q);
        $toyyibpay = $this->Toyyibpay_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'toyyibpay_data' => $toyyibpay,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->global['pageTitle'] = 'Toyyibpay'; 
        $this->loadViews('toyyibpay/payment_gateway_list', $this->global, $data, NULL);
        
    }

    public function read($id) 
    {
        $row = $this->Toyyibpay_model->get_by_id($id);
        if ($row) {
            $data = array(
		'pg_id' => $row->pg_id,
		'pg_url' => $row->pg_url,
		'pg_secretkey' => $row->pg_secretkey,
		'pg_catcode' => $row->pg_catcode,
		'pg_billname' => $row->pg_billname,
		'pg_returnurl' => $row->pg_returnurl,
        'pg_returnurl_public' => $row->pg_returnurl_public,
		'pg_callbackurl' => $row->pg_callbackurl,
		'pg_createbill' => $row->pg_createbill,
	    );
            $this->global['pageTitle'] = 'Toyyibpay'; /*tambah*/
            $this->loadViews('toyyibpay/payment_gateway_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('toyyibpay'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('toyyibpay/create_action'),
	    'pg_id' => set_value('pg_id'),
	    'pg_url' => set_value('pg_url'),
	    'pg_secretkey' => set_value('pg_secretkey'),
	    'pg_catcode' => set_value('pg_catcode'),
	    'pg_billname' => set_value('pg_billname'),
	    'pg_returnurl' => set_value('pg_returnurl'),
        'pg_returnurl_public' => set_value('pg_returnurl_public'),
	    'pg_callbackurl' => set_value('pg_callbackurl'),
	    'pg_createbill' => set_value('pg_createbill'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('toyyibpay/payment_gateway_form', $this->global, $data, NULL); /*tambah*/

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'pg_url' => $this->input->post('pg_url',TRUE),
		'pg_secretkey' => $this->input->post('pg_secretkey',TRUE),
		'pg_catcode' => $this->input->post('pg_catcode',TRUE),
		'pg_billname' => $this->input->post('pg_billname',TRUE),
		'pg_returnurl' => $this->input->post('pg_returnurl',TRUE),
        'pg_returnurl_public' => $this->input->post('pg_returnurl_public',TRUE),
		'pg_callbackurl' => $this->input->post('pg_callbackurl',TRUE),
		'pg_createbill' => $this->input->post('pg_createbill',TRUE),
	    );

            $this->Toyyibpay_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('toyyibpay'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Toyyibpay_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('toyyibpay/update_action'),
		'pg_id' => set_value('pg_id', $row->pg_id),
		'pg_url' => set_value('pg_url', $row->pg_url),
		'pg_secretkey' => set_value('pg_secretkey', $row->pg_secretkey),
		'pg_catcode' => set_value('pg_catcode', $row->pg_catcode),
		'pg_billname' => set_value('pg_billname', $row->pg_billname),
		'pg_returnurl' => set_value('pg_returnurl', $row->pg_returnurl),
        'pg_returnurl_public' => set_value('pg_returnurl_public', $row->pg_returnurl_public),
		'pg_callbackurl' => set_value('pg_callbackurl', $row->pg_callbackurl),
		'pg_createbill' => set_value('pg_createbill', $row->pg_createbill),
	    );
            $this->global['pageTitle'] = 'Update'; /*tambah*/
            $this->loadViews('toyyibpay/payment_gateway_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('toyyibpay'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('pg_id', TRUE));
        } else {
            $data = array(
		'pg_url' => $this->input->post('pg_url',TRUE),
		'pg_secretkey' => $this->input->post('pg_secretkey',TRUE),
		'pg_catcode' => $this->input->post('pg_catcode',TRUE),
		'pg_billname' => $this->input->post('pg_billname',TRUE),
		'pg_returnurl' => $this->input->post('pg_returnurl',TRUE),
        'pg_returnurl_public' => $this->input->post('pg_returnurl_public',TRUE),
		'pg_callbackurl' => $this->input->post('pg_callbackurl',TRUE),
		'pg_createbill' => $this->input->post('pg_createbill',TRUE),
	    );

            $this->Toyyibpay_model->update($this->input->post('pg_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('toyyibpay'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Toyyibpay_model->get_by_id($id);

        if ($row) {
            $this->Toyyibpay_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('toyyibpay'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('toyyibpay'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pg_url', 'pg url', 'trim|required');
	$this->form_validation->set_rules('pg_secretkey', 'pg secretkey', 'trim|required');
	$this->form_validation->set_rules('pg_catcode', 'pg catcode', 'trim|required');
	$this->form_validation->set_rules('pg_billname', 'pg billname', 'trim|required');
	$this->form_validation->set_rules('pg_returnurl', 'pg returnurl', 'trim|required');
    $this->form_validation->set_rules('pg_returnurl_public', 'pg returnurlpublic', 'trim|required');
	$this->form_validation->set_rules('pg_callbackurl', 'pg callbackurl', 'trim|required');
	$this->form_validation->set_rules('pg_createbill', 'pg createbill', 'trim|required');

	$this->form_validation->set_rules('pg_id', 'pg_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Toyyibpay.php */
/* Location: ./application/controllers/Toyyibpay.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-08-11 23:32:32 */
/* http://harviacode.com */