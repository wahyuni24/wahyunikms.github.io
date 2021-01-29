      <div class="page-title">    
        <div class="title_left">
          <h3>Edit Pegawai</h3>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Edit Data Pegawai</h2>
                <?php foreach($pegawai->result_array() as $row)?>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form action="<?php echo base_url();?>control/update_data_pegawai" method="post" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    No Induk Pegawai <span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" name="id_pengguna" value="<?php echo $row['id_pengguna'];?>" class="form-control col-md-7 col-xs-12">
                    <input type="text" name="nip" value="<?php echo $row['nip'];?>" class="form-control col-md-7 col-xs-12" readonly>
                    <?php echo form_error('nip'); ?>                                       
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                    Nama <span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="nama" value="<?php echo $row['nama'];?>" class="form-control col-md-7 col-xs-12">
                    <?php echo form_error('nama'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Jenis Kelamin
                  </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="minimal" <?php if($row['jenis_kelamin']=="Laki-Laki"){echo "checked";}?> /> Laki-Laki
                        </label>
                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="jenis_kelamin" value="Perempuan" class="minimal" <?php if($row['jenis_kelamin']=="Perempuan"){echo "checked";}?> /> Perempuan
                        </label>
                    </div>
                    <?php echo form_error('jenis_kelamin'); ?>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Tempat Lahir<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="tempat_lahir" value="<?php echo $row['tempat_lahir'];?>" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                  </div>
                  <?php echo form_error('tempat_lahir'); ?>
                </div>               
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Tanggal Lahir<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="tanggal lahir" value="<?php echo $row['tanggal_lahir'];?>" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                  </div>
                  <?php echo form_error('tanggal_lahir'); ?>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Bidang Kerja
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="id_bdkerja" class="form-control">
                      <option value="" disabled selected>Pilih Bidang Kerja</option>
                      <?php foreach($bidang_kerja->result_array() as $bk){?>
                      <option value="<?php echo $bk['id_bdkerja'];?>" <?php if($row['id_bdkerja']==$bk['id_bdkerja']){echo "selected";}?> >
                        <?php echo $bk['nama_bdkerja'];?>
                      </option>
                      <?php } ?>
                    </select>
                    <?php echo form_error('id_bdkerja'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Hak Akses
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="hak_akses" class="form-control">
                      <option value="1" <?php if($row['hak_akses']=='1'){echo "selected";}?>>USER(Pegawai)</option>
                      <option value="4" <?php if($row['hak_akses']=='4'){echo "selected";}?>>EXPERT(Tenaga Ahli)</option>
                    </select>
                    <?php echo form_error('hak_akses'); ?>
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                  <br><br><br><br><br>
                  <br><br><br><br><br>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>