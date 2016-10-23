<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

</head>
<body>
	<form id="formContact" class="form" method="post">
		<div id="columnContactName">
			<input type="text" name="name" id="name" class="inputMessageForm" placeholder="Name" />
		</div>
		<div id="columnContactEmail">
			<input type="text" name="contactemail" id="contactemail" class="inputMessageForm" placeholder="Email" />
		</div>
		<div id="columnSubject">
			<select id="subject" class="inputMessageForm" >
				<option value="Enquiries">Enquiries</option>
				<option value="Request For Demo">Request For Demo</option>
				<option value="Feedback">Feedback</option>
				<option value="Others">Others</option>
			</select>
		</div>
		<div id="columnMessage">
			<textarea type="text" name="message" id="message" class="inputMessageForm" rows="4" placeholder="Message"></textarea>
		</div>
		<div id="contactResponse"></div>
		<input type="submit" name="sendMessage" id="sendMessage" class="buttonForm" value="Submit" />
	</form>
</body>
</html>