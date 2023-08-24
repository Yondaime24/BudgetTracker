<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['forgotPassBtn']))
  {
    $email=$_POST['email_address'];

    $query=mysqli_query($con, "insert into reset_password(email) value('$email')");
    if ($query) {
     echo "<script>alert('Success!, instructions on how to reset your password will be sent on your gmail account')</script>";
     echo "<script>window.open('index.php','_self')</script>";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}

  ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <title>Budget Tracker | Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/budget.png">
    <link rel="icon" type="image/png" href="images/budget.png">


    <!-- Bootstrap core CSS-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin.css" rel="stylesheet">

    <style>
      .error{
        color: red;
        font-style: italic;
      }
    </style>

  </head>

  <body class="bg-dark">

     <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Reset Password</div>
        <div class="card-body">
      
          <form id="reset" method="post" action="">

            <div class="form-group validate">
              <div class="form-label-group">
                <input type="email" id="inputPassword" class="form-control" placeholder="Email Address" name="email_address" autofocus="autofocus">
                <label for="inputPassword">Enter email address</label>
              </div>
            </div>

            <button  class="btn btn-primary btn-block" type="submit" name="forgotPassBtn">Reset Password</button>

          </form>

           <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Register an Account</a>
            <a class="d-block small" href="index.php">Login Page</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
     <!-- validators -->
    <script src="assets/vendor/jquery/jquery.validator.js"></script>
    <script src="assets/vendor/jquery/additional-methods.min.js"></script>
    <!-- !validators -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery/reset2.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
