<?php
session_start();

$path = $_SERVER['DOCUMENT_ROOT']."/mayo/path.php";

$functionfile = $_SERVER['DOCUMENT_ROOT']."/mayo/includes/functions.php";

require_once($functionfile);

require_once($path);

include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{
	include($loginheader);
?>
<script src="ajax.js" type="text/javascript"></script>
<script src="responseHTML.js" type="text/javascript"></script>
<div id="storage" style="display:none;">
</div>

<section class="row">
	<div class="container">
		<div style="width:30%;float:left;padding:25px 0;">
		<ul style ="display: block;list-style: none outside none;text-decoration: none;" class="left1">
						<li style="padding:8px 0;">
						
						<!--<a href="http://<?php //echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/adduser.php" style="text-decoration:none;">Add User</a>-->
						<a href="#" ONCLICK="loadWholePage('adduser2.php')" style="text-decoration:none;">Add User</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('modify-user2.php')" style="text-decoration:none;">Modify User</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('deleteuser2.php')" style="text-decoration:none;">Delete User</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('view-logs2.php')" style="text-decoration:none;">View Logs</a>
						</li>
						
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('online-user.php')" style="text-decoration:none;">Online Users</a>
						</li>
						
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('reset-password2.php')" style="text-decoration:none;">Reset Password</a>
						</li>
					</ul>
		</div>
	
	<div id="displayed">
</div>
	
	
<?php }else { 
header('Location:../login.php');
 } ?>


<?php

	if(isset($_POST['register']))
	{
		$seprator = "|";
		
		$message = "User Added";
		
		$uname = $_POST['uname'];
		
		$password = $_POST['upassword'];
		
		$mdpass = md5($password);
		
		$fname = $_POST['fname'];
		
		$lname = $_POST['lname'];
		
		$designation = $_POST['designation'];
		
		$empno = $_POST['empno'];
		
		$organisation = $_POST['organisation'];
		
		$uemail = $_POST['uemail'];
		
		$data = $seprator." ".$message.",".$uname.",".$password.",".$fname.",".$lname.",".$designation.",".$empno.",".$organisation.",".$uemail;
		
		$check = mysql_query("SELECT * FROM `members` where `user_name`='$uname' || `email_id`='$uemail'") or die(mysql_error());
		
		if(mysql_num_rows($check) >=1)
		{
			echo "Username/Email id is already Registered with this account";
			exit();
		}
		else
		{
			$querys = mysql_query("INSERT INTO `members` (`user_name`,`password`,`first_name`,`last_name`,`designation`,`employee_no`,`organisation`,`email_id`)
		 VALUES ('$uname','$mdpass','$fname','$lname','$designation','$empno','$organisation','$uemail')") or die(mysql_error());
		 
	
		$log = new File_log();
	
		$log-> Write("../../test.txt",$data);
	
	}
	if($querys)
	{
		echo "<div class='messages'>You have Successfully Registered.</div>";
		exit();
		
	}
	else
	{
		echo "<div class='messages'>Something went wrong</div>";
	}
		
	}

?>
<!-- For validations -->
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>

<!-- validation end --> 

<!-- jQuery Form Validation code -->
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
				required:true,
				minlength:5,
				noSpace: true
				},
            email: {
                required: true,
                email: true
            },
            upassword: {
                required: true,
                minlength: 5,
                noSpace: true
            },
            confirm_password:{
					required:true,
					equalTo:"#uppassword"
				},
            fname:{
				required: true,
				minlength: 3,
				alpha: true
				},
			lname:{
				required:true,
				minlength: 3,
				alpha: true
				},
			designation:{
				required:true,
				minlength:4
				},
			empno:{
				required: true,
				},
			organisation:{
				required:true,
				},
				uemail:{
					required:true,
					}
				
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            uname: {
				required: "Please choose Username",
				noSpace: "Spaces are not allowed in Username"
			},
            fname:{
				required: "Please Enter your Name",
				alpha: "Only Characters are allowed"
			},
            lname:{
				required: "Please enter your Last Name",
				alpha: "Only Characters are allowed"
			},
            designation:"Field is required",
            empno: "Field is required",
            confirm_password:"Password don not Match",
            organisation:"Field is required",
            uemail: "Please enter a valid email address",
            username: "Please enter a valid username",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                noSpace: "Spaces are not allowed in Password"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script></div>
	</div>
</section>
<?php
require($get_footer);
?>
