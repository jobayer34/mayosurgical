<?php 
session_start();
$_SESSION['username']=$username;
$path = $_SERVER['DOCUMENT_ROOT']."/mayo/path.php";
require_once($path);
require_once($config);
include '../loginfunction.php';
if(loggedin()) 
{

include('header.php');
?>
<section class="row">
	<div class="container">
		<div class="login_section_content">
			hi <?php echo $_SESSION['username'];?><?php echo $_COOKIE['username'];?>
		</div>
	</div>
</section>
<?php
require($get_footer);
}
else
{
	
header('Location:../login.php');
	
}
?>

