<?php
	session_start();
	if( ( isset($_SESSION['companyID']) || isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "admin"){
		header('location: admin.php');
	}
	else if( ( !isset($_SESSION['companyID']) || !isset($_SESSION['userID']) )){
		header('location: index.php');
	}
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KPI</title>
<link rel="shortcut icon" href="images/icon.ico">
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.datetimepicker.css"/>
<link rel="stylesheet" type="text/css" href="css/color.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<style>
.bootstrap-datetimepicker-widget .datepicker-days table tbody tr:hover {
    background-color: #eee;
}
</style>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="js/bootstrap.js"></script>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/momentjs/2.10.6/moment.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
<script src="//cdn.jsdelivr.net/bootstrap.datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript" src="js/changekpi.js"></script>

<body>
<div id="wrapper">
	<?php include "header.php"; ?>
	<div id="mainContainer" class="container">
		<form id="formKPI" method="post">
			<div id="columnDate">
				<input type="text" id="weeklyDatePicker" class="inputForm" placeholder="Select Week" />
			</div>
			<div id="columnKPICategory">
				<select id="kpicategory" class="inputForm" >
					<option value="1">Improve Customer Satisfaction</option>
					<option value="2">Increase Sales Revenue</option>
					<option value="3">Increase Employee Efficiency</option>
					<option value="4">Others</option>
				</select>
			</div>
			<div id="columnDescription">
				<textarea type="text" name="description" id="description" class="inputForm" rows="4" placeholder="Description"></textarea>
			</div>
		</form>
	</div>
</div>
</body>
</html>