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
<script type="text/javascript" src="js/register.js"></script>

</head>

<body>
<div id="wrapper">
	<?php include "header.php"; ?>
	<div id="mainContainer" class="container">
		<h2 class="text-center">Register For Free</h2>
		<form id="formRegister" class="form" method="post">
			<div id="columnCompany" class="columnInput" hidden>
				<input type="text" name="company" id="company" class="inputForm" value="Ohsem Quest" />
			</div>
			<div id="columnName" class="columnInput">
				<input type="text" name="name" id="name" class="inputForm" placeholder="Name" />
			</div>
			<div id="columnEmail" class="columnInput">
				<input type="text" name="email" id="email" class="inputForm" placeholder="Email" />
			</div>
			<div id="columnPhoneNumber" class="columnInput">
				<input type="number" name="phonenumber" id="phonenumber" class="inputForm" placeholder="Phone Number" />
			</div>
			<div id="columnAddress" class="columnInput">
				<input type="text" name="address" id="address" class="inputForm" placeholder="Company (Optional)" />
			</div>
			<div id="registerResponse"></div>
			<input type="submit" name="submit" id="registerSubmit" class="buttonForm button" value="Register" />
		</form>
	</div><!-- mainContainer -->
</body>
</html>
