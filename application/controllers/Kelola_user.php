<?php defined('BASEPATH') or exit("Tidak bisa mengakses langsung");
class Kelola_user extends CI_Controller {
  private $login;
  function __construct(){
    parent::__construct();
    $this->load->library(array('template_admin', 'access'));
    $this->load->helper(array('url', 'form'));
    $this->login = $this->access->is_login();
  }
  function index(){
    if($this->login){
      $this->data_user();
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function data_user($offset = 0){
    if($this->login){
      $this->load->model('mod_user', '', TRUE);
      $this->load->library(array('table', 'pagination'));
      $limit = 10;
      if(empty($offset)) $offset = 0;
      $order_type = 'ASC';

      $data['header'] = "<a href='".site_url('kelola_user/tambah')."' class='btn btn-primary'>Tambah User</a>";
      $user = $this->mod_user->get_paged_list($limit, $offset, $order_type)->result();

      $template = array(
              'table_open'            => '<table class="table table-responsive table-hover">',
              'thead_open'            => '<thead>',
              'thead_close'           => '</thead>',
              'heading_row_start'     => '<tr>',
              'heading_row_end'       => '</tr>',
              'tbody_open'            => '<tbody>',
              'row_start'             => '<tr>',
              'row_end'               => '</tr>',
              'cell_start'            => '<td>',
              'cell_end'              => '</td>',
              'tbody_close'           => '</tbody>',
              'table_close'           => '</table>'
      );
      $this->table->set_template($template);
      $this->table->set_empty('&nbsp;');
      $this->table->set_heading(
          'nama',	'jabatan',	'username', 	'password',	'akses', 'Aksi'
      );

      foreach($user as $user) {
        $this->table->add_row(
          $user->nama,
          $user->jabatan,
          $user->username,
          $user->password,
          $user->akses,
          anchor('kelola_user/edit/'.$user->nama, 'Edit', array('class' => 'btn btn-warning'))." ".anchor('kelola_user/hapus/'.$user->nama, 'Hapus', array('class' => 'btn btn-danger', 'onclick'=>"return confirm('Apakah akan menghapus data?')" ))
        );
      }
      $data['table']= $this->table->generate();

      $config['base_url'] = site_url('kelola_user/data_user');
      $config['total_rows'] = $this->mod_user->count_all();
      $config['per_page'] = $limit;
      $config['uri_segment'] = 3;
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();

      if ($this->uri->segment(3) == "delete_success") {
        $data['message'] = "<span style='color: red;'>data sukses dihapus</span><br/>";
      } elseif ($this->uri->segment(3) == "add_success") {
        $data['message'] = "<span style='color: green;'>data sukses ditambah</span><br/>";
      } elseif ($this->uri->segment(3) == "update_success") {
        $data['message'] = "<span style='color: blue;'>data sukses diubah</span><br/>";
      } else {
        $data['message'] = "";
      }

      $this->template_admin->display('table_data', $data);
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }

  }
  function tambah(){
    if($this->login){
      $this->load->model('mod_user', '', TRUE);
      $this->load->library('form_validation');

      $data['proses'] = 'kelola_user/tambah';
      $data['header'] = 'Tambah User Baru';
      $data['action'] = 'TAMBAH';
      $this->_set_rules();

      if($this->form_validation->run() === FALSE) {
        $data['message']= "";
        $this->template_admin->display('form_user', $data);
      } else {
        $password = $this->input->post('password');
        $pwd_en = $this->encryption->encrypt($password);
        $user = array(
          'nama'=> $this->input->post('nama'),
          'jabatan'=> $this->input->post('jabatan'),
          'username'=> $this->input->post('username'),
          'password'=> $pwd_en,
          'akses'=> $this->input->post('akses'),
        );
        $this->mod_user->save($user);
        redirect('kelola_user/data_user/add_success');
      }
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function edit($id){
    if($this->login){
      $this->load->model('mod_user', '', TRUE);
      $this->load->library('form_validation');
      $user = $this->mod_user->get_by_id($id)->row();

      $data['proses'] = 'kelola_user/edit/'.$id;
      $data['header'] = 'Edit User';
      $data['action'] = 'EDIT';
      $this->_set_rules();

      if($this->form_validation->run() === FALSE) {
        $data['message']= "";
        $data['user']['nama'] = $user->nama;
        $data['user']['jabatan'] = $user->jabatan;
        $data['user']['username'] = $user->username;
        $data['user']['password'] = $user->password;
        $data['user']['akses'] = $user->akses;

        $this->template_admin->display('form_user', $data);
      } else {
        $user = array(
          'nama'=> $this->input->post('nama'),
          'jabatan'=> $this->input->post('jabatan'),
          'username'=> $this->input->post('username'),
          'password'=> $this->input->post('password'),
          'akses'=> $this->input->post('akses'),
        );
        $this->mod_user->update($id, $user);
        redirect('kelola_user/data_user/update_success');
      }
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function hapus($id) {
    if($this->login){
      $this->load->model('mod_user', '', TRUE);
      $this->mod_user->delete($id);
      redirect('kelola_user/data_user/delete_success', 'refresh');
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function _set_rules(){
    $this->form_validation->set_rules('username', 'username', 'required|trim');
    $this->form_validation->set_rules('password', 'password', 'required|trim');
  }
}
