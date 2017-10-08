<?php defined('BASEPATH') or exit("Tidak bisa mengakses langsung");
/**
 *
 */
class Admin extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library(array('access', 'template_admin', 'form_validation'));
    $this->load->helper('url');
  }
  function index($aksi = ""){
    if($aksi == "login") {
      $this->login();
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }

  }
  function login(){
    $this->load->helper(array('form'));
    $this->form_validation->set_rules('username', 'username', 'trim|required|strip_tags');
    $this->form_validation->set_rules('password', 'password', 'trim|required');
    $this->form_validation->set_rules('token', 'token', 'callback_cek_login');
    if($this->form_validation->run() === FALSE){
      echo '<script>
              alert("Username dan Password salah");
              history.back();
            </script>';
    } else {
      redirect('admin/welcome');
    }
  }
  function logout(){
    $this->access->logout();
    redirect('home');
  }
  function cek_login(){
    $username = $this->input->post('username', TRUE);
    $password = $this->input->post('password', TRUE);

    $login = $this->access->login($username, $password);
    if($login){
      return TRUE;
    }
    else {
      $this->form_validation->set_message('check_login', 'USERNAME dan PASSWORD salah');
      return FALSE;
    }
  }
  function welcome(){
    $data['username'] = $this->access->is_login();
    echo $this->access->is_login();
    // $this->template_admin->display('welcome', $data);
  }
}
