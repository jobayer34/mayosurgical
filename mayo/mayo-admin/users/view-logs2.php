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
			<h1 class="add_user">Connection Logs Details</h1>
			
			<div class="view_log_details">
				<div class="log_heading">
					
					<div class="serial_no">User</div>
					<div class="user_name">Action</div>
					<div class="first_name">Real IP</div>
					<div class="last_name">Virtual IP</div>
					<div class="email_address">Protocol</div>
					<div class="organisation">Duration</div>
					<div class="department">Date</div>
				</div>
<?php 
	$i = 1;
	$usersdata = mysql_query("SELECT * FROM `conn_logs`");
	while($userdetails = mysql_fetch_array($usersdata))
	{
		
 ?>		
		<div class="log_row">
			
			<div class="serial_no"><?php echo $userdetails['user'];?></div>
			<div class="user_name"><?php echo $userdetails['action'];?></div>
			<div class="first_name"><?php echo $userdetails['Real_IP'];?></div>
			<div class="last_name"><?php echo $userdetails['Virtual_IP'];?></div>
			<div class="email_address"><?php echo $userdetails['Protocole'];?></div>
			<div class="organisation"><?php if($userdetails['Duration'] == 'NULL' || $userdetails['Duration'] ==''){echo 0;}else echo $userdetails['Duration'];?></div>
			<div class="department"><?php echo $userdetails['date'];?></div>
		</div>
<?php
$i++;
}
?>
			</div>
		</div>
		
			<?php 
			
			//echo readfile("../../test.txt"); ?>
		


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
