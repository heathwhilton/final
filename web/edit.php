<?php

  // retrieve session information
  session_start();

  // if no username set, then redirect to login
  if(!isset($_SESSION['myemail'])){
    header("location:login.php");
    exit;
  }
?>

<head>
	<title>Textbook Swap</title>
	<link type="text/css" href="dark.css" rel="stylesheet">
	
	    <!-- Set up style for form error feedback areas -->

    <style type="text/css">
      .formError { color: red; font-weight: bold }
    </style>

    <!-- JavaScript for login form data validation -->

    <script type="text/javascript">

      function verifyUpdate()  // used to housekeep when Update Entry is pressed
      {
        document.getElementById('newEntryFormFeedback').innerHTML = "";
        document.getElementById('deleteEntryFormFeedback').innerHTML = "";
        document.getElementById('updateEntryFormFeedback').innerHTML = "";
        return true;
      }

      function verifyDelete()  // used to housekeep and confirm on Delete Entry
      {
        document.getElementById('newEntryFormFeedback').innerHTML = "";
        document.getElementById('deleteEntryFormFeedback').innerHTML = "";
        document.getElementById('updateEntryFormFeedback').innerHTML = "";
        var result=confirm("Are you sure you want to delete this entry?");
        if (result==false) 
          document.getElementById('deleteEntryFormFeedback').innerHTML = "Entry not deleted.";
        return result;
      }


      function checkNewEntryForm()  // used to housekeep and verify for Create Entry
      {

        // clear old feedback

        document.getElementById('newEntryFormFeedback').innerHTML = "";
        document.getElementById('deleteEntryFormFeedback').innerHTML = "";
        document.getElementById('updateEntryFormFeedback').innerHTML = "";
 
        // get form values

	return true;

      }
    </script>
</head>

<div id="header" class="container">
	<div id="logo">
		<h1><a href="about.html">Textbook Swap</a></h1>
	</div>
</div>

<body>
	<div id="menu">
		<ul>
			<li><a href="about.html" accesskey="1" title="">About</a></li>
			<li><a href="buy.php" accesskey="2" title="">Buy</a></li>
			<li><a href="sell.html" accesskey="3" title="">Sell</a></li>
			<li class="active"><a href="#" accesskey="4" title="">Edit</a></li>
		</ul>
	</div>

	<div class="wrapper">
		<h2>Edit your Listings</h2>

<!-- ************************** Update Entry Form ************************************ -->

              <hr>
              <form name="update_listing_form" method="post" id="update_listing_form" 
                    action="#" onsubmit="return verifyUpdate()">
                <table border="0" cellpadding="3" cellspacing="1">
                  <tr>
                    <td colspan="3">
                      <center>
                      <div id="updateEntryFormFeedback" class="formError">
                        <?php 
                          if (isset($_GET['updateEntryError'])) 
                             {echo 'ERROR: Entry could not be updated.'; }
                          if (isset($_GET['updateEntrySuccess'])) 
                             {echo '<font color="green">Selected entry was updated.</font>'; }
                        ?>
                      </div>
                      </center>
                    </td>
                  </tr>
                  <tr>
                    <td>Select Your Listing: </td>
                    <td>
                      <select name="listings">
                        <?php include('build_entry_select.php'); ?>
                      </select>
                    </td>
                    <td>
                      <center><input type="submit" name="Submit" value="Update Listing"></center>
                    </td>
                  </tr>
                </table>
              </form>

<!-- ************************** Edit Listing Form ************************************ -->

              <hr>
              <form name="delete_entry_form" method="post" id="delete_entry_form" 
                    action="delete_entry.php" onsubmit="return verifyDelete()">
                <table border="0" cellpadding="3" cellspacing="1">
                  <tr>
                    <td colspan="3">
                      <center>
                      <div id="deleteEntryFormFeedback" class="formError">
                        <?php 
                          if (isset($_GET['deleteEntryError'])) 
                             {echo 'ERROR: Entry could not be deleted.'; }
                          if (isset($_GET['deleteEntrySuccess'])) 
                             {echo '<font color="green">Selected Entry was deleted.</font>'; }
                        ?>
                      </div>
                      </center>
                    </td>
                  </tr>
                  <tr>
                    <td>Select Your Listing: </td>
                    <td>
                      <select name="title">
                        <?php include('build_entry_select.php'); ?>
                      </select>
                    </td>
                    <td>
                      <center><input type="submit" name="Submit" value="Delete Entry"></center>
                    </td>
                  </tr>
                </table>
              </form>	
	</div>
</body>
</html>

