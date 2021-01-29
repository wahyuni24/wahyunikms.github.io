    <div class="page-title">
      <div class="title_left">
        <h3>Pegawai</h3>
      </div>
    </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Pegawai<small>IAIN Kota Bengkulu bagian Pusat Komputer (PUSKOM) </small></h2>
                      <?php foreach($pengguna->result_array() as $user)?>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    </p>
                    <table id="example1" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th><center>No</th>
                          <th><center>Nip</th>
                          <th><center>Nama</th>
                          <th><center>Tempat, Tanggal Lahir</th>
                          <th><center>Photo</th>
                          <th><center>Bidang Kerja</th>
                          <th><center>Hak Akses sebagai</th>
                      <!-- <?php if($user['hak_akses']=='4'){?> -->
                          <th><center>Aksi</th>
                     <!--  <?php } ?> -->
                        </tr>
                      </thead>

                      <tbody>
                      <?php
                      $no   = 1;
                      foreach ($pegawai->result_array() as $data)  {
                      ?>
                        <tr>
                          <td width="10px"><center>
                            <?php echo $no;?>
                          </td>
                          <td>
                            <?php echo $data['nip'];?>
                          </td>
                          <td>
                            <a href="<?php echo base_url('control/pengguna');?>/<?php echo $data['id_pengguna'];?>"><?php echo $data['nama'];?></a>
                          </td>
                          <td>
                            <?php echo $data['tempat_lahir'];?>,<br/><?php echo $data['tanggal_lahir'];?>
                          </td>
                          <td width="100px">
                            <img src="<?php echo base_url();?>photo/images/<?php echo $data['userfile'];?>" width="100px"/>
                          </td>
                          <td>
                            <?php echo $data['nama_bdkerja'];?>
                          </td>                          
                          <td>
                           <?php if($data['hak_akses']  ==  '1'){ echo "USER";}?>
                           <?php if($data['hak_akses']  ==  '4'){ echo "EXPERT(Tenaga Ahli)";}?>
                          </td>
                          <?php if($user['hak_akses']=='4'){?>
                          <td width="100px"><center>
                            <a href="<?php echo base_url('control/edit_pegawai');?>/<?php echo $data['id_pengguna'];?>" title="Edit Data">
                              <button class="btn btn-info btn-xs">
                                <span class="glyphicon glyphicon-edit"></span>
                              </button>
                            </a>
                            <a onClick="return confirmSubmit()" href="<?php echo base_url('control/hapus_pegawai');?>/<?php echo $data['id_pengguna'];?>" title="Hapus Data">
                              <button class="btn  btn-danger btn-xs">
                                <span class="glyphicon glyphicon-trash"></span>
                              </button>
                            </a>
                            <a onClick="return confirmSubmit()" href="<?php echo base_url('control/reset_password');?>/<?php echo $data['id_pengguna'];?>" title="Reset Password">
                              <button class="btn  btn-warning btn-xs">
                                <span class="glyphicon glyphicon-lock"></span>
                              </button>
                            </a>
                          </td>
                          <?php } ?>
                        </tr>
                      <?php
                      $no++;
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        <!-- /page content -->