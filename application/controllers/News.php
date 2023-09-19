<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class News extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'news/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'news/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'news/index.html';
            $config['first_url'] = base_url() . 'news/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->News_model->total_rows($q);
        $news = $this->News_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'news_data' => $news,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->global['pageTitle'] = 'Makluman'; /*tambah*/
        $this->loadViews('news/news_list', $this->global, $data, NULL); /*tambah*/
    }

    public function read($id) 
    {
        $row = $this->News_model->get_by_id($id);
        if ($row) {
            $data = array(
		'news_id' => $row->news_id,
		'news_headline' => $row->news_headline,
		'news_story' => $row->news_story,
		'news_editor' => $row->news_editor,
		//'news_email' => $row->news_email,
		'news_timestamp' => $row->news_timestamp,
		'news_status' => $row->news_status,
	    );
            $this->global['pageTitle'] = 'Makluman'; /*tambah*/
            $this->loadViews('news/news_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('news'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('news/create_action'),
	    'news_id' => set_value('news_id'),
	    'news_headline' => set_value('news_headline'),
	    'news_story' => set_value('news_story'),
	    'news_editor' => set_value('news_editor'),
	    //'news_email' => set_value('news_email'),
	    'news_timestamp' => set_value('news_timestamp'),
	    'news_status' => set_value('news_status'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('news/news_form', $this->global, $data, NULL); /*tambah*/

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'news_headline' => $this->input->post('news_headline',TRUE),
		'news_story' => $this->input->post('news_story',TRUE),
		'news_editor' => $this->input->post('news_editor',TRUE),
		//'news_email' => $this->input->post('news_email',TRUE),
		'news_timestamp' => $this->input->post('news_timestamp',TRUE),
		'news_status' => $this->input->post('news_status',TRUE),
	    );

            $this->News_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('news'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->News_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('news/update_action'),
		'news_id' => set_value('news_id', $row->news_id),
		'news_headline' => set_value('news_headline', $row->news_headline),
		'news_story' => set_value('news_story', $row->news_story),
		'news_editor' => set_value('news_editor', $row->news_editor),
		//'news_email' => set_value('news_email', $row->news_email),
		'news_timestamp' => set_value('news_timestamp', $row->news_timestamp),
		'news_status' => set_value('news_status', $row->news_status),
	    );
            $this->global['pageTitle'] = 'Update'; /*tambah*/
            $this->loadViews('news/news_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('news'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('news_id', TRUE));
        } else {
            $data = array(
		'news_headline' => $this->input->post('news_headline',TRUE),
		'news_story' => $this->input->post('news_story',TRUE),
		'news_editor' => $this->input->post('news_editor',TRUE),
		//'news_email' => $this->input->post('news_email',TRUE),
		'news_timestamp' => $this->input->post('news_timestamp',TRUE),
		'news_status' => $this->input->post('news_status',TRUE),
	    );

            $this->News_model->update($this->input->post('news_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('news'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->News_model->get_by_id($id);

        if ($row) {
            $this->News_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('news'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('news'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('news_headline', 'news headline', 'trim|required');
	$this->form_validation->set_rules('news_story', 'news story', 'trim|required');
	$this->form_validation->set_rules('news_editor', 'news editor', 'trim|required');
	//$this->form_validation->set_rules('news_email', 'news email', 'trim|required');
	$this->form_validation->set_rules('news_timestamp', 'news timestamp', 'trim|required');
	$this->form_validation->set_rules('news_status', 'news status', 'trim|required');

	$this->form_validation->set_rules('news_id', 'news_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "news.xls";
        $judul = "news";
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
	xlsWriteLabel($tablehead, $kolomhead++, "News Headline");
	xlsWriteLabel($tablehead, $kolomhead++, "News Story");
	xlsWriteLabel($tablehead, $kolomhead++, "News Editor");
	//xlsWriteLabel($tablehead, $kolomhead++, "News Email");
	xlsWriteLabel($tablehead, $kolomhead++, "News Timestamp");
	xlsWriteLabel($tablehead, $kolomhead++, "News Status");

	foreach ($this->News_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->news_headline);
	    xlsWriteLabel($tablebody, $kolombody++, $data->news_story);
	    xlsWriteLabel($tablebody, $kolombody++, $data->news_editor);
	    //xlsWriteLabel($tablebody, $kolombody++, $data->news_email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->news_timestamp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->news_status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file News.php */
/* Location: ./application/controllers/News.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-28 09:16:45 */
/* http://harviacode.com */