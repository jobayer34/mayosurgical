<?phpsession_start();	$_SESSION = array();	session_destroy();		header("Location:demo.php");	exit;?>