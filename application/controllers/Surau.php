<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Surau extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Surau_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'surau/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'surau/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'surau/index.html';
            $config['first_url'] = base_url() . 'surau/index.html';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Surau_model->total_rows($q);
        $surau = $this->Surau_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'surau_data' => $surau,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->global['pageTitle'] = 'Lokasi/Taman'; /*tambah*/
        $this->loadViews('surau/surau_list', $this->global, $data, NULL); /*tambah*/
    }

    public function read($id) 
    {
        $row = $this->Surau_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'name' => $row->name,
		'desc' => $row->desc,
	    );
            $this->global['pageTitle'] = 'Lokasi/Taman'; /*tambah*/
            $this->loadViews('surau/surau_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surau'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('surau/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'desc' => set_value('desc'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('surau/surau_form', $this->global, $data, NULL); /*tambah*/

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'desc' => $this->input->post('desc',TRUE),
	    );

            $this->Surau_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('surau'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Surau_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('surau/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
		'desc' => set_value('desc', $row->desc),
	    );
            $this->global['pageTitle'] = 'Update'; /*tambah*/
            $this->loadViews('surau/surau_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surau'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'desc' => $this->input->post('desc',TRUE),
	    );

            $this->Surau_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('surau'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Surau_model->get_by_id($id);

        if ($row) {
            $this->Surau_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('surau'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surau'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('desc', 'desc', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Surau.php */
/* Location: ./application/controllers/Surau.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-10 07:42:02 */
/* http://harviacode.com */