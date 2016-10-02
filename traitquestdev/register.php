<?php
	session_start();
	// to redirect user to home page once they have logged in
	if( ( isset($_SESSION['companyID']) || isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "admin"){
		header('location: admin');
	}
	else if( ( isset($_SESSION['companyID']) || isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "employee" ){
		header('location: home');
	}

?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration</title>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/register.js"></script>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" type="text/css" href="css/global.css"/>
<link rel="stylesheet" type="text/css" href="css/color.css"/>
</head>

<body class="top-down-logoblue-logogreen-grad">
	<h1 class="text-align-center white">Registration</h1>
	<form id="formRegister" class="form" method="post">
		<div id="columnCompany">
			<input type="text" name="company" id="company" class="inputForm" placeholder="Company Name" />
		</div>
		<div id="columnName">
			<input type="text" name="name" id="name" class="inputForm" placeholder="Name" />
		</div>
		<div id="columnEmail">
			<input type="text" name="email" id="email" class="inputForm" placeholder="Email" />
		</div>
		<div id="columnPhoneNumber">
			<input type="text" name="phonenumber" id="phonenumber" class="inputForm" placeholder="Phone Number" />
		</div>
		<div id="registerResponse"></div>
		<input type="submit" name="submit" id="registerSubmit" class="buttonForm" value="Register" />
	</form>
</body>
</html>
