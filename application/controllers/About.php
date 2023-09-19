<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class About extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('About_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'about/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'about/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'about/index.html';
            $config['first_url'] = base_url() . 'about/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->About_model->total_rows($q);
        $about = $this->About_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'about_data' => $about,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->global['pageTitle'] = 'List'; /*tambah*/
        $this->loadViews('about/about_list', $this->global, $data, NULL); /*tambah*/
    }

    public function read($id) 
    {
        $row = $this->About_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ab_id' => $row->ab_id,
		'ab_title1' => $row->ab_title1,
		'ab_desc1' => $row->ab_desc1,
		'ab_title2' => $row->ab_title2,
		'ab_desc2' => $row->ab_desc2,
		'ab_note' => $row->ab_note,
	    );
            $this->global['pageTitle'] = 'Read'; /*tambah*/
            $this->loadViews('about/about_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('about'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('about/create_action'),
	    'ab_id' => set_value('ab_id'),
	    'ab_title1' => set_value('ab_title1'),
	    'ab_desc1' => set_value('ab_desc1'),
	    'ab_title2' => set_value('ab_title2'),
	    'ab_desc2' => set_value('ab_desc2'),
	    'ab_note' => set_value('ab_note'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('about/about_form', $this->global, $data, NULL); /*tambah*/

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ab_title1' => $this->input->post('ab_title1',TRUE),
		'ab_desc1' => $this->input->post('ab_desc1',TRUE),
		'ab_title2' => $this->input->post('ab_title2',TRUE),
		'ab_desc2' => $this->input->post('ab_desc2',TRUE),
		'ab_note' => $this->input->post('ab_note',TRUE),
	    );

            $this->About_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('about'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->About_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('about/update_action'),
		'ab_id' => set_value('ab_id', $row->ab_id),
		'ab_title1' => set_value('ab_title1', $row->ab_title1),
		'ab_desc1' => set_value('ab_desc1', $row->ab_desc1),
		'ab_title2' => set_value('ab_title2', $row->ab_title2),
		'ab_desc2' => set_value('ab_desc2', $row->ab_desc2),
		'ab_note' => set_value('ab_note', $row->ab_note),
	    );
            $this->global['pageTitle'] = 'Update'; /*tambah*/
            $this->loadViews('about/about_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('about'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ab_id', TRUE));
        } else {
            $data = array(
		'ab_title1' => $this->input->post('ab_title1',TRUE),
		'ab_desc1' => $this->input->post('ab_desc1',TRUE),
		'ab_title2' => $this->input->post('ab_title2',TRUE),
		'ab_desc2' => $this->input->post('ab_desc2',TRUE),
		'ab_note' => $this->input->post('ab_note',TRUE),
	    );

            $this->About_model->update($this->input->post('ab_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('about'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->About_model->get_by_id($id);

        if ($row) {
            $this->About_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('about'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('about'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ab_title1', 'ab title1', 'trim|required');
	$this->form_validation->set_rules('ab_desc1', 'ab desc1', 'trim|required');
	$this->form_validation->set_rules('ab_title2', 'ab title2', 'trim|required');
	$this->form_validation->set_rules('ab_desc2', 'ab desc2', 'trim|required');
	$this->form_validation->set_rules('ab_note', 'ab note', 'trim|required');

	$this->form_validation->set_rules('ab_id', 'ab_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-04 08:36:18 */
/* http://harviacode.com */