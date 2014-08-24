<?php
session_start();

$path = $_SERVER['DOCUMENT_ROOT']."/mayo/path.php";

require_once('../../includes/functions.php');

require_once($path);

include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{
	include($loginheader);
	
	$id = $_GET['id']
?>

<script src="ajax.js" type="text/javascript"></script>
<script src="responseHTML.js" type="text/javascript"></script>

		

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
    $("#modify-form").validate({
    
        // Specify the validation rules
        rules: {
            email_id: {
                required: true,
                email: true
            },
           first_name:{
				required: true,
				minlength: 3,
				alpha: true
				},
			last_name:{
				required:true,
				minlength: 3,
				alpha: true
				},
			designation:{
				required:true,
				minlength:4
				},
			employee:{
				required: true,
				},
			organisation:{
				required:true,
				},
				
        },
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            first_name:{
				required: "Please Enter your Name",
				alpha: "Only Characters are allowed"
			},
            last_name:{
				required: "Please enter your Last Name",
				alpha: "Only Characters are allowed"
			},
            designation:"Field is required",
            employee: "Field is required",
            confirm_password:"Password don not Match",
            organisation:"Field is required",
            email_id: "Please enter a valid email address"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<section class="row">
	<div class="container">
	
	<div id="storage" style="display:none;">
</div>

<div style="width:30%;float:left;padding:25px 0;">
		<ul style ="display: block;list-style: none outside none;text-decoration: none;" class="left1">
						<li style="padding:8px 0;">
						
						<!--<a href="http://<?php //echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/adduser.php" style="text-decoration:none;">Add User</a>-->
						<a href="#" ONCLICK="loadWholePage('http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/adduser2.php')" style="text-decoration:none;">Add User</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/modify-user2.php')" style="text-decoration:none;">Modify User</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/deleteuser2.php')" style="text-decoration:none;">Delete User</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/view-logs2.php')" style="text-decoration:none;">View Logs</a>
						</li>
						<li style="padding:8px 0;">
						<a href="#" ONCLICK="loadWholePage('http://<?php echo $_SERVER['HTTP_HOST']; ?>/mayo/mayo-admin/users/reset-password2.php')" style="text-decoration:none;">Reset Password</a>
						</li>
					</ul>
		</div>
	
	<div id="displayed">
</div>
		<div class="form_section_content">
			<h1 class="add_user">Modify User</h1>
			<form name="form1" method="post" action="" id="modify-form">
				<ul>
					<?php
					
						$modif = mysql_query("SELECT * FROM `members` where `id` = '$id'") or die(mysql_error());
						$row = mysql_fetch_array($modif);
					?>
					<li>
						<label>First Name</label>
						<input type="text" value="<?php echo $row['first_name'];?>" name="first_name" id="">
					</li>	
					<li>
						<label>Last Name</label>
						<input type="text" value="<?php echo $row['last_name'];?>" name="last_name" id="">
					</li>	
					<li>
						<label>Organisation</label>
						<input type="text" value="<?php echo $row['organisation'];?>" name="organisation" id="">
					</li>
					<li>
						<label>Employee No</label>
						<input type="text" value="<?php echo $row['employee_no'];?>" name="employee" id="">
					</li>
					<li>
						<label>Designation</label>
						<input type="text" value="<?php echo $row['designation'];?>" name="designation" id="">
					</li>	
					<li>
						<label>Email Address</label>
						<input type="text" value="<?php echo $row['email_id'];?>" name="email_id" id="">
					</li>
					<li>
						<input type="submit" name="modify" id="" value="Submit"/>
					</li>					
				</ul>
			</form>
			<?php
			
				//$password = $_POST['password'];
				
				$fname = $_POST['first_name'];
				
				$lname = $_POST['last_name'];
				
				$organisation = $_POST['organisation'];
				
				$employee = $_POST['employee'];
				
				$designation = $_POST['designation'];
				
				$email_id = $_POST['email_id'];
			
				if(isset($_POST['modify']))
				{
					
					$sql = mysql_query("Update `members` set `first_name`='$fname',`last_name`='$lname',`designation`
					='$designation',`employee_no`='$employee',organisation='$organisation' where `id` = '$id'") or die(mysql_error());
					if($sql)
					{
						
						echo "<div class='messages'>User Updated Successfully</div>";
						
					}
					else
					{
						
						echo "<div class='messages'>Something Wrong</div>";
						
					}
					
				}
			
			?>
		</div>
	</div>
</section>
<?php
include($get_footer);
}
else
{
header('Location:../login.php');
}
?>
