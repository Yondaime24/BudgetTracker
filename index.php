<?php

  include('functions/functions.php');

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <title>Budget Tracker | Login</title>
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
        <div class="card-header">Login</div>
        <div class="card-body">
          <div class="text-center mb-4">
            <img src="images/budget.png" width="50">
            <h4>Budget Tracker</h4>
          </div>
<center>
  <p style="font-size:16px; color:red;" align="center"><?php echo display_error(); ?></p>
</center>
          <form id="login" method="post" action="index.php">

           <div class="form-group validate">
              <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" autofocus="autofocus" autocomplete="off">
                <label for="inputEmail">Username</label>
              </div>
            </div>

            <div class="form-group validate">
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
                <label for="inputPassword">Password</label>
              </div>
            </div>

            <button  class="btn btn-primary btn-block" type="submit" name="loginBtn">Login</button>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Register an Account</a>
            <a class="d-block small" href="forgot_password.php">Forgot Password?</a>
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
    <script src="assets/vendor/jquery/login.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
