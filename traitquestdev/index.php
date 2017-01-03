<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="TraitQuest">
<meta name="description" content="TraitQuest Home">
<meta name="keywords" content="TraitQuest, Home, Index">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TraitQuest</title>
<link rel="shortcut icon" href="images/icon.ico">
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/color.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/stickyfooter.css"/>


<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="js/mobilenav.js"></script>

</head>
<body>

	<div id="header-bg"><!image>
		<div class="indexHeader"><!header>
		<div class="col-md-4 col-sm-4 col-xs-4">
			<a href="http://traitquest.com/"><img id="logo-image" src="images/logo.png" /></a>
		</div>
		<div class="col-md-8 hidden-sm hidden-xs"><!nav>
			<ul id="navBar" class="no-list-style text-right padding-topbottom-s navBar">
				<li class="navSelection"><a href="#about">About</a></li>
				<li class="navSelection"><a href="#features">Features</a></li>
				<li class="navSelection hidden"><a href="#testimonial">Testimonial</a></li>
				<li class="navSelection"><a href="#contact">Contact</a></li>
			</ul>
		</div><!nav.>

		<div id="mobileNav" class="mobileNav"><!mobilenav>
			<a href="javascript:void(0)" id="closeMobileNav" class="closeBtn white">&times;</a>
			<a href="#about" class="closeMobileNav padding-top-m display-block fontsize-m white">About</a>
			<a href="#features" class="closeMobileNav padding-top-m display-block fontsize-m white">Features</a>
			<a href="#testimonial" class="hidden closeMobileNav padding-top-m display-block fontsize-m white">Testimonial</a>
			<a href="#contact" class="closeMobileNav padding-top-m display-block fontsize-m white">Contact</a>
		</div>
		<i id="openMobileNav" class="glyphicon glyphicon-menu-hamburger
			hidden-lg hidden-md col-sm-8 col-xs-8
			display-block text-right padding-topbottom-s fontsize-l cursor-pointer"></i>

	</div><!--header.-->

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 hidden-sm hidden-xs text-right">
				<h1 class="gold">We bring your employees to a whole new level of engagement!</h1>
			</div>

			<div class="col-lg-4 col-lg-offset-2 col-md-4 col-offset-2 col-sm-12 col-xs-12">
			<div class="inputForm">
				<form id="formEmployeeLogin" class="padding-topbottom-s" method="post"><!login>

				<div id="columnLoginCompany" class="padding-top-s">
					<div class="icon-addon">
						<input type="text" name="loginCompany" id="companyName" class="inputLoginForm inputForm padding-left30px" placeholder="Company" />
						<i class="glyphicon glyphicon-briefcase"></i>
					</div>
				</div>
				<div id="columnLoginEmail" class="padding-top-s">
					<div class="icon-addon">
						<input type="text" name="loginEmail" id="email" class="inputLoginForm inputForm padding-left30px" placeholder="Email" />
						<i class="glyphicon glyphicon-envelope"></i>
					</div>
				</div>
				<div id="columnLoginPassword" class="padding-top-s">
					<div class="icon-addon">
						<input type="password" name="loginPassword" id="password" class="inputLoginForm inputForm padding-left30px" placeholder="Password" />
						<i class="glyphicon glyphicon-lock"></i>
					</div>
				</div>
				<div id="loginResponse" class="padding-topbottom-xs"></div>
				<input type="submit" name="submit" id="loginSubmit" class="buttonForm button" value="Login" />


				<a href="#" class="clear yellowAnchor" data-toggle="modal" data-target=".forgottenPasswordModal">Forgotten Password?</a><!ForgottenPasswordModal>
				<a href="#" class="clear yellowAnchor" data-toggle="modal" data-target=".companyLoginModal">Admin Login</a><!LoginAsAdmin>
				</form><!login.>

					<div class="modal fade forgottenPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgottenPasswordModal">
			  		<div class="modal-dialog modal-sm" role="document">
			    		<div class="modal-content">
								<h3 class="text-center grey">Please enter your e-mail</h3>
									<form id="formForgottenPassword" class="form padding-topbottom-s" method="post">
										<div id="columnForgottenPasswordEmail" class="padding-topbottom-xs">
											<div class="icon-addon">
												<input type="text" name="forgottenPasswordEmail" id="forgottenPasswordEmail" class="inputForgottenPasswordForm inputForm padding-left30px" placeholder="Email" />
												<i class="glyphicon glyphicon-envelope"></i>
											</div>
										</div>
										<div id="forgottenPasswordResponse"></div>
										<input type="submit" name="submit" id="submit" class="buttonForm button margin-topbottom-xs" value="Reset Password" />
									</form>
			    		</div>
			  		</div>
					</div><!ForgottenPasswordModal.>

					<div class="modal fade companyLoginModal" tabindex="-1" role="dialog" aria-labelledby="companyLoginModal"><!companyLoginModal>
			  		<div class="modal-dialog modal-sm" role="document">
			    		<div class="modal-content">
								<h3 class="text-center grey">Admin Login</h3>
								<form id="formCompanyLogin" class="form padding-topbottom-s" method="post">
									<div id="columnCompanyLoginCompany" class="columnInput">
										<div class="icon-addon">
										<input type="text" name="companyLoginCompany" id="companyLoginCompany" class="inputCompanyLoginForm inputForm padding-left30px" placeholder="Company" />
										<i class="glyphicon glyphicon-briefcase"></i>
										</div>
									</div>
									<div id="columnCompanyLoginEmail" class="columnInput">
										<div class="icon-addon">
										<input type="text" name="companyLoginEmail" id="companyLoginEmail" class="inputCompanyLoginForm inputForm padding-left30px" placeholder="Email" />
										<i class="glyphicon glyphicon-envelope"></i>
										</div>
									</div>
									<div id="columnCompanyLoginPassword" class="columnInput">
										<div class="icon-addon">
										<input type="password" name="companyLoginPassword" id="companyLoginPassword" class="inputCompanyLoginForm inputForm padding-left30px" placeholder="Password" />
										<i class="glyphicon glyphicon-lock"></i>
										</div>
									</div>
									<div id="companyLoginResponse"></div>
									<input type="submit" name="submit" id="loginSubmit" class="buttonForm button" value="Login As Admin" />
								</form>
							</div>
						</div>
					</div><!companyLoginModal.>

				</div>
			</div>
		</div>

		<div class="padding-topbottom-m">
			<button class="registerButton" data-toggle="modal" data-target=".freeRegister">Register For Free</button>
		</div><!RegisterForFree>

	</div><!image.>


	<div id="about" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-topbottom-s"><!About>
		<h1 class="text-center padding-topbottom-s">About</h1>
		<div class="col-sm-6 hidden-xs padding-bottom-s">
			<div class="col-md-12 col-sm-12 margin-topbottom-s">
				<div class="col-md-3 col-sm-5">
					<img src="./images/avatar.png" class="display-block center padding-topbottom-s imageSize100px"></img>
				</div>
				<div class="cyan-bg col-md-6 col-sm-4 margin-topbottom-m padding-topbottom-m">
					<p class="padding-bottom-s">I feel disengaged, unmotivated and dreaded to be at work</p>
				</div>
			</div>
				<div class="col-md-12 col-sm-12 margin-topbottom-s">
					<div class="darkgreen-bg col-md-6 col-md-offset-3 col-sm-4 col-sm-offset-5 margin-topbottom-s padding-topbottom-m">
						<p>TraitQuest provides the platform for Fun to Work and you will be completing all tasks in no time</p>
					</div>
					<div class="col-md-3 col-sm-3">
						<img src="./images/avatar1.png" class="display-block center padding-topbottom-s imageSize100px"></img>
					</div>
				</div>
			</div>

		<div class="col-sm-6 col-xs-12 text-center">
			<h3 class="padding-bottom-l">
				QUALITY Employees drive the Heart of an Organization
			</h3>
			<p class="padding-topbottom-l">
				TraitQuest unique solution uses gamification to track KPIs and gamify the data into individual Traits Profiling,
				Training Needs Analysis, Performance Linked Rewards, and many more.
			</p>
			<p class="padding-topbottom-l">
				TraitQuest is tailored to Gen-Y working mentality by applying fun, engagement, competition, and thus motivating them
				in work environment.
			</p>
		</div>
	</div>



	<div id="features" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-topbottom-s"><!Features>
		<h1 class="text-center padding-topbottom-m">Features</h1>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-topbottom-s margin-topbottom-s">
			<div class="col-lg-3 col-lg-offset-2 col-md-3 col-md-offset-2 col-sm-6 col-xs-12 padding-bottom-s">
				<img src="./images/featureicons/performancemanagementsystem.png" class="featureIcon display-block center padding-bottom-s"></img>
				<h3 class="padding-top-s text-center">Performance Management System</h3>
				<p class="padding-topbottom-m">From Daily to Weekly to Monthly to Quarterly feedbacks and constant updates.
				KRAs, Objectives & KPIs are align and adjust according to department, position and personnel</p>
			</div>
			<div class="col-lg-3 col-lg-offset-2 col-md-3 col-md-offset-2 col-sm-6 col-xs-12 padding-top-s">
				<img src="./images/featureicons/engagementplatform.png" class="featureIcon display-block center padding-bottom-s"></img>
				<h3 class="padding-top-s text-center">Engagement Platform</h3>
				<p class="padding-topbottom-m">Provides Realtime peer-to-peer and top down recognition. Surveys,
				feedbacks from employees improve experience detailing job satisfaction and identifying training and competency requirement</p>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-topbottom-s margin-topbottom-s">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding-topbottom-l">
				<img src="./images/featureicons/tracktracetreat.png" class="featureIcon display-block center padding-bottom-s"></img>
				<h3 class="padding-top-s text-center">T<sup>3</sup> - Track, Trace, and Treats</h3>
				<p class="padding-topbottom-m">Mentorship & Coaching through regular feedbacks, develop succession planning and career planning.
					Digitally recorded, traceable and retrievable anytime with information security for privacy</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding-topbottom-l">
				<img src="./images/featureicons/rewardsandrecognition.png" class="featureIcon display-block center padding-bottom-s"></img>
				<h3 class="padding-top-s text-center">Rewards and Recognition</h3>
				<p class="padding-topbottom-m">Make it known through recognition and appreciate their efforts. Every employees are responsible.</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding-topbottom-l">
				<img src="./images/featureicons/staffretentionprogram.png" class="featureIcon display-block center padding-bottom-s"></img>
				<h3 class="padding-top-s text-center">Staff Retention Program</h3>
				<p class="padding-topbottom-m">Provides Ownership and autonomy. Engaged, Motivated and Valued.</p>
			</div>
		</div>
	</div>

	<div class="padding-topbottom-m">
		<button class="registerButton" data-toggle="modal" data-target=".freeRegister">Register For Free</button>
		<div class="modal fade freeRegister" tabindex="-1" role="dialog" aria-labelledby="freeRegisterModal">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">

						<h3 class="text-center">Join Now For FREE!</h3>
						<form id="formRegister" class="form" method="post">
							<div id="columnRegisterCompanyName" class="columnInput">
								<div class="icon-addon">
									<input type="text" name="registerCompany" id="companyName" class="inputRegisterForm inputForm padding-left30px" placeholder="Company" />
									<i class="glyphicon glyphicon-briefcase"></i>
								</div>
							</div>
							<div id="columnRegisterName" class="columnInput">
								<div class="icon-addon">
									<input type="text" name="registerName" id="fullName" class="inputRegisterForm inputForm padding-left30px" placeholder="Full Name" />
									<i class="glyphicon glyphicon-user"></i>
								</div>
							</div>
							<div id="columnRegisterEmail" class="columnInput">
								<div class="icon-addon">
									<input type="text" name="registerEmail" id="email" class="inputRegisterForm inputForm padding-left30px" placeholder="Email" />
									<i class="glyphicon glyphicon-envelope"></i>
								</div>
							</div>
							<div id="columnRegisterPhoneNumber" class="columnInput">
								<div class="icon-addon">
									<input type="number" name="registerPhoneNumber" id="phonenumber" class="inputRegisterForm inputForm padding-left30px" placeholder="Phone" />
									<i class="glyphicon glyphicon-earphone"></i>
								</div>
							</div>
							<div id="registerResponse"></div>
							<input type="submit" name="submit" id="registerSubmit" class="buttonForm button" value="Register" />
						</form>
						<div class="inputForm">
							<p class="fontsize-xs">By clicking Register, you agree to our <a href="#" class="blue">Terms of Use</a> and <a href="#" class="blue">Privacy Policy</a></p>
							<p class="fontsize-xs">Free license is only valid for one(1) month and up to five(5) employees</p>
						</div>

				</div>
			</div>
		</div><!FreeRegisterModal.>
	</div><!RegisterForFree>


	<div id="footer-bg" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-12 col-xs-12 padding-topbottom-s text-left white">
			<h3 class="white padding-bottom-s">What We Do</h3>
			<p class="white padding-topbottom-xs"><strong class="fontsize-l">TraitQuest</strong> provides enterprise cloud-based solution for workflow
				management and collaboration to drive employees' motivation and engagement, cultivate corporate culture and retain
				valued employees.</p>
			<p class="white padding-topbottom-xs">Successful employees are engaged employees, and meeting basic needs of compensation
				and resources is the only foundation.</p>
			<p class="white padding-topbottom-xs">Employees need recognition, direction, inspiration, and purpose.</p>

		</div>
		<div id="contact" class="col-lg-3 col-md-3 col-sm-6 col-xs-12 margin-bottom-s padding-top-xl text-right white">
			<ul class="padding-bottom-m no-list-style">
				<li>TraitQuest Sdn Bhd</li>
				<li>3 Mile Square</li>
				<li>3 Jalan Klang Lama</li>
				<li>58100 Kuala Lumpur</li>
			</ul>
			<ul class="padding-topbottom-m no-list-style">
				<li class="padding-bottom-xs">hello@traitquest.com <i class="glyphicon glyphicon-envelope padding-left10px"></i></li>
			</ul>
			<p class="padding-topbottom-m fontsize-m">Follow Us!</p>
			<ul class="no-list-style">
				<li class="display-inline">
					<a href="https://www.facebook.com/TraitQuest-1729449967308271/">
						<img src="./images/socialnetwork/facebooklogo.png" />
					</a>
				</li>
				<li class="display-inline padding-left10px">
					<a href="#">
						<img src="./images/socialnetwork/instagramlogo.png" />
					</a>
				</li>
				<li class="display-inline padding-left10px">
					<a href="#">
						<img src="./images/socialnetwork/twitterlogo.png" />
					</a>
				</li>
			</ul>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding-topbottom-s"><!contact us form>
			<form id="formContact" class="form" method="post">
				<div id="columnContactName" class="padding-top-xs">
					<div class="icon-addon">
						<input type="text" name="name" id="name" class="inputMessageForm inputForm padding-left30px" placeholder="Name" />
						<i class="glyphicon glyphicon-user"></i>
					</div>
				</div>
				<div id="columnContactEmail" class="padding-top-xs">
					<div class="icon-addon">
						<input type="text" name="contactemail" id="contactemail" class="inputMessageForm inputForm padding-left30px" placeholder="Email" />
						<i class="glyphicon glyphicon-envelope"></i>
					</div>
				</div>
				<div id="columnSubject" class="padding-top-xs">
					<div class="icon-addon">
					<select id="subject" class="inputMessageForm inputForm padding-left30px" >
						<option value="Enquiries">Enquiries</option>
						<option value="Request For Demo">Request For Demo</option>
						<option value="Feedback">Feedback</option>
						<option value="Others">Others</option>
					</select>
					<i class="glyphicon glyphicon glyphicon-info-sign"></i>
					</div>
				</div>
				<div id="columnMessage" class="padding-top-xs">
					<div class="icon-addon">
						<textarea type="text" name="message" id="message" class="inputMessageForm inputForm padding-left30px" rows="4" placeholder="Message"></textarea>
						<i class="glyphicon glyphicon-comment"></i>
					</div>
				</div>
				<div id="contactResponse" class="padding-topbottom-xs"></div>
				<input type="submit" name="sendMessage" id="sendMessage" class="buttonForm button" value="Submit" />
			</form>
		</div>

	</div>

		<?php include 'footer.php'; ?>

</body>
</html>
