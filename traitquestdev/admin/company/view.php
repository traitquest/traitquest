<?php
session_start();
	// to redirect user to home page once they have logged in
	if( !isset($_SESSION['companyID']) || !isset($_SESSION['userID'])){
		header('location: ../../index.php');
	}
	else if( ( isset($_SESSION['companyID']) && isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "employee" ){
		header('location: ../../home.php');
	}

?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Company</title>
<link rel="shortcut icon" href="../../images/icon.ico">
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="../../css/color.css"/>
<link rel="stylesheet" type="text/css" href="../../css/style.css"/>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="../../js/admin/company/getcompany.js"></script>
<script type="text/javascript" src="../../js/admin/global.js"></script>
<script type="text/javascript" src="../../js/mobilenav.js"></script>
<script type="text/javascript" src="../../js/setheight.js"></script>
</head>

<body>

	<div id="mobileNav" class="mobileNav"><!mobilenav>
		<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
		<img class="userPic col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 margin-top-s imageSize100px" src="../../images/avatar2.jpg">
		<p class="userName col-lg-10 col-md-10 col-sm-10 margin-top-s fontsize-s white breakword">User123456789 123456789</p>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Company</a>
		<a href="employee.php" class="closeMobileNav padding-top-m display-block fontsize-m white">Employees</a>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Settings</a>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Logout</a>
	</div>

	<div class="hidden-sm hidden-xs sideBar affix"><!sideBar>
		<div class="col-lg-12 col-md-12 col-sm-12">
			<img class="userPic col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 margin-top-s imageSize100px" src="../../images/avatar2.jpg">
				<p class="userName col-lg-10 col-md-10 col-sm-10 margin-top-s fontsize-s breakword">User123456789 123456789</p>
			</img>
		</div>
		<div class="clear-both">
			<ul class="padding-top-m">
				<a href="#"><li class="padding-topbottom-s sideBarSelected">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-briefcase"></i></h4>
					<h4 class="display-block display-inline padding-left10px">Company</h4>
				</li></a>
				<a href="employee.php"><li class="padding-topbottom-s">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-user"></i></h4>
					<h4 class="display-block display-inline padding-left10px">Employees</h4>
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
			<img id="logo-image" src="../../images/logo.png" /></a>

		<i id="openMobileNav" class="glyphicon glyphicon-menu-hamburger
			hidden-lg hidden-md col-sm-2 col-xs-2 float-right
			display-block display-inline padding-topbottom-s text-right fontsize-l cursor-pointer"></i>


	</div>


	<div class="clear col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 white-bg">

			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 padding-topbottom-s">
				<h3>Company</h3>
			</div>
			<div class="text-right col-lg-2 col-md-2 col-sm-2 col-xs-2 padding-topbottom-s">
				<a href="edit.php"><h3><i class="glyphicon glyphicon-edit"></i></h3></a>
			</div>

	</div>

	<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xs-12 grey95-bg padding-bottom-s"><!content goes here>
		<div class="col-lg-12 col-md-12 padding-top-l"><!1stwindow>			
			<div class="padding-bottom-s padding-leftright-s border-top-grey white-bg clear">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<img class="userPic center margin-top-s imageSize100px" src="../../images/avatar2.jpg">
					<button class="margin-topbottom-xs btn btn-default center fontsize-s">Change picture</button>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<h3 id="companyName" class="grey30"></h3>
					<div class="padding-top-s">
						<h3 class="display-block display-inline"><i class="glyphicon glyphicon-map-marker"></i></h3>
						<p id="companyAddress" class="padding-left10px fontsize-m display-block display-inline"></p>
					</div>
					<div class="padding-top-s">
						<h3 class="display-block display-inline"><i class="glyphicon glyphicon-envelope"></i></h3>
						<p id="companyEmail" class="padding-left10px fontsize-m display-block display-inline"></p>
					</div>
					<div class="padding-top-s">
						<h3 class="display-block display-inline"><i class="glyphicon glyphicon-phone-alt"></i></h3>
						<p id="companyPhone" class="padding-left10px fontsize-m display-block display-inline"></p>
					</div>
					<div class="padding-top-s">
						<h3 class="display-block display-inline"><i class="glyphicon glyphicon-send"></i></h3>
						<p id="companyFax" class="padding-left10px fontsize-m display-block display-inline"></p>
					</div>
					<div class="padding-top-s">
						<h3 class="display-block display-inline"><i class="glyphicon glyphicon-globe"></i></h3>
						<p id="companyWebsite" class="padding-left10px fontsize-m display-block display-inline"></p>
					</div>
				</div>
			</div>
		</div>
		
		<div id="companyData"></div><!-- Description, Vision, Mission etc go in here-->

		<footer class="stickyFooter grey95-bg">
			<div class="">
				<p class="text-center fontsize-s padding-top-xs grey30"><strong>&copy; 2016 TraitQuest. All rights reserved.</strong></p>
			</div>
		</footer>

	</div><!content ends here>
</body>
</html>
