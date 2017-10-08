<div class="navigasi">
  <nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <botton type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="?page=home">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav nav-pills navbar-nav">
        <li><a href="<?php echo site_url('home/index');?>">Home</a>
        <li><a href="<?php echo site_url('home/visi_misi');?>">Visi & Misi</a></li>
        <li class="dropdown">
          <a href="#">Data</span></a>
          <ul class="my-dropdown-menu">
            <li><a href="<?php echo site_url('home/data_siswa');?>">Siswa</a></li>
            <li><a href="<?php echo site_url('home/data_alumni');?>">Alumni</a></li>
          </ul>
        </li>
        <?php
        $login = $this->access->is_login();
        if ($login == TRUE) {
          echo '<li><a href="'.site_url('admin/welcome').'">Admin Area</a></li>';
          echo '<li><a href="'.site_url('admin/logout').'">logout</a></li>';
        }
        ?>
      </ul>
    </div>
  </nav>
</div>
