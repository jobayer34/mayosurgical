<?php
if ($_SERVER["SERVER_NAME"] != 'localhost') {
	define('MARGE_DB_HOST', 'localhost');
	define('MARGE_DB_NAME', 'arvsush_mayo');
	define('MARGE_DB_USER', 'arvsush_mayo');
	define('MARGE_DB_PASS', 'mayo@123');
} 
else {
	define('MARGE_DB_HOST', 'localhost');
	define('MARGE_DB_NAME', 'paypoint');
	define('MARGE_DB_USER', 'root');
	define('MARGE_DB_PASS', '');
}
// Gmail SMTP Auth details: (username, password)
$gmail_smtp_auth = array ("support@paypoint.com.bd", "support@pp");
// Shurjo Payment Engine Library (API) location: spelib_path

?>

