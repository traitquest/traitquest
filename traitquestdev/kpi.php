<?php
	session_start();
	if( ( isset($_SESSION['companyID']) || isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "admin"){
		header('location: admin');
	}
	else if( ( !isset($_SESSION['companyID']) || !isset($_SESSION['userID']) )){
		header('location: index');
	}
	else if( !isset($_GET['id']) ){
		header('location: home');
	}
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KPI</title>
<link rel="shortcut icon" href="images/icon.ico">
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
						CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/color.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/kpi.css"/>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/kpi.js"></script>

<body>
<div id="wrapper">	
	<?php include "header.php" ;?>
	<div id="kpiContainer" class="container">
		<div id="kpiDescription"></div>
		<div id="kpiQuizContainer" hidden>
			<iframe id="kpiQuiz" class="col-xs-12" src="https://docs.google.com/forms/d/e/1FAIpQLSfLmbaA3df_z71TowGJjVu8gkp2ZWRkpDaY85sAJf-pVmseaA/viewform?embedded=true" frameborder="0">Loading...</iframe>
		</div>
	</div>
	<div id="kpiSubmission" class="margin-topbottom-s"></div>
	<div id="completedPopUp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	    <div class="modal-dialog modal-sm" role="document">
			<div class="modal-content padding-s">
			  <img id="completedBadge" src="http://viddyoze.com/club-final/images/badge.png" />
			  <p class="text-center margin-topbottom-s fontsize-s">Congratulations! You have completed the task!</p>
			  <input type="submit" id="completedButton" class="button margin-topbottom-xs" value="Next" />
			</div>
	    </div>
	</div>
</div>
</body>
