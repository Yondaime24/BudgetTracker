<?php  
  
  include('functions/functions.php');

   $user_id = $_GET['user_id'];

  if (!isLoggedIn()) {
    header('location: index.php');
  }

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <title>Budget Tracker | Edit Profile</title>
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
        <div class="card-header">Edit Profile Details</div>
        <div class="card-body">

          <form id="register" method="post" action="">

            <?php
                $query=mysqli_query($db,"SELECT * FROM user WHERE user_id='".$_SESSION['user']['user_id']."'")or die(mysqli_error());
                  while($row=mysqli_fetch_array($query)){
            ?>

            <div class="form-group validate" hidden="">
              <div class="form-label-group">
                <input type="text"  class="form-control" placeholder="Full Name" name="user_id" value="<?php echo $_SESSION['user']['user_id'] ?>">
              </div>
            </div>

            <div class="form-group validate">
              <div class="form-label-group">
                <input type="text" id="inputFullName" class="form-control" placeholder="Full Name" name="name" value="<?php echo $_SESSION['user']['name'] ?>">
                <label for="inputFullName">Full Name:</label>
              </div>
            </div>

              <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="contactNumber" class="form-control" placeholder="Contact Number" name="contact_number" value="<?php echo $_SESSION['user']['contact_number'] ?>"> 
                    <label for="contactNumber">Contact Number:</label>
                  </div>
                </div>
                  <div class="col-sm-6 validate">
                  <label for="input-type">Gender:</label>
                  <div id="input-type" class="row">
                    <div class="col-sm-6">
                      <label class="radio-inline" style="margin-left: 50px;">
                        <input type="radio" name="gender" value="Male"

                        <?php  

                          if ($_SESSION['user']['gender'] == 'Male') {
                            echo "checked";
                          }

                        ?>

                        > Male
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <label class="radio-inline">
                        <input type="radio" name="gender" value="Female"

                        <?php  

                          if ($_SESSION['user']['gender'] == 'Female') {
                            echo "checked";
                          }

                        ?>

                        > Female
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
                    <input type="email" id="emailAddress" class="form-control" placeholder="Email Address" name="email_address" value="<?php echo $_SESSION['user']['email_address'] ?>"> 
                    <label for="emailAddress">Email Address:</label>
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="userName" class="form-control" placeholder="Username" name="username"  value="<?php echo $_SESSION['user']['username'] ?>">
                    <label for="userName">Username: </label>
                  </div>
                </div>
              </div>
            </div>


            <?php }?>

            <button class="btn btn-primary btn-block" type="submit" name="updateprofileBtn">UPDATE</button>
             <a class="btn btn-secondary btn-block" href="profile.php">CANCEL</a>
          </form>
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

  </body>

</html>
