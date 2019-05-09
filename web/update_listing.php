<?php
  // create_user.php - 3/24/2011 - Steve Hadfield 
  // Shows how to create a new user with encrypted password 

  // check for newUsername and newPassword

  if ( !isset($_POST['newUsername']) || !isset($_POST['newPassword']) )
    header("location:admin.php?newUserError=1");

  // open connection to the database on LOCALHOST with 
  // userid of 'root', password '', and database 'csl'

  @ $db = new mysqli('LOCALHOST', 'root', '', 'csl');

  // Check if there were error and if so, report and exit

  if (mysqli_connect_errno()) 
  { 
    echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
    exit;
  }

  // sanitize the input from the form to eliminate possible SQL Injection

  $newUsername = stripslashes($_POST['newUsername']);
  $newUsername = $db->real_escape_string($newUsername);

  $newPassword = stripslashes($_POST['newPassword']);
  $newPassword = $db->real_escape_string($newPassword);

  // encrypt the password with MD5

  $newPassword = md5($newPassword);

  // check that new username does not already exist

  $checkQuery = "SELECT * FROM USERS WHERE userName = ?";

  $checkStmt = $db->prepare($checkQuery);

  $checkStmt->bind_param("s", $newUsername);

  $checkStmt->execute();

  $checkStmt->store_result();

  // check for SQL errors and existing users with the username

  if ( ($checkStmt->errno <> 0) || ($checkStmt->num_rows > 0) )
  {
    $checkStmt->close();
    header("location:admin.php?newUserError=2");
    exit;
  }

  $checkStmt->close();

  // set up a prepared statement to insert the new user info

  $query = "INSERT INTO USERS (userName, userPassword) VALUES ( ?, ? )";

  $stmt = $db->prepare($query);

  $stmt->bind_param("ss", $newUsername, $newPassword);

  $stmt->execute();

  if ($stmt->errno <> 0)
  {
    $stmt->close();
    $db->close();
    header("location:admin.php?newUserError=3");
    exit;
  }

  // all was good, do housekeeping

  $stmt->close();

  $db->close();

  // return to admin.php with success notification

  header("location:admin.php?newUserSuccess=1");

?>
