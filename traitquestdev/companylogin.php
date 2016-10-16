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
<meta name="description" content="Traitquest Admin Login">
<meta name="keywords" content="Traitquest, Admin, Login">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login</title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/color.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/companylogin.js"></script>
</head>

<body>
<div id="wrapper">
	<?php include "header.php"; ?>
	<div id="mainContainer" class="container">
		<h1 class="text-center">Admin Login</h1>
		<form id="formCompanyLogin" class="form" method="post">
			<div id="columnCompany" class="columnInput">
				<input type="text" name="company" id="companyName" class="inputForm margin-align-center" placeholder="Company Name" />
			</div>
			<div id="columnEmail" class="columnInput">
				<input type="text" name="email" id="email" class="inputForm margin-align-center" placeholder="Email" />
			</div>
			<div id="columnPassword" class="columnInput">
				<input type="password" name="password" id="password" class="inputForm margin-align-center" placeholder="Password" />
			</div>
			<div id="loginResponse"></div>
			<input type="submit" name="submit" id="loginSubmit" class="buttonForm button margin-align-center" value="Login" />
		</form>	
	</div>
	<?php include "footer.php" ?>
</body>
</html>
