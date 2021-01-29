<?php foreach($pengguna->result_array() as $user)?>
<script type="text/javascript"  src="<?php echo base_url();?>asset/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/jquery.livequery.js"></script>

    <div class="page-title">
      <div class="title_left">
        <h3>Detail Tacit Knowledge</h3>
      </div>
    </div>
    <?php foreach($detail->result_array() as $data)?>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2><b><?php echo $data['judul_tacit'];?></b>
                <small><b>
                  <i class="fa fa-user">
                    <a href="<?php echo base_url('control/pengguna');?>/<?php echo $data['id_pengguna'];?>">
                      <?php echo $data['nama'];?>
                    </a>
                  </i>
                  <i class="fa fa-spinner">
                    <font class='timeago' title="<?php echo $data['tgl_post'];?>">
                      <?php echo $data['tgl_post'];?>
                    </font>
                  </i></b>
                </small>
              </h2>
              <div class="clearfix"></div>
            </div><br>
              <div class="col-md-5 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_10 ">
                  <div class="x_title">
                    <h2><b>Kasus</b></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div style="text-align: overflow: hidden; margin: 10px 10px ;">
                      <?php echo $data['masalah'];?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_10 ">
                  <div class="x_title">
                    <h2><b>Solusi</b></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div style="text-align: overflow: hidden; margin: 10px 10px ;">
                      <?php echo $data['solusi'];?>
                    </div>
                  </div>
                </div>
              </div>
                            
              <div class="col-md-12 col-sm-6 col-xs-12">
                <br>
                <div class="x_panel fixed_height_100 ">
                  <div class="x_title">
                    <h2><b>Komentar</b></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url();?>control/submit_komentar_tacit" method="post" enctype="multipart/form-data">
                      <div class='col-sm-9'>
                        <input type="hidden" name="id_penerima" value="<?php echo $data['id_pengguna'];?>"/>
                        <input type="hidden" name="id_tacit" value="<?php echo $data['id_tacit'];?>"/>
                        <input type="text" name="isi_komentar_tacit" class="form-control col-md-7 col-xs-12" placeholder="Masukkan Komentar" required>
                      </div>                          
                      <div class='col-sm-3'>
                      <button class='btn btn-primary pull-right btn-block btn-sm'>Kirim</button>
                      </div>
                    </form><br>
                    <div class="x_title"><div class="clearfix"></div></div><br>                   
                  </div>
                    <div class="x_content">
                    <?php foreach ($komentar->result_array() as $k) {?>                    
                      <img class="avatar" src="<?php echo base_url();?>photo/<?php echo $k['userfile'];?>">
                      <span>
                        <a href="<?php echo base_url('control/pengguna');?>/<?php echo $k['id_pengguna'];?>">
                          <b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $k['nama'];?></b>
                        </a>
                        <?php if($k['id_pengguna']==$user['id_pengguna']) {?>
                        <form action="<?php echo base_url();?>control/hapus_komentar_tacit" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id_tacit" value="<?php echo $k['id_tacit'];?>"/>
                          <input type="hidden" name="id_komentar_tacit" value="<?php echo $k['id_komentar_tacit'];?>"/>
                          <button type="submit" class='btn pull-right btn-box-tool'><i class='fa fa-times'></i></button>
                        </form>
                        <?php } ?>
                        <b>
                          <span class='description'><?php echo $k['nip'];?> - <i class="fa fa-clock-o"></i> 
                            <font class='timeago' title="<?php echo $k['tgl_komentar'];?>">
                              <?php echo $k['tgl_komentar'];?>
                            </font>
                          </span>
                        </b>
                      </span>
                      <h4>
                      <?php echo $k['isi_komentar_tacit'];?>
                      </h4>
                      <div class="x_title"><div class="clearfix"></div></div> 
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

	<script type="text/javascript"  src="<?php echo base_url();?>asset/jquery.min.js"></script>
	<script src="<?php echo base_url();?>asset/jquery.timeago.js" type="text/javascript"></script>
	<script type="text/javascript">
		var $j = jQuery.noConflict();
		$j(document).ready(function() 
			{
				$j("font.timeago").timeago();
				$j("font.timeago1").timeago();
			});
	</script>