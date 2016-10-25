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
<meta name="title" content="TraitQuest">
<meta name="description" content="TraitQuest Admin Login">
<meta name="keywords" content="TraitQuest, Admin, Login">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="shortcut icon" href="images/icon.ico">

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
		<form id="formCompanyLogin" class="form padding-topbottom-s" method="post">
			<div id="columnCompany" class="columnInput">
				<div class="icon-addon">
					<input type="text" name="company" id="companyName" class="inputForm padding-left30px" placeholder="Company" />
					<i class="glyphicon glyphicon-briefcase"></i>
				</div>
			</div>
			<div id="columnEmail" class="columnInput">
				<div class="icon-addon">
					<input type="text" name="email" id="email" class="inputForm padding-left30px" placeholder="Email" />
					<i class="glyphicon glyphicon-envelope"></i>
				</div>
			</div>
			<div id="columnPassword" class="columnInput">
				<div class="icon-addon">
					<input type="password" name="password" id="password" class="inputForm padding-left30px" placeholder="Password" />
					<i class="glyphicon glyphicon-lock"></i>
				</div>
			</div>
			<div id="loginResponse"></div>
			<input type="submit" name="submit" id="loginSubmit" class="buttonForm button" value="Login As Admin" />
		</form>
	</div>
	<?php include "footer.php" ?>
</body>
</html>
