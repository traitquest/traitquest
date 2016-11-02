<?php
	session_start();
	// to redirect user to home page once they have logged in
	if( !isset($_SESSION['companyID']) || !isset($_SESSION['userID'])){
		header('location: index.php');
	}
	else if( ( isset($_SESSION['companyID']) && isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "employee" ){
		header('location: home.php');
	}

?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Company</title>
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
<script type="text/javascript" src="js/editcompany.js"></script>

</head>

<body>
<div id="wrapper">
	<?php include "header.php"; ?>
	<div id="mainContainer" class="container">
		<form id="formEditCompany" class="form" method="post">
			<div id="columnAddress" class="columnInput">
				<textarea type="text" name="address" id="address" class="inputForm" rows="4" placeholder="Address"></textarea>
			</div>
			<div id="columnPhone" class="columnInput">
				<input type="text" name="phone" id="phone" class="inputForm" placeholder="Phone" />
			</div>
			<div id="columnWebsite" class="columnInput">
				<input type="text" name="website" id="website" class="inputForm" placeholder="Website" />
			</div>
			<div id="columnDescription" class="columnInput">
				<textarea type="text" name="description" id="description" class="inputForm" rows="4" placeholder="Description"></textarea>
			</div>
			<div id="columnVision" class="columnInput">
				<textarea type="text" name="vision" id="vision" class="inputForm" rows="4" placeholder="Vision"></textarea>
			</div>
			<div id="columnMission" class="columnInput">
				<textarea type="text" name="mission" id="mission" class="inputForm" rows="4" placeholder="Mission"></textarea>
			</div>
			<div id="editResponse"></div>
			<input type="submit" name="submit" id="editCompanySubmit" class="buttonForm button" value="Save" />
		</form>
	</div>
</div>
</body>
</html>