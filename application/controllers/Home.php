<?php defined('BASEPATH') or exit("Tidak bisa mengakses langsung");
class Home extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library(array('template', 'access'));
    $this->load->helper(array('url', 'form'));
  }
  function index($offset = 3){
    $this->load->model('mod_berita', '', TRUE);
    $limit = 3;
    $data['berita'] = $this->mod_berita->get_paged_list($limit, 0, 'DESC')->result();
    $data['list_berita'] = $this->mod_berita->get_paged_list($limit, $limit, 'DESC')->result();
    $this->template->display('home', $data);
  }
  function berita($offset=0){
    $this->load->library('pagination');
    $this->load->model('mod_berita', '', TRUE);
    $limit = 5;

    $data['list_berita'] = $this->mod_berita->get_paged_list($limit, $offset, 'DESC')->result();
    $config['base_url'] = site_url('home/berita/');
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
    $this->template->display('berita', $data);
  }
  function visi_misi(){
    $data['message'] = 'sukses';
    $this->template->display('visi_misi', $data);
  }
  function data_siswa($offset = 0){
    $this->load->model('mod_siswa', '', TRUE);
    $this->load->library(array('table', 'pagination'));
    $limit = 5;
    if(empty($offset)) $offset = 0;
    $order_type = 'DESC';

    $data['header'] = "Daftar Siswa";
    $data['message'] = "";
    $swa = $this->mod_siswa->get_siswa($limit, $offset, $order_type)->result();

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
      'NISN', 'Nama', 'Alamat', 'No_Hp', 'Tgl Masuk'
    );
    foreach ($swa as $siswa) {
      $this->table->add_row(
        anchor('home/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->nisn),
        anchor('home/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->nama),
        anchor('home/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->alamat),
        anchor('home/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->no_hp),
        anchor('home/detail_siswa/'.$siswa->nisn.'/siswa', $siswa->tgl_masuk)
      );
    }
    $data['table']= $this->table->generate();

    $config['base_url'] = site_url('home/data_siswa/');
    $config['total_rows'] = $this->mod_siswa->count_siswa();
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

    $this->template->display('table_data', $data);
  }
  function data_alumni($offset= 0){
    $this->load->model('mod_siswa', '', TRUE);
    $this->load->library(array('pagination', 'table'));
    $limit = 3;
    if(empty($offset)) $offset= 0;
    $order_type = 'DESC';

    $data['header'] = "Daftar Alumni";
    $data['message'] = "";
    $alumni = $this->mod_siswa->get_alumni($limit, $offset, $order_type)->result();
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
      'NISN',	'Nama',	'Alamat',	'No_Hp',	'Tgl Masuk', 'Thn Keluar'
    );
    foreach ($alumni as $alm) {
      $this->table->add_row(
        anchor('home/detail_siswa/'.$alm->nisn.'/alumni', $alm->nisn),
        anchor('home/detail_siswa/'.$alm->nisn.'/alumni', $alm->nama),
        anchor('home/detail_siswa/'.$alm->nisn.'/alumni', $alm->alamat),
        anchor('home/detail_siswa/'.$alm->nisn.'/alumni', $alm->no_hp),
        anchor('home/detail_siswa/'.$alm->nisn.'/alumni', date('d-m-Y', strtotime($alm->tgl_masuk))),
        anchor('home/detail_siswa/'.$alm->nisn.'/alumni', date('Y', strtotime('+3 year', strtotime($alm->tgl_masuk))))
      );
    }
    $data['table'] = $this->table->generate();

    $config['base_url']= site_url('home/data_alumni/');
    $config['total_rows'] = $this->mod_siswa->count_alumni();
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
    $data['pagination'] =  $this->pagination->create_links();

    $this->template->display('table_data', $data);
  }
  function detail_siswa($id, $status) {
    $this->load->model('mod_siswa', '', TRUE);

    $data['siswa'] = $this->mod_siswa->get_by_id($id)->row();
    if($status == "siswa") {
      $data['status'] = FALSE;
    } elseif ($status == "alumni") {
      $data['status'] = TRUE;
    }

    $this->template->display('detail_siswa', $data);
  }
  function detail_berita($id){
    $this->load->model('mod_berita', '', TRUE);

    $data['berita'] = $this->mod_berita->get_by_id($id)->row();
    $this->template->display('detail_berita', $data);
  }
}
