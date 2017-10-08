<!DOCTYPE html>
<head>
  <title>SMA 3 KOTA PALEMBANG</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shotchut icon" href="img/favicon.png">
  <link href="<?php echo base_url('css/admin.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('css/bootstrap.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('css/bootstrap-datepicker.css'); ?>" rel="stylesheet"/>
</head>
<body style="background-color: #9B9797;">
  <nav style="box-shadow: 1px 2px 3px #6C6A6A;" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo site_url('admin/welcome'); ?>">welcome</a>
      </div>
      <div>
        <ul class="nav navbar-nav">
          <li><a href="<?php echo site_url('kelola_siswa/index'); ?>">Kelola Siswa</a></li>
          <li><a href="<?php echo site_url('kelola_berita/index'); ?>">Kelola Berita</a></li>
          <li><a href="<?php echo site_url('kelola_user/index'); ?>">Kelola User</a></li>
          <li><a href="<?php echo site_url('Home'); ?>">Lihat Web Home</a></li>
          <li><a href="<?php echo site_url('admin/logout'); ?>">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container" style="margin-bottom: 50px; margin-top: 50px; background-color: white; padding-top: 20px; padding-bottom: 20px;">
    <div class="row">
      <div class="col-md-12">
        <?php echo $_content;?>
      </div>
    </div>
  </div>
  <nav style="box-shadow: 1px -2px 3px #6C6A6A;" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
    <p><center>created by : Incepers</center></p>
  </nav>
  <script src="<?php echo base_url(); ?>/js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>/js/bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
        $(document).ready(function () {
            $('#tgl').datepicker({
                format: "dd-mm-yyyy",
                autoclose:true
            });
        });
        $(document).ready(function () {
            $('#tgl2').datepicker({
                format: "dd-mm-yyyy",
                autoclose:true
            });
        });
        $("preview_foto").change(function(){
          bacaGambar(this);
        });
        function bacaGambar(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#foto_baru').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }
    </script>
</body>
