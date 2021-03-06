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
<title>Employee</title>
<link rel="shortcut icon" href="../../images/icon.ico">
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="../../css/color.css"/>
<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../../css/datepicker.css"/>
<style>
.datepicker-icon-addon{position:relative;}
.datepicker-icon-addon .glyphicon{position:absolute;padding-top:5px;padding-left:10px;}
</style>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="../../js/admin/employee/editemployee.js"></script>
<script type="text/javascript" src="../../js/admin/global.js"></script>
<script type="text/javascript" src="../../js/setheight.js"></script>
<script type="text/javascript" src="../../js/mobilenav.js"></script>
<script type="text/javascript" src="../../js/bootstrap-datepicker.js"></script>

</head>

<body>
	<div id="mobileNav" class="mobileNav"><!mobilenav>
		<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
		<img class="userPic col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 margin-top-s imageSize100px" src="../../images/avatar2.jpg">
		<p class="userName col-lg-10 col-md-10 col-sm-10 margin-top-s fontsize-s white breakword">User123456789 123456789</p>
		<a href="company.php" class="closeMobileNav padding-top-m display-block fontsize-m white">Company</a>
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
				<a href="company.php"><li class="padding-topbottom-s sideBarSelected">
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
				<h3>Edit Employee</h3>
			</div>

	</div>
	<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xs-12 grey95-bg padding-bottom-s"><!content goes here>
			<div id="mainContainer" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-topbottom-l padding-leftright-s border-top-grey white-bg">
				<form id="formEditEmployee" class="form" method="post">
					<div id="columnEmployeePic" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
					<div id="columnEmployeeName" class="columnInput">
						<p class="clear-both padding-top-s">Name</p>
						<input type="text" name="employeeName" id="employeeName" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" placeholder="Name" />
					</div>
					<div id="columnEmployeeCode" class="columnInput">
						<p class="clear-both padding-top-s">Employee No.</p>
						<input type="text" name="employeeCode" id="employeeCode" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" placeholder="Employee No." />
					</div>
					<div id="columnDepartment" class="columnInput">
						<p class="clear-both padding-top-s">Department</p>
						<select id="employeeDepartment" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" >
							<option value="0">Select a department</option>
						</select>
					</div>
					<div id="columnEmployeeExt" class="columnInput">
						<p class="clear-both padding-top-s">Extension No.</p>
						<input type="text" name="employeeExt" id="employeeExt" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" placeholder="Extension No." />
					</div>
					<div id="columnEmployeeHiredDate" class="columnInput">
						<p class="clear-both padding-top-s">Hired Date</p>						
						<div class="datepicker-icon-addon input-append date" id="datepicker" data-date="102/2012" data-date-format="dd/mm/yyyy" data-date-viewmode="days" data-date-minviewmode="days">  
							<input class="span2 padding-left30px clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" size="16" type="text" value="01/01/1901" readonly>
							<span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>
					</div>
					
					<div id="columnEmployeeAddress" class="columnInput">
						<p class="clear-both padding-top-s">Address</p>
						<textarea type="text" name="employeeAddress" id="employeeAddress" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" rows="4" placeholder="Address"></textarea>
					</div>
					<div id="columnEmployeeBank" class="columnInput">
						<p class="clear-both padding-top-s">Bank Account No.</p>
						<input type="text" name="employeeBank" id="employeeBank" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" placeholder="Bank Account No." />
					</div>
					<div id="columnEmployeeEpf" class="columnInput">
						<p class="clear-both padding-top-s">EPF No.</p>
						<input type="text" name="employeeEpf" id="employeeEpf" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" placeholder="EPF No." />
					</div>
					<div id="columnEmployeeSocso" class="columnInput">
						<p class="clear-both padding-top-s">SOCSO No.</p>
						<input type="text" name="employeeSocso" id="employeeSocso" class="clear-both col-lg-5 col-md-5 col-sm-12 col-xs-12" placeholder="SOCSO No." />
					</div>
					<div class="col-lg-12 col-md-12 col-xs-12">
						<input type="submit" name="submit" id="editEmployeeSubmit" class="display-inline inputForm button margin-top-l" value="Save" />
						<input type="button" name="cancel" id="editEmployeeCancel" class="buttonForm buttonCancel display-inline margin-top-xs" value="Cancel" />
					</div>
				</form>
			</div>
			<footer class="stickyFooter grey95-bg">
				<div class="">
					<p class="text-center fontsize-s padding-top-xs grey30"><strong>&copy; 2016 TraitQuest. All rights reserved.</strong></p>
				</div>
			</footer>
	</div>
	<?php include "../../general/popup.php"; ?>
</body>
</html>
