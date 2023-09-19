<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/
require APPPATH . '/views/functions.php';


class Kadar extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kadar_model');
        $this->load->model('user_model');
        $this->load->model('Payment_model');
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
            $config['base_url'] = base_url() . 'kadar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kadar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kadar/index.html';
            $config['first_url'] = base_url() . 'kadar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kadar_model->total_rows($q);
        $kadar = $this->Kadar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $this->load->model('payment_model');
        //$yuran = $this->payment_model->checkYuran();

        $data = array(
            'kadar_data' => $kadar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            //'yuran_data' => $yuran,
        );

         

        $this->global['pageTitle'] = 'kadar'; /*tambah*/
        $this->loadViews('kadar/tbl_kadar_yuran_list', $this->global, $data, NULL); /*tambah*/

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

        $row = $this->Kadar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'yid' => $row->yid,
		'y_tahun' => $row->y_tahun,
		'y_jumlah' => $row->y_jumlah,
        'y_status' => $row->status,
	    );
            $this->global['pageTitle'] = 'kadar'; /*tambah*/
            $this->loadViews('kadar/tbl_kadar_yuran_read', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kadar'));
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
            'action' => site_url('kadar/create_action'),
	    'yid' => set_value('yid'),
        'y_title' => set_value('y_title'),
	    'y_tahun' => set_value('y_tahun'),
	    'y_jumlah' => set_value('y_jumlah'),
	    'y_jumlah_bujang' => set_value('y_jumlah_bujang'),
	);
        $this->global['pageTitle'] = 'Create'; /*tambah*/
        $this->loadViews('kadar/tbl_kadar_yuran_form', $this->global, $data, NULL); /*tambah*/

        }

    }
    
    public function create_action() 
    {
        $tahun = $this->input->post('y_tahun',TRUE);
        //exit();
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'y_title' => $this->input->post('y_title',TRUE),
		'y_tahun' => $this->input->post('y_tahun',TRUE),
		'y_jumlah' => $this->input->post('y_jumlah',TRUE),
		'y_jumlah_bujang' => $this->input->post('y_jumlah_bujang',TRUE),
        'status' => $this->input->post('status',TRUE),
	    );

            $result = $this->Kadar_model->checkYearExist($tahun);
            if($result > 0)
                {
                    $this->session->set_flashdata('message', '<b>Maaf ! Tahun '.$tahun.' telah wujud !.</b>');
                }
                else
                {
                    $this->Kadar_model->insert($data);
                    $this->session->set_flashdata('message', '<b>Tambahan Yuran tahun '.$tahun.' telah Berjaya !</b>');
                    
                }


            //$this->Kadar_model->insert($data);
            //$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kadar'));

        }
    }

    function checkYearExist($year)
    {
        $tahun = $this->input->post("y_tahun");
        $result = $this->user_model->checkYearExist($tahun);

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    
    public function update($id) 
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

        $row = $this->Kadar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kadar/update_action'),
        		'yid' => set_value('yid', $row->yid),
                'y_title' => set_value('y_title', $row->y_title),
        		'y_tahun' => set_value('y_tahun', $row->y_tahun),
        		'y_jumlah' => set_value('y_jumlah', $row->y_jumlah),
        		'y_jumlah_bujang' => set_value('y_jumlah_bujang', $row->y_jumlah_bujang),
                'status' => set_value('status', $row->status),
        	    );
            $this->global['pageTitle'] = 'Update'; /*tambah*/
            $this->loadViews('kadar/tbl_kadar_yuran_form', $this->global, $data, NULL); /*tambah*/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kadar'));
        }

        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('yid', TRUE));
        } else {
            $data = array(
                'y_title' => $this->input->post('y_title',TRUE),
        		'y_tahun' => $this->input->post('y_tahun',TRUE),
        		'y_jumlah_bujang' => $this->input->post('y_jumlah_bujang',TRUE),
        		'y_jumlah' => $this->input->post('y_jumlah',TRUE),
                'status' => $this->input->post('status',TRUE),
        	    );

            $this->Kadar_model->update($this->input->post('yid', TRUE), $data);
            $this->session->set_flashdata('message', 'Kemaskini Berjaya');
            redirect(site_url('kadar'));
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

        $row = $this->Kadar_model->get_by_id($id);

        if ($row) {
            $this->Kadar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kadar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kadar'));
        }

        }
    }

    public function generate($id) 
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

        $amount = $this->kadar_model->get_amount($id);
        $year = $this->kadar_model->get_year($id);

        //echo $id;
        
        

        //$row = $this->Payment_model->get_by_id($id); //y_id
        //$row = $this->Payment_model->get_by_id($id);
        //if ($row) 
