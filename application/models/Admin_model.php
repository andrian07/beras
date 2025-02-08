<?php

class admin_model extends CI_Model {


    public function get_admin_by_username($username, $password){
        $query = $this->db->query("select * from tbl_admin where admin_username = '".$username."' and admin_password = '".$password."' and admin_status = 1");
        $result = $query->result();
        return $result;
    }

    public function check_branch($user_id, $branchtype){
    	 $query = $this->db->query("select * from tbl_admin where admin_username = '".$username."' and admin_password = '".$password."' and admin_status = 1");
        $result = $query->result();
        return $result;
    }

    
}

?>