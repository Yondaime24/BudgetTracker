<?php

  include('functions/functions.php');

  $expense_id = $_GET['expense_id'];

  if (!isLoggedIn()) {
    header('location: index.php');
  }

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <title>Budget Tracker | Edit Expense</title>
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
        <div class="card-header"><i class="fas fa-fw fa-edit"></i> Edit Expense</div>
        <div class="card-body">
          <div class="text-center mb-4">
            <img src="images/budget.png" width="50">
            <h4>Budget Tracker</h4>
          </div>

          <form id="updateExpenses" method="post" action="editExpenses.php">

            <?php
                $query=mysqli_query($db,"SELECT * FROM expenses WHERE expense_id='".$expense_id."'")or die(mysqli_error());
                  while($row=mysqli_fetch_array($query)){
            ?>

             <div class="form-group validate" hidden>
              <div class="form-label-group">
                <input type="text" id="budget_id" class="form-control" placeholder="Budget ID" name="expense_id" autofocus="autofocus" value="<?php echo $expense_id;?>">
                <label for="budget_id">Budget ID</label>
              </div>
            </div>

            <div class="form-group validate" hidden="">
              <div class="form-label-group">
                <input type="datetime" id="added" class="form-control" placeholder="Amount" name="date" autofocus="autofocus" value="<?php echo $row['date'];?>">
                <label for="added">Date Added</label>
              </div>
            </div>

             <div class="form-group validate">
              <div class="form-label-group">
                 <input type="text" id="expenseName" class="form-control text-center" placeholder="Expense Name" name="expensename" value="<?php echo $row['expensename'];?>" autofocus="autofocus">
                <label for="expenseName">Expese Name:</label>
              </div>
            </div>

            <div class="form-group validate">
              <div class="form-label-group">
                 <input type="text" id="budgetAmount" class="form-control text-center" placeholder="Amount" name="amount" value="<?php echo $row['amount'];?>" autofocus="autofocus">
                <label for="budgetAmount">Amount:</label>
              </div>
            </div>

             <?php }?>

            <button  class="btn btn-primary btn-block" type="submit" name="updateExpenses">UPDATE</button>
            <a class="btn btn-secondary btn-block" href="viewExpenses.php">CANCEL</a>
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
    <script src="assets/vendor/jquery/updateExpense.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
