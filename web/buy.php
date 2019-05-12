<head>
	<title>Textbook Swap</title>
	<link type="text/css" href="dark.css" rel="stylesheet">

    <style type="text/css">
      .formError { color: red; font-weight: bold }
	  
	  tr:nth-child(even) {background-color: #262626;}
	  
	  select {
		width: 10%;
		}
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
	
	

	<div class="wrapper" >
		<h2>Buy</h2>
		
		<center>
		<form action="search.php" method="GET">
			<input type="text" name="query" />
			<select name="column">
				<option value="title">Book Title</option>
				<option value="isbn">ISBN</option>
				<option value="publisher">Publisher</option>
				<option value="squadron">Squadron</option>
			</select>
			<input type="submit" value="Search" />
		</form>
		</center>
		
		<div style="height:450px;overflow:auto;">
			<table cellpadding="4" style="margin:auto">
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

			// run the SQL query to retrieve the service partner info

			$results = $db->query('SELECT * FROM listing NATURAL JOIN book NATURAL JOIN student');

			// determine how many rows were returned

			$num_results = $results->num_rows;

			// loop through each row building the table rows and data columns

			for ($i=0; $i < $num_results; $i++) 
			{
			$r= $results->fetch_assoc();
			

				
			print '<tr><td>'.$r['title'].'</td><td>'.$r['isbn'].'</td><td>'.$r['publisher'].'</td><td>'.sprintf("$%u",$r['price']).' </td><td>'.sprintf("%s %s", $r['fname'], $r['lname']).'</td><td>'.$r['email'].'</td><td>'.sprintf("(%s) %s-%s",substr($r['phone'], 0, 3),substr($r['phone'], 3, 3),substr($r['phone'], 6)).'</td><td>'.$r['squadron'].'</td></tr>';
			}

			// deallocate memory for the results and close the database connection

			$results->free();
			$db->close();

			?>		
			</table>
		</div>
	</div>

</body>
<script src="script.js"></script>
</html>

