<div class="header berita"><h4>Berita</h4></div>
  <?php
  if (empty($list_berita)) {
    echo '<div class="alert alert-danger">Berita kosong</div>';
  } else {
    foreach ($list_berita as $berita) {
      $cuplikan = array();
		  $pecahan_kata = explode(" ", $berita->isi);
		  for($a=0; $a<50; $a++)
			   @ $cuplikan[$a] = $pecahan_kata[$a];

      $ttl_kata = count($pecahan_kata);
      $pecah_kata = count($cuplikan);
		  $isi_brt = implode(" ", $cuplikan);
      if($ttl_kata >= $pecah_kata) {
        $link_next = '<a href="'.site_url('home/detail_berita/'.$berita->id).'"> selengkapnya</a>';
      } else {
        $link_next = "";
      }
      echo '<div class="col-md-12 list-berita">
              <div class="row"><div class="col-md-12"><a href="'.site_url('home/detail_berita/'.$berita->id).'">'.$berita->judul.'</a></div></div>
              <div class="row">
                <div class="col-md-4"><img class="img img-responsive" src="'.base_url().'/img/'.$berita->img.'"></img></div>
                <div class="col-md-8"><p>'.$isi_brt.$link_next.'</p></div>
              </div>
            </div>';
    }
  }
  echo '<div class="pagination">'.$pagination.'</div>';
  ?>
