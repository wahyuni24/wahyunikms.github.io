<?php error_reporting(0); ?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title;?></title>
    <link rel="shortcut icon" href="<?php echo base_url();?>photo/puskom.png"/>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
     <link href="assets/css/materialicon.css" rel="stylesheet" type="text/css">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>asset/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url();?>asset/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url();?>asset/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url();?>asset/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo base_url();?>asset/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?php echo base_url();?>asset/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>asset/css/custom.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url();?>asset/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>asset/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script type="text/javascript">
      function confirmSubmit(){
        var agree=confirm("Apakah anda yakin ingin melanjutkan aksi ini?");
        if (agree)
          return true ;
        else
          return false ;
      }
    </script>


  </head>

  <body class="nav-md">
   <div class="container body">
    <?php foreach($pengguna->result_array() as $user)?>
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url();?>" class="site_title">
              <center><img src="<?php echo base_url();?>photo/puskom.png" height="50px"></img></center> 
              <!-- <span><b>IAIN Bengkulu</b></span> --></a>
            </div>
            <div class="clearfix"></div>
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">



                                <!--  TAMPILAN  PEGAWAI -->

                
                <?php if($user['hak_akses']=='1'){?></h3> <!-- As User -->
                <ul class="nav side-menu">
                  
                  <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-home"></span>&emsp;Halaman Utama</a>
                  </li>

                  <li><a href="<?php echo base_url('control/profil');?>"><span class="glyphicon glyphicon-user"></span>&emsp;Profil</a>
                  </li>

                  <li><a><span class="glyphicon glyphicon-edit"></span>&emsp;Knowledge Capture&emsp;&emsp;<span class="glyphicon glyphicon-chevron-down"></span></a>
                      <ul class="nav item-menu">
                      <li><a href="<?php echo base_url('control/input_dokumen');?>"><span class="glyphicon glyphicon-file"></span>&emsp;Knowledge Explicit </a>
                      </li>
                      <li><a href="<?php echo base_url('control/input_masalah_solusi'); ?>"><span class="glyphicon glyphicon-globe"></span>&emsp;Knowledge Tacit</a>
                      </li>
                    </ul>
                  </li>
                  <li><a><span class="glyphicon glyphicon-share-alt"></span>&emsp;Knowledge Sharing&emsp;&ensp;&ensp;<span class="glyphicon glyphicon-chevron-down"></span></a>
                      <ul class="nav item-menu">
                      <li>
                          <a href="<?php echo base_url('control/data_dokumen');?>"><span class="glyphicon glyphicon-file"></span>&emsp;Knowledge Explicit</a>
                      </li>
                      <li>
                          <a href="<?php echo base_url('control/data_masalah_solusi');?>"><span class="glyphicon glyphicon-globe"></span>&emsp;Knowledge Tacit</a>
                      </li>
                    </ul>
                  </li>
                  
                  <li>
                      <a href="<?php echo base_url('control/data_kasus'); ?>">
                        <span class="glyphicon glyphicon-tags"></span> 
                          &emsp;Knowledge Discovery<small class="label pull-right badge bg-green"></small>
                      </a>
                  </li>

                     <li>
                      <a>
                        <span class="glyphicon glyphicon-star"></span> 
                          &emsp;Pemecahan Masalah<small class="label pull-right badge bg-green" id="revisi"></small>
                      </a>
                  
				   <li class="nav child_menu">
				    <li class="nav item-menu">
                      <li>
						<a><font size="3">&emsp;&ensp;&ensp;Retrieve</font>&emsp;&ensp;&emsp;&ensp;&emsp;&ensp;&ensp;&emsp;<span class="glyphicon glyphicon-chevron-down"></span> <small class="label pull-right badge bg-green"></small></a>
						 <ul class="nav item-menu"> 
                             <li>
                              <a href="<?php echo base_url('control/problem_solving');?>"></i>Identify Feature</a>
                            </li>
                            <li>
                              <a href="<?php echo base_url('control/data_gejala');?>"></i>Initially Match</a>
                            </li>
                           </ul>
                      </li>
                      <li>
					
                        <a href="<?php echo base_url('control/revise'); ?>"> 
                        <font size="3">&emsp;&ensp;&ensp;Revise</font><small class="label pull-right badge bg-green" id="revisi1"></small>
                        </a>
                      </li>
					  </li>
                    </li>
					</li>
              </div>
            </div>
            <!-- /sidebar menu -->
            <?php } ?>

                                  <!--  TAMPILAN TENAGA AHLI -->


                <?php if($user['hak_akses']=='4'){?></h3> <!-- As (Expert) -->
                <ul class="nav side-menu">
                  
                  <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-home"></span>&emsp;Halaman Utama</a>
                  </li>

                 

                  <li><a><span class="glyphicon glyphicon-pencil"></span>&emsp;Knowledge Capture&emsp;&emsp;<span class="glyphicon glyphicon-chevron-down"></span></a>
                    <ul class="nav item-menu">
                      <li><a href="<?php echo base_url('control/input_dokumen');?>"><span class="glyphicon glyphicon-file"></span>&emsp;Knowledge Explicit </a>
                      </li>
                      <li><a href="<?php echo base_url('control/input_masalah_solusi'); ?>"><span class="glyphicon glyphicon-globe"></span>&emsp;Knowledge Tacit</a>
                      </li>
                    </ul>
                  </li>
                  <li><a><span class="glyphicon glyphicon-share-alt"></span>&emsp;Knowledge Sharing&emsp;&ensp;&ensp;<span class="glyphicon glyphicon-chevron-down"></span></a>
                    <ul class="nav item-menu">
                      <li>
                          <a href="<?php echo base_url('control/data_dokumen');?>"><span class="glyphicon glyphicon-file"></span>&emsp;Knowledge Explicit</a>
                      </li>
                      <li>
                          <a href="<?php echo base_url('control/data_masalah_solusi');?>"><span class="glyphicon glyphicon-globe"></span>&emsp;Knowledge Tacit</a>
                      </li>
                    </ul>
                  </li>
                  
                  <li>
                      <a href="<?php echo base_url('control/data_kasus'); ?>">
                        <span class="glyphicon glyphicon-tags"></span> 
                          &emsp;Knowledge Discovery<small class="label pull-right badge bg-green"></small>
                      </a>
                  </li>

                  <li>
                      <a>
                        <span class="glyphicon glyphicon-star"></span> 
                          &emsp;Pemecahan Masalah<small class="label pull-right badge bg-green" id="revisi"></small>
                      </a>
                  
				   <li class="nav child_menu">
				    <li class="nav item-menu">
                      <li>
						<a><font size="3">&emsp;&ensp;&ensp;Retrieve</font>&emsp;&ensp;&emsp;&ensp;&emsp;&ensp;&ensp;&emsp;<span class="glyphicon glyphicon-chevron-down"></span> <small class="label pull-right badge bg-green"></small></a>
						 <ul class="nav item-menu"> 
                             <li>
                              <a href="<?php echo base_url('control/problem_solving');?>"></i>Identify Feature</a>
                            </li>
                            <li>
                              <a href="<?php echo base_url('control/data_gejala');?>"></i>Initially Match</a>
                            </li>
                           </ul>
                      </li>
                      <li>
					
                        <a href="<?php echo base_url('control/revise'); ?>"> 
                        <font size="3">&emsp;&ensp;&ensp;Revise</font><small class="label pull-right badge bg-green" id="revisi1"></small>
                        </a>
                      </li>
					  </li>
                    </li>
					</li>
					
                  </li>

                  <li><a><span class="glyphicon glyphicon-user"></span>&emsp;Data Pegawai&emsp;&emsp;&emsp;&emsp;&ensp;<span class="glyphicon glyphicon-chevron-down"></span></a>
                    <ul class="nav item-menu">
                      <li>
                        <a href="<?php echo base_url('control/daftar_pegawai');?>"> Daftar Pegawai <i class="label pull-right fa fa-list"></i></a>
                      </li>
                      <li>
                        <a href="<?php echo base_url('control/input_pegawai');?>"> Input Pegawai <i class="label pull-right fa fa-upload"></i></a>
                      </li>
					  <li>
                        <a href="<?php echo base_url('control/data_bagian_kerja'); ?>"> Data Bidang Kerja Puskom</a>
                      </li>
                    </ul>
                  </li>

                  <li><a><span class="glyphicon glyphicon-check"></span>&emsp;Knowledge Validasi&emsp;&ensp;&ensp;<span class="glyphicon glyphicon-chevron-down"></span><small class="label pull-right badge bg-green" id="validasi"></small></a>
                   <ul class="nav item-menu">
                      <li>
                        <a href="<?php echo base_url('control/validasi_dokumen');?>"> Knowledge Validasi Explicit<small class="label pull-right badge bg-green" id="validasi_e"></small></a>
                      </li>
                      <li>
                        <a href="<?php echo base_url('control/validasi_masalah_solusi');?>"> Knowledge Validasi Tacit<small class="label pull-right badge bg-green" id="validasi_t"></small></a>
                      </li>
                    </ul>
                  </li>
				  
				   <li><a><span class="glyphicon glyphicon-print"></span>&emsp;Laporan Knowldege&emsp;&ensp;&nbsp;<span class="glyphicon glyphicon-chevron-down"></span></a>
                   <ul class="nav item-menu">
                      <li>
                        <a href="<?php echo base_url('control/cetak_explicit_laporan');?>"> Laporan Knowledge Explicit </a>
                      </li>
                      <li>
                        <a href="<?php echo base_url('control/cetak_tacit_laporan');?>">Laporan Knowledge Tacit</a>
                      </li>
                    </ul>
                  </li>

                </ul>
              </div>
                  
            </div>
            <!-- /sidebar menu -->
            <?php } ?>
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

          <div class="nav_menu">
            <nav class="" role="navigation">
              

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                     <img src="<?php echo base_url();?>photo/images/<?php echo $user['userfile'];?>"><?php echo $user['nama'];?>&ensp;
                    <span class="glyphicon glyphicon-cog"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url('control/profil');?>">Profil</a>
                    </li>
                    <li><a href="<?php echo base_url('control/logout');?>"><i class="glyphicon glyphicon-exit pull-right"></i> Log Out</a>
                    </li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
   
   
    <!--
                            
                    <li>
                      <div class="text-center">
                        <a href="<?php echo base_url('control/semua_notifikasi');?>">
                          <strong>See All Notification</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>-->
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">