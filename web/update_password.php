<?php
  // retrieve session information
  session_start();

  // if no username set, then redirect to login
  if(!isset($_SESSION['myusername'])){
    header("location:login.php");
    exit;
  }

  if ( !isset($_POST['password']) )
  {
    header("location:edit_select.php?updatePasswordError=1"); 
    exit;

  }

  // open connection to the database on LOCALHOST with 
  // orderNumber of 'root', password '', and database 'web'

  @ $db = new mysqli('LOCALHOST', 'root', '', 'web');

  // Check if there were error and if so, report and exit

  if (mysqli_connect_errno()) 
  { 
    echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
    exit;
  }

  // update password
  
	$password = stripslashes($_POST['password']);
	$password = $db->real_escape_string($password);

  $query = "UPDATE `student` SET `password` = ? WHERE `student`.`email` = '".$_SESSION["myusername"]."' ";

  $stmt = $db->prepare($query);

  $stmt->bind_param("s", md5($password));

  $stmt->execute();

  // check for errors

  if ($stmt->errno <> 0)
  {
    $stmt->close();
    $db->close();
    header("location:edit_select.php?updatePasswordError=2");
    exit;
  }

  // deallocate memory for the results and close the database connection

  $stmt->close();

  $db->close();

  // return to edit.php successfully

  header("location:edit_select.php?updatePasswordSuccess=1");

?>
