<?php

	
	define('DB_HOST', 'localhost'); 
	define('DB_NAME', 'bookstoredatabase'); 
	define('DB_USERNAME', 'root'); 
	define('DB_PASSWORD', ''); 

	
	define('PAYPAL_EMAIL', 'user@gmail.com'); 
	define('RETURN_URL', '/index.php'); 
	define('CANCEL_URL', 'cancel.php'); 
	define('NOTIFY_URL', 'notify.php'); 
	define('CURRENCY', 'USD'); 
	define('SANDBOX', TRUE);
	define('LOCAL_CERTIFICATE', FALSE);

	$paypal_url = (SANDBOX === TRUE) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr";
	
	define('PAYPAL_URL', $paypal_url);

?>