<!DOCTYPE html>
<head>
  <title>SMA 3 KOTA PALEMBANG</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shotchut icon" href="img/favicon.png">
  <link href="<?php echo base_url('css/bootstrap.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('css/index.css'); ?>" rel="stylesheet">
</head>
<body>
  <div class="container">
    <?php echo $_header; ?>
    <?php echo $_nav_menu; ?>
    <div class="content">
      <div class="row" style="padding-top: 15px;">
        <div class="col-md-9" style="padding-left: 25px;">
          <?php echo $_content;?>
        </div>
        <div class="col-md-3" style="padding-right: 25px;">
          <?php echo $_right_menu; ?>
        </div>
      </div>
    </div>
    <?php echo $_footer; ?>
  </div>
  <script src="<?php echo base_url(); ?>/js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>/js/bootstrap.js"></script>

</body>
</html>
