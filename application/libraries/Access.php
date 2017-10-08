<?php defined("BASEPATH") or exit("Tidak bisa akses langsung");
class Access {
   function __construct(){
     $this->_ci =& get_instance();
     $auth = $this->_ci->config->item('auth');
     $this->_ci->load->helper('cookie');
     $this->_ci->load->model('Mod_user', '', true);
     $this->_ci->load->library('session');

     $this->Mod_user = $this->_ci->Mod_user;
     $this->session = $this->_ci->session;
   }

   function login($username, $password) {
     $user = $this->Mod_user->get_login_info($username, $password);
     if($user){
       $this->session->set_userdata('username', $user->username);
       return TRUE;
     } else {
       return FALSE;
     }
   }

   function is_login(){
     return ($this->session->userdata('username')) ? $this->session->userdata('username') : NULL;
   }
   function logout(){
     $this->session->unset_userdata('username');
   }
 }
