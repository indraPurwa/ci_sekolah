<?php defined('BASEPATH') or exit("Tidak bisa mengakses langsung");
class Kelola_berita extends CI_Controller {
  private $login;
  function __construct(){
    parent::__construct();
    $this->load->library(array('template_admin', 'access'));
    $this->load->helper(array('url', 'form'));
    $this->login = $this->access->is_login();
  }
  function index(){
    if($this->login){
      $this->data_berita();
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function data_berita($offset = 0){
    if($this->login){
      $this->load->model('mod_berita', '', TRUE);
      $this->load->library(array('table', 'pagination'));
      $limit = 10;
      if(empty($offset)) $offset = 0;
      $order_type = 'ASC';

      $data['header'] = "<a href='".site_url('kelola_berita/tambah')."' class='btn btn-primary'>Tambah Berita</a>";
      $berita = $this->mod_berita->get_paged_list($limit, $offset, $order_type)->result();

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
         'id', 'Judul', 'Isi',	'Gambar',	'Tanggal Post',	'posted_by', 'Aksi'
      );

      foreach($berita as $brt) {
        $cuplikan = array();
  		  $pecahan_kata = explode(" ", $brt->isi);
  		  for($a=0; $a<30; $a++)
  			   @ $cuplikan[$a] = $pecahan_kata[$a];

        $ttl_kata = count($pecahan_kata);
        $pecah_kata = count($cuplikan);
  		  $isi_brt = implode(" ", $cuplikan);
        $this->table->add_row(
          anchor('kelola_berita/detail/'.$brt->id, $brt->id),
          anchor('kelola_berita/detail/'.$brt->id, $brt->judul),
          anchor('kelola_berita/detail/'.$brt->id, $isi_brt),
          anchor('kelola_berita/detail/'.$brt->id, $brt->img),
          anchor('kelola_berita/detail/'.$brt->id, date('H:i:s d-m-Y', strtotime($brt->tgl_post))),
          anchor('kelola_berita/detail/'.$brt->id, $brt->posted_by),
          anchor('kelola_berita/edit/'.$brt->id, 'Edit', array('class' => 'btn btn-warning'))." ".anchor('kelola_berita/hapus/'.$brt->id, 'Hapus', array('class' => 'btn btn-danger', 'onclick'=>"return confirm('Apakah akan menghapus data?')" ))
        );
      }
      $data['table']= $this->table->generate();

      $config['base_url'] = site_url('kelola_berita/data_berita/');
      $config['total_rows'] = $this->mod_berita->count_all();
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
      $this->load->model('mod_berita', '', TRUE);
      $this->load->library('form_validation');

      $data['proses'] = 'kelola_berita/tambah';
      $data['header'] = 'Tambah Berita Baru';
      $data['action'] = 'TAMBAH';
      $this->_set_rules();

      if($this->form_validation->run() === FALSE) {
        $data['message']= "";
        $data['berita']['judul'] = $this->input->post('judul');
        $data['berita']['isi'] = $this->input->post('isi');
        $data['berita']['img'] = $this->input->post('img');

        $this->template_admin->display('form_berita', $data);
      } else {
        $img = "";
        $config['upload_path'] = './img';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('img')){
          $data['message'] = $this->upload->display_errors();
        } else {
          $img = $this->upload->data('file_name');
        }
        $berita = array(
          'id'=> "",
          'judul'=> $this->input->post('judul'),
          'isi'=> $this->input->post('isi'),
          'img'=> $img,
          'tgl_post'=> date('Y-m-d H:i:s'),
          'posted_by'=> $this->access->is_login(),
        );
        $this->mod_berita->save($berita);
        redirect('kelola_berita/data_berita/add_success');
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
      $this->load->model('mod_berita', '', TRUE);
      $this->load->library('form_validation');
      $this->load->helper('file');
      $berita = $this->mod_berita->get_by_id($id)->row();


      $data['proses'] = 'kelola_berita/edit/'.$id;
      $data['header'] = 'Edit Berita';
      $data['action'] = 'EDIT';
      $this->_set_rules();

      if($this->form_validation->run() === FALSE) {
        $data['message']= "";
        $data['berita']['id'] = $berita->id;
        $data['berita']['judul'] = $berita->judul;
        $data['berita']['isi'] = $berita->isi;
        $data['berita']['img'] = $berita->img;

        $this->template_admin->display('form_berita', $data);
      } else {
        $img = $berita->img;

        $lokasifile = $_FILES['img']['tmp_name'];
        $tipefile = $_FILES['img']['type'];
        $namafile = $_FILES['img']['name'];

        if(isset($namafile)){
          $config['upload_path'] = './img/';
          $config['allowed_types'] = 'gif|jpg|png';
          $this->load->library('upload', $config);
          if(!$this->upload->do_upload('img')){
            $data['message'] = $this->upload->display_errors();
          } else {
            $img = $this->upload->data('file_name');
            $img_del = './img/'.$berita->img;

          }
        }
        $berita = array(
          'id'=> $berita->id,
          'judul'=> $this->input->post('judul'),
          'isi'=> $this->input->post('isi'),
          'img'=> $img,
          'tgl_post'=> $berita->tgl_post,
          'posted_by'=> $berita->posted_by,
        );
        $this->mod_berita->update($id, $berita);
        redirect('kelola_berita/data_berita/update_success');
      }
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function detail($id){
    if($this->login){
      $this->load->model('mod_berita', '', TRUE);
      $data['berita'] = $this->mod_berita->get_by_id($id)->row();
      $this->template_admin->display('detail_berita', $data);
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function hapus($id) {
    if($this->login){
      $this->load->model('mod_berita', '', TRUE);
      $this->mod_berita->delete($id);
      redirect('kelola_berita/data_berita/delete_success', 'refresh');
    } else {
      echo '<script>
              alert("Loginlah terlebih dahulu !!!");
              window.location = "'.site_url().'/home'.'";
            </script>';
    }
  }
  function _set_rules(){
    $this->form_validation->set_rules('judul', 'judul', 'required|trim');
    $this->form_validation->set_rules('isi', 'isi', 'required|trim');
  }
}
