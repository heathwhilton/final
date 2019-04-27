<?php
  // checklogin.php - 3/24/2011 - Steve Hadfield 
  // Shows how to check a login userEmail and password 

  session_start();  // link to session info

  // check if userEmail and password were sent

  if ( (isset($_POST['myusername'])) && (isset($_POST['mypassword'])) )
  {     // authentication check

    // open connection to the database on LOCALHOST with 
    // userid of 'root', password of '', and database 'web'

    @ $db = new mysqli('LOCALHOST', 'root', '', 'web');

    // Check if there were error and if so, report and exit

    if (mysqli_connect_errno()) 
    { 
      echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
      exit;
    }

    // sanitize the input from the form to eliminate possible SQL Injection

    $myusername = stripslashes($_POST['myusername']);
    $myusername = $db->real_escape_string($myusername);

    $mypassword = stripslashes($_POST['mypassword']);
    $mypassword = $db->real_escape_string($mypassword);

    // encrypt the password with MD5

    $mypassword = md5($mypassword);

    // check that userEmail / password pair exists

    $checkQuery = "SELECT * FROM USERS WHERE (userEmail = ?) AND (userPassword = ?)";

    $checkStmt = $db->prepare($checkQuery);

    $checkStmt->bind_param("ss", $myusername, $mypassword);

    $checkStmt->execute();

    $checkStmt->store_result();

    // check for SQL error or if userEmail/password pair does not exist

    if ( ($checkStmt->errno <> 0) || ($checkStmt->num_rows == 0) )
    {
      $checkStmt->close();
      header("location:login.php?err=1");
      exit;
    }

    // login was successful

    $checkStmt->close();

    // set session variable for user name

    $_SESSION['myusername']=$_POST['myusername'];
    header("location:edit.php"); 
    exit;
    }
  else  // userEmail and/or password were not sent
  {
    header("location:login.php?err=2");
    exit;
  }

?>