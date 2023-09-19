<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Khairat extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Khairat_model');
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
            $config['base_url'] = base_url() . 'khairat/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'khairat/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'khairat/index.html';
            $config['first_url'] = base_url() . 'khairat/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Khairat_model->total_rows($q);
        $khairat = $this->Khairat_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'khairat_data' => $khairat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->global['pageTitle'] = 'khairat'; /*tambah*/
        $this->loadViews('khairat/khairat_list', $this->global, $data, NULL); /*tambah*/

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

        $row = $this->Khairat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'k_id' => $row->k_id,
		'k_date' => $row->k_date,
		'userid' => $row->userid,
		'k_amaun' => $row->k_amaun,
		'k_catatan' => $row->k_catatan,
        'k_jenis' => $row->k_jenis,
		'updatedBy' => $row->updatedBy,
		'updatedDtm' => $row->updatedDtm,
	    );
            $this->load->model('user_model');
            $data['userlist'] = $this->user_model->getUserList();

            $this->global['pageTitle'] = 'khairat'; /*tambah*/
            $this->loadViews('khairat/khairat_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Maaf ! Tiada rekod');
            redirect(site_url('khairat'));
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
            'button' => 'Tambah',
            'action' => site_url('khairat/create_action'),
	    'k_id' => set_value('k_id'),
	    'k_date' => set_value('k_date'),
	    'userid' => set_value('userid'),
	    'k_amaun' => set_value('k_amaun'),
	    'k_catatan' => set_value('k_catatan'),
        'k_jenis' => set_value('k_jenis'),
	    'updatedBy' => set_value('updatedBy'),
	    'updatedDtm' => set_value('updatedDtm'),
	);
        $this->load->model('user_model');
        $data['userlist'] = $this->user_model->getUserList();

        $this->global['pageTitle'] = 'Tambah'; /*tambah*/
        $this->loadViews('khairat/khairat_form', $this->global, $data, NULL); /*tambah*/

        }

    }
    
    public function create_action() 
    {
        //print_r($_POST);
        //exit();

        $this->_rules();

        if ($this->form_validation->run() == TRUE) {
            $this->create();
        } else {
            $data = array(
		'k_date' => $this->input->post('k_date',TRUE),
		'userid' => $this->input->post('userid',TRUE),
		'k_amaun' => $this->input->post('k_amaun',TRUE),
		'k_catatan' => $this->input->post('k_catatan',TRUE),
        'k_jenis' => $this->input->post('k_jenis',TRUE),
		'updatedBy'=> $this->vendorId, //adminID
        'updatedDtm'=> date('Y-m-d H:i:s'),
	    );

            $this->Khairat_model->insert($data);
            $this->session->set_flashdata('message', 'Rekod telah dikemaskini');
            redirect(site_url('khairat'));
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

        $row = $this->Khairat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Kemaskini',
                'action' => site_url('khairat/update_action'),
		'k_id' => set_value('k_id', $row->k_id),
		'k_date' => set_value('k_date', $row->k_date),
		'userid' => set_value('userid', $row->userid),
		'k_amaun' => set_value('k_amaun', $row->k_amaun),
		'k_catatan' => set_value('k_catatan', $row->k_catatan),
        'k_jenis' => set_value('k_jenis', $row->k_jenis),
		'updatedBy' => set_value('updatedBy', $row->updatedBy),
		'updatedDtm' => set_value('updatedDtm', $row->updatedDtm),
	    );
            $this->load->model('user_model');
            $data['userlist'] = $this->user_model->getUserList();

            $this->global['pageTitle'] = 'Kemaskini'; /*tambah*/
            $this->loadViews('khairat/khairat_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Maaf ! Tiada rekod');
            redirect(site_url('khairat'));
        }

        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == TRUE) {
            $this->update($this->input->post('k_id', TRUE));
        } else {
            $data = array(
		'k_date' => $this->input->post('k_date',TRUE),
		'userid' => $this->input->post('userid',TRUE),
		'k_amaun' => $this->input->post('k_amaun',TRUE),
        'k_catatan' => $this->input->post('k_catatan',TRUE),
		'k_jenis' => $this->input->post('k_jenis',TRUE),
		'updatedBy'=> $this->vendorId, //adminID
        'updatedDtm'=> date('Y-m-d H:i:s'),
	    );

            $this->Khairat_model->update($this->input->post('k_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Rekod telah dikemaskini');
            redirect(site_url('khairat'));
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

        $row = $this->Khairat_model->get_by_id($id);

        if ($row) {
            $this->Khairat_model->delete($id);
            $this->session->set_flashdata('message', 'Rekod telah dipadam!');
            redirect(site_url('khairat'));
        } else {
            $this->session->set_flashdata('message', 'Maaf ! Tiada rekod');
            redirect(site_url('khairat'));
        }

        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('k_date', 'k date', 'trim|required');
	$this->form_validation->set_rules('userid', 'userid', 'trim|required');
	$this->form_validation->set_rules('k_amaun', 'k amaun', 'trim|required|numeric');
	$this->form_validation->set_rules('k_catatan', 'k catatan', 'trim|required');
	$this->form_validation->set_rules('updatedBy', 'updatedby', 'trim|required');
	$this->form_validation->set_rules('updatedDtm', 'updateddtm', 'trim|required');

	$this->form_validation->set_rules('k_id', 'k_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "khairat.xls";
        $judul = "khairat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tarikh");
	xlsWriteLabel($tablehead, $kolomhead++, "ID");
    xlsWriteLabel($tablehead, $kolomhead++, "Perkara");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
	xlsWriteLabel($tablehead, $kolomhead++, "Catatan");
	xlsWriteLabel($tablehead, $kolomhead++, "UpdatedBy");
	xlsWriteLabel($tablehead, $kolomhead++, "UpdatedDtm");

	foreach ($this->Khairat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->k_date);
	    xlsWriteNumber($tablebody, $kolombody++, $data->userid);
        xlsWriteLabel($tablebody, $kolombody++, $data->k_jenis);
	    xlsWriteNumber($tablebody, $kolombody++, $data->k_amaun);
	    xlsWriteLabel($tablebody, $kolombody++, $data->k_catatan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->updatedBy);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updatedDtm);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Khairat.php */
/* Location: ./application/controllers/Khairat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-04 15:58:08 */
/* http://harviacode.com */