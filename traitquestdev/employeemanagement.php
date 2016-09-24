<?php
	session_start();
	if( ( isset($_SESSION['companyID']) || isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "employee"){
		header('location: home');
	}
	else if( ( !isset($_SESSION['companyID']) || !isset($_SESSION['userID']) )){
		header('location: index');
	}
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee Management</title>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/employeemanagement.js"></script>

<body>
	<div>
		<p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
		<h1>Employee Management</h1>
		<div>
			<form id="formAddEmployee" class="form" method="post">
				<div id="columnCode">
					<input type="text" name="code" id="code" class="inputForm" placeholder="Employee Code" />
				</div>
				<div id="columnName">
					<input type="text" name="name" id="name" class="inputForm" placeholder="Name" />
				</div>
				<div id="columnEmail">
					<input type="text" name="email" id="email" class="inputForm" placeholder="Email" />
				</div>
				<div id="response"></div>
				<input type="submit" name="submit" id="submit" class="buttonForm" value="Add" />
			</form> 
		</div>
		<div id="employeeList"></div>
	</div>
</body>
