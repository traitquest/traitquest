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
<title>Login</title>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</head>

<body>
	<h1>Login</h1>
	<form id="formEmployeeLogin" class="form" method="post">
		<div id="columnCompany">
			<input type="text" name="company" id="companyName" class="inputForm" placeholder="Company Name" />
		</div>
		<div id="columnEmail">
			<input type="text" name="email" id="email" class="inputForm" placeholder="Email" />
		</div>
		<div id="columnPassword">
			<input type="password" name="password" id="password" class="inputForm" placeholder="Password" />
		</div>
		<div id="loginResponse"></div>
		<input type="submit" name="submit" id="loginSubmit" class="buttonForm" value="Login" />
	</form>
</body>
</html>