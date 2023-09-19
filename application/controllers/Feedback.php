<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Feedback extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Feedback_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'feedback/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'feedback/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'feedback/index.html';
            $config['first_url'] = base_url() . 'feedback/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Feedback_model->total_rows($q);
        $feedback = $this->Feedback_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'feedback_data' => $feedback,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->global['pageTitle'] = 'Feedback'; /*tambah*/
        $this->loadViews('feedback/feedback_list', $this->global, $data, NULL); /*tambah*/
    }

    public function read($id) 
    {
        $row = $this->Feedback_model->get_by_id($id);
        if ($row) {
            $data = array(
		'fb_id' => $row->fb_id,
		'Date' => $row->Date,
		'Name' => $row->Name,
		'Email' => $row->Email,
		'Mobile' => $row->Mobile,
		'Comment' => $row->Comment,
	    );
            $this->global['pageTitle'] = 'Feedback'; /*tambah*/
            $this->loadViews('feedback/feedback_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('feedback'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('feedback/create_action'),
	    'fb_id' => set_value('fb_id'),
	    'Date' => set_value('Date'),
	    'Name' => set_value('Name'),
	    'Email' => set_value('Email'),
	    'Mobile' => set_value('Mobile'),
	    'Relation' => set_value('Relation'),
	    'Comment' => set_value('Comment'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('feedback/feedback_form', $this->global, $data, NULL); /*tambah*/

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'Date' => $this->input->post('Date',TRUE),
		'Name' => $this->input->post('Name',TRUE),
		'Email' => $this->input->post('Email',TRUE),
		'Mobile' => $this->input->post('Mobile',TRUE),
		'Relation' => $this->input->post('Relation',TRUE),
		'Comment' => $this->input->post('Comment',TRUE),
	    );

            $this->Feedback_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('feedback'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Feedback_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('feedback/update_action'),
		'fb_id' => set_value('fb_id', $row->fb_id),
		'Date' => set_value('Date', $row->Date),
		'Name' => set_value('Name', $row->Name),
		'Email' => set_value('Email', $row->Email),
		'Mobile' => set_value('Mobile', $row->Mobile),
		'Comment' => set_value('Comment', $row->Comment),
	    );
            $this->global['pageTitle'] = 'Update'; /*tambah*/
            $this->loadViews('feedback/feedback_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('feedback'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('fb_id', TRUE));
        } else {
            $data = array(
		'Date' => $this->input->post('Date',TRUE),
		'Name' => $this->input->post('Name',TRUE),
		'Email' => $this->input->post('Email',TRUE),
		'Mobile' => $this->input->post('Mobile',TRUE),
		'Relation' => $this->input->post('Relation',TRUE),
		'Comment' => $this->input->post('Comment',TRUE),
	    );

            $this->Feedback_model->update($this->input->post('fb_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('feedback'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Feedback_model->get_by_id($id);

        if ($row) {
            $this->Feedback_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('feedback'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('feedback'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('Date', 'date', 'trim|required');
	$this->form_validation->set_rules('Name', 'name', 'trim|required');
	$this->form_validation->set_rules('Email', 'email', 'trim|required');
	$this->form_validation->set_rules('Mobile', 'mobile', 'trim|required');
	$this->form_validation->set_rules('Relation', 'relation', 'trim|required');
	$this->form_validation->set_rules('Comment', 'comment', 'trim|required');

	$this->form_validation->set_rules('fb_id', 'fb_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "feedback.xls";
        $judul = "feedback";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Mobile");
	//xlsWriteLabel($tablehead, $kolomhead++, "Relation");
	xlsWriteLabel($tablehead, $kolomhead++, "Comment");

	foreach ($this->Feedback_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Mobile);
	    //xlsWriteLabel($tablebody, $kolombody++, $data->Relation);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Comment);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Feedback.php */
/* Location: ./application/controllers/Feedback.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-04 09:35:05 */
/* http://harviacode.com */