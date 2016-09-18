<?php
	session_start();
	if( !isset($_SESSION['companyID']) || !isset($_SESSION['userID']) ){
		header('location: login');
	}
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/changepassword.js"></script>

<body>
	<h1>Change Password</h1>
	<form id="formChangePassword" class="form" method="post">
		<div id="columnOldPassword">
			<input type="password" name="oldPassword" id="oldPassword" class="inputForm" placeholder="Old Password" />
		</div>
		<div id="columnNewPassword">
			<input type="password" name="newPassword" id="newPassword" class="inputForm" placeholder="New Password" />
		</div>
		<div id="columnRetypeNewPassword">
			<input type="password" name="retypePassword" id="retypePassword" class="inputForm" placeholder="Retype Password" />
		</div>
		<div id="response"></div>
		<input type="submit" name="submit" id="submit" class="buttonForm" value="Change Password" />
	</form>
</body>
