<!DOCTYPE=html>
<html>
	<head>
		<title>Company Name</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"/>
		<link rel="stylesheet" href="input-no-spinner.css"/>
		<link rel="stylesheet" href="profilepage.css"/>

	</head>
<!header>
	<body onload="myFunction()";>
		<header>
			<div class = "col-sm-3">
				<img style="margin-top:10px" src="/profilepage/editedTQ.png"></img>
			</div>
			<div class = "col-sm-6">
				<nav style="margin-top:15px">
					<a style="font-size:20px; padding:15px; padding-left:0px" href = "/profilepage/profilepage.php" >My Profile</a>
					<a style="font-size:20px; padding:15px" href = "#" >My Character</a>
					<a style="font-size:20px; padding:15px" href = "/profilepage/badges.php" >My Badges</a>
					<a style="font-size:20px; padding:15px" href = "#" >Redemption</a>
					<a style="font-size:20px; padding:15px; padding-right:0px" href = "#" >My Company</a>
				</nav>
<p>&nbsp</p>
			</div>
			<div class = "col-sm-3">
				<p style = "text-align:center; padding:15px; font-size:20px">Welcome, <a href = "/profilepage/profilepage.php" >Leo</a></p>
<p>&nbsp</p>
			</div>
		</header>
<!end of header>

<!mid part>
		<div class="col-sm-3">
			<center><img id="display_pic" style = "display:block; width:120px; height:120px;"
								src = "/profilepage/defaultavatar.png"><p>&nbsp</p><button>Upload</button></img>
			<p>LEO LEE</p>
			<p>Marketing Manager</p></center>
			<p>&nbsp</p>
			<p>Email:leolee@example.com</p>
			<p>Phone:012-3456789</p>
			<p>&nbsp</p>
			<p style="border-bottom:solid #000000">Hire Date</p>
			<p>Aug 28, 2008</p>
			<p>5y-2m</p>
			<p>&nbsp</p>
			<p>Full Time</p>
			<p><i class="fa fa-briefcase" aria-hidden="true"></i> Marketing</p>
			<p><i class="fa fa-map-marker" aria-hidden="true"></i> Kuala Lumpur, MY</p>
			<p>&nbsp</p>
			<p style="border-bottom:solid #000000">Manager</p>
			<img src="/profilepage/no-user-image.png"></img>
			<p>Jason Chan</p>
			<p>VP, Marketing</p>
			<p>&nbsp</p>
			<p style="border-bottom:solid #000000">Direct Reports</p>
			<img src="/profilepage/no-user-image.png"></img>
			<p>John Doe</p>
			<p>Marketing Exec</p>
			<p>&nbsp</p>
			<img src="/profilepage/no-user-image.png"></img>
			<p>Ella Jean</p>
			<p>Trade Marketing</p>
		</div>

	<div class="col-sm-6">
		<h3>When a manager focuses on making whatever products are easy to produce,
				and then trying to sell them, that manager has a ________ orientation.
		</h3>
		<ul>
		<input type="radio">Marketing</p><br/>
		<input type="radio" id="quizb">Production</p><br/>
		<input type="radio">Sales</p><br/>
		<input type="radio">Profit</p><br/>
		<p>&nbsp</p>
		<button onclick="quizsubmit()">Submit</button>
	</ul>

	</div>

	<div class="col-sm-3">
	</div>


<!end of mid part>

<!footer>

<!end of footer>
		<script src="jQuery.js"></script>

	</body>

<!java>
	<script>

	function myFunction() {
		var redirect = confirm("Would you like to do the daily quiz now?");
	 if (redirect == true) {
			 window.location.href = '#';
	 }
	}

	function quizsubmit() {
		alert("You answered correctly! You have been given 10 pts as a reward!")
	}
	</script>
<!javaend>
</html>
