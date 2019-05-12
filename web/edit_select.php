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
	
	<!-- JavaScript for volunteer form data validation -->
	<script type="text/javascript">
	
		function validateForm()
		{
		// reset error indicators
			document.getElementById('formFeedback').innerHTML = "";
			
			var validForm = new Boolean(true);
			
		// Checks for successful update/delete	-----------------------
			document.getElementById('updatePasswordFormFeedback').innerHTML = "";
			document.getElementById('deleteEntryFormFeedback').innerHTML = "";
			
		// Title ---------------------------------
			var entryValue = document.forms["selection_form"]["entry"].value;
			myRegExp = new RegExp("^.{1,50}$");
			
		// Test our receivedValue string against the regular expression
			validInputValue = myRegExp.test(entryValue);  
			
		// Update form feedback
			if (validInputValue)
			{
				document.getElementById('entryFeedback').innerHTML = "";
			}
			else
			{
				validForm = false;
				displayError("Title must be 50 or fewer characters");
				document.getElementById('entryFeedback').innerHTML = "Error #1";
			}

		// Password ---------------------------------
			var passwordValue = document.forms["change_password_form"]["password"].value;
			myRegExp = new RegExp("^.{1,26}$");
			
		// Test our receivedValue string against the regular expression
			validInputValue = myRegExp.test(passwordValue);  
			
		// Update form feedback
			if (validInputValue)
			{
				document.getElementById('passwordFeedback').innerHTML = "";
			}
			else
			{
				validForm = false;
				displayError("Passwords must be between 4 and 26 characters long ");
				document.getElementById('passwordFeedback').innerHTML = "Error #2";
			}			
				
		//--------------------------------------------------------------------------------			
		return validForm;
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
		<h2>Pick Selection or <a href="logout.php">Logout</a></h2>
					
		<div style="height:450px;overflow:auto;">
		<tr>
			<td colspan="4">
				<center>
				<table>
					<tbody>
					<form name="selection_form" method="POST" id="selection_form" action="edit.php" enctype="multipart/form-data" onsubmit="return validateForm()">
					<div id="formFeedback" class="formError"></div>
					</div>
								<tr>
									<td>Select entry: </td>
									<td><select name="entry"><?php include('build_entry_select.php'); ?></select></td>
									<td><input type="submit" name="Submit" value="Edit"></td>
									<td><div id="entryFeedback" class="formError"></div></td>
								</tr>
					</form>
					
					<form name="change_password_form" method="POST" id="change_password_form" action="update_password.php" enctype="multipart/form-data" onsubmit="return validateForm()">
					<div id="formFeedback" class="formError"></div>
								<tr>
									<td>Change Password: </td>
									<td><input type="password" name="password" maxlength="26" size="50" align="left"></input></td>
									<td><input type="submit" name="Submit" value="Change"></td>
									<div id="passwordFeedback" class="formError"></div>
								</tr>
					</form>	
					</tbody>
				</table>
				<div id="deleteEntryFormFeedback" class="formError">
				<?php 
				  if (isset($_GET['deleteEntryError=1'])) 
					 {echo 'ERROR: Entry could not be updated.'; }
				  if (isset($_GET['deleteEntrySuccess=1'])) 
					 {echo '<font color="green">Entry was deleted.</font>';}
				?>
				</div>
				<div id="updatePasswordFormFeedback" class="formError">
				<?php 
				  if (isset($_GET['updatePasswordError'])) 
					 {echo 'ERROR: Password could not be updated.'; }
				  if (isset($_GET['updatePasswordSuccess'])) 
					 {echo '<font color="green">Password was updated.</font>'; }
				?>
				</div>				
				</center>
			</td>
		</tr>
		</div>
	</div>
</body>
<script src="script.js"></script>
</html>

