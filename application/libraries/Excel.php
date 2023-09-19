
<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  

//require APPPATH . '/libraries/BaseController.php'; 
require_once APPPATH."third_party/PHPExcel.php";
//require_once base_url('application/third_party/PHPExcel.php');
//require_once APPPATH . '/third_party/PHPExcel.php';
//require APPPATH . '/libraries/BaseController.php';
  
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}