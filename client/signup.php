<?php
$path = $_SERVER['DOCUMENT_ROOT']."/mayo/path.php";
require_once($path);
require($config);
require($get_header);
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
</script>
<!-- Jquery validation code ends -->
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">Add User</h1>
<form name="userinfo" method="post" action="" id="regform">
	<ul>
		<li>
			<span class="form_label">	
				<label>User Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="uname" placeholder="Choose User Name">
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">	
				<label>Password</label>
			</span>
			<span class="form_input">
				<input type="password" name="upassword" id="uppassword" placeholder="Choose Password">
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">
				<label>Confirm Password</label>
			</span>
			<span class="form_input">
				<input type="password" name="confirm_password" placeholder="Confirm Password">
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">
				<label>First Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="fname" placeholder="First Name">
				<span class="error"></span>
			</span>
		</li>
			
	   <li>
		   <span class="form_label">
				<label>Last Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="lname" placeholder="Last Name">
				<span class="error"></span>
			</span>
	   </li>
	  
	   <li>
		   <span class="form_label">
				<label>Designation</label>
			</span>
			<span class="form_input">
				<input type="text" name="designation" placeholder="Designation">
				<span class="error"></span>
			</span>
	   </li>
	
       <li>
		    <span class="form_label">
				<label>Employee No</label>	
			</span>
			<span class="form_input">
				<input type="text" name="empno" placeholder="Employee No">
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">
				<label>Organisation</label>
			</span>
			<span class="form_input">
				<input type="text" name="organisation" placeholder="Organisation">
				<span class="error"></span>
			</span>
		</li>
	
		<li>
			<span class="form_label">
				<label>Email-ID</label>
			</span>
			<span class="form_input">
				<input type="email" name="uemail" placeholder="Email-ID">
				<span class="error"></span>
			</span>
		</li>
		
		<li>	
			<input type="submit" name="register" value="Register">
		</li>
		</ul>
	
</form>

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
		 
		 
		require_once('../includes/functions.php');
	
		$log = new File_log();
	
		$log-> Write("../test.txt",$data);
	
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

?></div>
	</div>
</section>
<?php
require($get_footer);
?>
