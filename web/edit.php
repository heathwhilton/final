<?php

  // retrieve session information
  session_start();

  // if no username set, then redirect to login
  if(!isset($_SESSION['myusername'])){
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

      function verifyUpdate()  // used to housekeep when Update User is pressed
      {
        document.getElementById('newUserFormFeedback').innerHTML = "";
        document.getElementById('deleteUserFormFeedback').innerHTML = "";
        document.getElementById('updateUserFormFeedback').innerHTML = "";
        return true;
      }

      function verifyDelete()  // used to housekeep and confirm on Delete User
      {
        document.getElementById('newUserFormFeedback').innerHTML = "";
        document.getElementById('deleteUserFormFeedback').innerHTML = "";
        document.getElementById('updateUserFormFeedback').innerHTML = "";
        var result=confirm("Are you sure you want to delete this user?");
        if (result==false) 
          document.getElementById('deleteUserFormFeedback').innerHTML = "User not deleted.";
        return result;
      }


      function checkNewUserForm()  // used to housekeep and verify for Create User
      {

        // clear old feedback

        document.getElementById('newUserFormFeedback').innerHTML = "";
        document.getElementById('deleteUserFormFeedback').innerHTML = "";
        document.getElementById('updateUserFormFeedback').innerHTML = "";
 
        // get form values

        var newUsernameValue = document.forms["new_user_form"]["newUsername"].value;
        var newPasswordValue = document.forms["new_user_form"]["newPassword"].value;
        var newPasswordRepeatValue = document.forms["new_user_form"]["newPasswordRepeat"].value;

        if (newUsernameValue == "")
        {
          document.getElementById('newUserFormFeedback').innerHTML = 
                     "ERROR: Must specify a username."
          return false;
        }

        if (newPasswordValue == "")
        {
          document.getElementById('newUserFormFeedback').innerHTML = 
                     "ERROR: Must specify a password."
          return false;
        }

        if (newPasswordValue != newPasswordRepeatValue)
        {
          document.getElementById('newUserFormFeedback').innerHTML = 
                     "ERROR: Passwords must match."
          return false;
        }

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
		<h2>Login to Sell</h2>

<!-- ************************** Update User Form ************************************ -->

              <hr>
              <form name="update_listing_form" method="post" id="update_listing_form" 
                    action="#" onsubmit="return verifyUpdate()">
                <table border="0" cellpadding="3" cellspacing="1">
                  <tr>
                    <td colspan="3">
                      <center>
                      <div id="updateUserFormFeedback" class="formError">
                        <?php 
                          if (isset($_GET['updateUserError'])) 
                             {echo 'ERROR: User could not be updated.'; }
                          if (isset($_GET['updateUserSuccess'])) 
                             {echo '<font color="green">Selected user was updated.</font>'; }
                        ?>
                      </div>
                      </center>
                    </td>
                  </tr>
                  <tr>
                    <td>Select Your Listing: </td>
                    <td>
                      <select name="user">
                        <?php include('#'); ?>
                      </select>
                    </td>
                    <td>
                      <center><input type="submit" name="Submit" value="Update Listing"></center>
                    </td>
                  </tr>
                </table>
              </form>

<!-- ************************** Delete Listing Form ************************************ -->

              <hr>
              <form name="delete_listing_form" method="post" id="delete_listing_form" 
                    action="#" onsubmit="return verifyDelete()">
                <table border="0" cellpadding="3" cellspacing="1">
                  <tr>
                    <td colspan="3">
                      <center>
                      <div id="deleteUserFormFeedback" class="formError">
                        <?php 
                          if (isset($_GET['deleteUserError'])) 
                             {echo 'ERROR: User could not be deleted.'; }
                          if (isset($_GET['deleteUserSuccess'])) 
                             {echo '<font color="green">Selected user was deleted.</font>'; }
                        ?>
                      </div>
                      </center>
                    </td>
                  </tr>
                  <tr>
                    <td>Select Your Listing: </td>
                    <td>
                      <select name="user">
                        <?php include('#'); ?>
                      </select>
                    </td>
                    <td>
                      <center><input type="submit" name="Submit" value="Delete Listing"></center>
                    </td>
                  </tr>
                </table>
              </form>	
	</div>
</body>
</html>

