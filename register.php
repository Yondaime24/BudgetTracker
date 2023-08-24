<?php  
  
  include('functions/functions.php');

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <title>Budget Tracker | Register</title>
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
    <link href="assets/css/eye.css" rel="stylesheet">

    <style>
      .error{
        color: red;
        font-style: italic;
      }
    </style>

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <div class="card-body">

          <form id="register" method="post" action="">

            <div class="form-group validate">
              <div class="form-label-group">
                <input type="text" id="inputFullName" class="form-control" placeholder="Full Name" autofocus="autofocus" name="name" autocomplete="off">
                <label for="inputFullName">Enter Full Name</label>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="contactNumber" class="form-control" placeholder="Contact Number" autofocus="autofocus" name="contact_number" autocomplete="off"> 
                    <label for="contactNumber">Enter Contact Number</label>
                  </div>
                </div>
                <div class="col-sm-6 validate">
                  <label for="input-type">Select Gender:</label>
                  <div id="input-type" class="row">
                    <div class="col-sm-6">
                      <label class="radio-inline" style="margin-left: 50px;">
                        <input type="radio" name="gender" value="Male"> Male
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <label class="radio-inline">
                        <input type="radio" name="gender" value="Female"> Female
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="email" id="emailAddress" class="form-control" placeholder="Email Address" autofocus="autofocus" name="email_address" autocomplete="off"> 
                    <label for="emailAddress">Enter Email Address</label>
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="userName" class="form-control" placeholder="Username" name="username" autocomplete="off">
                    <label for="userName">Enter Username</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                   <input style="height: 50px;" type="password" id="passWord" class="form-control" placeholder="Password" name="password">
                    <label for="passWord">Enter Password</label>
                    <div class="input-group-append">
                        <span><i class="fas fa-eye eye1" id="eye" onclick="toggle1()"></i></span>
                    </div>
                  </div>
               </div>
                 <div class="col-md-6 validate">
                   <div class="form-label-group">
                    <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="input-group-append">
                       <span><i class="fas fa-eye eye2" id="eye2" onclick="toggle2()"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button class="btn btn-primary btn-block" type="submit" name="registerBtn">Register</button>
          </form>

          <div class="text-center">
            <a class="d-block small mt-3" href="index.php">Login Page</a>
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
    <script src="assets/vendor/jquery/register.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script>
    var state=false;
    function toggle1(){
      if (state) {
        document.getElementById("passWord").setAttribute("type","password");
        document.getElementById("eye").style.color='#3498db';
        state = false;
      }else{
        document.getElementById("passWord").setAttribute("type","text");
        document.getElementById("eye").style.color='#2ecc71';
        state = true;
      }
    }
  </script>

  <script>
    var state2=false;
    function toggle2(){
      if (state2) {
        document.getElementById("confirm_password").setAttribute("type","password");
        document.getElementById("eye2").style.color='#3498db';
        state2 = false;
      }else{
        document.getElementById("confirm_password").setAttribute("type","text");
        document.getElementById("eye2").style.color='#2ecc71';
        state2 = true;
      }
    }
  </script>

  </body>

</html>
