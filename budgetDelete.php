<?php
    
    include("functions/functions.php");

    $budget_id = $_GET['budget_id'];

    $query = "DELETE FROM `budget` WHERE `budget_id` = $budget_id;";

     if (mysqli_query($db, $query)) {

        echo "<script>alert('Budget data has been deleted successfully!')</script>";
        echo "<script>window.open('viewBudget.php','_self')</script>";
            
        }else{

        echo "<script>alert('Failed')</script>".mysqli_error($db);

        }

        mysqli_close($db);


if (!isLoggedIn()) {
  header('location: index.php');
}
    
?>