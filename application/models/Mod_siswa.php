<?php if(!defined("BASEPATH")) exit("Tidak bisa akses langsung");

Class Mod_siswa extends CI_Model {
  private $primary_key = 'nisn';
  private $table_name = 'siswa';
  function __construct(){
    parent::__construct();
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
  function save($person){
    return $this->db->insert($this->table_name, $person);
  }
  function update($id, $person) {
    $this->db->where($this->primary_key, $id);
    return $this->db->update($this->table_name, $person);
  }
  function delete($id){
    $this->db->where($this->primary_key, $id);
    return $this->db->delete($this->table_name);
  }
  function get_siswa($limit, $offset, $order_type) {
    $where = "year(now())- year(tgl_masuk) < 3";
    $this->db->where($where);
    $this->db->order_by($this->primary_key, 'DESC');
    return $this->db->get($this->table_name, $limit, $offset);
  }
  function count_siswa(){
    $where = "year(now())- year(tgl_masuk) < 3";
    $this->db->where($where);
    $this->db->from($this->table_name);
    return $this->db->count_all_results();
  }
  function get_alumni($limit, $offset, $order_type) {
    $where = "year(now()) - year(tgl_masuk) >= 3";
    $this->db->where($where);
    $this->db->order_by($this->primary_key, 'DESC');
    return $this->db->get($this->table_name, $limit, $offset);
  }
  function count_alumni(){
    $where = "year(now()) - year(tgl_masuk) >= 3";
    $this->db->where($where);
    $this->db->from($this->table_name);
    return $this->db->count_all_results();
  }
}
