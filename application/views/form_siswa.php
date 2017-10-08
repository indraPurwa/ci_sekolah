<div class="header page"><h4><?php echo $header; ?></h4></div>
<?php echo $message; ?>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart($proses); ?>
  <div class="form-group">
    <label for="nisn" class="col-md-4 control-label">NISN <span style="color: red">*</span></label>
    <div class="col-md-8">
      <input type="text" name="nisn" class="form-control" id="nisn" placeholder="nisn" <?php echo (isset($siswa['nisn'])) ? 'value="'.$siswa['nisn'].'" disabled="disable"' : "";?> required>
    </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-md-4 control-label">Nama <span style="color: red">*</span></label>
    <div class="col-sm-8">
      <input type="text" name="nama" class="form-control" id="nama" placeholder="nama" value="<?php echo (isset($siswa['nama'])) ? $siswa['nama'] : "";?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="jk" class="col-md-4 control-label">Jenis Kelamin <span style="color: red">*</span></label>
    <div class="col-sm-8">

        <label class="btn btn-default"><input type="radio" name="jk" id="jk" value="LAKI-LAKI" <?php if(isset($siswa['jk']) && $siswa['jk']=="LAKI-LAKI") echo "checked";?> required> LAKI-LAKI </label>
        <label class="btn btn-default"><input type="radio" name="jk" id="jk" value="PEREMPUAN" <?php if(isset($siswa['jk']) && $siswa['jk']=="PEREMPUAN") echo "checked";?> required> PEREMPUAN </label>
    </div>
  </div>
  <div class="form-group">
    <label for="tl" class="col-md-4 control-label">TTL <span style="color: red">*</span></label>
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-6"><input type="text" name="tl" class="form-control" id="tl" placeholder="tempat lahir" value="<?php echo (isset($siswa['tl'])) ? $siswa['tl'] : "";?>" required></div>
        <div class="col-md-6"><input type="text" id="tgl" name="tgl" class="form-control tgl" placeholder="tanggal lahir dd/mm/yyyy" value="<?php echo (isset($siswa['tgl'])) ? $siswa['tgl'] : "";?>" required></div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="nama_ortu" class="col-md-4 control-label">Nama Orang Tua/Wali <span style="color: red">*</span></label>
    <div class="col-sm-8">
      <input type="text" name="nama_ortu" class="form-control" id="nama_ortu" placeholder="Nama Orang Tua/Wali" value="<?php echo (isset($siswa['nama_ortu'])) ? $siswa['nama_ortu'] : "";?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="agama" class="col-md-4 control-label">Agama <span style="color: red">*</span></label>
    <div class="col-sm-8">
      <label class="btn btn-default"><input type="radio" name="agama" id="agama" value="ISLAM" <?php if(isset($siswa['agama']) && $siswa['agama']=="ISLAM") echo "checked";?> required> ISLAM </label>
      <label class="btn btn-default"><input type="radio" name="agama" id="agama" value="BUDHA" <?php if(isset($siswa['agama']) && $siswa['agama']=="BUDHA") echo "checked";?> required> BUDHA </label>
      <label class="btn btn-default"><input type="radio" name="agama" id="agama" value="HINDU" <?php if(isset($siswa['agama']) && $siswa['agama']=="HINDU") echo "checked";?> required> HINDU </label>
      <label class="btn btn-default"><input type="radio" name="agama" id="agama" value="PROTESTAN" <?php if(isset($siswa['agama']) && $siswa['agama']=="PROTESTAN") echo "checked";?> required> PROTESTAN </label>
      <label class="btn btn-default"><input type="radio" name="agama" id="agama" value="KATHOLIK" <?php if(isset($siswa['agama']) && $siswa['agama']=="KATHOLIK") echo "checked";?> required> KATHOLIK </label>
    </div>
  </div>
  <div class="form-group">
    <label for="no_hp" class="col-md-4 control-label">No HP <span style="color: red">*</span></label>
    <div class="col-sm-8">
      <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="no_hp" value="<?php echo (isset($siswa['no_hp'])) ? $siswa['no_hp'] : "";?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="no_ktp" class="col-md-4 control-label">No KTP</label>
    <div class="col-sm-8">
      <input type="text" name="no_ktp" class="form-control" id="no_ktp" placeholder="no_ktp" value="<?php echo (isset($siswa['no_ktp'])) ? $siswa['no_ktp'] : "";?>">
    </div>
  </div>
  <div class="form-group">
    <label for="alamat" class="col-md-4 control-label">Alamat <span style="color: red">*</span></label>
    <div class="col-sm-8">
      <textarea class="textarea" name="alamat" id="alamat" required><?php echo (isset($siswa['alamat'])) ? $siswa['alamat'] : "";?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="tgl_masuk" class="col-md-4 control-label">Tanggal Masuk <span style="color: red">*</span></label>
    <div class="col-sm-8">
      <input type="text" id="tgl2" name="tgl_masuk" class="form-control" placeholder="tanggal masuk dd/mm/yyyy" value="<?php echo (isset($siswa['tgl_masuk'])) ? $siswa['tgl_masuk'] : "";?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="pekerjaan" class="col-md-4 control-label">Pekerjaan</label>
    <div class="col-sm-8">
      <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" placeholder="pakerjaan" value="<?php echo (isset($siswa['pekerjaan'])) ? $siswa['pekerjaan'] : "";?>">
    </div>
  </div>
  <div class="form-group">
    <label for="foto" class="col-md-4 control-label">Foto <span style="color: red">*</span></label>
    <div class="col-sm-8">
      <?php if(isset($siswa['foto'])) {
        echo '<br/><img style="img img-thumbnail" src="'.base_url().'img/'.$siswa['foto'].'"> <div class="alert alert-info">'.$siswa['foto']."</div>";
      }?>
      <input type="file" name="foto" class="form-control" id="foto">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8" style="padding-top: 15px;">
      <input type="submit" class="btn btn-primary" value="<?php echo $action;?>"></input>
      <a href="javascript:history.back()" class="btn btn-primary">KEMBALI</a>
    </div>
  </div>
</form>
