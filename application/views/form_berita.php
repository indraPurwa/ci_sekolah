<div class="header page"><h4><?php echo $header; ?></h4></div>
  <?php echo $message; ?>
  <?php echo validation_errors(); ?>
<?php echo form_open_multipart($proses); ?>
  <div class="form-group">
    <label for="id" class="col-md-4 control-label">ID</label>
    <div class="col-md-8">
      <input type="text" name="id" class="form-control" id="id" placeholder="id (auto increment)" value="<?php echo (isset($berita['id'])) ? $berita['id'] : "";?>" disabled="disable">
    </div>
  </div>
  <div class="form-group">
    <label for="judul" class="col-md-4 control-label">Judul</label>
    <div class="col-md-8">
      <input type="text" name="judul" class="form-control" id="judul" placeholder="judul" value="<?php echo (isset($berita['judul'])) ? $berita['judul'] : "";?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="isi" class="col-md-4 control-label">Isi</label>
    <div class="col-md-8">
      <textarea name="isi" id="isi"><?php echo (isset($berita['isi'])) ? $berita['isi'] : "";?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="img" class="col-md-4 control-label">Foto</label>
    <div class="col-sm-8">
      <?php if(isset($berita['img'])) {
        echo '<br/><img style="img img-thumbnail" src="'.base_url().'img/'.$berita['img'].'"> <div class="alert alert-info">'.$berita['img']."</div>";
      }?>
      <input type="file" name="img" class="form-control" id="img" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8" style="margin-top: 30px;">
      <input type="submit" class="btn btn-primary" value="<?php echo $action; ?>"></input>
      <a href="javascript:history.back()" class="btn btn-primary">KEMBALI</a>
    </div>
  </div>
</form>
