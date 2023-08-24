<?php

include('functions/functions.php');

  $sql2 = "SELECT sum(amount) AS total FROM expenses WHERE user_id='".$_SESSION['user']['user_id']."'";
  $stmt2 = $db->query($sql2);
  $row1 = $stmt2->fetch_assoc();

if (!isLoggedIn()) {
	header('location: index.php');
}

?>
   
<!DOCTYPE html>
<html lang="en">

  <head>

    <title>Budget Tracker | View Expenses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/budget.png">
    <link rel="icon" type="image/png" href="images/budget.png">

    <!-- Bootstrap core CSS-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/balance5.css" rel="stylesheet">
    <link href="assets/css/empty.css" rel="stylesheet">
     

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a style="background: white; color: black; width: 200px; border-radius: 50px; text-align: center;" class="navbar-brand mr-1" href="dashboard.php"><img src="images/budget.png" width="20"> Budget Tracker</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" style="visibility: hidden;">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw fa-lg"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="profile.php">Profile</a>
             <a class="dropdown-item" href="changePassword.php">Change Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Budget</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
           <a class="dropdown-item" href="viewBudget.php"><i class="fas fa-fw fa-table"></i> View Budgets</a>
            <div class="dropdown-divider"></div>
           <a class="dropdown-item" href="addBudget.php"><i class="fas fa-fw fa-plus"></i> Add Budget</a>
          </div>
        </li>

        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Expenses</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
           <a class="dropdown-item" href="viewExpenses.php"><i class="fas fa-fw fa-table"></i> View Expenses</a>
            <div class="dropdown-divider"></div>
           <a class="dropdown-item" href="addExpense.php"><i class="fas fa-fw fa-plus"></i> Add Expense</a>
          </div>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

        <div class="container-fluid">
      <div class="card mb-3">
          <div class="card-header">
              <i class="fas fa-table"></i>
              Expenses Table</div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
                                     
                  $query = "SELECT * FROM expenses WHERE user_id='".$_SESSION['user']['user_id']."'  ORDER BY date ASC";
                  $result = mysqli_query($db,$query);
                
                ?>  
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Expense Name</th>
                      <th>Date Added</th>
                      <th>Amount</th>
                      <th style="width: 100px;">Option</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Overall Total:</th>
                      <th></th>
                      <th>&#8369; <?php echo $row1["total"] ?></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    if($result){
                      while($res = mysqli_fetch_array($result)) {     
                        echo "<tr>";
                        echo "<td>".$res['expensename']."</td>";
                        echo "<td>".date('F j, Y',strtotime($res['date']))."</td>";
                        echo "<td>&#8369; ".$res['amount']."</td>";
                        echo "<td>
                                <a class=\"btn btn-sm btn-block btn-outline-primary\" href=\"editExpenses.php?expense_id=$res[expense_id]\"><i class=\"fas fa-fw fa-edit\"></i> EDIT</a> 
                                  <a class=\"btn btn-outline-danger btn-sm btn-block\" onClick=\"return confirm('Are you sure you want to delete this expense?' )\" href=\"expenseDelete.php?expense_id=$res[expense_id]\"><i class=\"fas fa-fw fa-trash\" ></i> DELETE</a>
                              </td>";
                        echo "</tr>";                                   
                      }
                    }?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
      </div> 

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>© Budget Tracker 2021 | Coded by: Rhen Heart Gatera</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="dashboard.php?logout='1'">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="assets/js/demo/datatables-demo2.js"></script>
    <script src="assets/js/demo/chart-area-demo.js"></script>

    <script src="assets/js/balance.js"></script>

  </body>

</html>

