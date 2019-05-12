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

		$isbn = stripslashes($_POST['isbn']);
		$isbn = $db->real_escape_string($isbn);
		
		$title = stripslashes($_POST['title']);
		$title = $db->real_escape_string($title);
		
		$price = stripslashes($_POST['price']);
		$price = $db->real_escape_string($price);

		$email = stripslashes($_POST['email']);
		$email = $db->real_escape_string($email);
		
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
		
		$publisher = stripslashes($_POST['publisher']);
		$publisher = $db->real_escape_string($publisher);
		
		
//////////////////////// INSERT INTO STUDENT  goes here /////////////////////////////

		$stmt = $db->prepare('INSERT INTO STUDENT (email, fname, lname, phone, squadron, password)
			VALUES (?, ?, ?, ?, ?, ?)');
			
	
		$stmt->bind_param("ssssss", $email, $firstName, $lastName, $number, $squadron, $password);		
		
		$stmt->execute();
		
		

//////////////////////// INSERT INTO BOOK goes here ///////////////////////////
		
		$stmt = $db->prepare('INSERT INTO BOOK (isbn, title, publisher)
			VALUES (?, ?, ?)');
			
		$stmt->bind_param("sss", $isbn, $title, $publisher);
			
		$stmt->execute();
		
		
//////////////////////// INSERT INTO LISTING goes here ///////////////////////////

		$insert = $db->prepare('INSERT INTO listing (isbn, email, price) 
			VALUES(?, ?, ?)'); 

		$insert->bind_param("ssi", $isbn, $email, $price);
		
		$insert->execute();
		
		$db->close();    // close the database connection
		?>

		<table border="1" cellpadding="3">
		<tr><th>Parameter</th><th>Value</th></tr>
		<tr><td>Book Title</td><td><?php echo $title; ?></td></tr>
		<tr><td>ISBN</td><td><?php echo $isbn; ?></td></tr>
		<tr><td>Price</td><td><?php echo $price; ?></td></tr>
		<tr><td>Email</td><td><?php echo $email; ?></td></tr>
		<tr><td>First Name</td><td><?php echo $firstName; ?></td></tr>
		<tr><td>Last Name</td><td><?php echo $lastName; ?></td></tr>
		<tr><td>Phone</td><td><?php echo $number; ?></td></tr>
		<tr><td>Squadron</td><td><?php echo $squadron; ?></td></tr>
		</table>
		<br />
		
		
		<!-- Give a link back to the main page -->

		<a href="buy.php">Click Here</a> to return to the listings page.

	</center> 
	</div>

</body>
</html>

