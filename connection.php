<?php    

//start session
session_start();

//initialise username, email and errors array
$username = "";
$email    = "";
$update = false;
$errors = array(); 

//connect to DB
$db = mysqli_connect('localhost', 'gents', 'truegents1', 'water_quality');

//public chooses to flag water body for quality check by government
if (isset($_POST['submit-flag'])) {
  $latitude = mysqli_real_escape_string($db, $_POST['latitude']);
  $longitude = mysqli_real_escape_string($db, $_POST['longitude']);
  $description = mysqli_real_escape_string($db, $_POST['flag-description']);


  //ensure that fields are not left empty
  if (empty($latitude)) { 
    array_push($errors, "Latitude is required"); 
  }
  if (empty($longitude)) { 
    array_push($errors, "Longitude is required");
   }
  if (empty($description)) { 
    array_push($errors, "Description of flagging is required"); 
  }
  
  if (count($errors) == 0) {

    $flag_query = "INSERT INTO Sites (Latitude, Longitude, Description) 
            VALUES('$latitude', '$longitude', '$description')";
    mysqli_query($db, $flag_query);

    $_SESSION['flag-success'] = "You have flagged a location successfully";
    
    header('location: index.php');
  }
}

//public chooses to report issue
if (isset($_POST['submit-issue'])) {
  $description = mysqli_real_escape_string($db, $_POST['report-description']);

  //ensure that field is not left empty
  if (empty($description)) { 
    array_push($errors, "Description of issue is required"); 
  }
  
  if (count($errors) == 0) {

    $issue_query = "INSERT INTO Issues (IssueDesc) 
            VALUES('$description')";
    mysqli_query($db, $issue_query);

    $_SESSION['issue-success'] = "You have reported an issue successfully";
    
    header('location: index.php');
  }
}

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $update = true;
  $user_check_query = "SELECT * FROM Sites WHERE CheckID=$id LIMIT 1";
  $result = mysqli_query($db, $user_check_query);

  if(count($result)==1) {
    $row = $result->fetch_array();
    $teststatus = $row['TestStatus'];
    $testranking = $row['Ranking'];
    $equipment = $row['Equipment'];
  }

}

if(isset($_POST['submit-gov'])) {
  $id = $_POST['id'];
  $teststatus = $_POST['test-status'];
  $testranking = $_POST['water-ranking'];
  $equipment = $_POST['equipment'];

  $edit_query = "UPDATE Sites SET TestStatus='$teststatus', Ranking='$testranking',
  Equipment='$equipment' WHERE CheckID=$id";
  mysqli_query($db, $edit_query);

  $_SESSION['message'] = "Record has been saved";
  header('location: account.php');
}

//government user attempts to create account
if (isset($_POST['create'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $branch = mysqli_real_escape_string($db, $_POST['branch']);
  $role = mysqli_real_escape_string($db, $_POST['role']);
  $suburb = mysqli_real_escape_string($db, $_POST['suburb']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password-1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password-2']);


  //ensure that fields are not left empty
  if (empty($username)) { 
    array_push($errors, "Username is required"); 
  }
  if (empty($branch)) { 
    array_push($errors, "Branch is required");
   }
  if (empty($role)) { 
    array_push($errors, "Role is required"); 
  }
  if (empty($suburb)) { 
    array_push($errors, "Suburb/Region is required");
  }
  if (empty($password_1)) { 
    array_push($errors, "Password is required"); 
  }
  if (empty($password_2)) {
     array_push($errors, "Password confirmation is required"); 
  }  
  
  //ensure passwords match
  if ($password_1 != $password_2) {
	  array_push($errors, "The two passwords do not match");
  }

  $user_check_query = "SELECT * FROM Users WHERE Username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  //check that username is unique
  if ($user) { 
    if ($user['Username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  if (count($errors) == 0) {

    //encrypt user password before insertion into DB
  	$password = md5($password_1);

  	$query = "INSERT INTO Users (Username, Password, Branch, Role, Suburb) 
  			  VALUES('$username', '$password', '$branch', '$role', '$suburb')";
    mysqli_query($db, $query);
    
    //establish username in session
    $_SESSION['username'] = $username;
    $_SESSION['confirmation'] = "You created an account successfully";
    header('location: create-account.php');
  }
}

//login authentication process
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    //only able to log in if no errors arise
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM Users WHERE Username='$username' AND Password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";

          //redirect to user's dashboard
          header('location: account.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
             
?>  

