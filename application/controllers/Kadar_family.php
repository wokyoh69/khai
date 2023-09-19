<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Kadar_family extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kadar_family_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kadar_family/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kadar_family/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kadar_family/index.html';
            $config['first_url'] = base_url() . 'kadar_family/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kadar_family_model->total_rows($q);
        $kadar_family = $this->Kadar_family_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kadar_family_data' => $kadar_family,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->global['pageTitle'] = 'Kadar Yuran'; /*tambah*/
        $this->loadViews('kadar_family/tbl_kadar_yuran_family_list', $this->global, $data, NULL); /*tambah*/
    }

    public function read($id) 
    {
        $row = $this->Kadar_family_model->get_by_id($id);
        if ($row) {
            $data = array(
		'yf_id' => $row->yf_id,
		'yf_name' => $row->yf_name,
		'yf_agelimit' => $row->yf_agelimit,
		'yf_desc' => $row->yf_desc,
		'yf_jumlah' => $row->yf_jumlah,
	    );
            $this->global['pageTitle'] = 'kadar_family'; /*tambah*/
            $this->loadViews('kadar_family/tbl_kadar_yuran_family_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kadar_family'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kadar_family/create_action'),
	    'yf_id' => set_value('yf_id'),
	    'yf_name' => set_value('yf_name'),
	    'yf_agelimit' => set_value('yf_agelimit'),
	    'yf_desc' => set_value('yf_desc'),
	    'yf_jumlah' => set_value('yf_jumlah'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('kadar_family/tbl_kadar_yuran_family_form', $this->global, $data, NULL); /*tambah*/

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'yf_name' => $this->input->post('yf_name',TRUE),
		'yf_agelimit' => $this->input->post('yf_agelimit',TRUE),
		'yf_desc' => $this->input->post('yf_desc',TRUE),
		'yf_jumlah' => $this->input->post('yf_jumlah',TRUE),
	    );

            $this->Kadar_family_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kadar_family'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kadar_family_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kadar_family/update_action'),
		'yf_id' => set_value('yf_id', $row->yf_id),
		'yf_name' => set_value('yf_name', $row->yf_name),
		'yf_agelimit' => set_value('yf_agelimit', $row->yf_agelimit),
		'yf_desc' => set_value('yf_desc', $row->yf_desc),
		'yf_jumlah' => set_value('yf_jumlah', $row->yf_jumlah),
	    );
            $this->global['pageTitle'] = 'Kadar Yuran'; /*tambah*/
            $this->loadViews('kadar_family/tbl_kadar_yuran_family_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kadar_family'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('yf_id', TRUE));
        } else {
            $data = array(
		//'yf_name' => $this->input->post('yf_name',TRUE),
		'yf_agelimit' => $this->input->post('yf_agelimit',TRUE),
		'yf_desc' => $this->input->post('yf_desc',TRUE),
		'yf_jumlah' => $this->input->post('yf_jumlah',TRUE),
	    );

            $this->Kadar_family_model->update($this->input->post('yf_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->global['pageTitle'] = 'Kadar Yuran'; 
            redirect(site_url('kadar_family'));

            
            //$this->loadViews('kadar_family/tbl_kadar_yuran_family_list', $this->global, $data, NULL); /*tambah*/
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kadar_family_model->get_by_id($id);

        if ($row) {
            $this->Kadar_family_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kadar_family'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kadar_family'));
        }
    }

    public function _rules() 
    {
	//$this->form_validation->set_rules('yf_name', 'yf name', 'trim|required');
	$this->form_validation->set_rules('yf_agelimit', 'yf agelimit', 'trim|required');
	$this->form_validation->set_rules('yf_desc', 'yf desc', 'trim|required');
	$this->form_validation->set_rules('yf_jumlah', 'yf jumlah', 'trim|required|numeric');

	$this->form_validation->set_rules('yf_id', 'yf_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kadar_family.php */
/* Location: ./application/controllers/Kadar_family.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-10 10:06:38 */
/* http://harviacode.com */