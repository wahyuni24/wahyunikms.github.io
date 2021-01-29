    <div class="page-title">
      <div class="title_left">
        <h3>Tacit Knowledge</h3>
      </div>
    </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <table id="example2" class="table">
              <thead>
                <tr>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=1;
                foreach($tacit->result_array() as $data){ ?>
                <tr>
                  <td><br>
                    <div class="col-md-12 col-sm-6 col-xs-12">
                      <div class="x_panel fixed_height_10 ">
                        <div class="x_title">
                          <div class="x_content">
                          <h2><b>
                            <a href="<?php echo base_url('control/detail_masalah_solusi');?>/<?php echo $data['id_tacit'];?>">
                              <?php echo $data['judul_tacit'];?>
                            </a>
                          </h2></b>
                            <ul class="nav navbar-right panel_toolbox">
                              <a style="font-size:12px;color:gray" href="<?php echo base_url('control/pengguna');?>/<?php echo $data['id_pengguna'];?>"> 
                                <i class="fa fa-user"></i> 
                                <?php echo $data['nama'];?>
                              </a>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <a style="font-size:12px;color:gray">
                                <i class="fa fa-clock-o"></i> 
                                <font class='timeago' title="<?php echo $data['tgl_post'];?>">
                                  <?php echo $data['tgl_post'];?>
                                </font>
                              </a>
                            </ul>
                            </div>
                            <div class="clearfix"></div>
                            <div class="x_content">
                            <br>
                              <div class="timeline-body">
							  <h4>Kasus	:</h4>
                                <?php echo $data['masalah'];?>
                              </div>
                            <br>
                            </div>
                            <div class="clearfix"></div>
                              <h3 class="timeline-header"></h3>
                              <div class="timeline-footer">
                                <a href="<?php echo base_url('control/detail_masalah_solusi');?>/<?php echo $data['id_tacit'];?>" class="btn btn-round btn-primary btn-xs">
                                  LIHAT SOLUSI
                                </a>
                                <span style="float:right">
                                  <i class="glyphicon glyphicon-comments"></i> <?php echo $data['komentar'];?> komentar
                                </span>
                              </div>                    
                        </div>
                      </div>
                    </div>
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