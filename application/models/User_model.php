<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

    public $tble = 'tbl_users';
    public $tble_family = 'tbl_users_family';
    public $uid = 'userId';
    public $fid = 'f_id';
    public $order = 'ASC';

    // get all
    function get_all_export()
    {
        $this->db->order_by($this->uid, $this->order);
        return $this->db->get($this->tble)->result();
    }

    // get all Ahli 
    function export_Ahli()
    {
        $this->db->where('userId !=',0);
        $this->db->order_by($this->uid, $this->order);
        return $this->db->get($this->tble)->result();
    }

    // get all Tanggungan 
    function export_Tanggungan($userId)
    {
        $this->db->where('userid',$userId);
        $this->db->order_by($this->fid, $this->order);
        return $this->db->get($this->tble_family)->result();
    }
    
    function userListingCount($searchText = '',$surauid = '',$ahli_khairat = '')
    {
        $this->db->select('BaseTbl.userId,  BaseTbl.noAhli, BaseTbl.email, BaseTbl.name, BaseTbl.phone, BaseTbl.address, Role.role, BaseTbl.status, BaseTbl.pakej, BaseTbl.surau, BaseTbl.ahli_khairat');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        $this->db->join('surau as Sr', 'Sr.id = BaseTbl.surau','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.noAhli  LIKE '%".$searchText."%'
                            OR  BaseTbl.address  LIKE '%".$searchText."%'
                            OR  BaseTbl.icno  LIKE '%".$searchText."%'
                            OR  BaseTbl.pakej  LIKE '%".$searchText."%'
                            OR  Role.role  LIKE '%".$searchText."%'
                            OR  Sr.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', "Aktif");
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->where('BaseTbl.userId !=',0);
        if (!empty($surauid)){
            $this->db->where('BaseTbl.surau',$surauid);
        }

        if ($ahli_khairat == "Y"){
            $this->db->where('BaseTbl.ahli_khairat',$ahli_khairat);
        }

        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function userListingCount_inactive($searchText = '')
    {
        $this->db->select('BaseTbl.userId,  BaseTbl.noAhli, BaseTbl.email, BaseTbl.name, BaseTbl.phone, BaseTbl.address, BaseTbl.status, BaseTbl.pakej, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        $this->db->join('surau as Sr', 'Sr.id = BaseTbl.surau','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.noAhli  LIKE '%".$searchText."%'
                            OR  BaseTbl.icno  LIKE '%".$searchText."%'
                            OR  BaseTbl.pakej  LIKE '%".$searchText."%'
                            OR  Role.role  LIKE '%".$searchText."%'
                            OR  Sr.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', "Tidak Aktif");
        $this->db->where('BaseTbl.userId !=',0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function userKhairatCount($searchText = '')
    {
        $this->db->select('BaseTbl.userId,  BaseTbl.noAhli, BaseTbl.email, BaseTbl.name, BaseTbl.phone, BaseTbl.address, Role.role, BaseTbl.status, BaseTbl.pakej, BaseTbl.ahli_khairat');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        $this->db->join('surau as Sr', 'Sr.id = BaseTbl.surau','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.noAhli  LIKE '%".$searchText."%'
                            OR  BaseTbl.address  LIKE '%".$searchText."%'
                            OR  BaseTbl.icno  LIKE '%".$searchText."%'
                            OR  BaseTbl.pakej  LIKE '%".$searchText."%'
                            OR  Role.role  LIKE '%".$searchText."%'
                            OR  Sr.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', "Aktif");
        $this->db->where('BaseTbl.ahli_khairat', "Y");
        $this->db->where('BaseTbl.userId !=',0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function userKhairatCount_inactive($searchText = '')
    {
        $this->db->select('BaseTbl.userId,  BaseTbl.noAhli, BaseTbl.email, BaseTbl.name, BaseTbl.phone, BaseTbl.address, BaseTbl.status, BaseTbl.pakej, Role.role, BaseTbl.ahli_khairat');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        $this->db->join('surau as Sr', 'Sr.id = BaseTbl.surau','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.noAhli  LIKE '%".$searchText."%'
                            OR  BaseTbl.icno  LIKE '%".$searchText."%'
                            OR  BaseTbl.pakej  LIKE '%".$searchText."%'
                            OR  Role.role  LIKE '%".$searchText."%'
                            OR  Sr.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', "Tidak Aktif");
        $this->db->where('BaseTbl.userId !=',0);
        $this->db->where('BaseTbl.ahli_khairat', "Y");
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function familyListing($searchText = '', $page, $segment)
    {
        $this->db->select('Base.f_id, Base.userid,  Base.f_name, Base.f_icno, Base.f_phone, Base.f_pertalian, , Base.createDtm, Base.deathStatus, Base.deathDtm, Base.approval, Sub.userId, Sub.isDeleted, Sub.name');
        $this->db->from('tbl_users_family as Base');
        $this->db->join('tbl_users as Sub', 'Base.userid = Sub.userId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(Base.f_name  LIKE '%".$searchText."%'
                            OR  Base.f_icno  LIKE '%".$searchText."%'
                            OR  Base.f_phone  LIKE '%".$searchText."%'
                            OR  Sub.userId  LIKE '%".$searchText."%'
                            OR  Sub.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('Base.userid !=',0);
        $this->db->where('Sub.isDeleted', 0);
        //$this->db->where('Base.approval','N');
        $this->db->order_by('Base.approval','DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    function familyListingCount($searchText = '')
    {
        $this->db->select('Base.f_id, Base.userid,  Base.f_name, Base.f_icno, Base.f_phone, Base.f_pertalian, , Base.createDtm, Base.deathStatus, Base.deathDtm, Base.approval, Sub.userId, Sub.isDeleted, Sub.name');
        $this->db->from('tbl_users_family as Base');
        $this->db->join('tbl_users as Sub', 'Base.userid = Sub.userId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(Base.f_name  LIKE '%".$searchText."%'
                            OR  Base.f_icno  LIKE '%".$searchText."%'
                            OR  Base.f_phone  LIKE '%".$searchText."%'
                            OR  Sub.userId  LIKE '%".$searchText."%'
                            OR  Sub.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('Base.userid !=',0);
        $this->db->where('Sub.isDeleted', 0);
        //$this->db->where('Base.approval','DESC');
        //$this->db->order_by('Base.approval','ASC');
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    

    function get_total_members(){

        $this->db->select('*');
        $this->db->from('tbl_users');
        //$this->db->where("status",'Selesai');
        //$result = $this->db->get('payment')->row();  
        //return $result->amaun; 

        //$this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('status','Aktif'); //hanya yang aktif sahaja
        $this->db->where('userId !=', 0); //administrator
        $query = $this->db->get();
        
        return $query->num_rows(); //tolak 1(admin)
    }

    function get_total_tanggungan(){

        $this->db->select('*');
        $this->db->from('tbl_users_family');

        //$this->db->where('status','Aktif'); //hanya yang aktif sahaja
        //$this->db->where('userId !=', 0); //administrator
        $query = $this->db->get();
        
        return $query->num_rows(); //tolak 1(admin)
    }
    

    function userSearch($name) {
        //$this->db->select('userId,name');
        //$this->db->from('tbl_users');
        //$this->db->like('name', $name);
        //return $this->db->get()->result();

        $this->db->select('userId,name,noAhli'); 
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 'Aktif');
        //$this->db->where('roleId !=', 1);
         $this->db->where('userId !=', 0);
        $this->db->where('icno', $name);
        //$this->db->like('name', $name);
        $this->db->order_by('name','ASC');
        $query = $this->db->get();
        return $query->result();
    }

     function userSearchCount($name) {
        //$this->db->select('userId,name');
        //$this->db->from('tbl_users');
        //$this->db->like('name', $name);
        //return $this->db->get()->result();

        $this->db->select('userId,name,noAhli'); 
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 'Aktif');
        //$this->db->where('roleId !=', 1);
        $this->db->where('userId !=', 0);
        $this->db->where('icno', $name);
        //$this->db->like('name', $name);
        $this->db->order_by('name','ASC');
        $query = $this->db->get();
        return $query->num_rows();
        //return $query->result();
    }

    function familySearch($name) {
        $this->db->select('a.userid, a.f_name, a.f_icno, a.f_pertalian, b.userId, b.name, b.noAhli'); 
        $this->db->from('tbl_users_family as a');
        $this->db->join('tbl_users as b', 'a.userid = b.userId','left');
        $this->db->where('f_icno', $name);
        $this->db->order_by('f_name','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function familySearchCount($name) {
        $this->db->select('userid,f_id,f_name,f_icno,f_pertalian'); 
        $this->db->from('tbl_users_family');
        $this->db->where('f_icno', $name);
        $this->db->order_by('f_name','ASC');
        $query = $this->db->get();
        return $query->num_rows();
    }


    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing($searchText = '', $surauid = '', $ahli_khairat = '', $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.noAhli, BaseTbl.email, BaseTbl.name, BaseTbl.phone, BaseTbl.icno, BaseTbl.address, Role.role, BaseTbl.status, BaseTbl.pakej, BaseTbl.surau, BaseTbl.ahli_khairat, Sr.name SurauName');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        $this->db->join('surau as Sr', 'Sr.id = BaseTbl.surau','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.noAhli  LIKE '%".$searchText."%'
                            OR  BaseTbl.address  LIKE '%".$searchText."%'
                            OR  BaseTbl.icno  LIKE '%".$searchText."%'
                            OR  BaseTbl.pakej  LIKE '%".$searchText."%'
                            OR  Role.role  LIKE '%".$searchText."%'
                            OR  Sr.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', "Aktif");
        //$this->db->where('BaseTbl.roleId !=', 1);
        
        $this->db->where('BaseTbl.userId !=',0);
        if (!empty($surauid)){
            $this->db->where('Sr.id',$surauid);
        }

        if ($ahli_khairat == "Y"){
            $this->db->where('BaseTbl.ahli_khairat',$ahli_khairat);
        }

        $this->db->order_by('BaseTbl.noAhli','ASC');

        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function userListing_inactive($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.noAhli, BaseTbl.email, BaseTbl.name, BaseTbl.phone, BaseTbl.address, BaseTbl.icno, BaseTbl.status, BaseTbl.catatan, Role.role, BaseTbl.pakej, Sr.name SurauName');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        $this->db->join('surau as Sr', 'Sr.id = BaseTbl.surau','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.noAhli  LIKE '%".$searchText."%'
                            OR  BaseTbl.icno  LIKE '%".$searchText."%'
                            OR  BaseTbl.pakej  LIKE '%".$searchText."%'
                            OR  Role.role  LIKE '%".$searchText."%'
                            OR  Sr.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.catatan  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', "Tidak Aktif");
        //$this->db->order_by('createdDtm','DESC');
        $this->db->where('BaseTbl.userId !=',0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    


    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRolesRegister()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 0); //Superadmin
        $this->db->where('roleId !=', 1); //Pentadbir Sistem
        $this->db->where('roleId !=', 3); //Ahli Asnaf
        $query = $this->db->get();
        
        return $query->result();
    }

    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 0); //administrator
        //$this->db->where('roleId !=', 1); //pentadbir sistem
        $query = $this->db->get();
        
        return $query->result();
    }

    function getUserRolesSuperAdmin()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        //$this->db->where('roleId !=', 0); //administrator
        //$this->db->where('roleId !=', 1); //pentadbir sistem
        $query = $this->db->get();
        
        return $query->result();
    }

    function getRoleId($userid,$column,$table)
    {
        $this->db->select($column);
        $this->db->from($table);
        $this->db->where('userId', $userid);
        return $this->db->get()->row()->$column;
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserList()
    {
        $this->db->select('userId, noAhli, name, phone, email, icno, address');
        $this->db->from('tbl_users');
        //$this->db->where('roleId !=', 0);
        $this->db->where('userId !=', 0);
        $this->db->order_by('name','ASC');
        $query = $this->db->get();
        
        return $query->result();
    }

    function getAdminList()
    {
        $this->db->select('userId, noAhli, name, phone, email, icno, address');
        $this->db->from('tbl_users');
        //$this->db->where('roleId !=', 0);
        $this->db->where('userId', 0);
        $this->db->order_by('name','ASC');
        $query = $this->db->get();
        
        return $query->result();
    }

    function getUserListApply()
    {
        $this->db->select('userId, name, icno, phone, email, regdate, surau, pakej, ahli_khairat, roleId');
        $this->db->from('tbl_apply_users');
        $this->db->where('status=', 'Aktif');
        $this->db->where('isDeleted =', 0);
        $this->db->order_by('regdate','ASC');
        $query = $this->db->get();
        
        return $query->result();
    }
     /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserActive()
    {
        $this->db->select('userId, name, status, icno, roleId, pakej, ahli_khairat');
        $this->db->from('tbl_users');
        $this->db->where('status=', 'Aktif');
        $this->db->where('userId !=', 0); //superadmin excluded
        $this->db->where('roleId !=', 4); //ahli seumur hidup tak perlu generate yuran
        $this->db->where('isDeleted !=', 1); //ahli yang telah delete tak perlu generate yuran
        $this->db->order_by('userId');
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : // tahun dipilih dan tahun sebelum
     */
    function getUserActiveSelectedYear($year)
    {
        $this->db->select('userId, name, status, YEAR(regdate) as year');
        $this->db->from('tbl_users');
        $this->db->where('status=', 'Aktif');
        $this->db->where('YEAR(regdate) <=', $year); // tahun dipilih dan tahun sebelum
        $this->db->order_by('userId');
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : // tahun dipilih sahaja
     */
    function getUserActiveByYear($year)
    {
        $this->db->select('userId, name, status, YEAR(regdate) as year');
        $this->db->from('tbl_users');
        $this->db->where('status=', 'Aktif');
        $this->db->where('YEAR(regdate)', $year); // tahun dipilih sahaja
        $this->db->order_by('userId');
        $query = $this->db->get();
        
        return $query->result();
    }


    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function checkIcExisted($noic, $userId = 0)
    {
        $this->db->select("userId");
        $this->db->from("tbl_users");
        $this->db->where("icno", $noic);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function checkIcExisted_family($icno)
    {
        $this->db->select("REPLACE(f_icno,' ','')");
        $this->db->from("tbl_users_family");
        $this->db->where("f_icno", $icno);   
        $query = $this->db->get();
        return $query->result();
        
        //$result = $this->db->get('tbl_users_family')->row();
        //return $result->f_icno; 
    }


     function get_id_by_year($year)
    {
        $this->db->select('yid');
        $this->db->where("y_tahun", $year);
        $result = $this->db->get('tbl_kadar_yuran')->row();  
        return $result->yid;
    }


    /*function checkNewApprovedMembers($userId)
    {
        $this->db->select("f_id");
        $this->db->from("tbl_users");
        $this->db->where("userId", $userId);   
        $this->db->where("approval", "Y");
        $this->db->where("userId NOT IN payment_details");
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }*/

    function checkIdExisted($userId,$table)
    {
        $this->db->select("userid");
        $this->db->from($table);
        $this->db->where("userid", $userId);
        $query = $this->db->get();

        return $query->result();
    }

    function checkIcApplyExisted($noic, $userId = 0)
    {
        $this->db->select("userId");
        $this->db->from("tbl_apply_users");
        $this->db->where("icno", $noic);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }

    function getLatestPayment()
    {
        $this->db->select_max('p_id');
        $this->db->from('payment');
        $query = $this->db->get();
     
         if ($query->num_rows() == 1) {
            return $query->row('p_id');
          } else {
            return 0;
          }  

    }
    
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->set('createdDtm', 'NOW()', FALSE);
        $this->db->insert('tbl_users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function addUserApply($userInfo)
    {
        $this->db->trans_start();
        $this->db->set('createdDtm', 'NOW()', FALSE);
        $this->db->insert('tbl_apply_users', $userInfo);

        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function addFamilyApply($familyInfo)
    {
        $this->db->trans_start();
        $this->db->set('createDtm', 'NOW()', FALSE);
        $this->db->insert('tbl_apply_family', $familyInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


    function getLatestMember()
    {
        $this->db->select_max('userId');
        $this->db->from('tbl_users');
        $query = $this->db->get();
     
         if ($query->num_rows() == 1) {
            return $query->row('userId');
          } else {
            return 0;
          }  

    }

    function getLatestFamilyMember()
    {
        $this->db->select_max('f_id');
        $this->db->from('tbl_users_family');
        $query = $this->db->get();
     
         if ($query->num_rows() == 1) {
            return $query->row('f_id');
          } else {
            return 0;
          }  

    }

    function getLatestMemberApply()
    {
        $this->db->select_max('userId');
        $this->db->from('tbl_apply_users');
        $query = $this->db->get();
     
         if ($query->num_rows() == 1) {
            return $query->row('userId');
          } else {
            return 0;
          }  

    }

    

    function get_total_members_apply(){

        $this->db->select('*');
        $this->db->from('tbl_apply_users');
        //$this->db->where("status",'Selesai');
        //$result = $this->db->get('payment')->row();  
        //return $result->amaun; 

        //$this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('status','Aktif'); //hanya yang aktif sahaja
        $this->db->where('isDeleted =', 0); 
        $query = $this->db->get();
        
        return $query->num_rows(); //tolak 1(admin)
    }


    ///SELECT MAX(id) FROM TABLE
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('userId, noAhli, name, email, phone, icno, address, regdate, status, pakej, catatan, roleId, surau, ahli_khairat');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getUserAddress($userId)
    {

        $this->db->select('Us.address, Us.name, Us.surau, Us.ahli_khairat, Sr.id, Sr.name as namaLorong, Sr.Desc as namaTaman');
        $this->db->from('tbl_users as Us');
        $this->db->join('surau as Sr', 'Sr.id = Us.surau','left');
        $this->db->where('Us.userId', $userId);
        $query = $this->db->get();
        $result = $query->row();        
        return $result;

    }

    function getApplicantInfo($userId)
    {
        $this->db->select('userId, name, email, phone, icno, regdate, address, surau, pakej, ahli_khairat, status, catatan, roleId');
        $this->db->from('tbl_apply_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('roleId !=', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getApplicantInfoByIcno($icno)
    {
        $this->db->select('userId, name, email, phone, icno');
        $this->db->from('tbl_users');
        $this->db->where('icno', $icno);
        $query = $this->db->get();
        
        return $query->result();
    }


    function getApplicantFamily($userId)
    {
        $this->db->select('f_id, f_name, f_icno, f_pertalian, f_pasangan, createDtm, approval');
        $this->db->from('tbl_apply_family');
        $this->db->where('userid', $userId);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getFamilyRecords($userId)
    {
        $this->db->select('f_id, f_name, f_icno, f_pertalian, f_pasangan, createDtm, approval');
        $this->db->from('tbl_users_family');
        $this->db->where('userid', $userId);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }


    function getFamilyInfo($familyid)
    {
        $this->db->select('f_id, userid, f_name, f_icno, f_phone, f_jantina, f_pertalian, f_pasangan, createDtm, deathStatus, deathDtm, approval');
        $this->db->from('tbl_users_family');
        //$this->db->where('isDeleted', 0);
        //$this->db->where('roleId !=', 0);
        $this->db->where('f_id', $familyid);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getFamilyDetails($fid,$column)
    {
        $this->db->select($column);
        $this->db->from('tbl_users_family');
        $this->db->where('f_id', $fid);
        return $this->db->get()->row()->$column;
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return TRUE;
    }
    
    function addFamily($familyInfo)
    {
        $this->db->trans_start();
        $this->db->set('createDtm', 'NOW()', FALSE);
        $this->db->insert('tbl_users_family', $familyInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    

    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function deleteAllRecords($userId)
    {
        //Copy records to deleted files
        $this->db->query("INSERT INTO delete_tbl_users SELECT * FROM tbl_users WHERE userId = $userId");
        $this->db->query("INSERT INTO delete_tbl_users_family SELECT * FROM tbl_users_family WHERE userid = $userId");
        $this->db->query("INSERT INTO delete_tbl_users_doc SELECT * FROM tbl_users_doc WHERE userid = $userId");
        $this->db->query("INSERT INTO delete_payment SELECT * FROM payment WHERE userid = $userId");
        $this->db->query("INSERT INTO delete_payment_details SELECT * FROM payment_details WHERE userid = $userId");
        $this->db->query("INSERT INTO delete_khairat SELECT * FROM khairat WHERE userid = $userId");

        //delete all user records 
        $this->db->delete('khairat', array('userId' => $userId));
        $this->db->delete('tbl_users', array('userId' => $userId));
        $this->db->delete('tbl_users_family', array('userid' => $userId));
        $this->db->delete('tbl_users_doc', array('userid' => $userId));
        $this->db->delete('payment', array('userid' => $userId));
        $this->db->delete('payment_details', array('userid' => $userId));

         return $this->db->affected_rows();
    }

    function updateFamily($familyid, $familyInfo)
    {
        $this->db->where('f_id', $familyid);
        $this->db->update('tbl_users_family', $familyInfo);
        
        return $this->db->affected_rows();
    }

    function deleteFamily($id)
    {
        $this->db->where('f_id', $id);
        $this->db->delete('tbl_users_family');

         return $this->db->affected_rows();
    }


    function applicantReject($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_apply_users', $userInfo);
        
        return $this->db->affected_rows();
    }
    
    function applicantRejectFamily($userId, $familyInfo)
    {
        $this->db->where('userid', $userId);
        $this->db->update('tbl_apply_family', $familyInfo);
        
        return $this->db->affected_rows();
    }

    function applicantApprove($userId, $userInfo)
    {
        echo "approved @ user_model";
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     */
    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, phone, icno, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getFamilyList($userId)
    {
        $this->db->select('f_id, f_name, f_icno, f_jantina, f_phone, f_pertalian,f_pasangan, createDtm, deathStatus, deathDtm, approval');
        $this->db->from('tbl_users_family');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getFamilyListAlive($userId)
    {
        $this->db->select('f_id, f_name, f_icno, f_jantina, f_phone, f_pertalian,f_pasangan, createDtm, deathStatus, deathDtm, approval');
        $this->db->from('tbl_users_family');
        $this->db->where('userId', $userId);
        $this->db->where('deathStatus', 'N');
        $query = $this->db->get();
        
        return $query->result();
    }

    

     function getNewFamily()
    {
        $this->db->select('f_id, userid, approval');
        $this->db->from('tbl_users_family');
        $this->db->where('approval', "N");
        $query = $this->db->get();
        
        return $query->result();
    }

    function getFamilyCount($userId)
    {

        $this->db->select('*');
        $this->db->from('tbl_users_family');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        return $query->num_rows(); 
        
        return $query->result();
    }

     // Graf Report
    function getMonthlyReg()
    {
        $this->db->select('count(userId) as count, MONTHNAME(createdDtm) as month_name');
        $this->db->from('tbl_users');
        $this->db->where('YEAR(createdDtm)', date('Y'));


        $this->db->group_by(array('YEAR(createdDtm)','MONTH(createdDtm)'));
        $query = $this->db->get();
        return $query->result();
        /*
            $query =  $this->db->query("SELECT COUNT(id) as count,MONTHNAME(created_at) as month_name FROM users WHERE YEAR(created_at) = '" . date('Y') . "'
             GROUP BY YEAR(created_at),MONTH(created_at)"); 
            */
        //return $this->db->get($this->table)->result();
    }
    
     // Graf Report
    function getMonthlyReg2()
    {
        $this->db->select('COUNT(name) as regNumber, name as SurauName, namAhli as namaAhli');
        $this->db->from('registration_statistics');
        $this->db->order_by('regNumber');
        //$this->db->where('YEAR(createdDtm)', date('Y'));


        $this->db->group_by(array('name'));
        $query = $this->db->get();
        return $query->result();
        /*
            $query =  $this->db->query("SELECT COUNT(id) as count,MONTHNAME(created_at) as month_name FROM users WHERE YEAR(created_at) = '" . date('Y') . "'
             GROUP BY YEAR(created_at),MONTH(created_at)"); 
            */
        //return $this->db->get($this->table)->result();
    }

     /*
    Laporan ikut blok/surau/kariah
        CREATE VIEW registration_statistics
        AS
        SELECT  a.name namAhli,
                a.icno,
                b.name,
                b.desc
        FROM    tbl_users a
        INNER JOIN surau b
        ON a.surau = b.id
        WHERE a.userId != 0;
    */

    function is_icno_available($icno)  
      {  
            $this->db->where('icno', $icno); 
            $this->db->where('isDeleted', 0);  
           $query = $this->db->get("tbl_users");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }   
      } 

    function is_icno_family_available($icno)  
      {  
            $this->db->where('f_icno', $icno);  
           $query = $this->db->get("tbl_users_family");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }   
      } 

    //documents
    function insert_doc_getrowid($data)
    {
        $this->db->insert("tbl_users_doc", $data);
        $insertId = $this->db->insert_id();
        return  $insertId;
    }

    // update documents table
    function update_doc($id, $data)
    {
        $this->db->where('doc_id', $id);
        $this->db->set('createDtm', 'NOW()', FALSE);
        $this->db->update("tbl_users_doc", $data);
    }

    function getDocumentList($userId)
    {
        $this->db->select('doc_id, doc_title, attachment, createDtm');
        $this->db->from('tbl_users_doc');
        $this->db->where('userid', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getTagsList($userId)
    {
        $this->db->select('tut_id, tags_id, userid');
        $this->db->from('tbl_users_tags');
        $this->db->where('userid', $userId);
        $query = $this->db->get();
        
        return $query->result();

        /* $this->db->select('Us.address, Us.name, Us.surau, Us.ahli_khairat, Sr.id, Sr.name as namaLorong, Sr.Desc as namaTaman');
        $this->db->from('tbl_users as Us');
        $this->db->join('surau as Sr', 'Sr.id = Us.surau','left');
        $this->db->where('Us.userId', $userId);
        $query = $this->db->get();*/
    }

    function delete_doc($id)
    {
        $this->db->where('doc_id', $id);
        $this->db->delete('tbl_users_doc');

         return $this->db->affected_rows();
    }

    // get all
    function get_all_tags()
    {
        $this->db->order_by('id', $this->order);
        return $this->db->get('tags')->result();
    }

    function deleteUserTags($userId)
    {
        $this->db->where('userid', $userId);
        $this->db->delete('tbl_users_tags');

        return $this->db->affected_rows();
    }

    function addUserTags($tagsInfo)
    {
        $this->db->insert("tbl_users_tags", $tagsInfo);
        $insertId = $this->db->insert_id();
        return  $insertId;
    }

    function addUserTags2($tagsInfo)
    {
        $this->db->trans_start();
        //$this->db->set('createdDtm', 'NOW()', FALSE);
        $this->db->insert('tbl_users_tags', $tagsInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    //documents
    function insertInvoice($data)
    {
        $this->db->trans_start();
        $this->db->set('createDtm', 'NOW()', FALSE);
        $this->db->insert('account_payment', $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function getInvoiceList()
    {
        $this->db->select('*');
        $this->db->from('account_payment');
        //$this->db->where('userid', $userId);
        $this->db->order_by('acc_date', 'DESC');
        $query = $this->db->get();
        
        return $query->result();
    }

}

  