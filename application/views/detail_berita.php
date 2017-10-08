<div class="header page"><h4><?php echo $berita->judul;?></h4></div>
<div class="col-md-12"><img src="<?php echo base_url().'/img/'.$berita->img;?>" class="img img-responsive img-rounded" style="width: 100%;padding: 5px 10px 5px 10px;height: 300px;"></div>
<div class="col-md-12 berita">
  <label style="margin-left: 10px;" class="label label-info">Posted by : <?php echo $berita->posted_by; ?></label>
  <label class="label label-info"><?php echo date('G:i:s d-m-Y' , strtotime($berita->tgl_post)); ?></label><br/>
  <br/><p><?php echo $berita->isi; ?></p><hr/>
</div>
