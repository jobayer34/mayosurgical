<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<title>:: Home Page :</title>
	
		<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/style.css" type="text/css"/>
	
</head>
<body>
<header class="row">
	<div class="container">
		<div class="logo">
			<h1><a href="#">logo</a></h1>
		</div>
		<div class="social_right">
			<div class="social_feeds">
				<ul>
					<li class="social_facebook"><a href="#">F</a></li>
					<li class="social_twitter"><a href="#">t</a></li>
					<li class="social_linkedin"><a href="#">l</a></li>
				<ul>
			</div>
			<div class="toll_free">
				<h1>1-866-411-2525</h1>
			</div>
		</div>
	</div>
	<div class="primary_nav">
		<div class="container">
			<div class="primary_nav_left">
				<span class="nav_icon_left"></span>
				
				<div class="menu_bg">
					<ul>
						<li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/adduser.php">Add User</a></li>
						<li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/modify-user.php">Modify User</a></li>
						<li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/deleteuser.php">Delete User</a></li>
						<li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/view-logs.php">View Logs</a></li>
						<li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/reset-password.php">Reset Password</a></li>
					</ul>
				</div>
				
				<span class="nav_icon_right"></span>
			</div>
			<div class="login_button">
				<span class="login_icon"></span>
				<h1><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/logout.php">Logout</a></h1>
			</div>
		</div>
	</div>	
</header>