//exit();
        //if($row) {
            $this->Payment_model->generate_payment($id);
            $this->session->set_flashdata('message', 'Tuntutan Yuran Telah Dijana Kepada Semua Ahli');
            redirect(site_url('kadar'));    
            //exit();
        //}

        /*
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kadar/update_action'),
        'yid' => set_value('yid', $row->yid),
        'y_title' => set_value('y_title', $row->y_title),
        'y_tahun' => set_value('y_tahun', $row->y_tahun),
        'y_jumlah' => set_value('y_jumlah', $row->y_jumlah),
        );
            $this->global['pageTitle'] = 'Update'; 
            $this->loadViews('kadar/tbl_kadar_yuran_form', $this->global, $data, NULL); 
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kadar'));
        } */
        }
    }

    public function generateFee($id) 
    {
    if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

        //$amount = $this->kadar_model->get_amount($id);
        $year = $this->Kadar_model->get_year($id);

        ///list of selected year & kadar id
        if($year > 0){
            $datauser = $this->user_model->getUserActive();
            //1. LIST ALL ACTIVE USER
            foreach ($datauser as $ul) {
                $userId = $ul->userId;
                $pakej = $ul->pakej;
                $ahli_khairat = $ul->ahli_khairat;

            if($ahli_khairat == "Y"){
                //2. CEK JIKA YURAN AHLI TELAH WUJUD
                if($this->Payment_model->checkPaymentRecord($userId,$id))  
                { 
                    $jumlah_yuran = 0;
                } else {
                    //3. JIKA YURAN AHLI BELUM WUJUD...//get_amount_pakej
                    //$jumlah_yuran = $this->Kadar_model->get_amount($id);
                    if($pakej == "Keluarga") { 
                        if($id == 1) { 
                            $jumlah_daftar = $this->Kadar_model->get_amount_daftar(1,"y_jumlah","tbl_kadar_yuran");
                        } else {
                            $jumlah_yuran = $this->Kadar_model->get_amount_daftar($id,"y_jumlah","tbl_kadar_yuran");
                        }
                            
                    } else if($pakej == "Bujang"){
                        if($id == 1) { 
                            $jumlah_daftar = $this->Kadar_model->get_amount_daftar(1,"y_jumlah_bujang","tbl_kadar_yuran");
                        } else {
                            $jumlah_yuran = $this->Kadar_model->get_amount_daftar($id,"y_jumlah_bujang","tbl_kadar_yuran");
                        }
                    }

                    //4. INSERT PAYMENT AHLI 
                    $data = array( 
                        'userid'  => $userId, 
                        'yid'=>  $id,
                        'amaun'=> $jumlah_yuran, 
                        'total_amaun'=> $jumlah_yuran
                    );
                    $this->Payment_model->insert($data); 

                    //5. INSERT PAYMENT DETAIL AHLI
                    //echo "<br>".$userId;
                    $umur = umur($ul->icno);

                    $yuran = yuran("AHLI", $umur);
                    //$jumlah_tahunan = total_renew_yuran_in_year($yuran); //yuran ahli setahun

                    $payment_id = $this->user_model->getLatestPayment();
                    $paymentDetails = array(
                                'p_id'=>$payment_id, 
                                'userid'=>$userId, 
                                //'amaun'=>$jumlah_tahunan,  
                                'amaun'=>$yuran, 
                                );
                    $this->Payment_model->insert_details($paymentDetails);

                    //6. INSERT PAYMENT DETAIL SETIAP FAMILY
                    $total = 0;
                    $rowf = $this->user_model->getFamilyListAlive($userId);
                    foreach ($rowf as $fam)
                      { 
                        $familyInfo = array(
                            'f_name'=>$fam->f_name, 
                            'userid'=>$userId, 
                            'f_icno'=>$fam->f_icno,  
                            'f_pertalian'=>$fam->f_pertalian, 
                            'f_pasangan'=>$fam->f_pasangan, 
                            'approval' => "Y",
                            );

                        $umurF = umur($fam->f_icno);
                        $yuranF = yuran($fam->f_pertalian, $umurF);
                        //$jumlah_tahunanF = total_renew_yuran_in_year($yuranF); //yuran tahunan family
                        $total = $total + $yuranF;

                        $paymentfamilyInfo = array(
                            'p_id'=>$payment_id, 
                            'f_id'=>$fam->f_id,
                            'userid'=>$userId, 
                            'amaun'=>$yuranF, 
                            );
                        $this->Payment_model->insert_details($paymentfamilyInfo);
                      } 

                      //7. UPDATE TOTAL PAYMENT (AHLI + TANGGUNGAN)
                      $jumlah_keseluruhan_yuran = $jumlah_yuran + $yuran + $total;
                      $paymentInfo = array('total_amaun'=>$jumlah_keseluruhan_yuran);
                      $this->Payment_model->updatePayment($payment_id,$paymentInfo);
                }
            }//end if ahl_khairat
            }//end foreach
        }

            $this->session->set_flashdata('message', 'Tuntutan Yuran Telah Dijana Kepada Semua Ahli');
            redirect(site_url('kadar'));    
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('y_tahun', 'y tahun', 'trim|required');
	$this->form_validation->set_rules('y_jumlah', 'y jumlah', 'trim|required|numeric');

	$this->form_validation->set_rules('yid', 'yid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    /*public function index() {
        $data['export_list'] = $this->export->exportList();
        $this->load->view('export', $data);
    }*/


    public function generateXls($yid) {
        // create file name
        $fileName = 'data-'.time().'.xlsx'; 
        // load excel library
        $this->load->library('Excel');//echo APPPATH."third_party/PHPExcel.php";

        $listInfo = $this->Kadar_model->exportList($yid);
        //exit();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Nama Ahli');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'No. Ahli');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Tahun');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Yuran Tahunan');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Yuran Ahli');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Tarikh Bayaran'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Status');     

        // set Row
        $rowCount = 2;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->userId);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->y_tahun);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->amaun); 
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->total_amaun); 
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $list->p_date);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $list->statusbayaran);
            $rowCount++;
        }
        $year = $this->Kadar_model->get_year($yid);
        $filename = "Senarai_Bayaran_".$year."-".date("Y_m_d").".csv";
        //header('Content-Type: application/vnd.ms-excel'); 
        //header('Content-Disposition: attachment;filename="'.$filename.'"');
        //header('Cache-Control: max-age=0'); 

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
        //$objWriter->save("php://output"); 
        $filename = "download/".$filename;
        //$objWriter->save($filename);
        $objWriter->save(str_replace(__file__,$filename,__file__));
        
        //$this->load->helper('download');
            
        //download file from directory
        //force_download($filename, NULL);
        //$this->loadViews('kadar/tbl_kadar_yuran_form', $this->global, $data, NULL); /*tambah*/

    }

    public function excel($yid)
    {
        $this->load->helper('exportexcel');
        $year = $this->Kadar_model->get_year($yid);
        $namaFile = date("Y_m_d_his")." - Senarai_Bayaran_".$year.".xls";
        //$namaFile = "feedback.xls";
        //$judul = "Senarai_Bayaran";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Ahli");
        xlsWriteLabel($tablehead, $kolomhead++, "No.Ahli");
        xlsWriteLabel($tablehead, $kolomhead++, "Tahun");
        xlsWriteLabel($tablehead, $kolomhead++, "Yuran Tahunan");
        xlsWriteLabel($tablehead, $kolomhead++, "Yuran Ahli");
        xlsWriteLabel($tablehead, $kolomhead++, "Tarikh Bayaran");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        
       foreach ($this->Kadar_model->exportList($yid) as $data) {
       //foreach ($this->Feedback_model->get_all() as $data) {
        $kolombody = 0;

        //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->name);
        xlsWriteLabel($tablebody, $kolombody++, $data->userId);
        xlsWriteLabel($tablebody, $kolombody++, $data->y_tahun);
        xlsWriteLabel($tablebody, $kolombody++, $data->amaun);
        xlsWriteLabel($tablebody, $kolombody++, $data->total_amaun);
        xlsWriteLabel($tablebody, $kolombody++, $data->p_date);
        xlsWriteLabel($tablebody, $kolombody++, $data->statusbayaran);

        $tablebody++;
        $nourut++;
        }

        xlsEOF();
        exit();
    }


}

/* End of file Kadar.php */
/* Location: ./application/controllers/Kadar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-01 18:12:55 */
/* http://harviacode.com */