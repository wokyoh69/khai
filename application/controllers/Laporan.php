<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php'; /*tambah*/

class Laporan extends BaseController
{

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('laporan_model');
        //$this->load->model('payment_model');
        $this->load->model('Kadar_model');
        $this->load->model('user_model');
        $this->isLoggedIn();
    }
    /**
     * Index Page for this controller.
     */
    public function index()
    {
        //$name = "null";
        //$data['search_data'] = $this->user_model->userSearch($name);
        //$this->global['pageTitle'] = "Carian Nama"; 

        //$this->loadViews('checkname', $this->global, $data, NULL); 
        //$this->load->view('checkname',$data);
        //echo "test";
        //$this->load->view('report/laporan.php');
    
        $rec = $this->user_model->getMonthlyReg2();
        $surau = [];
        foreach($rec as $rows) {
            $surau[] = array(
                'surauName'   => $rows->SurauName,
                'regNumber' => floatval($rows->regNumber)
            );
        }
      $data['surau'] = ($surau); 

      $record = $this->user_model->getMonthlyReg();
      $data = [];
 
      foreach($record as $row) {
            $data['label'][] = $row->month_name;
            $data['data'][] = (int) $row->count;
      }
      $data['chart_data'] = json_encode($data);
      $data['surau'] = ($surau); 
      $this->global['pageTitle'] = 'laporan'; /*tambah*/
      $this->loadViews('report/laporan.php', $this->global, $data, NULL); /*tambah*/
    }

    public function bar_chart() {
   
      //$query = $this->user_model->getMonthlyReg();

      //$query =  $this->db->query("SELECT COUNT(id) as count,MONTHNAME(created_at) as month_name FROM users WHERE YEAR(created_at) = '" . date('Y') . "'
      //GROUP BY YEAR(created_at),MONTH(created_at)"); 
 
      //$record = $query->result();
      $record = $this->user_model->getMonthlyReg();
      $data = [];
 
      foreach($record as $row) {
            $data['label'][] = $row->month_name;
            $data['data'][] = (int) $row->count;
      }
      $data['chart_data'] = json_encode($data);
      $this->load->view('bar_chart',$data);
    }


