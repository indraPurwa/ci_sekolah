<?php defined("BASEPATH") or exit("Tidak bisa akses langsung");
class template_admin {
  protected $_ci;
  function __construct(){
    $this->_ci =& get_instance();
  }
  function display($page, $data){
    $d['_content'] = $this->_ci->load->view($page, $data, true);
    $this->_ci->load->view('tmpt_admin', $d);
  }
}
