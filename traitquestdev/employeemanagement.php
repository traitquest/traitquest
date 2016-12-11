<?php /*
	session_start();
	if( ( isset($_SESSION['companyID']) || isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "employee"){
		header('location: home');
	}
	else if( ( !isset($_SESSION['companyID']) || !isset($_SESSION['userID']) )){
		header('location: index');
	} */
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Employee Management</title>
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
<!--<script type="text/javascript" src="js/employeemanagement.js"></script>-->
<script type="text/javascript" src="js/setheight.js"></script>
<script type="text/javascript" src="js/mobilenav.js"></script>

<body>

		<div id="mobileNav" class="mobileNav"><!mobilenav>
			<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
			<img class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 margin-top-s imageSize100px" src="./images/avatar2.jpg">
			<p class="col-lg-10 col-md-10 col-sm-10 margin-top-s fontsize-s white breakword">User123456789 123456789</p>
			<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Company</a>
			<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Employees</a>
			<a href="#" class="hidden closeMobileNav padding-top-m display-block fontsize-m white">Settings</a>
			<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Logout</a>
		</div>

		<div class="hidden-sm hidden-xs sideBar affix"><!sideBar>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<img class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 margin-top-s imageSize100px" src="./images/avatar2.jpg">
					<p class="col-lg-10 col-md-10 col-sm-10 margin-top-s fontsize-s breakword">User123456789 123456789</p>
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
			<img id="logo-image" src="images/logo.png" /></a>

		<i id="openMobileNav" class="glyphicon glyphicon-menu-hamburger
			hidden-lg hidden-md col-sm-2 col-xs-2 float-right
			display-block display-inline padding-topbottom-s text-right fontsize-l cursor-pointer"></i>


	</div>

	<div class="clear col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 white-bg">

			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 padding-topbottom-s">
				<h3>Employees</h3>
			</div>

	</div>

<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xs-12 grey95-bg padding-bottom-s"><!content goes here>

	<div id="mainContainer">
			<form id="formAddEmployee" class="form col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-s padding-leftright-s padding-bottom-s border-top-grey white-bg" method="post">
				<h3>Add Employee</h3>
				<div id="columnName" class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<input type="text" name="name" id="name" class="inputForm margin-top-s" placeholder="Name" />
				</div>
				<div id="columnEmail" class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<input type="text" name="email" id="email" class="inputForm margin-top-s" placeholder="Email" />
				</div>
				<div id="columnCode" class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<input type="text" name="code" id="code" class="inputForm margin-top-s" placeholder="Employee Code" />
				</div>
				<div id="response"></div>
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<input type="submit" name="submit" id="submit" class="inputForm margin-top-s button" value="Add" />
			</div>
			</form>

			<div class="form col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s border-top-grey white-bg">
				<form id="formSearchEmployee" method="post">
					<h3 class="col-lg-6 col-md-6">Employee List</h3>
					<div class="col-lg-3 col-lg-offset-3 col-md-3 col-md-offset-3">
						<div id="columnSearch" class="icon-addon icon-addon-right">
							<input type="text" name="search" id="search" class="inputForm margin-top-s" placeholder="Search.." />
							<button type="submit" id="submitSearch"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				</form>

				<div id="employeeList"></div>
				<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="img-wrap">
					<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="./images/avatar4.jpg">
					<button type="submit" id=""><i class="del red glyphicon glyphicon-remove-sign"></i></button>
					<button type="submit" id=""><i class="edit green glyphicon glyphicon-edit"></i></button>
					</div>
					<ul class="padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li><li>email</li></ul>
				</div>
					<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="img-wrap">
						<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="./images/avatar5.jpg">
						<button type="submit" id=""><i class="del red glyphicon glyphicon-remove-sign"></i></button>
						<button type="submit" id=""><i class="edit green glyphicon glyphicon-edit"></i></button>
						</div>
						<ul class="padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li><li>email</li></ul>
					</div>
					<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="img-wrap">
						<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="./images/avatar6.jpg">
						<button type="submit" id=""><i class="del red glyphicon glyphicon-remove-sign"></i></button>
						<button type="submit" id=""><i class="edit green glyphicon glyphicon-edit"></i></button>
						</div>
						<ul class="padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li><li>email</li></ul>
					</div>
					<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="img-wrap">
						<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="./images/avatar7.jpg">
						<button type="submit" id=""><i class="del red glyphicon glyphicon-remove-sign"></i></button>
						<button type="submit" id=""><i class="edit green glyphicon glyphicon-edit"></i></button>
						</div>
						<ul class="padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li><li>email</li></ul>
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
