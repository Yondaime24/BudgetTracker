<?php

  include('functions/functions.php');

  $sql2 = "SELECT sum(amount) AS total FROM budget WHERE user_id='".$_SESSION['user']['user_id']."'";
  $stmt2 = $db->query($sql2);
  $row1 = $stmt2->fetch_assoc();

  $sql3 = "SELECT sum(amount) AS total2 FROM expenses WHERE user_id='".$_SESSION['user']['user_id']."'";
  $stmt3 = $db->query($sql3);
  $row2 = $stmt3->fetch_assoc();

  if (!isLoggedIn()) {
    header('location: index.php');
  }

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <title>Budget Tracker | Add Expense</title>
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
        <div class="card-header"><i class="fas fa-fw fa-plus"></i> Add Expense</div>
        <div class="card-body">
          <div class="text-center mb-4">
            <img src="images/budget.png" width="50">
            <h4>Budget Tracker</h4>
          </div>

        <?php  
        if (empty($row1["total"])) {
        ?>

          <center>
           <h2>Please add budget first!</h2>
           <a class="btn btn-success btn-block" href="addBudget.php">Add Budget</a>
           <a class="btn btn-secondary btn-block" href="dashboard.php">Cancel</a>
          </center>

        <?php  
        }else if ($row1["total"] <= $row2["total2"]){
        ?>

         <center>
           <h2>Insufficient Budget!</h2>
           <span>Add budget now!</span>
           <a class="btn btn-success btn-block" href="addBudget.php">Add Budget</a>
           <a class="btn btn-secondary btn-block" href="dashboard.php">Cancel</a>
          </center>

        <?php
          }else{
        ?>

          <form id="addExpense" method="post" action="addExpense.php">

            <div class="form-group" hidden>
              <div class="form-label-group">
                <input type="text" id="user_id" class="form-control" placeholder="Amount" name="user_id" autofocus="autofocus" value="<?php echo $_SESSION['user']['user_id']; ?>">
                <label for="user_id">User ID</label>
              </div>
            </div>

            <div class="form-group validate">
              <div class="form-label-group">
                <input type="text" id="expenseName" class="form-control" placeholder="Expense Name" name="expensename" autofocus="autofocus" autocomplete="off">
                <label for="expenseName">Enter Expense Name</label>
              </div>
            </div>

            <div class="form-group validate">
              <div class="form-label-group">
                <input type="text" id="costAmount" class="form-control" placeholder="Cost" name="amount" autofocus="autofocus" autocomplete="off">
                <label for="costAmount">Enter Cost</label>
              </div>
            </div>

            <button  class="btn btn-primary btn-block" type="submit" name="costBtn">ADD</button>
            <a class="btn btn-secondary btn-block" href="dashboard.php">CANCEL</a>
          </form>

        <?php }?>

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
    <script src="assets/vendor/jquery/cost.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
