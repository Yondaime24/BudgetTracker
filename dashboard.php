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

    <title>Budget Tracker | Dashboard</title>
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
    <link href="assets/css/chart.css" rel="stylesheet">
     

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
        <li class="nav-item active">
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

        <li class="nav-item dropdown">
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

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-6 col-sm-7 mb-4">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-money-bill-wave"></i>
                  </div>

                <?php
                  if(empty($row1["total"])){
                    ?>
                    <div class="mr-5 text-center">Please add budget first!</div>
                  <?php
                    }else{
                  ?>
                    <div class="mr-5 text-center">&#8369; <?php echo $row1["total"] ?> Total Budget!</div>
                  </ul>
                    <?php }
                  ?> 

                </div>
                <a class="card-footer text-white clearfix small z-1" href="#" data-toggle="modal" data-target="#totalBudget">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-6 col-sm-7 mb-4">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-money-bill-wave"></i>
                  </div>

                 <?php
                  if(empty($row2["total2"])){
                    ?>
                    <div class="mr-5 text-center">Please add expenses first!</div>
                  <?php
                    }else{
                  ?>
                    <div class="mr-5 text-center">&#8369; <?php echo $row2["total2"] ?> Total Expenses!</div>
                  </ul>
                    <?php }
                 ?> 

                </div>
                <a class="card-footer text-white clearfix small z-1" href="#" data-toggle="modal" data-target="#totalExpenses">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

          	<input type="text" id="budget" class="form-control" value="<?php echo $row1["total"] ?>" readonly hidden>
          	<input type="text" id="expense" class="form-control" value="<?php echo $row2["total2"] ?>" readonly hidden>

       <?php 
       if (empty($row1["total"])) {
          echo " 
          <center>
            <input class=\"emptyBudgetExpense\" value=\"Please add budget first!\">
          </center>
          ";
       }else if (empty($row2["total2"])) {
          echo " 
          <center>
            <input class=\"emptyBudgetExpense\" value=\"Please add expense first!\">
          </center>
          ";
       }else if ($row1["total"] == $row2["total2"]) {
           echo " 
            <center>
              <input class=\"emptyBudgetExpense\" value=\"Budget & Expenses Now Equal!\">
            </center>
            ";
       }else{
         echo " 
          <div class=\"form-group\">
            <div class=\"form-row\">
              <div class=\"col-md-12\">
                <div class=\"form-label-group\">
                    <input type=\"text\" id=\"balance\" class=\"form-control balance\" style=\"height: 110px;\" readonly>
                    <div class=\"text-center\">
                      <b style=\"margin-right: 20px;\">Remaining Balance</b>
                    </div>
                </div>
              </div>
            </div>
          </div>
          ";
       }
       ?>

        <center>
          <a href="" style="pointer-events: none;">
        <?php if (isset($_SESSION['success'])) : ?>
           <div class="error success" >
            <h4 style="color: #3498db">
              <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
              ?>
              <?php  if (isset($_SESSION['user'])) : ?>
              <strong><?php echo $_SESSION['user']['name']; ?></strong>
             <?php endif ?>!!!
            </h4>
          </div>
        <?php endif ?>            
          </a>
         </center>

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

      <!-- Logout Modal-->
    <div class="modal fade" id="totalBudget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 550px">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Total Budget</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="card mb-3">
            <div class="card-body">
              <div class="table-responsive">
                  <?php                
                  $query = "SELECT * FROM budget WHERE user_id='".$_SESSION['user']['user_id']."'";
                  $result = mysqli_query($db,$query);
                ?>  

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Date Added</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Overall Total</th>
                      <th>&#8369;<?php echo $row1["total"] ?></th>
                    </tr>
                  </tfoot>
                  <tbody>
              <?php
                    if($result){
                      while($res = mysqli_fetch_array($result)) {     
                        echo "<tr>";
                        echo "<td>".date('F j, Y',strtotime($res['date_added']))."</td>";
                        echo "<td>&#8369; ".$res['amount']."</td>";
                        echo "</tr>";                                   
                      }
                    }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
            <a class="btn btn-primary btn-sm" href="viewBudget.php">View Budgets</a>
          </div>
        </div>
      </div>
    </div>

      <!-- Logout Modal-->
    <div class="modal fade" id="totalExpenses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 550px">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Total Expenses</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="card mb-3">
            <div class="card-body">
              <div class="table-responsive">
                  <?php                
                  $query = "SELECT * FROM expenses WHERE user_id='".$_SESSION['user']['user_id']."'";
                  $result = mysqli_query($db,$query);
                ?>  

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Expense Name</th>
                      <th>Date Added</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Overall Total</th>
                      <th></th>
                      <th>&#8369;<?php echo $row2["total2"] ?></th>
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
                        echo "</tr>";                                   
                      }
                    }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
            <a class="btn btn-primary btn-sm" href="viewExpenses.php">View Expenses</a>
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

    <script src="assets/js/easypiechart.js"></script>
    <script src="assets/js/easypiechart-data.js"></script>

  </body>

</html>

