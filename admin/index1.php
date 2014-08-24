<?php

$path = $_SERVER['DOCUMENT_ROOT']."/mayo/path.php";

require_once($path);

require_once($get_header);
 
require_once('../config/mayo-config.php');

require_once('classes/registeration.php');
?>
<?php
	$register = new Registration();
?>
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">Registration form for Admin</h1>
<form name="form1" method="post" action="">
	<ul>
		<li>
			<label>User Name</label>
			
	<input type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="User Name" required />
	</li>
		
		<li>
			<label>Password</label>
	<input type="email" name="user_email" placeholder="Email-ID" required />
	</li>
		
		<li>
			<label>Password</label>
	<input type="password" name="user_password_new" pattern=".{6,}" placeholder="Password" required autocomplete="off" />
	</li>
	</li>
		
		<li>
			<label>Confirm Password</label>
	<input type="password" name="user_password_repeat" pattern=".{6,}" placeholder="Confirm Password" required autocomplete="off" />
	</li>
	<li>
	<input type="submit" name="register" value="Register">
	</li>
	</ul>
</form>
<?php

if(isset($_POST['register']))
	{
		
		$user_name = mysql_real_escape_string($_POST['user_name']);
		
		$password  = mysql_real_escape_string(md5($_POST['user_password_new']));
		
		$user_email = mysql_real_escape_string($_POST['user_email']);
		
		
		$registration_ip = $_SERVER['REMOTE_ADDR'];
		
		$register->UserRegister($user_name,$password,$user_email,$today,$registration_ip);
		
		if($register)
		{
			
			echo "Registration Successfull";
			
		}
		else
		{
			
			echo "Registration Failed";
			
		}
	}
?></div>
	</div>
</section>
<?php
include($get_footer);
?>
