<?php/*
	session_start();
	// to redirect user to home page once they have logged in
	if( !isset($_SESSION['companyID']) || !isset($_SESSION['userID'])){
		header('location: ../../index.php');
	}
	else if( ( isset($_SESSION['companyID']) && isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "admin" ){
		header('location: ../../admin/employee.php');
	}
*/
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profile</title>
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
<script type="text/javascript" src="../../js/my/profile/getemployee.js"></script>-->
<script type="text/javascript" src="../../js/setheight.js"></script>
<script type="text/javascript" src="../../js/mobilenav.js"></script>
</head>
<body>
<div id="mobileNav" class="mobileNav"><!mobilenav>
	<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
	<img class="userPic clear-both center margin-top-s imageSize100px" src="../../images/avatar2.jpg">
	<p class="userName clear-both center margin-top-s fontsize-s white breakword">User123456789 123456789</p>
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
			<img class="userPic center margin-top-s imageSize100px" src="../../images/avatar2.jpg"></img>
			<button id=""><p class="img-description fontsize-s black-bg white width100px">Upload Photo</p></button>
		</div>
			<p class="userName text-center margin-top-s fontsize-s breakword">User123456789 123456789</p>

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
				<h3>Profile</h3>
			</div>
			<div class="text-right col-lg-2 col-md-2 col-sm-2 col-xs-2 padding-topbottom-s">
				<a href="edit.php"><h3><i class="glyphicon glyphicon-edit"></i></h3></a>
			</div>

	</div>


	<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xs-12 grey95-bg padding-bottom-s"><!content goes here>
		<div id="mainContainer">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s border-top-grey white-bg"><!1stwindow>
				<div class="clear-both margin-top-s">

						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-top-s">
							<img class="center margin-top-s imageSize100px" src="../../images/avatar2.jpg">
							<button class="center">upload</button>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 margin-top-s">
							<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
							<div class="clear-both margin-top-xs">
								<p class="fontsize-m col-lg-3 col-md-3 col-sm-12 col-xs-12">Name</p>
								<p class="fontsize-m col-lg-9 col-md-9 col-sm-12 col-xs-12 breakword">asdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdf</p>
							</div>
							<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
							<div class="clear-both margin-top-xs">
								<p class="black fontsize-m col-lg-3 col-md-3 col-sm-12 col-xs-12">Email</p>
								<p class="fontsize-m col-lg-9 col-md-9 col-sm-12 col-xs-12 breakword">asdf@asdf.com</p>
							</div>
							<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
							<div class="clear-both margin-top-xs">
								<p class="black fontsize-m col-lg-3 col-md-3 col-sm-12 col-xs-12">Department</p>
								<p class="fontsize-m col-lg-9 col-md-9 col-sm-12 col-xs-12 breakword">Accounting</p>
							</div>
							<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
							<div class="clear-both margin-top-xs">
								<p class="black fontsize-m col-lg-3 col-md-3 col-sm-12 col-xs-12">Extension</p>
								<p class="fontsize-m col-lg-9 col-md-9 col-sm-12 col-xs-12 breakword">227</p>
							</div>
							<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
							<div class="clear-both margin-top-xs">
								<p class="black fontsize-m col-lg-3 col-md-3 col-sm-12 col-xs-12">Hire Date</p>
								<p class="fontsize-m col-lg-9 col-md-9 col-sm-12 col-xs-12 breakword">5/1/2017</p>
							</div>
							<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
						</div>

				</div>

					<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 margin-top-s padding-leftright-s padding-bottom-s">

							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="clear-both white">Personal Info</h3>
								</div>
								<div class="panel-body">
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">Mobile</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">0123456789</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">D.O.B</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">22/2/2002</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">Nationality</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">Malaysia</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">Race</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">Indian</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">Religion</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">Hindu</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">Marital Status</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">Married</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">Bio</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">asdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdf
											asdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdf</p>
									</div>
								</div>
							</div>

					</div>
					<div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-12 col-xs-12 margin-top-s padding-leftright-s padding-bottom-s">

							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="clear-both white">Employee Info</h3>
								</div>
								<div class="panel-body">
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12">Employee No.</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">T032</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12">Address</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">606-3727 Ullamcorper. Street, Roseville NH 11523</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12">Bank Info</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">CIMB 1561851684</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12">EPF</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">146852</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12">Socso</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">57415215</p>
									</div>
								</div>
							</div>

					</div>

					<div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 col-sm-12 col-xs-12 margin-top-s padding-leftright-s padding-bottom-s">

							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="clear-both white">Emergency Contact</h3>
								</div>
								<div class="panel-body">
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">Name</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">sdasdagfa</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">Relationship</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">Spouse</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">Phone No.</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">0147258369</p>
									</div>
									<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
									<div class="clear-both margin-top-xs">
										<p class="fontsize-m col-lg-5 col-md-5 col-sm-12 col-xs-12 ">Alt. Phone No.</p>
										<p class="fontsize-m col-lg-7 col-md-7 col-sm-12 col-xs-12 breakword">0369258147</p>
									</div>
								</div>
							</div>

					</div>



			<div id="superiorContainer" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-s padding-leftright-s padding-bottom-s">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="clear-both white">Superior</h3>
					</div>
					<div class="panel-body">
						<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="../../images/avatar3.jpg">
							<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li><li>email</li></ul>
						</div>
						<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
						<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="../../images/avatar4.jpg">
							<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li><li>email</li></ul>
						</div>
						<div id="superiorList"></div>
					</div>
				</div>
			</div>

			<div id="subordinateContainer" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="clear-both white">Subordinate</h3>
					</div>
					<div class="panel-body">
						<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="../../images/avatar5.jpg">
							<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li><li>email</li></ul>
						</div>
						<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
						<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="../../images/avatar6.jpg">
							<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li><li>email</li></ul>
						</div>
						<div class="clear-both visible-sm visible-xs horizontal-divider"></div>
						<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="../../images/avatar7.jpg">
							<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li><li>email</li></ul>
						</div>
						<div id="subordinateList"></div>
					</div>
				</div>
			</div>

		</div>
		<footer class="stickyFooter grey95-bg">
			<div class="">
				<p class="text-center fontsize-s padding-top-xs grey30"><strong>&copy; 2016 TraitQuest. All rights reserved.</strong></p>
			</div>
		</footer>
	</div>

</body>
</html>
