<?php
  // build_user_select.php - 3/24/2011 - Steve Hadfield 
  // build a HTML select of current users 

  // open connection to the database on LOCALHOST with 
  // isbn of 'root', password '', and database 'web'

  @ $db = new mysqli('LOCALHOST', 'root', '', 'web');

  // Check if there were error and if so, report and exit

  if (mysqli_connect_errno()) 
  { 
    echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
    exit;
  }

  // run the SQL query to retrieve the user info

  $results = $db->query('SELECT isbn, title FROM BOOK ORDER BY title');

  // determine how many rows were returned

  $num_results = $results->num_rows;

  // loop through each row

  for ($i=0; $i < $num_results; $i++) 
  {
    $r= $results->fetch_assoc();
    print '<option value="'.$r['isbn'].'">'.$r['title'].'</option>';
  }

  // deallocate memory for the results and close the database connection

  $results->free();

  $db->close();

?>
