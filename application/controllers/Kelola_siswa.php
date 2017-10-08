<?php defined('BASEPATH') or exit("Tidak bisa mengakses langsung");
class Kelola_siswa extends CI_Controller {
  private $login;
  function __construct(){
    parent::__construct();
    $this->load->library(array('template_admin', 'access'));
    $this->load->helper(array('url', 'form'));
    $this->login = $this->access->is_login();
  }
  function index(){
    if($this->login){
      $this->data_siswa();
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function data_siswa($offset = 0){
    if($this->login){
      $this->load->model('mod_siswa', '', TRUE);
      $this->load->library(array('table', 'pagination'));
      $limit = 10;
      if(empty($offset)) $offset = 0;
      $order_type = 'ASC';

      $data['header'] = "<a href='".site_url('kelola_siswa/tambah_siswa')."' class='btn btn-primary'>Tambah Siswa</a>";
      $swa = $this->mod_siswa->get_paged_list($limit, $offset, $order_type)->result();

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
        'NISN', 'Nama', 'Alamat', 'JK', 'Agama', 'No_Hp', 'No_KTP', 'Tgl Masuk', 'Pekerjaan', 'Aksi'
      );
      foreach ($swa as $siswa) {
        ($siswa->no_ktp != NULL) ? $ktp = anchor('kelola_siswa/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->no_ktp): $ktp="NULL";
        (($siswa->pekerjaan) != NULL) ? $p = anchor('kelola_siswa/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->pekerjaan) : $p="NULL";

        $this->table->add_row(
          anchor('kelola_siswa/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->nisn),
          anchor('kelola_siswa/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->nama),
          anchor('kelola_siswa/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->alamat),
          anchor('kelola_siswa/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->jk),
          anchor('kelola_siswa/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->agama),
          anchor('kelola_siswa/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->no_hp),
          $ktp,
          anchor('kelola_siswa/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->tgl_masuk),
          $p,
          anchor('kelola_siswa/edit_siswa/'.$siswa->nisn.'/siswa', 'Edit', array('class' => 'btn btn-warning'))." ".anchor('kelola_siswa/hapus_siswa/'.$siswa->nisn, 'Hapus', array('class' => 'btn btn-danger', 'onclick'=>"return confirm('Apakah akan menghapus data?')" ))
        );
      }
      $data['table']= $this->table->generate();

      $config['base_url'] = site_url('kelola_siswa/data_siswa/');
      $config['total_rows'] = $this->mod_siswa->count_all();
      $config['per_page'] = $limit;
      $config['uri_segment'] = 3;

      $config['first_link'] = '<span class="glyphicon glyphicon-fast-backward"></span>';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';

      $config['last_link'] = '<span class="glyphicon glyphicon-fast-forward"></span>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';

      $config['prev_link'] = '<span class="glyphicon glyphicon-backward"></span>';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';

      $config['next_link'] = '<span class="glyphicon glyphicon-forward"></span>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';

      $config['cur_tag_open'] = '<li class="active"><a href="">';
      $config['cur_tag_close'] = '</a></li>';

      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();

      if ($this->uri->segment(3) == "delete_success") {
        $data['message'] = "<span style='color: red;'>data sukses dihapus</span><br/>";
      } elseif ($this->uri->segment(3) == "add_success") {
        $data['message'] = "<span style='color: green;'>data sukses ditambah</span><br/>";
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
  function tambah_siswa(){
    if($this->login){
      $this->load->model('mod_siswa', '', TRUE);
      $this->load->library('form_validation');

      $data['proses'] = 'kelola_siswa/tambah_siswa';
      $data['header'] = 'Tambah siswa baru';
      $data['action'] = 'TAMBAH';
      $this->_set_rules();
      $this->_set_rules2();

      if($this->form_validation->run() === FALSE) {
        $data['message']= "";
        $data['siswa']['nisn'] = $this->input->post('nisn');
        $data['siswa']['nama'] = $this->input->post('nama');
        $data['siswa']['tl'] = $this->input->post('tl');
        $data['siswa']['tgl'] = $this->input->post('tgl');
        $data['siswa']['nama_ortu'] = $this->input->post('nama_ortu');
        $data['siswa']['alamat'] = $this->input->post('alamat');
        $data['siswa']['jk'] = $this->input->post('jk');
        $data['siswa']['agama'] = $this->input->post('agama');
        $data['siswa']['no_hp'] = $this->input->post('no_hp');
        $data['siswa']['no_ktp'] = $this->input->post('no_ktp');
        $data['siswa']['tgl_masuk'] = $this->input->post('tgl_masuk');
        $data['siswa']['pekerjaan'] = $this->input->post('pekerjaan');

        $this->template_admin->display('form_siswa', $data);
      } else {
        $foto = "";
        $config['upload_path'] = './img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('foto')){
          $data['message'] = $this->upload->display_errors();
        } else {
          $foto = $this->upload->data('file_name');
        }
        (isset($_POST['no_ktp'])) ? $ktp = $_POST['no_ktp']:$ktp="NULL";
        (isset($_POST['pekerjaan'])) ? $p= $_POST['pekerjaan']:$p="NULL";
        $siswa = array(
          'nisn'=> $this->input->post('nisn'),
          'nama'=> $this->input->post('nama'),
          'tl'=> $this->input->post('tl'),
          'tgl'=> $this->input->post('tgl'),
          'nama_ortu'=> $this->input->post('nama_ortu'),
          'alamat'=> $this->input->post('alamat'),
          'jk'=> $this->input->post('jk'),
          'agama'=> $this->input->post('agama'),
          'no_ktp'=> $ktp,
          'foto'=> $foto,
          'tgl_masuk'=> $this->input->post('tgl_masuk'),
          'no_hp'=> $this->input->post('no_hp'),
          'pekerjaan'=> $p,
        );
        $this->mod_siswa->save($siswa);
        redirect('kelola_siswa/data_siswa/add_success');
      }
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function edit_siswa($nisn){
    if($this->login){
      $this->load->model('mod_siswa', '', TRUE);
      $siswa = $this->mod_siswa->get_by_id($nisn)->row();
      $this->load->library('form_validation');
      $this->load->helper('file');

      $data['proses'] = 'kelola_siswa/edit_siswa/'.$nisn;
      $data['header'] = 'Edit Siswa';
      $data['action'] = 'EDIT';
      $this->_set_rules();

      if($this->form_validation->run() === FALSE) {
        $data['message']= "";
        $data['siswa']['nisn'] = $siswa->nisn;
        $data['siswa']['nama'] = $siswa->nama;
        $data['siswa']['tl'] = $siswa->tl;
        $data['siswa']['tgl'] = date('d-m-Y', strtotime($siswa->tgl));
        $data['siswa']['nama_ortu'] = $siswa->nama_ortu;
        $data['siswa']['alamat'] = $siswa->alamat;
        $data['siswa']['jk'] = $siswa->jk;
        $data['siswa']['agama'] = $siswa->agama;
        $data['siswa']['no_hp'] = $siswa->no_hp;
        $data['siswa']['no_ktp'] = $siswa->no_ktp;
        $data['siswa']['tgl_masuk'] = date('d-m-Y', strtotime($siswa->tgl_masuk));
        $data['siswa']['pekerjaan'] = $siswa->pekerjaan;
        $data['siswa']['foto'] = $siswa->foto;

        $this->template_admin->display('form_siswa', $data);
      } else {
        $foto = $siswa->foto;

        $lokasifile = $_FILES['foto']['tmp_name'];
        $tipefile = $_FILES['foto']['type'];
        $namafile = $_FILES['foto']['name'];

        if(isset($namafile)){
          $config['upload_path'] = './img/';
          $config['allowed_types'] = 'gif|jpg|png';
          $this->load->library('upload', $config);
          if(!$this->upload->do_upload('foto')){
            $data['message'] = $this->upload->display_errors();
          } else {
            $foto = $this->upload->data('file_name');
            $foto_del = './img/'.$siswa->foto;
            delete_files($foto_del);
          }
        }
        $siswa = array(
          'nisn'=> $siswa->nisn,
          'nama'=> $this->input->post('nama'),
          'tl'=> $this->input->post('tl'),
          'tgl'=> date('Y-m-d', strtotime($_POST['tgl'])),
          'nama_ortu'=> $this->input->post('nama_ortu'),
          'alamat'=> $this->input->post('alamat'),
          'jk'=> $this->input->post('jk'),
          'agama'=> $this->input->post('agama'),
          'no_ktp'=> $this->input->post('no_ktp'),
          'foto'=> $foto,
          'tgl_masuk'=> date('Y-m-d', strtotime($_POST['tgl_masuk'])),
          'no_hp'=> $this->input->post('no_hp'),
          'pekerjaan'=> $this->input->post('pekerjaan'),
        );
        $this->mod_siswa->update($nisn, $siswa);
        redirect('kelola_siswa/data_siswa/update_success');
      }
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function detail_siswa($nisn, $status){
    if($this->login){
      $this->load->model('mod_siswa', '', TRUE);

      $data['siswa'] = $this->mod_siswa->get_by_id($nisn)->row();
      if($status == "siswa") {
        $data['status'] = FALSE;
      } elseif ($status == "alumni") {
        $data['status'] = TRUE;
      }

      $this->template_admin->display('detail_siswa', $data);
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function hapus_siswa($nisn) {
    if($this->login){
      $this->load->model('mod_siswa', '', TRUE);
      $row = $this->mod_siswa->get_by_id($nisn)->row();
      unlink('img/'.$row->foto);
      $this->mod_siswa->delete($nisn);
      redirect('kelola_siswa/data_siswa/delete_success', 'refresh');
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function _set_rules(){
    $this->form_validation->set_rules('nama', 'nama', 'required|trim');
    $this->form_validation->set_rules('tl', 'tl', 'required|trim');
    $this->form_validation->set_rules('tgl', 'tgl', 'required|trim');
    $this->form_validation->set_rules('nama_ortu', 'nama_ortu', 'required|trim');
    $this->form_validation->set_rules('alamat', 'alamat', 'required|trim');
    $this->form_validation->set_rules('jk', 'jk', 'required');
    $this->form_validation->set_rules('agama', 'agama', 'required');
    $this->form_validation->set_rules('no_hp', 'no_hp', 'required|trim');
    $this->form_validation->set_rules('no_ktp', 'no_ktp', 'trim');
    $this->form_validation->set_rules('tgl_masuk', 'tgl_masuk', 'required|trim');
    $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim');
  }
  function _set_rules2(){
    $this->form_validation->set_rules('nisn', 'nisn', 'required|trim');
  }
}
