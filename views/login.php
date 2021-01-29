<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="<?php echo base_url();?>photo/puskom.png"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/css/main.css">
<!--===============================================================================================-->
	<style>
	.btn_style{
		border: 1px solid #cecece;
		border-radius: 3px;
		padding: 3px 10px;
		box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
		color: white;
		background-color: green;
	}
	.btn_style:hover{
		border: 1px solid #b1b1b1;
		box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
	}
	</style>
</head>

  <body>
    <div class="limiter" align="center">

      <div id="wrapper" class="container-login100">
        <div id="login" class="wrap-login100 p-t-85 p-b-20">
          <section class="login_content">
            
			
            <center><img src="<?php echo base_url();?>photo/puskom.png" width="250px"></center>
            <br>
			<center><h5 style="line-height:2em;"><b>Knowledge Management System (KMS) pada bagian Pusat Komputer (PUSKOM) IAIN Bengkulu</h5></center>
			<br><br>
            <form action="<?php echo base_url();?>control/home" method="post" enctype="multipart/form-data" class="login100-form validate-form">

              
              
              <div class="wrap-input100 validate-input m-t-0 m-b-35" data-validate = "Enter username/NIP">
                <input type="text" name="nip"  required="" class="input100"/>
                <span class="focus-input100" data-placeholder="Username/NIP"></span>
              </div>

              <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                <input type="password" name="password" class="input100"  required="" />
                <span class="focus-input100" data-placeholder="Password"></span>
              </div>
			  
      <button class="btn_style btn btn-dark btn-lg btn-lg btn-block btn-outline-dark btn-pill login-btn">
                        Login
                </button>
              <div class="clearfix"></div>
              <div class="separator">
                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <div id="dropDownSelect1"></div>
  
  <!--===============================================================================================-->
    <script src="<?php echo base_url();?>asset/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
    <script src="<?php echo base_url();?>asset/vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
    <script src="<?php echo base_url();?>asset/vendor/bootstrap/js/popper.js"></script>
    <script src="<?php echo base_url();?>asset/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
    <script src="<?php echo base_url();?>asset/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
    <script src="<?php echo base_url();?>asset/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url();?>asset/vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
    <script src="<?php echo base_url();?>asset/vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
    <script src="<?php echo base_url();?>asset/js/main.js"></script>
  </body>
</html>