public function umur ($noic) {
    //$no_ic = 800211085631; //CONTOH NO IC   871118077020
    if ($noic > 0) {
        $no_ic = $noic;
    
        $tmp_hari = substr($no_ic,4,2);
        $tmp_bulan = substr($no_ic,2,2);
        $tmp_tahun = substr($no_ic,0,2);
        $tmp_negeri = substr($no_ic,6,2);
        $tmp_jantina = substr($no_ic,11,1);
        
        //TARIKH LAHIR//////////////////////////////////////
        if($tmp_tahun >= 00 && $tmp_tahun <= 30) {
            $tmp_tahun = 2000+$tmp_tahun;
        }
        
        if($tmp_tahun >= 31 && $tmp_tahun <= 99) {
            $tmp_tahun = 1900+$tmp_tahun;
        }
        
        $tarikh_lahir = $tmp_hari."/".$tmp_bulan."/".$tmp_tahun;
        
        //UMUR//////////////////////////////////////
        $tmp_tarikh_lahir = $tmp_tahun."-".$tmp_bulan."-".$tmp_hari;;
        $umur = date_create($tmp_tarikh_lahir)->diff(date_create('today'))->y;
    
    }else {
        $umur = 0;
    }
    
         return $umur;
    }


    public function downloadAll()
    {
        /*foreach ($this->user_model->export_Ahli() as $ahli) 
        {
            echo "<b>".$ahli->userId."-".$ahli->name."</b>- ";
            echo $this->umur($ahli->icno);
            echo "<br>";
            foreach ($this->user_model->export_Tanggungan($ahli->userId) as $family) 
                {
                    //echo "&nbsp;&nbsp;&nbsp;".$ahli->userId.":";
                    echo $family->f_name;
                    echo " - ";
                    echo $this->umur($family->f_icno)."<br>";
                    
                }
        }
        exit();*/
        

        $this->load->helper('exportexcel');
        $tarikh = date('Y-m-d');
        $namaFile = "Senarai_Ahli_".$tarikh.".xls";
        $judul = "Senarai Ahli Terkini";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Bil");
        xlsWriteLabel($tablehead, $kolomhead++, "No. Ahli");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Kad Pengenalan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kategori");
        xlsWriteLabel($tablehead, $kolomhead++, "Peserta Khairat");
        xlsWriteLabel($tablehead, $kolomhead++, "Telefon");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        xlsWriteLabel($tablehead, $kolomhead++, "Tarikh Daftar");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggungan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kad Pengenalan");
        xlsWriteLabel($tablehead, $kolomhead++, "Pertalian");
        //xlsWriteLabel($tablehead, $kolomhead++, "Umur");

    foreach ($this->user_model->export_Ahli() as $ahli) {
        $kolombody = 0;

        //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $ahli->noAhli);
        xlsWriteLabel($tablebody, $kolombody++, $ahli->name);
        xlsWriteLabel($tablebody, $kolombody++, $ahli->icno);
        xlsWriteLabel($tablebody, $kolombody++, $ahli->pakej);
        xlsWriteLabel($tablebody, $kolombody++, $ahli->ahli_khairat);
        xlsWriteLabel($tablebody, $kolombody++, $ahli->phone);
        xlsWriteLabel($tablebody, $kolombody++, $ahli->status);
        xlsWriteLabel($tablebody, $kolombody++, $ahli->regdate);
        xlsWriteLabel($tablebody, $kolombody++, $ahli->address);


        //if($ahli->userId != 0)
        foreach ($this->user_model->export_Tanggungan($ahli->userId) as $family) 
                {
                    //echo "&nbsp;&nbsp;&nbsp;".$ahli->userId.":".$family->f_name;
                    //echo "<br>";
                    $tablebody++;
                    xlsWriteLabel($tablebody, 10, $family->f_name);
                    xlsWriteLabel($tablebody, 11, $family->f_icno);
                    xlsWriteLabel($tablebody, 12, $family->f_pertalian);
                    //xlsWriteLabel($tablebody, 11, $this->umur($family->f_icno));

                }

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function laporan_yuran($yid)
    {
        $this->load->helper('exportexcel');
        $year = $this->Kadar_model->get_year($yid);
        //$namaFile = date("Y_m_d_his")."- Senarai_Bayaran_".$year.".xls";
        $namaFile = "Senarai_Bayaran.xls";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "No. Ahli");
        xlsWriteLabel($tablehead, $kolomhead++, "Tahun");
        xlsWriteLabel($tablehead, $kolomhead++, "Yuran Tahunan");
        xlsWriteLabel($tablehead, $kolomhead++, "Yuran Ahli");
        xlsWriteLabel($tablehead, $kolomhead++, "Tarikh Bayaran");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        xlsWriteLabel($tablehead, $kolomhead++, "Ahli Khairat");

      
       foreach ($this->Kadar_model->exportList($yid) as $data) {

        $kolombody = 0;
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->name);
        xlsWriteLabel($tablebody, $kolombody++, $data->noAhli);
        xlsWriteLabel($tablebody, $kolombody++, $data->y_tahun);
        xlsWriteLabel($tablebody, $kolombody++, $data->amaun);
        xlsWriteLabel($tablebody, $kolombody++, $data->total_amaun);
        xlsWriteLabel($tablebody, $kolombody++, $data->p_date);
        xlsWriteLabel($tablebody, $kolombody++, $data->statusbayaran);
        xlsWriteLabel($tablebody, $kolombody++, $data->ahli_khairat);

        $tablebody++;
        $nourut++;
        }
       

        xlsEOF();
        exit();
    }
    
    
}

?>