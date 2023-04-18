<?php
	$cookievalue = rand();
	ini_set( 'session.cookie_httponly', 1 );
	ini_set('expose_php',0);
	session_start();
	header('X-XSS-Protection: 0;');
	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
	header("Pragma: no-cache"); // HTTP 1.0.
	header("Expires: 0"); // Proxies.
	setcookie("usercookie", $cookievalue, [
			'secure' => true,
			'httponly' => true,
			'samesite' => 'Lax',
		]); //cookie

	//sql connection parameters
	$servername = "localhost";
	$db_username = "root";
	$db_password = "";
	$dbName = "books";
?>