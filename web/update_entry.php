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
		<h2>Update Results</h2>

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

		$orderNumber = stripslashes($_POST['orderNumber']);
		$orderNumber = $db->real_escape_string($orderNumber);
		
		$isbn = stripslashes($_POST['isbn']);
		$isbn = $db->real_escape_string($isbn);
		
		$title = stripslashes($_POST['title']);
		$title = $db->real_escape_string($title);
		
		$authorName = stripslashes($_POST['authorName']);
		$authorName = $db->real_escape_string($authorName);
		
		$price = stripslashes($_POST['price']);
		$price = $db->real_escape_string($price);
		
		//$image = $_FILES['image']['tmp_name'];
		//$image = addslashes(file_get_contents($image));

		//$email = stripslashes($_POST['email']);
		//$email = $db->real_escape_string($email);
		
		//$password = stripslashes($_POST['password']);
		//$password = $db->real_escape_string($password);
		
		//$firstName = stripslashes($_POST['firstName']);
		//$firstName = $db->real_escape_string($firstName);

		//$lastName = stripslashes($_POST['lastName']);
		//$lastName = $db->real_escape_string($lastName );
		
		//$number = stripslashes($_POST['number']);
		//$number = $db->real_escape_string($number);

		//$squadron = stripslashes($_POST['squadron']);
		//$squadron = $db->real_escape_string($squadron);
		
		$publisher = stripslashes($_POST['publisher']);
		$publisher = $db->real_escape_string($publisher);
		

//////////////////////// INSERT INTO BOOK goes here ///////////////////////////
		
		$stmt = $db->prepare("UPDATE `listing` NATURAL JOIN `book` SET `title` = ?, `publisher` = ?, `isbn` = ?, `price` = ? WHERE `orderNumber` = ?");
			
		$stmt->bind_param('ssiii', $title, $publisher, $isbn, $price, $orderNumber);
			
		$stmt->execute();
		
		$db->close();    // close the database connection
		?>

		<table border="1" cellpadding="3">
		<tr><th>Parameter</th><th>Value</th></tr>
		<tr><td>Order Number</td><td><?php echo $orderNumber; ?></td></tr>
		<tr><td>Book Title</td><td><?php echo $title; ?></td></tr>
		<tr><td>ISBN</td><td><?php echo $isbn; ?></td></tr>
		<tr><td>Publisher</td><td><?php echo $publisher; ?></td></tr>
		<tr><td>authorName</td><td><?php echo $authorName; ?></td></tr>
		<tr><td>Price</td><td><?php echo $price; ?></td></tr>
		</table>
		<br />
		
		
		<!-- Give a link back to the main page -->

		<a href="edit_select.php">Click Here</a> to return to the selection page.

	</center> 
	</div>

</body>
</html>

