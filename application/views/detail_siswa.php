<div class="header page"><h4><?php echo $siswa->nama;?></h4></div>
<div class="row" style="margin-top: 5px;">
  <div class="col-md-5">
    <img class="img img-responsive img-thumbnail" style="margin-left: 30px; padding-top: 10px; padding-bottom: 10px;width: 300px;height: 370px;" class="img img-responsive" alt="gambar" src="<?php echo base_url().'/img/'.$siswa->foto; ?>"/>
  </div>
  <div class="col-md-7">
    <table class="table table-bordered table-responsive">
       <tbody>
          <tr>
             <th>NISN</th>
             <td>:</td>
             <td><?php echo $siswa->nisn;?></td>
          </tr>
          <tr>
             <th>Nama</th>
             <td>:</td>
             <td><?php echo $siswa->nama;?></td>
          </tr>
          <tr>
             <th>Tempat Lahir</th>
             <td>:</td>
             <td><?php echo $siswa->tl;?></td>
          </tr>
          <tr>
             <th>Tanggal Lahir</th>
             <td>:</td>
             <td><?php echo date('d-m-Y', strtotime($siswa->tgl));?></td>
          </tr>
          <tr>
             <th>Nama Orang Tua/Wali</th>
             <td>:</td>
             <td><?php echo $siswa->nama_ortu;?></td>
          </tr>
          <tr>
             <th>Alamat</th>
             <td>:</td>
             <td><?php echo $siswa->alamat;?></td>
          </tr>
          <tr>
             <th>Jenis Kelamin</th>
             <td>:</td>
             <td><?php echo $siswa->jk;?></td>
          </tr>
          <tr>
             <th>Agama</th>
             <td>:</td>
             <td><?php echo $siswa->agama;?></td>
          </tr>
          <tr>
             <th>No KTP</th>
             <td>:</td>
             <td><?php echo $siswa->no_ktp;?></td>
          </tr>
          <tr>
             <th>No Telepon</th>
             <td>:</td>
             <td><?php echo $siswa->no_hp;?></td>
          </tr>
          <?php
          if($status == TRUE) {
            echo '<tr>
                     <th>Pekerjaan</th>
                     <td>:</td>
                     <td>'.$siswa->pekerjaan.'</td>
                  </tr>';
          } ?>
          <tr>
             <th>Tanggal Masuk</th>
             <td>:</td>
             <td><?php echo date('d-m-Y', strtotime($siswa->tgl_masuk));?></td>
          </tr>
          <tr>
             <th>Status</th>
             <td>:</td>
             <td>
               <?php
               if($status == FALSE) {
                 echo '<span style="font-size= 26;" class="label label-warning">Belum Lulus</span><br/>';
               } elseif ($status == TRUE) {
                 echo '<span style="font-size= 26;" class="label label-success">Telah Lulus</span><br/>';
                 echo '<h5><strong>Di Tahun '.date('Y', strtotime('+3 year', strtotime($siswa->tgl_masuk))),'</strong></h5>';
               }

               ?></td>
          </tr>
       </tbody>
    </table>
  </div>
</div>
