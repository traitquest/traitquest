<?php
	session_start();
	if( ( isset($_SESSION['companyID']) || isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "employee"){
		header('location: ../../home.php');
	}
	else if( ( !isset($_SESSION['companyID']) || !isset($_SESSION['userID']) )){
		header('location: ../../index.php');
	} 
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Department</title>
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
<script type="text/javascript" src="../../js/admin/department/view.js"></script>
<script type="text/javascript" src="../../js/admin/global.js"></script>
<script type="text/javascript" src="../../js/bootstrap.js"></script>
<script type="text/javascript" src="../../js/setheight.js"></script>
<script type="text/javascript" src="../../js/mobilenav.js"></script>

<body>

		<div id="mobileNav" class="mobileNav"><!mobilenav>
			<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
			<img class="userPic col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 margin-top-s imageSize100px" src="../../images/avatar2.jpg">
			<p class="userName col-lg-10 col-md-10 col-sm-10 margin-top-s fontsize-s white breakword">User123456789 123456789</p>
			<a href="company.php" class="closeMobileNav padding-top-m display-block fontsize-m white">Company</a>
			<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Employees</a>
			<a href="#" class="hidden closeMobileNav padding-top-m display-block fontsize-m white">Settings</a>
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
					<a href="company.php"><li class="padding-topbottom-s">
						<h4 class="display-block display-inline padding-left10px"><i class="glyphicon glyphicon-briefcase"></i></h4>
						<h4 class="display-block display-inline padding-left10px">Company</h4>
					</li></a>
					<a href="#"><li class="padding-topbottom-s sideBarSelected">
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
				<h3>Department</h3>
			</div>

	</div>

<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xs-12 grey95-bg padding-bottom-s"><!content goes here>

	<div id="mainContainer">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s">
 				<div class="img-wrap">
 					<h4><a id="addDepartmentButton" href="#"><i class="black glyphicon glyphicon-plus-sign"></i></a></h4>
 				</div>
 			</div>

			<div class="form col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s border-top-grey white-bg">
				<div id="departmentList"></div><!-- list of department go in here -->
			</div>
			
			<div id="addDepartmentModal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="addDepartmentModal">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<h4 class="text-center grey margin-top-xs">Enter department name:</h4>
						<form id="formDepartment" class="form padding-topbottom-s" method="post">
							<div id="columnDepartment">
								<input type="text" name="department" id="department" class="inputForm" placeholder="Department" />
							</div>
							<div id="departmentResponse"></div>
							<input type="submit" name="submit" id="submitDepartment" class="clear-both inputForm button margin-top-xs" value="Save" />
							<input type="button" name="cancel" id="cancelDepartment" class="clear-both inputForm buttonCancel margin-top-xs" value="Cancel" />
						</form>
					</div>
				</div>
			</div><!addDepartmentModal.>
	</div>

	<footer class="stickyFooter grey95-bg">
		<div class="">
			<p class="text-center fontsize-s padding-top-xs grey30"><strong>&copy; 2016 TraitQuest. All rights reserved.</strong></p>
		</div>
	</footer>

</div>

</body>
</html>
