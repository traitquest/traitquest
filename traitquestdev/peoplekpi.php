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

<title>People</title>
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
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript" src="js/toggledescription.js"></script>
<script type="text/javascript" src="js/barwidth.js"></script>

</head>

<body>

	<div id="mobileNav" class="mobileNav"><!mobilenav>
		<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
		<img class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 margin-top-s imageSize100px" src="./images/avatar2.jpg">
		<p class="col-lg-10 col-md-10 col-sm-10 margin-top-s fontsize-s white breakword">User123456789 123456789</p>
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
				<a href="#"><li class="padding-topbottom-s">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-stats"></i></h4>
					<h4 class="display-block display-inline padding-left10px">KPI</h4>
				</li></a>
				<a href="#"><li class="padding-topbottom-s sideBarSelected">
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
				<h3>People</h3>
			</div>

	</div>

	<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xs-12 grey95-bg padding-bottom-s"><!content goes here>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s border-top-grey white-bg"><!1stwindow>

			<div class="margin-top-s col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-12" src="./images/avatar5.jpg">
				<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li></ul>
			</div>
			<div class="margin-top-s col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 hidden-xs">
				<h3 class="display-block display-inline"><button><i class="glyphicon glyphicon-plus-sign"></i></button></h3>
				<h3 class="display-block display-inline"><button><i class="glyphicon glyphicon-print"></i></button></h3>
			</div>

			<div class="clear col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s">
				<input type="text" id="datepicker" placeholder="Date" class="margin-xs" />
			</div>

			<div class="clear-both col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s">

				<div class="clear-both padding-topbottom-s border-top-grey white-bg"><!kpi1>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-bottom-xs">
      		<p class="display-inline">
						KPI 1<button id="toggledescription1"><i class="glyphicon glyphicon-plus"></i></button>
					</p>
					<div class="statuspending visible-xs">
						<i class="glyphicon glyphicon-option-horizontal display-block display-inline"></i>
						<p class="display-block display-inline">Pending</p>
					</div>

					<p id="kpidetail1" class="kpidetail breakword">
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						Description
					</p>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs margin-topbottom-xs">
					<div class="statuspending">
					<i class="glyphicon glyphicon-option-horizontal display-block display-inline"></i>
					<p class="display-block display-inline">Pending</p>
					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 margin-topbottom-xs">

					<div class="progress">

  					<div class="progress-bar progress-bar-info" role="progressbar"
						aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo "80" /*number here*/ ?>">

  					</div>

					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 margin-topbottom-xs">
					<p>number1/number2</p>
				</div>


				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-topbottom-xs">
					<button class="buttonwidth70 buttonverify fontsize-s">Verify</button>
					<button class="buttonwidth70 buttondeny fontsize-s">Deny</button>
				</div>
			</div><!kpi1.>


			<div class="clear-both padding-topbottom-s border-top-grey white-bg"><!kpi2>
				<div class="clear-both col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-topbottom-xs">
      		<p class="display-inline">
						KPI 2<button id="toggledescription2"><i class="glyphicon glyphicon-plus"></i></button>
					</p>
					<div class="statusverified visible-xs">
						<i class="glyphicon glyphicon-ok display-block display-inline"></i>
						<p class="display-block display-inline">Verified</p>
					</div>

					<p id="kpidetail2" class="kpidetail breakword">
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						Description
					</p>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs margin-topbottom-xs">
					<div class="statusverified">
					<i class="glyphicon glyphicon-ok display-block display-inline"></i>
					<p class="display-block display-inline">Verified</p>
					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 margin-topbottom-xs">
					<div class="progress">

  					<div class="progress-bar progress-bar-success" role="progressbar"
						aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo "30" /*number here*/ ?>">

  					</div>

					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 margin-topbottom-xs">
					<p>number1/number2</p>
				</div>


				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-topbottom-xs">
					<button class="buttonwidth70 buttonverify fontsize-s">Verify</button>
					<button class="buttonwidth70 buttondeny fontsize-s">Deny</button>
				</div>
			</div><!kpi2.>

					</div>
					<?php include 'loading.php'; ?>
				</div>

<footer class="stickyFooter grey95-bg">
	<div class="">
		<p class="text-center fontsize-s padding-top-xs grey30"><strong>&copy; 2016 TraitQuest. All rights reserved.</strong></p>
	</div>
</footer>
  		</div>

			</div>

		</div>
	</div><!content ends here>
</body>
</html>
