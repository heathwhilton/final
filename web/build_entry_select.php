<?php
  // retrieve session information
  session_start();

  // if no username set, then redirect to login
  if(!isset($_SESSION['myusername'])){
    header("location:login.php");
    exit;
  }
  
  // open connection to the database on LOCALHOST with 
  // isbn of 'root', password '', and database 'web'

  @ $db = new mysqli('LOCALHOST', 'root', '', 'web');

  // Check if there were error and if so, report and exit

  if (mysqli_connect_errno()) 
  { 
    echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
    exit;
  }
  
  // run the SQL query to retrieve the entry info

	$results = $db->query("SELECT `orderNumber`, `title` FROM `listing` NATURAL JOIN `book` NATURAL JOIN `student` WHERE `email`='".$_SESSION["myusername"]."'");
	
  // determine how many rows were returned

  $num_results = $results->num_rows;


  // loop through each row

  for ($i=0; $i < $num_results; $i++) 
  {
    $r= $results->fetch_assoc();
    print '<option value="'.$r['orderNumber'].'">'.$r['title'].'</option>';
  }

  // deallocate memory for the results and close the database connection

  $results->free();

  $db->close();

?>