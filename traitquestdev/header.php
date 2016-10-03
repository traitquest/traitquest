<div id="header" class="padding-xs clear">
	<div id="logo" class="col-md-3 col-sm-4 col-xs-4">
		<a href="http://traitquest.com/"><img id="logo-image" src="images/logo.png" /></a>
	</div>
	<div class="text-right col-md-offset-7 col-md-2 col-sm-offset-5 col-sm-3 col-xs-offset-3 col-xs-5">
		<?php if (isset($_SESSION['name'])){ ?><b><p>Hi, <?php echo $_SESSION['name']; ?>!</p>
		<a href="logout">Log Out</a></b><?php } ?>
	</div>
</div><!-- header -->