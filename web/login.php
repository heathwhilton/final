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
		<h2>Login to Sell</h2>

		<tr>
		  <td colspan="4">
			<div><br/><p><center>Seller Login</center><p></div>
			<center>
			  <form name="login_form" method="post" id="login_form" action="checklogin.php" onsubmit="return checkLoginForm()">
				<table border="0" cellpadding="3" cellspacing="1">
				  <tr>
					<td colspan="2">
					  <div id="formFeedback" class="formError">
						<?php 
						  if (isset($_GET['err'])) {echo 'ERROR: Username - password not valid.'; }
						?>
					  </div>
					</td>
				  </tr>
				  <tr>
					<td>Email</td>
					<td><input name="myusername" type="text" id="myusername"></td>
				  </tr>
				  <tr>
					<td>Password</td>
					<td><input name="mypassword" type="password" id="mypassword"></td>
				  </tr>
				  <tr>
					<td colspan="2"><br/><center><input type="submit" name="Submit" value="Login"></center></td>
				  </tr>
				</table>
			  </form>
			</center>
		  </td>
		</tr>
	</div>
</body>
</html>

