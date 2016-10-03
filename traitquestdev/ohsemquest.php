<?php
	session_start();
	// to redirect user to home page once they have logged
	if ( ( isset($_SESSION['companyID']) || isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "admin"){
		header('location: admin');
	}
	else if( ( isset($_SESSION['companyID']) || isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "employee"){
		header('location: home');
	}
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ohsem Quest</title>
<link rel="shortcut icon" href="images/icon.ico">
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/color.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/ohsem.css"/>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/ohsem.js"></script>

</head>

<body>
<div id="wrapper">
	<?php include "header.php"; ?>
	<div id="mainContainer" class="container">
		<div id="registerContainer" class="col-md-6 col-xs-12 margin-topbottom-s">
			<h2 class="text-center">Welcome to Ohsem Quest!</h2>
			<p class="text-center">Have not registered yet? It's free!</p>
			<a id="registerButton" class="buttonForm button text-center center margin-s" href="register">Register Here</a>
		</div><!-- #registerContainer -->
		<div id="loginContainer" class="col-md-offset-1 col-md-5 col-xs-12 margin-topbottom-s">
			<h2 class="text-center">Login</h2>
			<form id="formEmployeeLogin" class="form" method="post">
				<div id="columnCompany" class="columnInput" hidden>
					<input type="text" name="company" id="companyName" class="inputForm" value="Ohsem Quest" />
				</div>
				<div id="columnEmail" class="columnInput" >
					<input type="text" name="email" id="email" class="inputForm" placeholder="Email" />
				</div>
				<div id="columnPhone" class="columnInput" >
					<input type="number" name="phone" id="phone" class="inputForm" placeholder="Phone" />
				</div>
				<div id="loginResponse"></div>
				<input type="submit" name="submit" id="loginSubmit" class="buttonForm button" value="Login" />
			</form>
		</div><!-- #loginContainer -->
	</div><!-- #mainContainer -->
</div>
</body>
</html>
