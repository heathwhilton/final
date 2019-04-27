<head>
	<title>Textbook Swap</title>
	<link type="text/css" href="dark.css" rel="stylesheet">
	
	    <style type="text/css">
      .formError { color: red; font-weight: bold }
    </style>

    <!-- JavaScript for login form data validation -->

    <script type="text/javascript">
      function checkLoginForm()
      {
        var userName = document.forms["login_form"]["myusername"].value;

        if (userName == "") 
        {
          document.getElementById('formFeedback').innerHTML = "ERROR: User Name must be specified.";
          return false;
        }
        else
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
			<li class="active"><a href="#" accesskey="3" title="">Sell</a></li>
			<li><a href="login.php" accesskey="4" title="">Edit</a></li>
		</ul>
	</div>

	<div class="wrapper">
		<h2>Insert Results</h2>

	<center>
		<br />
		<br />

		<?php 

		// open connection to the database on LOCALHOST with 
		// userid of 'root', password '', and database 'web'

		@ $db = new mysqli('LOCALHOST', 'root', '', 'web');

		// Check if there were error and if so, report and exit

		if (mysqli_connect_errno()) 
		{ 
		echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
		exit;
		}

		// sanitize the input from the form to eliminate possible SQL Injection

		$title = stripslashes($_POST['title']);
		$title = $db->real_escape_string($title);
		
		$authorName = stripslashes($_POST['authorName']);
		$authorName = $db->real_escape_string($authorName);
		
		$condition = stripslashes($_POST['condition']);
		$condition = $db->real_escape_string($condition);
		
		$price = stripslashes($_POST['price']);
		$price = $db->real_escape_string($price);
		
		//Photo goes here///////////how the hell we suppose to do that?!?///////////
		
		$email = stripslashes($_POST['email']);
		$email = $db->real_escape_string($title);
		
		$password = stripslashes($_POST['password']);
		$password = $db->real_escape_string($password);
		
		$firstName = stripslashes($_POST['firstName']);
		$firstName = $db->real_escape_string($firstName);

		$lastName = stripslashes($_POST['lastName']);
		$lastName = $db->real_escape_string($lastName );
		
		$number = stripslashes($_POST['number']);
		$number = $db->real_escape_string($number);

		$squadron = stripslashes($_POST['squadron']);
		$squadron = $db->real_escape_string($squadron);
		
		$listDate = '2019-27-04'; ////////eventually it will report date of submission

		// set up a prepared statement to insert the volunteer info

		$query = "INSERT INTO LISTING (title, condition, email, price) 
		   VALUES ( ?, ?, ?, ?)";  // question marks are parameter locations

		$stmt = $db->prepare($query);  // creates the Prepared Statement

		// binds the parameters of Prepared Statement to corresponding variables
		// first argument, gives the parameter data types of 3 strings, an int, a date (string?)
		$stmt->bind_param("sssi", $title, $condition, $email, $price);

		$stmt->execute();  // runs the Prepared Statement query

		echo $stmt->affected_rows.' records inserted.<br/><br/>';  // report results

		$stmt->close();  // deallocate the Prepared Statement
		
//////////////////////// INSERT INTO USER  goes here /////////////////////////////

//////////////////////// INSERT INTO STUDENT goes here ///////////////////////////
		
		$db->close();    // close the database connection
		?>

		<table border="1" cellpadding="3">
		<tr><th>Parameter</th><th>Value</th></tr>
		<tr><td>Book Title</td><td><?php echo $title; ?></td></tr>
		<tr><td>Author's Name</td><td><?php echo $authorName; ?></td></tr>
		<tr><td>Condition</td><td><?php echo $condition; ?></td></tr>
		<tr><td>Price</td><td><?php echo $price; ?></td></tr>
		<tr><td>Email</td><td><?php echo $email; ?></td></tr>
		<tr><td>Name</td><td><?php echo $firstName; ?></td></tr>
		<tr><td>Number</td><td><?php echo $number; ?></td></tr>
		<tr><td>Squadron</td><td><?php echo $squadron; ?></td></tr>
		<tr><td>Date</td><td><?php echo $listDate; ?></td></tr>
		</table>
		<br />

		<!-- Below demonstrates how to get system information from PHP -->

		Web page <b><?php echo $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'] ?></b><br />
		accessed on <b><?php echo date("Y-m-d H:i") ?></b> 
		from IP address <b><?php echo $_SERVER['REMOTE_ADDR'] ?></b> via
		<b><?php echo $_SERVER['REQUEST_METHOD'] ?></b><br/>
		<br />

		<!-- Give a link back to the main page -->

		<a href="buy.php">Click Here</a> to return to the listings page.

	</center> 
	</div>

</body>
</html>

