<!--
	Documentation: used https://owlcation.com/stem/Simple-search-PHP-MySQL to learn how to implement a search bar
-->

<head>
	<title>Textbook Swap</title>
	<link type="text/css" href="dark.css" rel="stylesheet">

    <style type="text/css">
      .formError { color: red; font-weight: bold }
    </style>	
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
			<li class="active"><a href="#" accesskey="2" title="">Buy</a></li>
			<li><a href="sell.html" accesskey="3" title="">Sell</a></li>
			<li><a href="login.php" accesskey="4" title="">Edit</a></li>
		</ul>
	</div>
	
	

	<div class="wrapper">
		<h2>Buy</h2>
		
		<form action="search.php" method="GET">
		<input type="text" name="query" />
		<input type="submit" value="Search" />
		</form>
		
		<table border="1" cellpadding="4" style="margin:auto">
		<tr><th>Book Title</th><th>ISBN</th><th>Publisher</th><th>Asking Price</th><th>Seller Name</th><th>Seller Email</th><th>Seller Phone</th><th>Seller Squad</th></tr>
		<?php 
		// open connection to the database on LOCALHOST with 
		// userid of 'root', password '', and database 'web'

		@ $db = new mysqli('LOCALHOST', 'root', '', 'web');

		// Check if there were error and if so, report and exit

		if (mysqli_connect_errno()) 
		{ 
		echo 'ERROR: Could not connect to database.  Error is '.mysqli_connect_error();
		exit;
		}
		
		$query = $_GET['query'];		
		$query = htmlspecialchars($query);
		$query = mysqli_real_escape_string($db, $query);
		
		echo $query;
		
		$results = mysqli_query($db, "SELECT * FROM listing NATURAL JOIN book NATURAL JOIN student WHERE
		('title' LIKE '%".$query."%') OR ('author' LIKE '%".$query."%') OR ('isbn' LIKE '%".$query."%') OR 
		('publisher' LIKE '%".$query."%') OR ('email' LIKE '%".$query."%') OR ('squadron' LIKE '%".$query."%') OR 
		('fname' LIKE '%".$query."%') OR ('lname' LIKE '%".$query."%')");
		
		// determine how many rows were returned
		

		$num_results = mysqli_num_rows($results);
		echo $num_results;

		// loop through each row building the table rows and data columns

		for ($i=0; $i < $num_results; $i++) 
		{
		$r= $results->fetch_assoc();
		print '<tr><td>'.$r['title'].'</td><td>'.$r['isbn'].'</td><td>'.$r['publisher'].'</td><td>'.sprintf("$%u",$r['price']).' </td><td>'.sprintf("%s %s", $r['fname'], $r['lname']).'</td><td>'.$r['email'].'</td><td>'.$r['phone'].'</td><td>'.$r['squadron'].'</td></tr>';
		}

		// deallocate memory for the results and close the database connection

		$results->free();
		$db->close();

		?>		
		</table>

		<a href="buy.php">Exit Search</a>		
	</div>
	
	

</body>
</html>
