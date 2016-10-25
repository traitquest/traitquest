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
<meta name="title" content="TraitQuest">
<meta name="description" content="TraitQuest Register">
<meta name="keywords" content="TraitQuest, Register">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registration</title>
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
<script type="text/javascript" src="js/register.js"></script>

</head>

<body>
<div id="wrapper">
	<?php include "header.php"; ?>
	<div id="mainContainer" class="container">
		<h1 class="text-center">Join Now For FREE!</h1>
		<form id="formRegister" class="form" method="post">
			<div id="columnName" class="columnInput">
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
			<div id="columnPhoneNumber" class="columnInput">
				<div class="icon-addon">
					<input type="number" name="phonenumber" id="phonenumber" class="inputForm padding-left30px" placeholder="Phone" />
					<i class="glyphicon glyphicon-earphone"></i>
				</div>
			</div>
			<div id="columnAddress" class="columnInput">
				<div class="icon-addon inputAddress">
					<textarea type="text" name="address" id="address" class="inputForm padding-left30px inputAddress" rows="4" placeholder="Address"></textarea>
					<i class="glyphicon glyphicon-home"></i>
				</div>
			</div>
			<div id="registerResponse"></div>
			<input type="submit" name="submit" id="registerSubmit" class="buttonForm button" value="Register" />
		</form>
		<div class="inputForm">
			<p class="fontsize-xs">By clicking Register, you agree to our <a href="#" class="blue">Terms of Use</a> and <a href="#" class="blue">Privacy Policy</a></p>
			<p class="fontsize-xs">Free license is only valid for one(1) month and up to five(5) employees</p>
		</div>
	</div><!-- mainContainer -->
	<?php include "footer.php" ?>
</body>
</html>
