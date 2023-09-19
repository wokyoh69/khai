<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Gallery extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Gallery_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'gallery/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'gallery/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'gallery/index.html';
            $config['first_url'] = base_url() . 'gallery/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Gallery_model->total_rows($q);
        $gallery = $this->Gallery_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'gallery_data' => $gallery,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->global['pageTitle'] = 'gallery'; /*tambah*/
        $this->loadViews('gallery/gallery_list', $this->global, $data, NULL); /*tambah*/
    }

    public function read($id) 
    {
        $row = $this->Gallery_model->get_by_id($id);
        if ($row) {
            $data = array(
		'gallery_id' => $row->gallery_id,
		'gallery_date' => $row->gallery_date,
		'gallery_title' => $row->gallery_title,
		'gallery_image' => $row->gallery_image,
		'gallery_status' => $row->gallery_status,
	    );
            $this->global['pageTitle'] = 'gallery'; /*tambah*/
            $this->loadViews('gallery/gallery_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gallery'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('gallery/create_action'),
    	    'gallery_id' => set_value('gallery_id'),
    	    'gallery_date' => set_value('gallery_date'),
    	    'gallery_title' => set_value('gallery_title'),
    	    'gallery_image' => set_value('userfile'),
    	    'gallery_status' => set_value('gallery_status'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('gallery/gallery_form', $this->global, $data, NULL); /*tambah*/

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) 
        {
            $this->create();
        } else {

            if (empty($_FILES['userfile']['name']))
            {
                $image_name = 'default.jpg';
                //assign name but no file upload
            } else {
                $file_type = pathinfo($_FILES['userfile']['name']);
                $next_id = $this->Gallery_model->get_next_gallery_id();
                $next_id = sprintf("%03d", $next_id);
                $image_name = "img".$next_id.".".$file_type['extension'];  
                $this->do_upload($image_name); 
            }
            

            $data = array(
    		'gallery_date' => $this->input->post('gallery_date',TRUE),
    		'gallery_title' => $this->input->post('gallery_title',TRUE),
    		'gallery_image' => $image_name,
    		'gallery_status' => $this->input->post('gallery_status',TRUE),
	       );
        
             
             $this->Gallery_model->insert($data);
             $this->session->set_flashdata('message', 'Create Record Success');
             redirect(site_url('gallery'));
        }
    }

   public function do_upload($image_name)
    {
        
        if (empty($_FILES['userfile']['name']))
        {
                $image_name = 'default.jpg';//default image
            } else {
                $config['upload_path']      = './upload/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg';
                $config['max_size']         = 2048;
                $config['max_width']        = 1024;
                $config['max_height']       = 1024;
                $config['file_ext_tolower'] = TRUE;
                $config['file_name']        = $image_name;
                $config['overwrite']        = TRUE;

                $this->load->library('upload', $config);
                //$this->upload->do_upload('userfile');

                if ( ! $this->upload->do_upload('userfile'))
                {
                   
                   echo $this->upload->display_errors();
                }
                else
                {
                    echo $this->upload->data();  
                }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Gallery_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gallery/update_action'),
        		'gallery_id' => set_value('gallery_id', $row->gallery_id),
        		'gallery_date' => set_value('gallery_date', $row->gallery_date),
        		'gallery_title' => set_value('gallery_title', $row->gallery_title),
        		'gallery_image' => set_value('userfile', $row->gallery_image),
        		'gallery_status' => set_value('gallery_status', $row->gallery_status),
        	    );
            $this->global['pageTitle'] = 'Update'; /*tambah*/
            $this->loadViews('gallery/gallery_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gallery'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('gallery_id', TRUE));
        } else {

            if (empty($_FILES['userfile']['name']))
            {
                $image_name = $this->input->post('gallery_image', TRUE);
                //assign name but no file upload
            } else {
                $file_type = pathinfo($_FILES['userfile']['name']);
                $current_id = $this->input->post('gallery_id', TRUE);
                $current_id = sprintf("%03d", $current_id);
                $image_name = "img".$current_id.".".$file_type['extension'];  
                $this->do_upload($image_name); 
            }

            $data = array(
    		'gallery_date' => $this->input->post('gallery_date',TRUE),
    		'gallery_title' => $this->input->post('gallery_title',TRUE),
    		'gallery_image' => $image_name,
    		'gallery_status' => $this->input->post('gallery_status',TRUE),
    	    );

            $this->Gallery_model->update($this->input->post('gallery_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('gallery'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Gallery_model->get_by_id($id);

        if ($row) {
            $this->Gallery_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('gallery'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gallery'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('gallery_date', 'gallery date', 'trim|required');
	$this->form_validation->set_rules('gallery_title', 'gallery title', 'trim|required');
	$this->form_validation->set_rules('userfile', 'Image', 'trim');
	$this->form_validation->set_rules('gallery_status', 'gallery status', 'trim|required');

	$this->form_validation->set_rules('gallery_id', 'gallery_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Gallery.php */
/* Location: ./application/controllers/Gallery.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-23 04:46:34 */
/* http://harviacode.com */