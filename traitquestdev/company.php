<?php
/*session_start();
	// to redirect user to home page once they have logged in
	if( !isset($_SESSION['companyID']) || !isset($_SESSION['userID'])){
		header('location: index.php');
	}
	else if( ( isset($_SESSION['companyID']) && isset($_SESSION['userID']) ) && $_SESSION['logintype'] == "employee" ){
		header('location: home.php');
	}
*/
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Company</title>
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
<?php /*<script type="text/javascript" src="js/getcompany.js"></script>*/ ?>
<script type="text/javascript" src="js/mobilenav.js"></script>
</head>

<body>
<?php /*
	<div id="mobileNav" class="mobileNav"><!mobilenav>
		<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Company</a>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Employees</a>
		<a href="#" class="hidden closeMobileNav padding-top-m display-block fontsize-m white">Settings</a>
		<a href="#" class="closeMobileNav padding-top-m display-block fontsize-m white">Logout</a>
	</div>
	<i id="openMobileNav" class="glyphicon glyphicon-menu-hamburger
		hidden-lg hidden-md col-sm-8 col-xs-8
		display-block text-right padding-topbottom-s fontsize-l cursor-pointer"></i><!mobilenav.> */?>

	<div class="col-lg-2 col-md-2 hidden-sm hidden-xs sideBar">

	</div>

	<div class="col-lg-10 col-md-10 grey95-bg padding-bottom-s">
		<div class="padding-topbottom-xs">
			<a href="http://traitquest.com/"><img id="logo-image" src="images/logo.png" /></a>
		</div>
	</div>
	<div style="width:100%;" class="col-lg-10 col-md-10 padding-topbottom-xs white-bg">
		<div class="padding-topbottom-m">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
				<h3>Company</h3>
			</div>
			<div class="text-right col-lg-1 col-lg-offset-5 col-md-1 col-md-offset-5 col-sm-1 col-sm-offset-5 col-xs-2 col-xs-offset-6">
				<a href="#"><h4><i class="glyphicon glyphicon-edit"></i></h4></a>
			</div>
		</div>
	</div>
	<div class="col-lg-10 col-md-10 grey95-bg padding-bottom-s">
			<div class="col-lg-10 col-md-10 padding-top-l"><!1stwindow>
				<div class="padding-bottom-s padding-leftright-s border-top-grey white-bg">
					<h3 class="grey30">Tesla Motors Inc</h3>
					<div class="padding-top-s">
						<h3 class="display-block display-inline"><i class="glyphicon glyphicon-map-marker"></i></h3>
						<p class="padding-left10px fontsize-m display-block display-inline">1 Hacker Way</p>
					</div>
					<div class="padding-top-s">
						<h3 class="display-block display-inline"><i class="glyphicon glyphicon-envelope"></i></h3>
						<p class="padding-left10px fontsize-m display-block display-inline">admin@tesla</p>
					</div>
					<div class="padding-top-s">
						<h3 class="display-block display-inline"><i class="glyphicon glyphicon-phone-alt"></i></h3>
						<p class="padding-left10px fontsize-m display-block display-inline">tel</p>
					</div>
				</div>
			</div>
			<div class="col-lg-10 col-md-10 padding-top-l"><!2ndwindow>
				<div class="padding-bottom-s padding-leftright-s border-top-grey white-bg">
					<h3 class="grey30">Description</h3>
					<p class="padding-top-s">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						Vestibulum imperdiet, nisi non pellentesque ullamcorper, mauris enim consectetur massa,
						id dapibus lacus tortor fermentum quam. Mauris semper blandit vestibulum. Sed tincidunt sem velit,
						vitae varius nunc gravida ut. Nunc iaculis auctor ultrices. Aliquam posuere odio et lorem pulvinar,
						id bibendum augue cursus. Cras suscipit leo vel feugiat commodo. Nunc et metus ac nisl luctus blandit.
						Nunc gravida in arcu vitae vehicula. Aliquam vehicula sollicitudin varius.
						Nulla sollicitudin sollicitudin ante a imperdiet.
					</p>
					<p class="padding-top-s">
						Duis id metus vitae felis ultricies ullamcorper in nec enim.
						Quisque aliquet massa eu lectus mollis tincidunt. Sed tempus gravida risus,
						sed facilisis mauris gravida eget. Fusce faucibus nunc ut ipsum luctus, eu euismod sem mollis.
						Ut pulvinar odio nulla, et efficitur augue accumsan sit amet. Vestibulum ullamcorper erat non mi venenatis,
						non placerat leo tristique. Fusce non auctor arcu. Suspendisse ac pharetra ante.
						Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
						Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
						In maximus leo nisi, a viverra ante consectetur non. Morbi vitae sem est.
					</p>
				</div>
			</div>
			<div class="col-lg-10 col-md-10 padding-top-l"><!3rdwindow>
				<div class="padding-bottom-s padding-leftright-s border-top-grey white-bg">
					<h3 class="grey30">Vision</h3>
					<p class="fontsize-m">To help people be healthy</p>
					<p class="fontsize-m">To have our product in every home in United States</p>
					<p class="fontsize-m">To help people enjoy life, or offer an affordable solution to health care</p>
				</div>
			</div>
			<div class="col-lg-10 col-md-10 padding-topbottom-l"><!4thwindow>
				<div class="padding-leftright-s border-top-grey white-bg">
					<h3 class="grey30">Mission</h3>
					<p class="fontsize-m">Our mission is to deliver happiness to customers, employees, and vendors</p>
				</div>
			</div>

			<footer class="footer grey95-bg">
				<div class="">
					<p class="text-center fontsize-s padding-top-xs grey30"><strong>&copy; 2016 TraitQuest. All rights reserved.</strong></p>
				</div>
			</footer>

	</div>






</body>
</html>
