<?php      
session_start();

$username = "";
$email    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'gents', 'truegents1', 'water_quality');

if (isset($_POST['create'])) {

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $branch = mysqli_real_escape_string($db, $_POST['branch']);
  $role = mysqli_real_escape_string($db, $_POST['role']);
  $suburb = mysqli_real_escape_string($db, $_POST['suburb']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password-1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password-2']);


  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($branch)) { array_push($errors, "Branch is required"); }
  if (empty($role)) { array_push($errors, "Role is required"); }
  if (empty($suburb)) { array_push($errors, "Suburb/Region is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($password_2)) { array_push($errors, "Password confirmation is required"); }  

  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  $user_check_query = "SELECT * FROM Users WHERE Username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['Username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password_1);

  	$query = "INSERT INTO Users (Username, Password, Branch, Role, Suburb) 
  			  VALUES('$username', '$password', '$branch', '$role', '$suburb')";
  	mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['confirmation'] = "You created an account successfully";
    header('location: login-portal.php');
  }
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM Users WHERE Username='$username' AND Password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: account.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
             
?>  

