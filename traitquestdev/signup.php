<?php
session_start();
// to redirect user to home page once they have logged in
if (isset($_SESSION['companyID']) || isset($_SESSION['userID']))
{
    header('location: home.php');
}
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign Up</title>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/signup.js"></script>
<link rel="stylesheet" href="css/signup.css"/>
<link rel="stylesheet" href="css/color.css"/>
</head>

<body>
  <?php include('header.php') ?>
  <div class="formBackground"></div>
	<h1>Company Sign Up</h1>
	<form id="formCompanySignUp" class="form" method="post">
		<div id="columnCompany">
			<input type="text" name="company" id="companyName" class="inputForm" placeholder="Company Name" />
		</div>
		<div id="columnEmail">
			<input type="text" name="email" id="email" class="inputForm" placeholder="Admin Email" />
		</div>
		<div id="columnPassword">
			<input type="password" name="password" id="password" class="inputForm" placeholder="Password" />
		</div>
		<div id="signupResponse"></div>
		<button type="submit" name="submit" id="signupSubmit" class="buttonForm" value="Sign Up">Sign Up</button>
	</form>


</body>
</html>
