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
	//include($loginheader);
?>
<html>
<head>
<title>Another HTML page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">

		<div class="form_section_content">
			<h1 class="add_user">Users Details</h1>
			<div class="log_calender">
				<label>Date From</label>
				<input type="date" name="" id=""/>
				<label>Date To</label>
				<input type="date" name="" id=""/>
				<input type="Submit" name="" id="" value="Submit"/>
			</div>
			<div class="view_log_details">
				<div class="log_heading">
					<div class="serial_no">S.No.</div>
					<div class="user_name">User Name</div>
					<div class="first_name">First Name</div>
					<div class="last_name">Last Name</div>
					<div class="email_address">Email Address</div>
					<div class="organisation">Organisation</div>
					<div class="department">Action</div>
				</div>
<?php 
	$i = 1;
	$usersdata = mysql_query("SELECT * FROM `members`");
	while($userdetails = mysql_fetch_array($usersdata))
	{
		
 ?>		
		<div class="log_row">
			<div class="serial_no"><?php echo $i; ?></div>
			<div class="user_name"><?php echo $userdetails['user_name'];?></div>
			<div class="first_name"><?php echo $userdetails['first_name'];?></div>
			<div class="last_name"><?php echo $userdetails['last_name'];?></div>
			<div class="email_address"><?php echo $userdetails['email_id'];?></div>
			<div class="organisation"><?php echo $userdetails['organisation'];?></div>
			<div class="department"><a href="edituser.php?id=<?php echo $userdetails['id'];?>">Edit</a></div>
		</div>
<?php
$i++;
}
?>
			</div>
		</div>
	</div>
</section>

</div>
	
</body>
</html>
<?php
//include($get_footer);
}
else
{
header('Location:../login.php');
}
?>
