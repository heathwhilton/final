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

	$results = $db->query("SELECT * FROM `listing` NATURAL JOIN `book` WHERE `orderNumber`='".$_POST["entry"]."' LIMIT 1");

	$r= $results->fetch_assoc();	
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

			var errorCount = new Number(0);
			
			function displayError( errorMsg )
			{
				errorCount = errorCount + 1;

				if (document.getElementById('formFeedback').innerHTML != "")
				{
					document.getElementById('formFeedback').innerHTML =
						document.getElementById('formFeedback').innerHTML + "<br/>" + "Error #" + errorCount + " - " + errorMsg;
				}
				else
				{
					document.getElementById('formFeedback').innerHTML = "Error #" + errorCount + " - " + errorMsg;
				}
			}
		
			function validateForm()
			{
			// reset error indicators
				errorCount = 0;
				document.getElementById('formFeedback').innerHTML = "";
				
				var validForm = new Boolean(true);
			//---------------------------------------------TOP-------------------------------------
			// Title ---------------------------------
				var titleValue = document.forms["selling_info"]["title"].value;
				myRegExp = new RegExp("^.{1,50}$");
				
			// Test our receivedValue string against the regular expression
				validInputValue = myRegExp.test(titleValue);  
				
			// Update form feedback
				if (validInputValue)
				{
					document.getElementById('titleFeedback').innerHTML = "";
				}
				else
				{
					validForm = false;
					displayError("Title must be 50 or fewer characters");
					document.getElementById('titleFeedback').innerHTML = "Error #" + errorCount;
				}			
			// ISBN ---------------------------------
				var isbnValue = document.forms["selling_info"]["isbn"].value;

				myRegExp = new RegExp("^[0-9]{13}$");
				
			// Test our receivedValue string against the regular expression
				validInputValue = myRegExp.test(isbnValue);  
				
			// Update form feedback
				if (validInputValue)
				{
					document.getElementById('isbnFeedback').innerHTML = "";
				}
				else
				{
					validForm = false;
					displayError("ISBN must be a 13 digit long number");
					document.getElementById('isbnFeedback').innerHTML = "Error #" + errorCount;
				}
				
			// Publisher ---------------------------------
				var publisherValue = document.forms["selling_info"]["publisher"].value;
				myRegExp = new RegExp("^[a-zA-Z0-9 _./!?@#%&+-]{1,50}$");
				
			// Test our receivedValue string against the regular expression
				validInputValue = myRegExp.test(publisherValue);  
				
			// Update form feedback
				if (validInputValue)
				{
					document.getElementById('publisherFeedback').innerHTML = "";
				}
				else
				{
					validForm = false;
					displayError("Publisher cannot have special characters");
					document.getElementById('publisherFeedback').innerHTML = "Error #" + errorCount;
				}
				
			// Author's Name ---------------------------------
				var authorNameValue = document.forms["selling_info"]["authorName"].value;
				myRegExp = new RegExp("^[a-zA-Z -.]{1,50}$");
				
			// Test our receivedValue string against the regular expression
				validInputValue = myRegExp.test(authorNameValue);  
				
			// Update form feedback
				if (validInputValue)
				{
					document.getElementById('authorNameFeedback').innerHTML = "";
				}
				else
				{
					validForm = false;
					displayError("Author names may cointain spaces, hyphens, or periods and must be 50 or fewer characters");
					document.getElementById('authorNameFeedback').innerHTML = "Error #" + errorCount;
				}
			
			// Price ---------------------------------
				var priceValue = document.forms["selling_info"]["price"].value;
				myRegExp = new RegExp("^[0-9.]{1,7}$");
				
			// Test our receivedValue string against the regular expression
				validInputValue = myRegExp.test(priceValue);  
				
			// Update form feedback
				if (validInputValue)
				{
					document.getElementById('priceFeedback').innerHTML = "";
				}
				else
				{
					validForm = false;
					displayError("Price must be numeric up to the thousands");
					document.getElementById('priceFeedback').innerHTML = "Error #" + errorCount;
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
		<h2><a href="edit_select.php">Choose Selection</a> or <a href="logout.php">Logout</a></h2>
		
		<div style="height:450px;overflow:auto;">
		<form name="selling_info" method="POST" id="sell_form" action="update_entry.php" enctype="multipart/form-data" onsubmit="return validateForm()">
		<center><table border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td>Order Number: </td>
				<td><?php print '<input type="text" name="orderNumber" size="15" readonly="readonly" align="left" value="'.$r['orderNumber'].'"</input>';?></td>
			</tr>
			<tr>
				<td>Title: </td>
				<td><?php print '<input type="text" name="title" maxlength="50" size="50" align="left" value="'.$r['title'].'"</input>';?></td>
				<td><div id="titleFeedback" class="formError"></div></td>
			</tr>			  
			<tr>
				<td>ISBN: </td>
				<td><?php print '<input type="text" name="isbn" maxlength="13" size="13" align="left" value="'.$r['isbn'].'"</input>';?></td>
				<td><div id="isbnFeedback" class="formError"></div></td>
			</tr>
			<tr>
				<td>Publisher: </td>
				<td><?php print '<input type="text" name="publisher" maxlength="50" size="50" align="left" value="'.$r['publisher'].'"</input>';?></td>
				<td><div id="publisherFeedback" class="formError"></div></td>
			</tr>
			<tr>
			<tr>
				<td>Author's Name: </td>
				<td><input type="text" name="authorName" maxlength="50" size="50" align="left" value="Unavailable"></input></td>
				<td><div id="authorNameFeedback" class="formError"></div></td>
			</tr>
			<tr>
				<td>Price: </td>
				<td><?php print '<input type="text" name="price" maxlength="7" size="7" align="left" value="'.$r['price'].'"</input>';?></td>
				<td><div id="priceFeedback" class="formError"></div></td>
			</tr>
			<!--<tr>
				<td>Upload Photo: </td>
				<td><input type="file" name="image"></td>
			</tr> -->
			<tr>
				<td colspan="3"><br/><center>
				<input type="submit" name="Submit" value="Update entry">
				<input type="submit" formaction="delete_entry.php" value="Delete entry">
				</center></td>
			</tr>
			</table></center>
			<div id="formFeedback" class="formError"></div>
		</form>		
		</div>
	</div>
</body>
<script src="script.js"></script>
</html>
<?php
	// deallocate memory for the results and close the database connection
	$results->free();
	$db->close();
?>

