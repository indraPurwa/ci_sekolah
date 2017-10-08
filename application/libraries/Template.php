<?php defined("BASEPATH") or exit("Tidak bisa akses langsung");
class Template {
  protected $_ci;
  function __construct(){
    $this->_ci =& get_instance();
  }
  function display($page, $data){
    $d['_header'] = $this->_ci->load->view('header', $data, true);
    $d['_nav_menu'] = $this->_ci->load->view('nav_menu', $data, true);
    $d['_content'] = $this->_ci->load->view($page, $data, true);
    $d['_right_menu'] = $this->_ci->load->view('right_menu', $data, true);
    $d['_footer'] = $this->_ci->load->view('footer', $data, true);
    $this->_ci->load->view('template', $d);
  }
}
