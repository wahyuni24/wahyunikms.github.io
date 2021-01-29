    <div class="page-title">
      <div class="title_left">
        <h3>Tacit Knowledge</h3>
      </div>
    </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabel Tacit Knowledge<small></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30" $().DataTable();>
                    </p>
                    <table id="example1" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th><center>No</th>
                          <th><center>Judul Knowledge Tacit</th>
                          <th><center>Pengguna</th>
                          <th><center>NIP</th>
                          <th><center>Tanggal Posting</th>
                          <th><center>Status</th>
                          <th><center>Aksi</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php
                      $no   = 1;
                      foreach ($tacit->result_array() as $data)  {
                      ?>
                        <tr>
                          <td width="10px"><center>
                            <?php echo $no;?>
                          </td>
                          <td>
                            <a target="_blank" href="<?php echo base_url('control/data_masalah_solusi');?>/<?php echo $data['id_tacit'];?>">
                              <?php echo $data['judul_tacit'];?>
                            </a>
                          </td>
                          <td>
                            <a href="<?php echo base_url('control/pengguna');?>/<?php echo $data['id_pengguna'];?>"><?php echo $data['nama'];?></a>
                          </td>
                          <td>
                            <?php echo $data['nip'];?>
                          </td>
                          <td>
                            <font class='timeago' title="<?php echo $data['tgl_post'];?>"><?php echo $data['tgl_post'];?></font>
                          </td>
                          <td>
                            <?php if($data['validasi_tacit']=="1"){ echo "Tervalidasi";} else { echo "Belum Tervalidasi";}?>
                          </td>
                          <td><center>
                            <a onClick="return confirmSubmit()" href="<?php echo base_url('control/validasi_tacit');?>/<?php echo $data['id_tacit'];?>/<?php echo $data['id_pengguna'];?>">
                              <button class="btn  btn-warning btn-xs">
                                <i class="glyphicon glyphicon-check"> VALIDASI</i>
                              </button>
                            </a>
                          </td>
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
<!-- jQuery -->    
    <script src="<?php echo base_url();?>asset/jquery.min.js"></script>
    <script src="<?php echo base_url();?>asset/jquery.timeago.js" type="text/javascript"></script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
        jQuery("font.timeago").timeago();
      });
    </script>