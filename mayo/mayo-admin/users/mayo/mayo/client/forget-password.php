<?php
session_start();

$path = $_SERVER['DOCUMENT_ROOT']."/mayo/path.php";

require_once($path);

include($config);

require($get_header);

$activationcode = $_GET['activation_code'];

$sqlgetmail = mysql_query("select `email_id` from `members` where `activation_code`='$activationcode'") or die(mysql_error());

$getemail = mysql_fetch_array($sqlgetmail);

$email_id = $getemail['email_id'];
?>
<!-- For validations -->
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
    $("#changepassword").validate({
    
        // Specify the validation rules
        rules: {
           new_password:{
				required: true,
				minlength: 5,
				noSpace:true
				},
		   confirm_password:{
			   equalTo:"#newpassw"
			   }
				
        },
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            old_password:{
				required: "Please Enter Your Old Password",
				noSpace: "Spaces are not allowed"
			},
            new_password:{
				required: "Please enter New Password",
				noSpace: "Spaces are not allowed"
			},
            confirm_password:"Password don not Match"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">Reset Password</h1>
			<form name="changep" method="post" id="changepassword" action="">
				<ul>
					<li>
						<label>New Password</label>
						<input type="password" name="new_password" id="newpassw"/>
					</li>
					<li>
						<label>Confirmed Password</label>
						<input type="password" name="confirm_password" id=""/>
					</li>
					<li>
						<input type="submit" name="changepassword" id="" value="Submit"/>
					</li>					
				</ul>
			</form>
			<?php
				
				$password = mysql_real_escape_string($_POST['new_password']);
				
				$passwordmd = md5($password);
			
				if(isset($_POST['changepassword']))
				{
					
					$get_time = mysql_query("SELECT `date_time` from `members` where `activation_code`='$activationcode'") or die(mysql_error());
					
					$get_time1 = mysql_fetch_array($get_time);
					
					/*$orgtime = $get_time['date_time'];
					
					$timing = strtotime($orgtime);
					
					$nowtime = now();
					
					$nowtiming = strtotime($nowtime);
					
					if(($nowtiming-$nowtime)>30)*/
					
					$changepass = mysql_query("UPDATE `members` set `password`='$passwordmd' where `activation_code`='$activationcode'") or die(mysql_error());
					
					if($changepass)
					{
						
						echo "<div class='messages'>Password Changed Successfully</div>";
						
						$to = $email_id;
										
						$authormail = "info@mayo.com";
																	
						$activation = mysql_query("UPDATE `members` set `activation_code`='',`date_time`='' where `email_id`='$email_id'") or die(mysql_error());
										
						$headers = "From: Mayo " . $authormail . "\r\n";
										
						$headers .= "MIME-Version: 1.0\r\n";
										
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
										
						$subject = "Your New Password";
										
						$link = $_SERVER['HTTP_HOST'];
										
						$message = '<html><body>';
										
						$message.= '<table rules="all" style="border-color: #666;" cellpadding="10">';
										
						$message.= '<tr><td><img src="http://nordiff.biz/mayo/mayo-admin/users/images/logo.png" alt="Password Change Request"/></td></tr>';
										
						$message.= '<tr><td>Please Keep it safe</td></tr>';
										
						$message .='<tr><td>Password:'.$password.'</td></tr>';
										
						$message .= "</table>";
										
						$message .= "</body></html>";
										
						$mail=mail($to,$subject,$message,$headers);
										
						if($mail)
						{
											
							echo "<div class='messages'>Please Check your E-Mail</div>";
											
						}
						else
						{
											
							echo "<div class='messages'>Error</div>";
											
						}
						
					}
					else
					{
						
						echo "<div class='messages'>Token Expires/User not found</div>";
						
					}
					
				}
			
			?>
		</div>
	</div>
</section>
<?php
include($get_footer);
?>
