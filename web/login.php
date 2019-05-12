<head>
	<title>Textbook Swap</title>
	<link type="text/css" href="dark.css" rel="stylesheet">
	
	    <!-- Set up style for form error feedback areas -->

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
			<li><a href="sell.html" accesskey="3" title="">Sell</a></li>
			<li class="active"><a href="#" accesskey="4" title="">Edit</a></li>
		</ul>
	</div>

	<div class="wrapper">
		<h2>Login to Edit</h2>

		<tr>
          <td colspan="4">
            <div id="Login"><br /><h3><center>User Login</center></h3></div>
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
                    <td>Username</td>
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
<script src="script.js"></script>
</html>

