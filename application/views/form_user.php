<div class="header page"><h4><?php echo $header; ?></h4></div>
  <?php echo $message; ?>
  <?php echo validation_errors(); ?>
<?php echo form_open_multipart($proses); ?>
  <div class="form-group">
    <label for="id" class="col-md-4 control-label">Nama</label>
    <div class="col-md-8">
      <input type="text" name="nama" class="form-control" placeholder="nama" value="<?php echo (isset($user['nama'])) ? $user['nama'] : "";?>" required="requie">
    </div>
  </div>
  <div class="form-group">
    <label for="jabatan" class="col-md-4 control-label">jabatan</label>
    <div class="col-md-8">
      <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="jabatan" value="<?php echo (isset($user['jabatan'])) ? $user['jabatan'] : "";?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="username" class="col-md-4 control-label">username</label>
    <div class="col-md-8">
      <input type="text" name="username" class="form-control" id="username" placeholder="username" value="<?php echo (isset($user['username'])) ? $user['username'] : "";?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-md-4 control-label">password</label>
    <div class="col-md-8">
      <input type="text" name="password" class="form-control" id="password" placeholder="password" value="<?php echo (isset($user['password'])) ? $user['password'] : "";?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="akses" class="col-md-4 control-label">Akses<span style="color: red">*</span></label>
    <div class="col-sm-8">
        <label class="btn btn-default"><input type="radio" name="akses" id="akses" value="ADMIN" <?php if(isset($user['akses']) && $user['akses']=="ADMIN") echo "checked";?> required> ADMIN </label>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8" style="margin-top: 30px;">
      <input type="submit" class="btn btn-primary" value="<?php echo $action; ?>"></input>
      <a href="javascript:history.back()" class="btn btn-primary">KEMBALI</a>
    </div>
  </div>
</form>
