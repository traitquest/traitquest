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
<title>KPI</title>
<link rel="shortcut icon" href="../../images/icon.ico">
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="../../css/color.css"/>
<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../../css/datepicker.css"/>
<style>
.datepicker-icon-addon{width:200px;position:relative;}
.datepicker-icon-addon .glyphicon{position:absolute;padding:10px;}
</style>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.js"></script>
<script type="text/javascript" src="../../js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../../js/mobilenav.js"></script>
<script type="text/javascript" src="../../js/setheight.js"></script>
<script type="text/javascript" src="../../js/toggledescription.js"></script>
<script type="text/javascript" src="../../js/barwidth.js"></script>
<!--<script type="text/javascript" src="../../js/my/kpi/all.js"></script>
<script type="text/javascript" src="../../js/my/global.js"></script>-->

<body>
	<div id="mobileNav" class="mobileNav"><!mobilenav>
		<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
		<img class="clear-both center margin-top-s imageSize100px" src="../../images/avatar2.jpg">
		<p class="clear-both center margin-top-s fontsize-s white breakword">User123456789 123456789</p>
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
				<h3>People</h3>
			</div>

	</div>

	<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xs-12 grey95-bg padding-bottom-s"><!content goes here>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s padding-leftright-s padding-bottom-s border-top-grey white-bg"><!1stwindow>

			<div class="margin-top-s col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-12" src="../../images/avatar5.jpg">
				<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12"><li>name</li></ul>
			</div>
			<div class="margin-top-s col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 hidden-xs text-right">
				<h3 class="display-block display-inline"><button><i id="buttonAssignKPI" class="glyphicon glyphicon-plus-sign"></i></button></h3>
				<h3 class="display-block display-inline"><button><i class="glyphicon glyphicon-print"></i></button></h3>
			</div>

			<div class="clear col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s">
				<div class="datepicker-icon-addon input-append date input-append date" id="datepicker" data-date="102/2012" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
					<input class="span2 inputForm padding-left30px" size="16" type="text" value="01/2015" readonly>
					<span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span>
				</div>
			</div>

			<div class="clear-both col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-topbottom-s">

				<div class="clear-both padding-topbottom-s border-top-grey white-bg"><!kpi1>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-xs">
      		<p class="display-inline">
						<button id="toggledescription1" class="display-inline"><i class="glyphicon glyphicon-plus"></i></button>
						<a href="#" class="grey modalText" data-toggle="modal" data-target=".log1Modal">KPI 1 test text test text test text test text test text test text test text test text</a>
						<span class="label label-info">Pending</span>
						<div class="modal fade log1Modal" tabindex="-1" role="dialog" aria-labelledby="log1Modal">
					    <div class="modal-dialog modal-sm" role="document">
					      <div class="modal-content">
										<div class="modal-header margin-topbottom-s">
											KPI 1 test text test text test text test text test text test text test text test text
										</div>
					          <div class="modal-body margin-topbottom-s">
					            <p class="col-xs-4 text-left">7/2/2017</p>
					            <p class="col-xs-8 text-right">4%</p>
					          </div>
					          <div class="modal-footer clear-both">
					            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					          </div>
					      </div>
					    </div>
					  </div>
					</p>

					<p id="kpidetail1" class="kpidetail breakword">
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						Description
					</p>



				</div>


				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 margin-topbottom-xs">

					<div class="progress">

  					<div class="progress-bar progress-bar-info" role="progressbar"
						aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo "100" /*number here*/ ?>">
						<?php echo "100%" /*number here*/ ?>
						</div>
					</div>
				</div>


				<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs margin-topbottom-xs text-right">
					<button class="buttonwidth70 buttonverify fontsize-s">Verify</button>
					<button class="buttonwidth70 buttondeny fontsize-s">Deny</button>
				</div>

				<div class="visible-xs">
					<button class="assignButton buttonverify fontsize-s margin-topbottom-xs center">Verify</button>
					<button class="assignButton buttondeny fontsize-s margin-topbottom-xs center">Deny</button>
				</div>

			</div><!kpi1.>


			<div class="clear-both padding-topbottom-s border-top-grey white-bg"><!kpi2>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-xs">
      		<p class="display-inline">
						<button id="toggledescription1" class="display-inline"><i class="glyphicon glyphicon-plus"></i></button>
						<a href="#" class="grey modalText" data-toggle="modal" data-target=".log2Modal">KPI 2 test text test text test text test text test text test text test text test text</a>
						<span class="label label-success">Verified</span>
						<div class="modal fade log2Modal" tabindex="-1" role="dialog" aria-labelledby="log2Modal">
					    <div class="modal-dialog modal-sm" role="document">
					      <div class="modal-content">
										<div class="modal-header margin-topbottom-s">
											KPI 2 test text test text test text test text test text test text test text test text
										</div>
					          <div class="modal-body margin-topbottom-s">
					            <p class="col-xs-4 text-left">7/2/2017</p>
					            <p class="col-xs-8 text-right">12%</p>
											<p class="col-xs-4 text-left">12/2/2017</p>
					            <p class="col-xs-8 text-right">7%</p>
					          </div>
					          <div class="modal-footer clear-both">
					            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					          </div>
					      </div>
					    </div>
					  </div>
					</p>

					<p id="kpidetail2" class="kpidetail breakword">
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						DescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescriptionDescription
						Description
					</p>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 margin-topbottom-xs">
					<div class="progress">

  					<div class="progress-bar progress-bar-success" role="progressbar"
						aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo "30" /*number here*/ ?>">
						<?php echo "30%" /*number here*/ ?>
  					</div>

					</div>
				</div>


				<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs margin-topbottom-xs text-right">
					<button class="buttonwidth70 buttonverify fontsize-s">Verify</button>
					<button class="buttonwidth70 buttondeny fontsize-s">Deny</button>
				</div>

				<div class="visible-xs">
					<button class="assignButton buttonverify fontsize-s margin-topbottom-xs center">Verify</button>
					<button class="assignButton buttondeny fontsize-s margin-topbottom-xs center">Deny</button>
				</div>
			</div><!kpi2.>
			<div id="kpiList"></div>
		</div>
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
