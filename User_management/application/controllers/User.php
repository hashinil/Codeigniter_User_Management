<?php
class User extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('user_model');
    $this->load->helper('url_helper');
    $this->load->library('session');
    
    $this->load->helper('form');
    $this->load->library('form_validation');
  }

  public function user_login($username,$password) {
		$CI =& get_instance();
		$CI->load->library('session');
	
		$sess_data=array(
		  'username'=>$username,
		  'password'=>$password
		);

		$CI->session->set_userdata('logged_in',$sess_data);
	}

  public function user_logout($username,$password) {
		$CI =& get_instance();
		$CI->load->library('session');
	
		$CI->session->unset_userdata('logged_in');
		$CI->session->sess_destroy();
		redirect('login', 'refresh');
	}

  public function this_user_name(){
		$CI =& get_instance();
		
		$session_data= $CI->session->userdata('logged_in');
		if($CI->user_model->is_user_exist($session_data['username'])){
		 	return $session_data['username'];
		} else {
		  show_404();
		}
	}

  public function welcome() {
      if($this->session->userdata('logged_in')){
        $username=$this->this_user_name();
        $data['title'] = 'Hello '.$username;
        $data['user_group'] = $this->user_model->is_user_admin($username);
        $this->load->view('templates/header', $data);
        $this->load->view('user/welcome');
        $this->load->view('templates/footer');
      } else {
        redirect('login','refresh');
      }
  }

  public function logout() {
    $data['title'] = ''; 
    $data['msg'] = '';

    $this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
    $this->load->view('templates/header');
    $this->load->view('admin/login', $data);
    $this->load->view('templates/footer');
  }

  public function login() {
    $data['title'] = ''; 
    $data['msg'] = '';
        
    if(isset($this->session->userdata['logged_in'])) {
        $username=$this->this_user_name();
        $data['title'] = 'Hello '.$username;
        $data['user_group'] = $this->user_model->is_user_admin($username);

      $this->load->view('templates/header', $data);
      $this->load->view('user/welcome');
      $this->load->view('templates/footer');
    } else {
      $this->form_validation->set_rules('useremail', 'Username', 'trim|required');
      $this->form_validation->set_rules('userpw', 'Password', 'trim|required');

      if ($this->form_validation->run() === FALSE) {
        $this->load->view('templates/header');
        $this->load->view('admin/login', $data);
        $this->load->view('templates/footer');
      } else {
        $data['username'] = $username = $this->input->post('useremail');
        $data['password'] = $password = $this->input->post('userpw');
        
        if($this->user_model->is_user_exist($username)){ 
          if($this->user_model->is_user_active($username)){

            $user_password=$this->user_model->get_password_by_username($username);
						$form_password=md5($password);

            if($user_password == $form_password){
              $this->user_login($username,$password);

              $data['user_group'] = $this->user_model->is_user_admin($username);

              $data['title'] = 'Hello '.$username=$this->this_user_name();
              //$data['user_list'] = $this->user_model->get_users();
              $this->load->view('templates/header', $data);
              $this->load->view('user/welcome');
              $this->load->view('templates/footer');
            } else {
              $data['msg'] = 'Password not matching.';
              $this->load->view('templates/header', $data);
              $this->load->view('admin/login');
              $this->load->view('templates/footer');
            }
          } else {
            $data['msg'] = 'Deactivated Login.';
            $this->load->view('templates/header', $data);
              $this->load->view('admin/login');
              $this->load->view('templates/footer');
          }
        } else {
          $data['msg'] = 'User does not exist.';
          $this->load->view('templates/header', $data);
              $this->load->view('admin/login');
              $this->load->view('templates/footer');
        }
      } 
    }
  }

  public function create() {
    $data['title'] = ''; 
    $data['msg'] = '';
      
    $this->load->helper('form');
    $this->load->library('form_validation');
    if(isset($this->session->userdata['logged_in'])) {  
      $data['title'] = 'Add User';

      $username=$this->this_user_name();
      $data['user_group'] = $this->user_model->is_user_admin($username);
      

      if(isset($_POST['submit'])){  
        $this->form_validation->set_rules('username', 'UserName', 'trim|required');
        $this->form_validation->set_rules('userpw', 'Password', 'trim|required');
        $this->form_validation->set_rules('ugRadios', 'User Group', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = 'Enter Valid Details';
            $data['usergroups'] = $this->user_model->get_user_groups();

            $this->load->view('templates/header', $data);
            $this->load->view('user/add_user');
            $this->load->view('templates/footer');
        } else {
          $username = $this->input->post('username');
          $usergroup = $this->input->post('ugRadios');
          if(!$this->user_model->is_user_exist($username)){ 
            $data = array(
              'user_name' => $username,
              'user_email' => $username,
              'user_group_id' => $usergroup,
              'user_password' => md5($this->input->post('userpw'))
            );
            
            $this->user_model->add_user($data);
              
            $data['title'] = 'Users'; 
            $data['user_list'] = $this->user_model->get_users();
            $user_name=$this->this_user_name();
            $data['user_group'] = $this->user_model->is_user_admin($user_name);
            $this->load->view('templates/header', $data);
            $this->load->view('user/user_list');
            $this->load->view('templates/footer');
          } else {
            $msg = 'Username already exist';
            if($this->user_model->is_user_active($username)){
              $msg .= ' and Active User';
            } else {
              $msg .= ' and inactive User';
            }
            $data['msg'] = $msg;
            $data['usergroups'] = $this->user_model->get_user_groups();

            $this->load->view('templates/header', $data);
            $this->load->view('user/add_user');
            $this->load->view('templates/footer');
          }
        }
      } else {

        $data['usergroups'] = $this->user_model->get_user_groups();

        $this->load->view('templates/header', $data);
        $this->load->view('user/add_user');
        $this->load->view('templates/footer');
      }
    } else {
      $this->load->view('templates/header', $data);
      $this->load->view('admin/login');
      $this->load->view('templates/footer');
    }
  }

  public function create_user_group() {
    $data['title'] = ''; 
    $data['msg'] = '';
        
    $this->load->helper('form');
    $this->load->library('form_validation');
    if(isset($this->session->userdata['logged_in'])) {  

      $username=$this->this_user_name();
      $data['user_group'] = $this->user_model->is_user_admin($username);

      $data['title'] = 'Add User Group';
      if(isset($_POST['submit'])){  
        $this->form_validation->set_rules('usergroupname', 'User Group', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = 'Enter Valid Details';
            $this->load->view('templates/header', $data);
            $this->load->view('user/add_usergroup');
            $this->load->view('templates/footer');
        } else {
          $usergroupname = $this->input->post('usergroupname');
          if(!$this->user_model->is_usergroup_exist($usergroupname)){ 
            $data = array(
              'ug_name' => $usergroupname
            );
            
            $this->user_model->add_user_group($data);
              
            $data['title'] = 'User Group'; 
            $data['usergroup_list'] = $this->user_model->get_user_groups();
            $username=$this->this_user_name();
            $data['user_group'] = $this->user_model->is_user_admin($username);
            $this->load->view('templates/header', $data);
            $this->load->view('user/usergroup_list');
            $this->load->view('templates/footer');
          } else {
            $msg = 'User group already exist';
            if($this->user_model->is_usergroup_active($usergroupname)){
              $msg .= ' and Active User Group';
            } else {
              $msg .= ' and inactive User Group';
            }
            $data['msg'] = $msg;
            $this->load->view('templates/header', $data);
            $this->load->view('user/add_usergroup');
            $this->load->view('templates/footer');
          }
        }
      } else {
        $this->load->view('templates/header', $data);
        $this->load->view('user/add_usergroup');
        $this->load->view('templates/footer');
      }

    } else {
      $this->load->view('templates/header', $data);
                $this->load->view('admin/login');
                $this->load->view('templates/footer');
    }
  }

  public function user_list(){
    if(isset($this->session->userdata['logged_in'])) { 
      $username=$this->this_user_name();
      $data['user_group'] = $this->user_model->is_user_admin($username);

      $data['title'] = 'Users'; 
    
      $data['user_list'] = $this->user_model->get_users();
      $this->load->view('templates/header', $data);
      $this->load->view('user/user_list');
      $this->load->view('templates/footer');
    } else {
      $this->load->view('templates/header', $data);
      $this->load->view('admin/login');
      $this->load->view('templates/footer');
    }
  }

  public function usergroup_list() {
    if(isset($this->session->userdata['logged_in'])) {  
      $username=$this->this_user_name();
      $data['user_group'] = $this->user_model->is_user_admin($username);

      $data['title'] = 'User Groups'; 
      $data['usergroup_list'] = $this->user_model->get_user_groups();
      $this->load->view('templates/header', $data);
      $this->load->view('user/usergroup_list');
      $this->load->view('templates/footer');
    } else {
      $this->load->view('templates/header', $data);
      $this->load->view('admin/login');
       $this->load->view('templates/footer');
    }
  }

  public function delete_user(){
    $user_id = $this->input->post('user_id');
    $this->user_model->delete_user($user_id);
    
    echo json_encode(1);
  }

  
  public function delete_user_group(){
    $ug_id = $this->input->post('ug_id');

    $assigned = $this->user_model->is_usergroup_assigned($ug_id);
    if($assigned == 1){
      echo json_encode(0);  
    } else {
      $this->user_model->delete_user_group($ug_id);
      echo json_encode(1);
    }
    
  }

  public function edit_user_($user_id){
    if(isset($this->session->userdata['logged_in'])) { 
      $username=$this->this_user_name();
      $data['user_group'] = $this->user_model->is_user_admin($username);
    
      $data['title'] = 'Edit User'; 
      $data['user_data'] = $this->user_model->get_users($user_id);
      $data['usergroups'] = $this->user_model->get_user_groups();

      $this->load->view('templates/header', $data);
      $this->load->view('user/edit_user');
      $this->load->view('templates/footer');
    } else {
      $this->load->view('templates/header', $data);
      $this->load->view('admin/login');
      $this->load->view('templates/footer');
    }
  }
  
  public function edit_user($user_id) {
    $data['title'] = ''; 
    $data['msg'] = '';
        
    $this->load->helper('form');
    $this->load->library('form_validation');
    if(isset($this->session->userdata['logged_in'])) {
      $data['title'] = 'Edit User';

      $data['user_data'] = $this->user_model->get_users($user_id);
      $data['usergroups'] = $this->user_model->get_user_groups();

      $username=$this->this_user_name();
      $data['user_group'] = $this->user_model->is_user_admin($username);


      if(isset($_POST['submit'])){  
        $this->form_validation->set_rules('ugRadios', 'User Group', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = 'Enter Valid Details';
            $data['usergroups'] = $this->user_model->get_user_groups();

            $this->load->view('templates/header', $data);
            $this->load->view('user/edit_user');
            $this->load->view('templates/footer');
        } else {
          $usergroup = $this->input->post('ugRadios');
          $this->user_model->update_user($usergroup, $user_id);
            
          $data['title'] = 'Users'; 
          $data['user_list'] = $this->user_model->get_users();
          $this->load->view('templates/header', $data);
          $this->load->view('user/user_list');
          $this->load->view('templates/footer');
        }
      } else {
        $this->load->view('templates/header', $data);
        $this->load->view('user/edit_user');
        $this->load->view('templates/footer');
      }
    } else {
      $this->load->view('templates/header', $data);
                $this->load->view('admin/login');
                $this->load->view('templates/footer');
    }
  }
}