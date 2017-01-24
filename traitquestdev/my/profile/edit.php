<?php/*
	session_start();
	// to redirect user to home page once they have logged in
	if( !isset($_SESSION['companyID']) || !isset($_SESSION['userID'])){
		header('location: ../../index.php');
	}
	else if( ( isset($_SESSION['companyID']) && isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "admin" ){
		header('location: ../../admin/employee.php');
	}*/
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Profile</title>
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
<!--<script type="text/javascript" src="../../js/my/global.js"></script>
<script type="text/javascript" src="../../js/my/profile/editprofile.js"></script>-->
<script type="text/javascript" src="../../js/setheight.js"></script>
<script type="text/javascript" src="../../js/mobilenav.js"></script>

</head>

<body>
	<div id="mobileNav" class="mobileNav"><!mobilenav>
		<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
		<img class="userPic clear-both center margin-top-s imageSize100px" src="../../images/avatar2.jpg">
		<p class="userName clear-both center fontsize-s white breakword">User123456789 123456789</p>
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
				<img class="center margin-top-s imageSize100px" src="../../images/avatar2.jpg">
				<button id=""><p class="img-description fontsize-s black-bg white width100px">Upload Photo</p></button>
			</div>
				<p class="text-center margin-top-s fontsize-s breakword">User123456789 123456789</p>
			</img>
		</div>
		<div class="clear-both">
			<ul class="padding-top-m">
				<a href="#"><li class="padding-topbottom-s">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-briefcase"></i></h4>
					<h4 class="display-block display-inline padding-left10px">Company</h4>
				</li></a>
				<a href="#"><li class="padding-topbottom-s sideBarSelected">
					<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-user"></i></h4>
					<h4 class="display-block display-inline padding-left10px">Profile</h4>
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
			<img id="logo-image" src="../../images/logo.png" /></a>

		<i id="openMobileNav" class="glyphicon glyphicon-menu-hamburger
			hidden-lg hidden-md col-sm-2 col-xs-2 float-right
			display-block display-inline padding-topbottom-s text-right fontsize-l cursor-pointer"></i>


	</div>

	<div class="clear col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 white-bg">

			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 padding-topbottom-s">
				<h3>Edit Profile</h3>
			</div>

	</div>


	<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xs-12 grey95-bg padding-bottom-s"><!content goes here>
		<div class="col-lg-12 col-md-12 margin-topbottom-s padding-topbottom-l padding-leftright-s border-top-grey white-bg">
		<div id="mainContainer">
			<form id="formEditProfile" class="form" method="post">
				<div id="columnPhone" class="columnInput">
					<p class="clear-both padding-top-s">Mobile</p>
					<input type="text" name="phone" id="phone" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" placeholder="Mobile Phone No." />
				</div>
				<div id="" class="columnInput">
					<p class="clear-both padding-top-s">D.O.B</p>
					<input type="text" name="" id="" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" placeholder="Date of Birth" />
				</div>
				<div id="" class="columnInput">
					<p class="clear-both padding-top-s">Nationality</p>
					<?php include 'countryselect.php' ?>
				</div>
				<div id="" class="columnInput">
					<p class="clear-both padding-top-s">Race</p>
					<select class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" name="race">
						<option value="">Select</option>
						<option value="chinese">Chinese</option>
						<option value="malay">Malay</option>
						<option value="indian">Indian</option>
						<option value="other">Other</option>
					</select>
				</div>
				<div id="" class="columnInput">
					<p class="clear-both padding-top-s">Religion</p>
					<input type="text" name="" id="" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" placeholder="Religion" />
				</div>
				<div id="" class="columnInput">
					<p class="clear-both padding-top-s">Marital Status</p>
					<select class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" name="race">
						<option value="">Select</option>
						<option value="single">Single</option>
						<option value="married">Married</option>
						<option value="other">Other</option>
					</select>
				</div>
				<div id="" class="columnInput">
					<p class="clear-both padding-top-s">Bio</p>
					<textarea type="text" name="" id="" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" rows="4" placeholder="Bio"></textarea>
				</div>
				<div id="columnAddress" class="columnInput">
					<p class="clear-both padding-top-s">Address</p>
					<textarea type="text" name="address" id="address" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" rows="4" placeholder="Address"></textarea>
				</div>
				<div id="" class="columnInput">
					<p class="clear-both padding-top-s">Emergency Contact</p>
					<input type="text" name="" id="" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12 margin-bottom-xs" placeholder="Name" />
					<input type="text" name="" id="" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12 margin-bottom-xs" placeholder="Relationship" />
					<input type="text" name="" id="" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12 margin-bottom-xs" placeholder="Phone No." />
					<input type="text" name="" id="" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12 margin-bottom-xs" placeholder="Alt. Phone No." />
				</div>

				<div id="editResponse"></div>
				<div class="clear-both text-right">
					<input type="submit" name="submit" id="editProfileSubmit" class="buttonForm button clear-both display-block display-inline margin-top-xs" value="Save" />
					<input type="submit" name="submit" id="editProfileCancel" class="buttonForm buttonCancel clear-both display-block display-inline margin-top-xs" value="Cancel" />
				</div>
			</form>
		</div>
		</div>
		<footer class="stickyFooter grey95-bg">
			<div class="">
				<p class="text-center fontsize-s padding-top-xs grey30"><strong>&copy; 2016 TraitQuest. All rights reserved.</strong></p>
			</div>
		</footer>
	</div>
</div>
</body>
</html>
