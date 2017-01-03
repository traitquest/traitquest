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
<link rel="stylesheet" type="text/css" href="css/color.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/subkpi.js"></script>

<body>
<div id="wrapper">
	<?php include "header.php"; ?>
	<div id="mainContainer" class="container">
		<div class="input-append date" id="datepicker" data-date="102/2012" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">  
		<input class="span2" size="16" type="text" value="01/2015" readonly>
		  <span class="add-on"><i class="glyphicon glyphicon-comment"></i></span>
		</div>
		<button id="buttonAssignKPI">Add new</button>
		<div id="kpiList"></div>
	</div>
</div>
</body>
</html>