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
<style type="text/css" media="all">

</style>

</head>

<body bgcolor="#FFFFFF">
		<?php 
		exec('/usr/bin/vpnstatus',$output);
		//echo '<pre>';
		//var_dump($output);
		
		/*$value[] = substr($output[0],0,16);
		$value[] = substr($output[0],26,15);
		$value[] = substr($output[0],45,15);
		$value[] = substr($output[0],65,15);
		$value[] = substr($output[0],80,10);
		$value[] = substr($output[0],90,25);
		
		$value[] = substr($output[1],0,16);
		$value[] = substr($output[1],26,15);
		$value[] = substr($output[1],45,15);
		$value[] = substr($output[1],65,15);
		$value[] = substr($output[1],80,10);
		$value[] = substr($output[1],90,25);
		
		$pieces[] = explode("  ", $output[1]);
		
		$empty_elements = array_keys($pieces[0],"");
		foreach ($empty_elements as $e)
		unset($pieces[0][$e]);*/
		
		//var_dump($pieces);
		?>
		
		
		<div class="form_section_content" style="float:none;padding:0;padding:33px 0;">
			<h1 class="add_user" style="text-indent:0;">Online Users</h1>	
			
			<div class="view_log_details" style="position:relative;top:-151px;">
				<!--<div class="log_heading">
					
					<div class="serial_no">User</div>
					<div class="user_name">Action</div>
					<div class="first_name">Real IP</div>
					<div class="last_name">Virtual IP</div>
					<div class="email_address">Protocol</div>
					
					<div class="department">Date</div>
				</div>-->
				
				
			<?php if(count($output)>1){ ?>
			<table id="box-table-a">
				<thead>
				<tr >
					<th style="border:1px;solid;">Common Name</th> 
					<th style="border:1px;solid;">Virtual Address</th> 
					<th style="border:1px;solid;">Real Address</th>
					<th style="border:1px;solid;">Sent</th>
					<th style="border:1px;solid;">Received</th>
					<th style="border:1px;solid;">Connected Since</th>
				
				</tr>
				</thead>
			<?php 				
				foreach($output as $test){	
					$pieces2[] = explode("  ", $test);
					if($pieces2[0][0] != 'Common Name'){
										
					
					$empty_elements = array_keys($pieces2[0],"");
					foreach ($empty_elements as $e)
					unset($pieces2[0][$e]);
					?>
					
						<tbody>
							<tr >
							<td style="border:1px;solid;"><?php echo $pieces2[0][0];?></td> 
							<td style="border:1px;solid;"><?php echo $pieces2[0][10];?></td> 
							<td style="border:1px;solid;"><?php echo $pieces2[0][14];?></td>
							<td style="border:1px;solid;"><?php echo $pieces2[0][17];?></td>
							<td style="border:1px;solid;"><?php echo $pieces2[0][20];?></td>
							<td style="border:1px;solid;"><?php echo $pieces2[0][21];?></td>
							
							</tr>
							</tbody>
							<!--<div class="serial_no"><?php echo $pieces2[0][0];?></div>
							<div class="user_name"><?php echo $pieces2[0][10];?></div>
							<div class="first_name"><?php echo $pieces2[0][14];?></div>
							<div class="last_name"><?php echo $pieces2[0][17];?></div>
							<div class="email_address"><?php echo $pieces2[0][20];?></div>
							
							<div class="department"><?php echo $pieces2[0][21];?></div>-->
						</div>
		<?php
					//print_r($pieces2[0]);
			?>							
				
					<?php //foreach($pieces2[0] as $test2){ ?>
					 <em><?php //echo $test2;?></em>
					<?php //} ?>
				
			
					<?php
						}
					unset($pieces2);
					}
					
					?> 
			
			</table>
			<?php } 
			else echo "No user available";
			?>
		

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
