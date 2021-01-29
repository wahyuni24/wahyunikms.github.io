      <div class="page-title">
        <div class="title_left">
          <h3>Data Bidang Kerja</h3>
        </div>
      </div>
<?php foreach($kode_bagian->result_array() as $rows)?>
<?php
  $no = @$rows['urut'] + 1;
  if(strlen($no) == '1'){
    $kd_bagian = "BK00".$no;
  }
    elseif(strlen($no) == '2'){
      $kd_bagian = "BK0".$no;
    }
      elseif(strlen($no) == '3'){
        $kd_bagian = "BK".$no;
      }
?>      
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Input Data Bidang Kerja</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form id="demo-form"  action="<?php echo base_url();?>control/submit_bagian" method="post" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group col-md-3">
                  <label class="col-md-2col-xs-12">
                    Kode Bidang Kerja
                  </label>
                    <input type="text" name="id_bdkerja" value="<?php echo $kd_bagian;?>" class="form-control" readonly>
                    <?php echo form_error('id_bdkerja'); ?>                                       
                </div>
                <div class="form-group col-md-10">
                  <label>
                    Bidang Kerja
                  </label>
                    <input type="text" name="nama_bdkerja" class="form-control" placeholder="Masukkan Bagian">
                    <input type="hidden" name="urut" value="<?php echo $no;?>" class="form-control">
                    <?php echo form_error('nama_bdkerja'); ?>
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>

          <div class="x_panel">
            <div class="x_title">
              <h2>List Data Bidang Kerja</h2>
              <div class="clearfix"></div>
            </div>          
            <div class="x_content">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><center>No</th>
                    <th><center>Kode Bagian</th>
                    <th>Nama Bagian</th>
                    <th><center>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no   = 1;
                foreach($bagian->result_array() as $data){?>
                  <tr>
                    <td width="10px"><center>
                      <?php echo $no;?>
                    </td>
                    <td width="120px"><center>
                      <?php echo $data['id_bdkerja'];?>
                    </td>
                    <td>
                      <?php echo $data['nama_bdkerja'];?>
                    </td>
                    <td width="100px"><center>
                      <a href="<?php echo base_url('control/edit_bagian');?>/<?php echo $data['id_bdkerja'];?>">
                        <button class="btn btn-info btn-xs">
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                      </a>
                      <a onClick="return confirmSubmit()" href="<?php echo base_url('control/hapus_bagian');?>/<?php echo $data['id_bdkerja'];?>">
                        <button class="btn btn-danger btn-xs">
                          <i class="glyphicon glyphicon-trash"></i>
                        </button>
                      </a>
                    </td>
                  </tr>
                  <?php
                  $no++;
                }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>