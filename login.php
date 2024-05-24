<?php
session_start();


include 'database.php';

if(isset($_SESSION['auth'])){
    $_SESSION['status']="you are already logged in";
    header('location:index.php');
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>[Admin] ALPHA NERO - Admin Login</title>
  <style>
    #submitbtn:hover{
      background-color: black!important;
    }
  </style>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="media/ADIPEC-favicon.png">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  
  <div class="card card-outline card-primary" style="border-top: 4px solid #b28250;">
    <div class="card-header text-center">
    <img src="assets/images/logo-noir.png" alt="ADIPEC's Logo"  style="opacity: .8; padding-bottom:15px;height:100px!important">
     <!-- <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>-->
    </div>
    <div class="card-body" style="font-family: 'Nexa', sans-serif !important;"> 
      <p class="login-box-msg">Enter your Username and Password to Login</p>

      <form action="logincode.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="username" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
         
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">

        <!-- message.php file included-->
        <?php include 'message.php' ?>
          <!--<input type="password" name="password" class="form-control" placeholder="Password">

          <div class="input-group-append">
              <div class="input-group-text">
            <span class="fas fa-lock"></span>
            </div>
          </div>-->
        </div>
     
        <br>
       
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
         
        </div>


               <div class="icheck-primary">
           <!--   <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>-->
            </div>
          </div>
          
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name = "submit" class="btn btn-primary btn-block" id="submitbtn" style="margin-left:-120px;background-color:#b28250;border-color:#b28250">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
<!--
      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>-->
      <!-- /.social-auth-links -->

      <p class="mb-1">
       <!-- <a href="forgot-password.html">I forgot my password</a>-->
      </p>
      <p class="mb-0">
      <!--  <a href="register.html" class="text-center">Register a new membership</a>-->
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  <!-- /.message file included -->
<br>
 
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
