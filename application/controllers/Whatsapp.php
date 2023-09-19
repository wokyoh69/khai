<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Whatsapp extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Whatsapp_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    public function index()
    {
        $wa_phone2 = $this->Whatsapp_model->get_phone(2,"wa_phone");
        //$wa_phone4 = $this->Whatsapp_model->get_phone(4,"wa_phone");
        
        $data = array(
            'wa_phone2' => $wa_phone2,
            //'wa_phone4' => $wa_phone4,
        );

        $data['whatsapp_records'] = $this->Whatsapp_model->get_all();
        $this->global['pageTitle'] = 'Whatsapp Logs'; /*tambah*/
        $this->loadViews('whatsapp/whatsapp_message_list', $this->global, $data, NULL); /*tambah*/
    }

    public function read($id) 
    {
        $row = $this->Whatsapp_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'wm_id' => $row->wm_id,
    		'userid' => $row->userid,
    		'phone' => $row->phone,
    		'messageid' => $row->messageid,
    		'message' => $row->message,
    		'createDtm' => $row->createDtm,
    		'createdBy' => $row->createdBy,
    	    );

            $this->global['pageTitle'] = 'whatsapp'; /*tambah*/
            $this->loadViews('whatsapp/whatsapp_message_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('whatsapp'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('whatsapp/create_action'),
	    'wm_id' => set_value('wm_id'),
	    'userid' => set_value('userid'),
	    'phone' => set_value('phone'),
	    'messageid' => set_value('messageid'),
	    'message' => set_value('message'),
	    'createDtm' => set_value('createDtm'),
	    'createdBy' => set_value('createdBy'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('whatsapp/whatsapp_message_form', $this->global, $data, NULL); /*tambah*/

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'userid' => $this->input->post('userid',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'messageid' => $this->input->post('messageid',TRUE),
		'message' => $this->input->post('message',TRUE),
		'createDtm' => $this->input->post('createDtm',TRUE),
		'createdBy' => $this->input->post('createdBy',TRUE),
	    );

            $this->Whatsapp_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('whatsapp'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Whatsapp_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('whatsapp/update_action'),
		'wm_id' => set_value('wm_id', $row->wm_id),
		'userid' => set_value('userid', $row->userid),
		'phone' => set_value('phone', $row->phone),
		'messageid' => set_value('messageid', $row->messageid),
		'message' => set_value('message', $row->message),
		'createDtm' => set_value('createDtm', $row->createDtm),
		'createdBy' => set_value('createdBy', $row->createdBy),
	    );
            $this->global['pageTitle'] = 'Update'; /*tambah*/
            $this->loadViews('whatsapp/whatsapp_message_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('whatsapp'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('wm_id', TRUE));
        } else {
            $data = array(
		'userid' => $this->input->post('userid',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'messageid' => $this->input->post('messageid',TRUE),
		'message' => $this->input->post('message',TRUE),
		'createDtm' => $this->input->post('createDtm',TRUE),
		'createdBy' => $this->input->post('createdBy',TRUE),
	    );

            $this->Whatsapp_model->update($this->input->post('wm_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('whatsapp'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Whatsapp_model->get_by_id($id);

        if ($row) {
            $this->Whatsapp_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('whatsapp'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('whatsapp'));
        }
    }

    public function saveAdminPhone() 
    {
        
        $data2 = array(
            'wa_phone' => $this->input->post('wa_phone2',TRUE),
            'wa_admin' => "Y",
            );

        /*$data4 = array(
            'wa_phone' => $this->input->post('wa_phone4',TRUE),
            'wa_admin' => "Y",
            );*/

            $this->Whatsapp_model->update_phone(2, $data2);
            //$this->Whatsapp_model->update_phone(4, $data4);

            $this->session->set_flashdata('success', 'Kemaskini Berjaya');
            redirect(site_url('whatsapp'));
        
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('userid', 'userid', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('messageid', 'messageid', 'trim|required');
	$this->form_validation->set_rules('message', 'message', 'trim|required');
	$this->form_validation->set_rules('createDtm', 'createdtm', 'trim|required');
	$this->form_validation->set_rules('createdBy', 'createdby', 'trim|required');

	$this->form_validation->set_rules('wm_id', 'wm_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Whatsapp.php */
/* Location: ./application/controllers/Whatsapp.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-03-27 00:45:13 */
/* http://harviacode.com */