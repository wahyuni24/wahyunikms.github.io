
      <div class="page-title">    
        <div class="title_left">
          <h3>Tacit Knowledge</h3>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
		      <form action="<?php echo base_url();?>control/lihat_masalah_solusi" method="post" data-parsley-validate class="form-horizontal form-label-left">
			   <div class="form-group">
                  <div class="clearfix">
                    <button type="submit" class="btn btn-primary">Lihat Knowedge Tacit Anda</button>
                  </div>
                </div>
				 </form>
            <div class="x_title">
              <h2>Form Tacit Knowledge</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form action="<?php echo base_url();?>control/submit_masalah_solusi" method="post" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3 col-xs-12">
                    Judul 
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="judul_tacit" class="form-control col-md-7 col-xs-12">
                    <?php echo form_error('judul_tacit'); ?>                                       
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3 col-xs-12">
                    Kasus
                  </label>
                  <div class="col-md-10 col-sm-6 col-xs-12">
                    <textarea id="editor1" name="masalah" rows="10" cols="80"></textarea>
                    <?php echo form_error('masalah'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3 col-xs-12">
                    Solusi 
                  </label>
                  <div class="col-md-10 col-sm-6 col-xs-12">
                    <textarea id="editor2" name="solusi" rows="10" cols="80"></textarea>
                  </div>
                  <?php echo form_error('solusi'); ?>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">Simpan Knowedge Tacit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>