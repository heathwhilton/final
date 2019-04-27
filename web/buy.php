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

		<p>Click on the book title to see a picture.</p>
		
		<table border="1" cellpadding="4" style="margin:auto">
		<tr><th>Book Title</th><th>Seller Email</th><th>Asking Price</th></tr>
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

		// run the SQL query to retrieve the service partner info

		$results = $db->query('SELECT * FROM LISTING');

		// determine how many rows were returned

		$num_results = $results->num_rows;

		// loop through each row building the table rows and data columns

		for ($i=0; $i < $num_results; $i++) 
		{
		$r= $results->fetch_assoc();
		print '<tr><td>'.$r['title'].'</td><td>'.$r['email'].'</td><td>'.sprintf("$%u",$r['price']).' </td></tr>';
		}

		// deallocate memory for the results and close the database connection

		$results->free();
		$db->close();

		?>		
		</table>		
	</div>

</body>
</html>

