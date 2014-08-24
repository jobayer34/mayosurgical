<?php

$path = $_SERVER['DOCUMENT_ROOT']."/mayo/path.php";

require_once($path);

require($config);

include('header.php');

?>

<section class="row">
	<div class="container">
		<div class="form_section_content">
		<h1 class="add_user">User Registration</h1>
<form name="userinfo" method="post" id="regform" action="">
	<ul>
		<li>
			<label>User Name</label>
			<input type="text" name="uname" placeholder="Choose User Name"/>
		</li>
		
		<li>
			<label>Password</label>
			<input type="password" name="upassword" placeholder="Choose Password" required/>
		</li>
		
		<li>
			<label>First Name</label>
			<input type="text" name="fname" placeholder="First Name" required/>
		</li>
			
	   <li>
			<label>Last Name</label>
			<input type="text" name="lname" placeholder="Last Name" required/>
	   </li>
	  
	   <li>
			<label>Designation</label>
			<input type="text" name="designation" placeholder="Designation" required/>
	   </li>
	
       <li>
			<label>Employee No</label>	
			<input type="text" name="empno" placeholder="Employee No" required/>
		</li>
		
		<li>
			<label>Organisation</label>
			<input type="text" name="organisation" placeholder="Organisation" required/>
		</li>
	
		<li>
			<label>Email-ID</label>
			<input type="email" name="uemail" placeholder="Email-ID" required/>
		</li>
		
		<li>	
			<input type="submit" name="register" value="Register" required/>
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
		 
		 
		 require_once('includes/functions.php');
	
		$log = new File_log();
	
		$log-> Write("test.txt",$data);
	
	}
	if($querys)
	{
		echo "You have Successfully Registered";
		exit();
		
	}
	else
	{
		echo "Something went wrong";
	}
		
	}

?></div>
	</div>
</section>
<?php
require($get_footer);
?>
