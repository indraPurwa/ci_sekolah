<?php
if (empty($berita)) {
  echo NULL;
} else {
  echo '<div id="MyCarousel" class="carousel slide">';
  echo '<div class="carousel-inner">';
  $active = 1;
  foreach ($berita as $news) {
    ($active==1)? $act="active" : $act="";
    echo '<div class="item '.$act.'">
            <img src="'.base_url().'/img/'.$news->img.'">
            <div class="carousel-caption"><a href="'.site_url('home/detail_berita/'.$news->id).'">'.$news->judul.'</div>
          </div>';
          $active++;
  }
  echo "</div>";
  echo '<a class="carousel-control left" href="#MyCarousel" data-slide="prev"><span class="glyphicon glyphicon-menu-left"></span></a>
        <a class="carousel-control right" href="#MyCarousel" data-slide="next"><span class="glyphicon glyphicon-menu-right"></span></a>';
  echo "</div>";
}
?>
<div class="header berita"><h4>Berita</h4></div>
  <?php
  if (empty($list_berita)) {
    echo '<div class="alert alert-danger">Berita kosong</div>';
  } else {
    foreach ($list_berita as $berita) {
      echo '<div class="col-md-12 list-berita">
              <div class="row"><div class="col-md-12"><a href="'.site_url('home/detail_berita/'.$berita->id).'">'.$berita->judul.'</a></div></div>
              <div class="row">
                <div class="col-md-4"><img class="img img-responsive" src="'.base_url().'/img/'.$berita->img.'"></img></div>
                <div class="col-md-8"><p>'.$berita->isi.'</p></div>
              </div>
            </div>';
    }
    echo '<a style="margin: 10px 0;" href="'.site_url('home/berita/').'" class="btn btn-default">Berita selanjutnya</a>';
  }
  ?>
