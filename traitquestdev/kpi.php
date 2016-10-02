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
<title>KPI</title
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
						CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/kpi.js"></script>

<style>
.photoContainer {
	margin: 25px;
	width: 200px;
	height: 200px;
	display: inline-block;
	position: relative;
}
.image{
	width: 200px;
	height: 200px;
}
.checked{
	width: 100px; 
	height: 100px;
	top: 25%;
	left: 25%;
	position: absolute;
	visibility: hidden;
}
.completed .checked{
	visibility: visible;
}
</style>

<body>
	<div>
		<p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
	</div>
	<div id="kpiContainer">
		<div id="kpiQuizContainer" hidden>
			<iframe id="kpiQuiz" src="https://docs.google.com/forms/d/e/1FAIpQLSfufMiybUS3ho6Uv8rqujN4qnvd1c2Wxp6wRshuIKBaTeut_w/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
		</div>
	</div>
	<div id="kpiSubmission"></div>
	<div id="completedPopUp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	    <div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
			  <img src="http://viddyoze.com/club-final/images/badge.png" />
			  <input type="submit" id="completedButton" value="Next" />
			</div>
	    </div>
	</div>	
</body>
