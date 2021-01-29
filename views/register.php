<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "puskom";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

    if(isset($_POST['save'])){
        $sql = "INSERT INTO users (username, password, email)
        VALUES ('".$_POST["username"]."','".$_POST["password"]."','".$_POST["email"]."')";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="<?php echo base_url();?>foto/puskom.png"/>
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
</head>

  <body>
        <form method="post"> 
    <label id="first"> First name:</label><br/>
    <input type="text" name="username"><br/>

    <label id="first">Password</label><br/>
    <input type="password" name="password"><br/>

    <label id="first">Email</label><br/>
    <input type="text" name="email"><br/>

    <button type="submit" name="save">save</button>
    <button type="submit" name="get">get</button>
    </form>
    <div class="limiter">

      <div id="wrapper" class="container-login100">
        <div id="login" class="wrap-login100 p-t-85 p-b-20">
          <section class="login_content">
            
            <center><img src="<?php echo base_url();?>foto/puskom.png" width="250px"></center>
            <br>

            <form action="<?php echo base_url();?>control/masuk" method="post" enctype="multipart/form-data" class="login100-form validate-form">

              
              
              <div class="wrap-input100 validate-input m-t-0 m-b-35" data-validate = "Enter username">
                <input type="text" name="nip"  required="" class="input100"/>
                <span class="focus-input100" data-placeholder="Username"></span>
              </div>

              <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                <input type="password" name="password" class="input100"  required="" />
                <span class="focus-input100" data-placeholder="Password"></span>
              </div>
              
              <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                        Login
                </button>
             </div>
              
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