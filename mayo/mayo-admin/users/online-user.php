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
		<?php 
		exec('/usr/bin/vpnstatus',$output);
		
		var_dump($output);
		//var_dump($return);
		//passthru('/usr/bin/vpnstatus');
		//var_dump($return);
		?>
		
		
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
