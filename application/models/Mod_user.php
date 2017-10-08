<?php if(!defined("BASEPATH")) exit("Tidak dapat mengakses langsung");
Class Mod_user extends CI_Model {
  protected $primary_key = "nama";
  protected $table_name = 'pengguna';
  function __construct(){
    parent::__construct();
    $this->load->library('encryption');
  }
  function get_paged_list($limit, $offset, $order_type) {
    if(empty($order_type)) $this->db->order_by($this->primary_key, 'asc');
    else $this->db->order_by($this->primary_key, $order_type);
    return $this->db->get($this->table_name, $limit, $offset);
  }
  function count_all(){
    return $this->db->count_all($this->table_name);
  }
  function get_by_id($id){
    $this->db->where($this->primary_key, $id);
    return $this->db->get($this->table_name);
  }
  function save($user){
    $this->db->insert($this->table_name, $user);
    return $this->db->insert_id();
  }
  function update($id, $user){
    $this->db->where($this->primary_key, $id);
    return $this->db->update($this->table_name, $user);
  }
  function delete($id){
    $this->db->where($this->primary_key, $id);
    return $this->db->delete($this->table_name);
  }
  function get_login_info($username, $password){
    $this->db->where('username', $username);
    $pengguna = $this->db->get($this->table_name, 1)->row();
    if(isset($pengguna)) {
      $pwd_dec = $this->encryption->decrypt($pengguna->password);
      if($password == $pwd_dec){
        return $pengguna;
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  }
}
