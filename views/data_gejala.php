      <div class="page-title">
        <div class="title_left">
          <h3>Data Gejala</h3>
        </div>
      </div>
<?php foreach($kode_gejala->result_array() as $rows)?>
<?php
  $no = @$rows['urut'] + 1;
  if(strlen($no) == '1'){
    $kd_gejala = "G00".$no;
  }
    elseif(strlen($no) == '2'){
      $kd_gejala = "G0".$no;
    }
      elseif(strlen($no) == '3'){
        $kd_gejala = "G".$no;
      }
?>      
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Input Data Gejala</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form id="demo-form"  action="<?php echo base_url();?>control/submit_gejala" method="post" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group col-md-4">
                  <label class="col-md-2col-xs-12">
                    Kode Gejala
                  </label>
                    <input type="text" name="id_gejala" value="<?php echo $kd_gejala;?>" class="form-control" readonly>
                    <input type="hidden" name="urut" value="<?php echo $no;?>" class="form-control">
                    <?php echo form_error('id_gejala'); ?>                                       
                </div>
                <div class="form-group col-md-8">
                  <label>
                    Bidang Kerja
                  </label>
                    <select name="id_bdkerja" class="form-control">
                      <?php foreach($bagian->result_array() as $b){?>
                      <option value="<?php echo $b['id_bdkerja'];?>"><?php echo $b['nama_bdkerja'];?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-10">
                  <label>
                    Gejala
                  </label>
                    <input type="text" name="nama_gejala" class="form-control" placeholder="Masukkan Gejala">
                    <?php echo form_error('nama_gejala'); ?>
                </div>
                <div class="form-group col-md-2">
                  <label>Bobot Gejala</label>
                    <select name="bobot_gejala" class="form-control">
                    <option value="2">2	(Akan Ditindaklanjuti)</option>
                    <option value="5">5	(Ditindaklanjuti)</option>
                    <option value="8">8	(Segera Ditindaklanjuti)</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary">Masukkan Gejala</button>
                </div>
              </form>
            </div>
          </div>

          <div class="x_panel">
            <div class="x_title">
              <h2>Daftar Gejala</h2>
              <div class="clearfix"></div>
            </div>          
            <div class="x_content">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><center>No</th>
                    <th><center>Kode Gejala</th>
                    <th><center>Nama Gejala</th>
                    <th><center>Bidang Kerja</th>
                    <th><center>Bobot</th>
                    <th><center>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no   = 1;
                foreach($gejala->result_array() as $data){?>
                  <tr>
                    <td width="10px"><center>
                      <?php echo $no;?>
                    </td>
                    <td width=110px"><center>
                      <?php echo $data['id_gejala'];?>
                    </td>
                    <td>
                      <?php echo $data['nama_gejala'];?>
                    </td>
                    <td width="150px"><center>
                      <?php echo $data['nama_bdkerja'];?>
                    </td>
                    <td width="50px"><center>
                      <?php echo $data['bobot_gejala'];?>
                    </td>
                    <td width="90px"><center>
                      <a href="<?php echo base_url('control/edit_gejala');?>/<?php echo $data['id_gejala'];?>">
                        <button class="btn btn-info btn-xs">
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                      </a>
                      <a onClick="return confirmSubmit()" href="<?php echo base_url('control/hapus_gejala');?>/<?php echo $data['id_gejala'];?>">
                        <button class="btn btn-warning btn-xs">
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