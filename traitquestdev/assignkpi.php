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

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/createeditkpi.js"></script>

<body>
<div id="wrapper">
	<?php include "header.php"; ?>
	<div id="mainContainer" class="container">
		<form id="formAssignKPI" class="form" method="post">			
			<div id="columnKRA" class="columnInput">
				<select id="kra" class="inputForm" >
					<option value="0">Select a KRA</option>
				</select>
			</div>
			<div id="columnKPI" class="columnInput">
				<select id="kpi" class="inputForm" >
					<option value="0">Select a KPI</option>
				</select>
			</div>
			<div id="columnDescription" class="columnInput">
				<textarea type="text" name="description" id="description" class="inputForm" rows="4" placeholder="Description"></textarea>
			</div>
			
			<div id="editResponse"></div>
			<input type="submit" name="submit" id="editKPISubmit" class="buttonForm button" value="Save" />
			<input type="button" name="cancel" id="editKPICancel" class="buttonForm button" value="Cancel" />
						
		</form>
	</div>
</div>
</body>
</html>