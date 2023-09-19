<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model
{
    
    function regUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_reg_users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function checkRegUser($regId)
    {
        $this->db->select("regId");
        $this->db->from("tbl_reg_users");
        $this->db->where("regId", $regId);   
        $query = $this->db->get();

        return $query->result();
    }

    function regUserUpdate($userInfo, $regId)
    {
        $this->db->where('regId', $regId);
        $this->db->update('tbl_reg_users', $userInfo);
        
        return TRUE;
    }


    function regFamily($familyInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_reg_family', $familyInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function getFamilyList($regId)
    {
        $this->db->select('f_id, regId, f_name, f_icno, f_pertalian');
        $this->db->from('tbl_reg_family');
        $this->db->where('regId', $regId);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getUserInfo($regId)
    {
        $this->db->select('r_id, regId, email, name, phone,icno, address, roleId, surau, pakej, ahli_khairat, regDate');
        $this->db->from('tbl_reg_users');
        $this->db->where('regId', $regId);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getRegRoleId($regId,$column,$table)
    {
        $this->db->select($column);
        $this->db->from($table);
        $this->db->where('regId', $regId);
        return $this->db->get()->row()->$column;
    }

    function getRegById($id)
    {
        $this->db->where('regId', $id);
        return $this->db->get('tbl_reg_users')->row();
    }


    function delFamilyList($id)
    {
        $this->db->where('f_id', $id);
        $this->db->delete('tbl_reg_family');

         return $this->db->affected_rows();
    }

    function delRegRecord($regId,$table)
    {
        $this->db->where('regId', $regId);
        $this->db->delete($table);

         return $this->db->affected_rows();
    }

}

?>