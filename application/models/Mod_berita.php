<?php if(!defined('BASEPATH')) exit("Tidak bisa mengakses langsung");

Class Mod_berita extends CI_Model {
  private $primary_key = 'id';
  private $table_name = 'berita';
  function __construct(){
    parent::__construct();
  }
  function get_paged_list($limit, $offset, $order_type = 'asc') {
    if(empty($order_type)) {
      $this->db->order_by($this->primary_key, 'asc');
    } else {
      $this->db->order_by($this->primary_key, $order_type);
    }
    return $this->db->get($this->table_name, $limit, $offset);
  }
  function count_all(){
    return $this->db->count_all($this->table_name);
  }
  function get_by_id($id) {
    $this->db->where($this->primary_key, $id);
    return $this->db->get($this->table_name);
  }
  function save($berita) {
    $this->db->insert($this->table_name, $berita);
    return $this->db->insert_id();
  }
  function update($id, $berita) {
    $this->db->where($this->primary_key, $id);
    return $this->db->update($this->table_name, $berita);
  }
  function delete($id) {
    $this->db->where($this->primary_key, $id);
    return $this->db->delete($this->table_name);
  }
}
