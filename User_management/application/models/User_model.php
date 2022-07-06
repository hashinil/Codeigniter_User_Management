<?php
class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function is_user_exist($username){
		$this->db->select('*'); 
        $this->db->where('user_name',$username); 
        $query = $this->db->get("in_user");
        //echo $this->db->last_query(); die();

        if($query -> num_rows()> 0){
			return true;
		}else{
			return false;
		}
	}
    
    public function is_usergroup_exist($usergroupname){
		$this->db->select('*'); 
        $this->db->where('ug_name',$usergroupname); 
        $query = $this->db->get("in_user_groups");
        //echo $this->db->last_query(); die();

        if($query -> num_rows()> 0){
			return true;
		}else{
			return false;
		}
	}

    public function is_user_active($username){
		$this->db->select('user_status');
		$this->db->where('user_name', $username);
		$query = $this->db->get('in_user');
		$query = $query->row_array(); 
        
		return $query['user_status'];
	}

    
    public function is_usergroup_active($usergroupname){
		$this->db->select('ug_status');
		$this->db->where('ug_name', $usergroupname);
		$query = $this->db->get('in_user_groups');
		$query = $query->row_array(); 
        
		return $query['ug_status'];
	}

    public function get_password_by_username($username){
		$this->db->select('user_password');
		$this->db->where('user_name', $username);
		$query = $this->db->get('in_user');
		$query = $query->row_array(); 
		return $query['user_password'];
	}

    public function get_users($userid = FALSE) {
        $this->db->select('u.*,ug.ug_name'); 
                $this->db->from('in_user u');
                $this->db->join('in_user_groups ug', 'u.user_group_id = ug.ug_id', 'left');
        if ($userid === FALSE) {
                $query = $this->db->get();
                return $query->result_array();
        }

        $this->db->where('u.user_id', $userid);
        $query = $this->db->get();
        
        return $query->row_array();
    }

    public function get_user_groups($groupid = FALSE) {
        if ($groupid === FALSE)
        {
                $query = $this->db->get('in_user_groups');
                return $query->result_array();
        }

        $query = $this->db->get_where('in_user_groups', array('ug_id' => $groupid));
        return $query->row_array();
    }

    public function delete_user($userid)  {
        $this->db->where('user_id', $userid);
        $this->db->delete('in_user');
        //echo $this->db->last_query(); die();
        return true;
    }

    
    public function delete_user_group($usergroupid) {
        $this->db->where('ug_id', $usergroupid);
        $this->db->delete('in_user_groups');
        //echo $this->db->last_query(); die();
        return true;
    }

    public function login_users($userdata) {
        $query = $this->db->get_where('in_user', array('user_email' => $useremailm, 'user_password' => $userpw));
        return $query->row_array();
    }

    
    public function add_user($data) {
        return $this->db->insert('in_user', $data);
    }

    public function add_user_group($data) {
        return $this->db->insert('in_user_groups', $data);
    }


    public function update_user($usergroup, $user_id){
        $this->db->where('user_id = '.$user_id);
        return $this->db->update('in_user', array('user_group_id'=>$usergroup));
    }

    public function is_usergroup_assigned($usergroupid){
        $this->db->select('*'); 
        $this->db->where('user_group_id',$usergroupid); 
        $query = $this->db->get("in_user");
        //echo $this->db->last_query(); die();

        if($query -> num_rows()> 0){
            return 1;
        }else{
            return 0;
        }
    }

    public function is_user_admin($username){
        $this->db->select('ug.ug_name'); 
        $this->db->from('in_user u');
        $this->db->join('in_user_groups ug', 'u.user_group_id = ug.ug_id');
        $this->db->where('u.user_name',$username); 
        $query = $this->db->get();
        $query = $query->row_array(); 
        //echo $this->db->last_query(); die();
        return $query['ug_name'];
    }


}