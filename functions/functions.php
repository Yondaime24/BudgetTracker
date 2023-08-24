<?php  
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'budgettracker');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['registerBtn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$name = e($_POST['name']);
	$contact_number = e($_POST['contact_number']);
	$gender = e($_POST['gender']);
	$email_address = e($_POST['email_address']);
	$username = e($_POST['username']);
	$password = e($_POST['password']);
	$confirm_password = e($_POST['confirm_password']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email_address)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password != $confirm_password) {
		array_push($errors, "The two passwords do not match");
	}

	// $ret=mysqli_query($con, "select email_address from user where email_address='$email_address' ");
 //    $result=mysqli_fetch_array($ret);
 //    if($result>0){
	// 	$msg="This email  associated with another account";
 //    }

	 	$sqlCheckUsername = "SELECT * FROM `user` WHERE `username` LIKE '$username' ";
        $usernameQuery = mysqli_query($db,$sqlCheckUsername);

        $sqlCheckEmail = "SELECT * FROM `user` WHERE `email_address` LIKE '$email_address' ";
        $emailQuery = mysqli_query($db,$sqlCheckEmail);

        if(mysqli_num_rows($usernameQuery)>0){

            echo "<script>alert('Username is Already Used, Type Another One!')</script>";
            echo "<script>window.open('register.php','_self')</script>";

        }else if (mysqli_num_rows($emailQuery)>0) {

            echo "<script>alert('This Email is Already Registered Type Another One!')</script>";
            echo "<script>window.open('register.php','_self')</script>";


	// register user if there are no errors in the form
	}else if (count($errors) == 0) {
		$password = md5($password);//encrypt the password before saving in the database

		if (isset($_POST['name'])) {
			$name = e($_POST['name']);
			$query = "INSERT INTO user (name, contact_number, gender, email_address, username, password, status) 
					  VALUES('$name', '$contact_number', '$gender', '$email_address', '$username', '$password', 'active')";
			mysqli_query($db, $query);
			echo "<script>alert('Account Successfully Created!')</script>";
        	echo "<script>window.open('index.php','_self')</script>";
		}else{
			$query = "INSERT INTO user (name, contact_number, gender, email_address, username, password, status) 
					  VALUES('$name', '$contact_number', '$gender', '$email_address', '$username', '$password', 'active')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "Welcome";
			echo "<script>alert('Account Successfully Created!')</script>";			
		}
	}
}


// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM user WHERE user_id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: index.php");
}

// call the login() function if register_btn is clicked
if (isset($_POST['loginBtn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM user WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['status'] == 'active') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "Welcome";
				header('location: dashboard.php');		  
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

if (isset($_POST['budegtBtn'])) {
	budget();
}

function budget(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
    $amount = $_POST['amount'];

		$query = "INSERT INTO budget (`user_id`, `amount`, `date_added`)VALUES('$user_id', '$amount', CURRENT_TIMESTAMP)";
		mysqli_query($db, $query);

		echo "<script>alert('Budget amount has been added succesfully!')</script>";
        echo "<script>window.open('dashboard.php','_self')</script>";
		
}

if (isset($_POST['costBtn'])) {
	expense();
}

function expense(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
    $expensename = $_POST['expensename'];
    $amount = $_POST['amount'];

		$query = "INSERT INTO expenses (`user_id`, `expensename`, `date`, `amount`)VALUES('$user_id', '$expensename', CURRENT_TIMESTAMP, '$amount')";
		mysqli_query($db, $query);

		echo "<script>alert('Expense cost has been added succesfully!')</script>";
        echo "<script>window.open('dashboard.php','_self')</script>";
		
}

if (isset($_POST['updateBudget'])) {
	budgetUpdate();
}

function budgetUpdate(){

	global $db, $errors, $username, $email;

	$budget_id = $_POST['budget_id'];
    $date_added = $_POST['date_added'];
    $amount = $_POST['amount'];

	$query="UPDATE `budget` SET `amount`='$amount',`date_added`='$date_added' WHERE budget_id='$budget_id'";
    $query_run = mysqli_query($db, $query);


     if ($query_run) {
      echo "<script>alert('Update Success!!!')</script>";
      echo "<script>window.open('viewBudget.php','_self')</script>";
     }else{

      echo "<script>alert('Update Failed!')</script>";
      echo "<script>window.open('viewBudget.php','_self')</script>";

     }
		
}

if (isset($_POST['updateExpenses'])) {
	expenseUpdate();
}

function expenseUpdate(){

	global $db, $errors, $username, $email;

	$expense_id = $_POST['expense_id'];
    $expensename = $_POST['expensename'];
    $amount = $_POST['amount'];

	$query="UPDATE `expenses` SET `expensename`='$expensename',`amount`='$amount' WHERE expense_id='$expense_id'";
    $query_run = mysqli_query($db, $query);


     if ($query_run) {
      echo "<script>alert('Update Success!!!')</script>";
      echo "<script>window.open('viewExpenses.php','_self')</script>";
     }else{

      echo "<script>alert('Update Failed!')</script>";
      echo "<script>window.open('viewExpenses.php','_self')</script>";

     }
		
}


if (isset($_POST['updateprofileBtn'])) {
	profileUpdate();
}

function profileUpdate(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $contact_number = $_POST['contact_number'];
    $gender = $_POST['gender'];
    $email_address = $_POST['email_address'];
    $username = $_POST['username'];

	$query="UPDATE `user` SET `name`='$name',`contact_number`='$contact_number',`gender`='$gender',`email_address`='$email_address',`username`='$username' WHERE user_id='$user_id'";
    $query_run = mysqli_query($db, $query);


     if ($query_run) {
      session_destroy();
      session_unset();
      echo "<script>alert('Update Success!!!')</script>";
      echo "<script>alert('In order for this changes to take effect you need to login again!')</script>";
      echo "<script>window.open('index.php','_self')</script>";
     }else{

      echo "<script>alert('Update Failed!')</script>";
      echo "<script>window.open('profile.php','_self')</script>";

     }
		
}

if (isset($_POST['updatePass'])) {
	passwordUpdate();
}

function passwordUpdate(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
    $password = $_POST['password'];

    $password = md5($password);

	$query="UPDATE `user` SET `password`='$password' WHERE user_id='$user_id'";
    $query_run = mysqli_query($db, $query);


     if ($query_run) {
      session_destroy();
      session_unset();
      echo "<script>alert('Update Success!!!')</script>";
      echo "<script>alert('In order for this changes to take effect you need to login again!')</script>";
      echo "<script>window.open('index.php','_self')</script>";
     }else{

      echo "<script>alert('Update Failed!')</script>";
      echo "<script>window.open('profile.php','_self')</script>";

     }
		
}

?>