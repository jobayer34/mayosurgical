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
?>
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<?php echo readfile("../../test.txt"); ?>
		</div>
	</div>
</section>

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
