<?php
  // checklogin.php - 3/24/2011 - Steve Hadfield 
  // Shows how to check a login username and password 

  session_start();  // link to session info

  // check if username and password were sent

  if ( (isset($_POST['myusername'])) && (isset($_POST['mypassword'])) )
  {     // authentication check

    // open connection to the database on LOCALHOST with 
    // userid of 'root', password of '', and database 'csl'

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

    // check that username / password pair exists

    $checkQuery = "SELECT * FROM STUDENT WHERE (email = ?) AND (password = ?)";

    $checkStmt = $db->prepare($checkQuery);

    $checkStmt->bind_param("ss", $myusername, $mypassword);

    $checkStmt->execute();

    $checkStmt->store_result();

    // check for SQL error or if username/password pair does not exist

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
    header("location:edit_select.php"); 
    exit;
    }
  else  // username and/or password were not sent
  {
    header("location:login.php?err=2");
    exit;
  }

?>