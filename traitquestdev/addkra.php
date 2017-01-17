<?php/*
session_start();
	// to redirect user to home page once they have logged in
	if( !isset($_SESSION['companyID']) || !isset($_SESSION['userID'])){
		header('location: ../index.php');
	}
	else if( ( isset($_SESSION['companyID']) && isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "employee" ){
		header('location: ../home.php');
	}
*/
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KRA</title>
<link rel="shortcut icon" href="images/icon.ico">
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/color.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="js/mobilenav.js"></script>
<script type="text/javascript" src="js/setheight.js"></script>
<script type="text/javascript" src="js/toggledescription.js"></script>
<script type="text/javascript" src="js/barwidth.js"></script>
<script type="text/javascript" src="js/datepicker.js"></script>

</head>

<body>

	<div id="mobileNav" class="mobileNav"><!mobilenav>
		<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
		<img class="clear-both margin-top-s imageSize100px" src="./images/avatar2.jpg">
		<p class="clear-both margin-top-s fontsize-s white breakword">User123456789 123456789</p>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Company</a>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Profile</a>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">KPI</a>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">People</a>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Settings</a>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Logout</a>
	</div>

	<div class="hidden-sm hidden-xs sideBar affix"><!sideBar>
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="img-wrap">
				<img class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 margin-top-s imageSize100px" src="./images/avatar2.jpg">
				<button id=""><p class="img-description fontsize-s black-bg white">Upload Photo</p></button>
			</div>
				<p class="col-lg-10 col-md-10 col-sm-10 margin-top-s fontsize-s breakword">User123456789 123456789</p>
			</img>
		</div>
		<div class="clear-both">
			<ul class="padding-top-m">
				<a href="#"><li class="padding-topbottom-s">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-briefcase"></i></h4>
					<h4 class="display-block display-inline padding-left10px">Company</h4>
				</li></a>
				<a href="#"><li class="padding-topbottom-s">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-user"></i></h4>
					<h4 class="display-block display-inline padding-left10px">Profile</h4>
				</li></a>
				<a href="#"><li class="padding-topbottom-s sideBarSelected">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-user"></i></h4>
					<h4 class="display-block display-inline padding-left10px">KRA</h4>
				</li></a>
				<a href="#"><li class="padding-topbottom-s">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-stats"></i></h4>
					<h4 class="display-block display-inline padding-left10px">KPI</h4>
				</li></a>
				<a href="#"><li class="padding-topbottom-s">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-user"></i></h4>
					<h4 class="display-block display-inline padding-left10px">People</h4>
				</li></a>
				<a href="#"><li class="padding-topbottom-s">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-cog"></i></h4>
					<h4 class="display-block display-inline padding-left10px">Settings</h4>
				</li></a>
				<a href="#"><li class="padding-topbottom-s">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-off"></i></h4>
					<h4 class="display-block display-inline padding-left10px">Logout</h4>
				</li></a>

			</ul>
		</div>
	</div>


	<div class="clear col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 padding-topbottom-xs grey95-bg">

			<a href="http://traitquest.com/">
			<img id="logo-image" src="images/logo.png" /></a>

		<i id="openMobileNav" class="glyphicon glyphicon-menu-hamburger
			hidden-lg hidden-md col-sm-2 col-xs-2 float-right
			display-block display-inline padding-topbottom-s text-right fontsize-l cursor-pointer"></i>


	</div>


	<div class="clear col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 white-bg">

			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 padding-topbottom-s">
				<h3>KRA</h3>
			</div>

	</div>

	<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xs-12 grey95-bg padding-bottom-s"><!content goes here>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s border-top-grey white-bg"><!1stwindow>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-xs padding-leftright-s padding-bottom-s">
					<p>Date: <input type="text" id="datepicker"></p>
			</div>

			<form>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s border-top-grey white-bg">
					<h3 class="clear-both">Human Resource</h3>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text1</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text2</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text3</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text4</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text5</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text6</input>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s border-top-grey white-bg">
					<h3 class="clear-both">Finance</h3>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text1</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text2</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text3</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text4</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text5</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text6</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text7</input>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
						<input type="checkbox"> Text8</input>
					</div>
					<div class="margin-top-m clear-both float-right">
						<input type="submit" name="submit" id="addKRASubmit" class="buttonForm button clear-both display-block display-inline margin-top-xs" value="Save" />
						<input type="reset" class="buttonForm buttonCancel clear-both display-block display-inline margin-top-xs" value="Clear Selection" />
					</div>
				</div>
			</form>


		</div>

		<footer class="stickyFooter grey95-bg">
			<div class="">
				<p class="text-center fontsize-s padding-top-xs grey30"><strong>&copy; 2016 TraitQuest. All rights reserved.</strong></p>
			</div>
		</footer>
	</div><!content ends here>
</body>
</html>
