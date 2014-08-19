<?php 

session_start();

$_SESSION['username']=$username;

$path = $_SERVER['DOCUMENT_ROOT']."/mayo/path.php";

include 'loginfunction.php'; 

require_once($path);

require_once($config);

if(loggedin()) 
{
	
$_SESSION['username']=$username;

header ('Location:welcome');

exit();

}

/*************************************/

if (isset($_POST['logins']))
{

	$username = mysql_real_escape_string($_POST['username']);

	$password = mysql_real_escape_string($_POST['password']);

	$passwordmd = md5($password);

	$remember = $_POST['remember'];

	$logind = mysql_query("SELECT `id` FROM members WHERE `user_name`='$username' && `password`='$passwordmd'") or die(mysql_error());

	$datas = mysql_num_rows($logind);

	if($datas>=1)
	{
		$loginok = TRUE;
		
	} 
	else 
	{
		//echo $username.' '.$passwordmd.'<br/>';
		$message = "Incorrect Password/Username";

	}
 
	if ($loginok==TRUE)
	{
		if ($remember == "yes")
		{
			setcookie("username", $username, time()+7600, "/", "nordiff.biz");
		 
			header("Location:welcome");
			
			exit();
		}
		else if($remember=="")
		{
			setcookie("username", $username, time()+7600, "/", "nordiff.biz");
			
			$_SESSION['username']=$username;
			
			header("Location:welcome");
			
		}
	}
} 
require($get_header);?>

<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>

<script>
	setTimeout(function(){ $('.messages').fadeOut('slow'); }, 5000);
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#regform").validate({
    
        // Specify the validation rules
        rules: {
            uname: {
				required:true
				},
            upassword: {
                required: true
            }
	
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            uname: {
				required: "Please enter username",
			},
            password: {
                required: "Please Enter password"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>

<section class="row">
	<div class="container">
		<div class="login_section_content">
			<div class="login_left">
				<img src="../images/login_image.jpg" alt="image"/>
				<h1>Welcome to Mayo Surgical !</h1>
				<p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit</p>
			</div>
			<div class="login_right">
				<div class="login_right_inner">
					<h1>Login to Mayo Surgical</h1>
<form  action="" method="post" name="form-login" id="regform">

<input required placeholder="Username" type="text" name="username"/>
<span class="error"></span>
<input required placeholder="Password" type="password" name="password"/>
<span class="error"></span>
<label for="remember">Remember Me:</label>
<input type="checkbox" name="remember" value="yes">
<span class="messages"><div class="messages"><?php if(!empty($message)){echo $message;}?></div></span>
<input type="submit" name="logins" value="LOG IN"/>

<label class="forgot_password"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/client/forgot-password.php">Forgot Password</a></label>
</form>
				</div>	
			</div>

		</div>
	</div>
</section>
<?php
require($get_footer);
?>
