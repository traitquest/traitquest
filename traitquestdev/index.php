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

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					JAVASCRIPT
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/contact.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>

</head>
<body>
	<div id="header-bg"><!image>
		<div class="indexHeader col-sm-12 col-xs-12"><!header>
		<div class="col-sm-4 col-xs-4">
			<a href="http://traitquest.com/"><img id="logo-image" src="images/logo.png" /></a>
		</div>
		<div id="Navbar" class="col-sm-8 col-xs-8"><!nav>
			<ul class="no-list-style text-right padding-top-s">
				<li class="navSelection"><a href="#about">About</a></li>
				<li class="navSelection"><a href="#features">Features</a></li>
				<li class="navSelection hidden"><a href="#testimonial">Testimonial</a></li>
				<li class="navSelection"><a href="#contact">Contact</a></li>
			</ul>
		</div><!nav.>
	</div><!header.>
		<div class="col-sm-12 col-xs-12">
			<div class="col-sm-5 col-sm-offset-1 col-xs-10 col-xs-offset-1 text-right">
			<h1>We bring your employees to a whole new level</h1>
		</div>
			<div class="col-sm-6 col-xs-12">
			<form id="formEmployeeLogin" class="form padding-topbottom-s col-lg-4 col-lg-offset-4 col-md-4 col-offset-4 col-sm-4 col-sm-offset-4 col-xs-4" method="post"><!login>
				<div id="columnCompany" class="padding-top-s">
				<div class="icon-addon">
					<input type="text" name="company" id="companyName" class="inputForm padding-left30px" placeholder="Company" />
					<i class="glyphicon glyphicon-briefcase"></i>
				</div>
			</div>
				<div id="columnEmail" class="padding-top-s">
				<div class="icon-addon">
					<input type="text" name="email" id="email" class="inputForm padding-left30px" placeholder="Email" />
					<i class="glyphicon glyphicon-envelope"></i>
				</div>
			</div>
				<div id="columnPassword" class="padding-top-s">
				<div class="icon-addon">
					<input type="password" name="password" id="password" class="inputForm padding-left30px" placeholder="Password" />
					<i class="glyphicon glyphicon-lock"></i>
				</div>
			</div>
				<div id="loginResponse" class="padding-topbottom-xs"></div>
				<input type="submit" name="submit" id="loginSubmit" class="buttonForm button" value="Login" />


				<a href="#" class="forgottenPassword clear yellowAnchor" data-toggle="modal" data-target=".forgottenPasswordModal">Forgotten Password?</a>
				<!ForgottenPasswordModal>
				<a href="#" class="clear yellowAnchor">Admin Login</a><!LoginAsAdmin>
					</form><!login.>
					<div class="modal fade forgottenPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgottenPasswordModal">
			  		<div class="modal-dialog modal-sm" role="document">
			    		<div class="modal-content">
								<h3 class="text-center grey">Please enter your e-mail</h3>
									<form id="formForgottenPassword" class="form padding-topbottom-s" method="post">
										<div id="columnEmail" class="padding-topbottom-xs">
											<div class="icon-addon">
												<input type="text" name="email" id="email" class="inputForm padding-left30px" placeholder="Email" />
												<i class="glyphicon glyphicon-envelope"></i>
											</div>
										</div>
										<div id="response"></div>
										<input type="submit" name="submit" id="submit" class="buttonForm button margin-topbottom-xs" value="Reset Password" />
									</form>
			    		</div>
			  		</div>
					</div><!ForgottenPasswordModal.>

				</div>
		</div>

		<div class="padding-topbottom-m">
			<button class="registerButton" data-toggle="modal" data-target=".freeRegister">Register For Free</button>
		</div><!RegisterForFree>
	</div><!image.>


	<div id="about" class="col-sm-12 col-xs-12 padding-topbottom-s"><!About>
		<h1 class="text-center padding-topbottom-s">About</h1>
		<div class="col-sm-6 hidden-xs padding-bottom-s">
			<div class="col-md-12 col-sm-12 margin-topbottom-s">
				<div class="col-md-3 col-sm-5">
					<img src="./images/avatar.png" class="display-block center padding-topbottom-s imageMaxWidth100px"></img>
				</div>
				<div class="cyan-bg col-md-6 col-sm-4 margin-topbottom-m padding-topbottom-m">
					<p class="padding-bottom-s">I feel so unmotivated at work!</p>
				</div>
			</div>
				<div class="col-md-12 col-sm-12 margin-topbottom-s">
					<div class="darkgreen-bg col-md-6 col-md-offset-3 col-sm-4 col-sm-offset-5 margin-topbottom-m padding-topbottom-m">
						<p>That is because you are not having fun while you work!</p>
					</div>
					<div class="col-md-3 col-sm-3">
						<img src="./images/avatar1.png" class="display-block center padding-topbottom-s imageMaxWidth100px"></img>
					</div>
				</div>
			</div>

		<div class="col-sm-6 col-xs-12 text-center">
			<h3 class="padding-bottom-xs">
				QUALITY Employees drive the Heart of an Organization
			</h3>
			<p class="padding-bottom-xs">
				TraitQuest unique solution uses gamification to track KPIs and gamify the data into individual Traits Profiling,
				Training Needs Analysis, Performance Linked Rewards, and many more.
			</p>
			<p class="padding-bottom-xs">
				Most important of all, TraitQuest is tailored to Gen-Y working mentality by applying fun, engagement,
				competition and thus motivating them in the work environment.
			</p>
		</div>
	</div>



	<div id="features" class="col-sm-12 col-xs-12 padding-topbottom-m margin-topbottom-m"><!Features>
		<h1 class="text-center padding-topbottom-m">Features</h1>
		<div class="col-sm-4 col-xs-12 padding-top-m">
			<img src="./images/featureicons/1.png" class="featureIcon display-block center padding-bottom-s"></img>
			<p class="padding-top-m">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque mattis justo vitae nibh congue,
				non laoreet elit bibendum. Aliquam aliquam tellus et mollis fringilla. Nam semper commodo enim sit amet laoreet.
				Integer eleifend, sapien eu tincidunt accumsan, dolor metus lobortis quam, vel convallis eros quam vel lorem.
				Quisque sagittis pulvinar tempus. Phasellus non sollicitudin urna.
				Pellentesque eu bibendum urna. Nullam non lorem sit amet dolor laoreet porta.
				Aenean a leo ac sem dictum fermentum et eu dolor. Vivamus aliquam velit in rutrum tincidunt.
				Ut luctus accumsan nisl, non laoreet libero luctus placerat. Proin id sapien ut purus pellentesque euismod.
				Mauris dignissim euismod ipsum eget interdum. Curabitur sollicitudin neque rhoncus lorem sagittis,
				sed gravida massa vehicula. Proin vitae elit sodales, tincidunt quam at, pulvinar elit. Praesent sit amet tempus sapien.
				In hendrerit leo ac justo porttitor cursus. Mauris a velit id metus vehicula facilisis. Suspendisse turpis felis,
				tristique eget tincidunt vitae, faucibus eget quam.</p>
		</div>
		<div class="col-sm-4 col-xs-12 padding-top-m">
			<img src="./images/featureicons/2.png" class="featureIcon display-block center padding-bottom-s"></img>
			<p class="padding-top-m">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque mattis justo vitae nibh congue,
				non laoreet elit bibendum. Aliquam aliquam tellus et mollis fringilla. Nam semper commodo enim sit amet laoreet.
				Integer eleifend, sapien eu tincidunt accumsan, dolor metus lobortis quam, vel convallis eros quam vel lorem.
				Quisque sagittis pulvinar tempus. Phasellus non sollicitudin urna.
				Pellentesque eu bibendum urna. Nullam non lorem sit amet dolor laoreet porta.
				Aenean a leo ac sem dictum fermentum et eu dolor. Vivamus aliquam velit in rutrum tincidunt.
				Ut luctus accumsan nisl, non laoreet libero luctus placerat. Proin id sapien ut purus pellentesque euismod.
				Mauris dignissim euismod ipsum eget interdum. Curabitur sollicitudin neque rhoncus lorem sagittis,
				sed gravida massa vehicula. Proin vitae elit sodales, tincidunt quam at, pulvinar elit. Praesent sit amet tempus sapien.
				In hendrerit leo ac justo porttitor cursus. Mauris a velit id metus vehicula facilisis. Suspendisse turpis felis,
				tristique eget tincidunt vitae, faucibus eget quam.</p>
		</div>
		<div class="col-sm-4 col-xs-12 padding-top-m">
			<img src="./images/featureicons/1.png" class="featureIcon display-block center padding-bottom-s"></img>
			<p class="padding-top-m">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque mattis justo vitae nibh congue,
				non laoreet elit bibendum. Aliquam aliquam tellus et mollis fringilla. Nam semper commodo enim sit amet laoreet.
				Integer eleifend, sapien eu tincidunt accumsan, dolor metus lobortis quam, vel convallis eros quam vel lorem.
				Quisque sagittis pulvinar tempus. Phasellus non sollicitudin urna.
				Pellentesque eu bibendum urna. Nullam non lorem sit amet dolor laoreet porta.
				Aenean a leo ac sem dictum fermentum et eu dolor. Vivamus aliquam velit in rutrum tincidunt.
				Ut luctus accumsan nisl, non laoreet libero luctus placerat. Proin id sapien ut purus pellentesque euismod.
				Mauris dignissim euismod ipsum eget interdum. Curabitur sollicitudin neque rhoncus lorem sagittis,
				sed gravida massa vehicula. Proin vitae elit sodales, tincidunt quam at, pulvinar elit. Praesent sit amet tempus sapien.
				In hendrerit leo ac justo porttitor cursus. Mauris a velit id metus vehicula facilisis. Suspendisse turpis felis,
				tristique eget tincidunt vitae, faucibus eget quam.</p>
		</div>
	</div>

	<div class="padding-topbottom-xl">
		<button class="registerButton" data-toggle="modal" data-target=".freeRegister">Register For Free</button>
		<div class="modal fade freeRegister" tabindex="-1" role="dialog" aria-labelledby="freeRegisterModal">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">

						<h3 class="text-center">Join Now For FREE!</h3>
						<form id="formRegister" class="form" method="post">
							<div id="columnName" class="columnInput">
								<div class="icon-addon">
									<input type="text" name="company" id="companyName" class="inputForm padding-left30px" placeholder="Company" />
									<i class="glyphicon glyphicon-briefcase"></i>
								</div>
							</div>
							<div id="columnEmail" class="columnInput">
								<div class="icon-addon">
									<input type="text" name="email" id="email" class="inputForm padding-left30px" placeholder="Email" />
									<i class="glyphicon glyphicon-envelope"></i>
								</div>
							</div>
							<div id="columnPhoneNumber" class="columnInput">
								<div class="icon-addon">
									<input type="number" name="phonenumber" id="phonenumber" class="inputForm padding-left30px" placeholder="Phone" />
									<i class="glyphicon glyphicon-earphone"></i>
								</div>
							</div>
							<div id="columnAddress" class="columnInput">
								<div class="icon-addon inputAddress">
									<textarea type="text" name="address" id="address" class="inputForm padding-left30px inputAddress" rows="4" placeholder="Address"></textarea>
									<i class="glyphicon glyphicon-home"></i>
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


	<div id="footer-bg" class="col-sm-12 col-xs-12">

		<div class="col-md-6 col-sm-6 col-xs-12 padding-topbottom-s text-right white">
			<ul class="padding-bottom-s no-list-style">
				<li class="padding-bottom-xs">TraitQuest Sdn Bhd</li>
				<li class="padding-bottom-xs">3 Mile Square</li>
				<li class="padding-bottom-xs">3 Jalan Klang Lama</li>
				<li class="padding-bottom-xs"> 58100 Kuala Lumpur</li>
			</ul>
			<ul class="padding-bottom-s no-list-style">
				<li class="padding-bottom-xs">(Tel)</li>
				<li class="padding-bottom-xs">(Email)</li>
			</ul>
			<p class="padding-topbottom-s fontsize-m">Follow Us!</p>
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

		<div id="contact" class="col-md-3 col-sm-6 col-xs-12 padding-topbottom-s"><!contact us form>
			<form id="formContact" class="form" method="post">
				<div id="columnContactName" class="padding-top-xs">
					<div class="icon-addon">
						<input type="text" name="name" id="name" class="inputForm padding-left30px" placeholder="Name" />
						<i class="glyphicon glyphicon-user"></i>
					</div>
				</div>
				<div id="columnContactEmail" class="padding-top-xs">
					<div class="icon-addon">
						<input type="text" name="contactemail" id="contactemail" class="inputForm padding-left30px" placeholder="Email" />
						<i class="glyphicon glyphicon-envelope"></i>
					</div>
				</div>
				<div id="columnSubject" class="padding-top-xs">
					<div class="icon-addon">
					<select id="subject" class="inputForm padding-left30px" >
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
						<textarea type="text" name="message" id="message" class="inputForm padding-left30px" rows="4" placeholder="Message"></textarea>
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
