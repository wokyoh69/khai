<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Check_model extends CI_Model
{
    
    function addCheck($checkInfo)
    {
        $this->db->trans_start();
        $this->db->insert('log_check', $checkInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
}

?>