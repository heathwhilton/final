<?php
  // delete_entry.php - 3/24/2011 - Steve Hadfield 
  // delete a selected title 

  // check that a isbn value was sent

  if ( !isset($_POST['title']) )
  {
    header("location:edit.php?deleteEntryError=1"); 
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

  // delete the selected title with a prepared statement

  $query = "DELETE FROM BOOK WHERE title = ?";

  $stmt = $db->prepare($query);

 // $stmt->bind_param("s", $_POST['title']);

  $stmt->execute();

  // check for errors

  if ($stmt->errno <> 0)
  {
    //$stmt->close();
    //$db->close();
    header("location:edit.php?deleteEntryError=2");
    exit;
  }

  // deallocate memory for the results and close the database connection

  $stmt->close();

  $db->close();

  // return to edit.php successfully

  header("location:edit.php?deleteEntrySuccess=1");

?>
