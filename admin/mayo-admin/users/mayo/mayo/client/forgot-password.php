<?php 

session_start();

$_SESSION['username']=$username;

$path = $_SERVER['DOCUMENT_ROOT']."/mayo/path.php";

require_once($path);

require_once($config);

require($get_header);

?>

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
            email_id: {
				required:true,
				email: true
				},
	
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            email_id: {
				required: "Please enter your Email ID",
				email: "Please Enter Valid Email ID"
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
					<h1>Forgot Password</h1>
					<form  action="" method="post" name="forgot-password" id="regform">
						<input placeholder="Email" type="text" name="email_id"/>
						<span class="error"></span>
						<input type="submit" name="forget-password" value="Reset Password"/>
					<form>
						<?php
						
							function getRandomString($length) 
							{
								$validCharacters = "1080nordiff00123456vikas09084abcdefghijklmnopqrstuvwxyz";
								
								$validCharNumber = strlen($validCharacters);
								
								$result = "";

								for ($i = 0; $i < $length; $i++) 
								{
									$index = mt_rand(0, $validCharNumber - 1);
									
									$result .= $validCharacters[$index];
								}
								
								return $result;
							}
							$token=getRandomString(50);
							
							if(isset($_POST['forget-password']))
							{
								
								$email_id = mysql_real_escape_string($_POST['email_id']);
								
								$checkemail = mysql_query("SELECT `id` FROM `members` where `email_id`='$email_id'") or die(mysql_error());
								
								$success = mysql_num_rows( $checkemail );
								
								if ($success >= 1)
								{
										
										$to = $email_id;
										
										$authormail = "info@mayo.com";
																	
										$activation = mysql_query("UPDATE `members` set `activation_code`='$token',`date_time`=now() where `email_id`='$email_id'") or die(mysql_error());
										
										$headers = "From: Mayo " . $authormail . "\r\n";
										
										$headers .= "MIME-Version: 1.0\r\n";
										
										$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
										
										$subject = "Password Change Link";
										
										$link = $_SERVER['HTTP_HOST'];
										
										$message = '<html><body>';
										
										$message.= '<table rules="all" style="border-color: #666;" cellpadding="10">';
										
										$message.= '<tr><td><img src="http://nordiff.biz/mayo/mayo-admin/users/images/logo.png" alt="Password Change Request"/></td></tr>';
										
										$message.= '<tr><td>Click the link below to reset password. The Link will expire after 30 minutes</td></tr>';
										
										$message .='<tr><td>http://nordiff.biz/mayo/client/forget-password.php?activation_code='.$token.'</td></tr>';
										
										$message .= "</table>";
										
										$message .= "</body></html>";
										
										$mail=mail($to,$subject,$message,$headers);
										
										if($mail)
										{
											
											echo "<div class='messages'>Mail Successfully Send</div>";
											
										}
										else
										{
											
											echo "<div class='messages'>Error</div>";
											
										}
							
								}
								else
								{
									
									echo "<div class='messages'>Email does not Exist</div>";
									
								}								
								
							}
						?>
				</div>	
			</div>

		</div>
	</div>
</section>
<?php
require($get_footer);
?>
