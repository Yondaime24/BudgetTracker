<?php
    
    include("functions/functions.php");

    $expense_id = $_GET['expense_id'];

    $query = "DELETE FROM `expenses` WHERE `expense_id` = $expense_id;";

     if (mysqli_query($db, $query)) {

        echo "<script>alert('Expense data has been deleted successfully!')</script>";
        echo "<script>window.open('viewExpenses.php','_self')</script>";
            
        }else{

        echo "<script>alert('Failed')</script>".mysqli_error($db);

        }

        mysqli_close($db);


if (!isLoggedIn()) {
  header('location: index.php');
}
    
?>