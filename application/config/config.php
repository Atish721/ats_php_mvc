
<?php

/**
 * @package		ATS PHP MVC
 * @author		Atish Chandole
 * @since       31 May 2021
 */

error_reporting(-1);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// ---------------Set Base URL----------------
function baseUrl(){
	if (isset($_SERVER['HTTP_HOST'])) {
		$http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$hostname = $_SERVER['HTTP_HOST'];
		$dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

		$tmplt = "%s://%s%s";
		$end = $dir;
		$base_url = sprintf( $tmplt, $http, $hostname, $end );
	}
	else $base_url = 'http://localhost/';

	return $base_url;
}

$baseUrl = baseUrl();
define("BASEURL", $baseUrl);

// ---------------DB Setting----------------
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "root");
define("DATABASE", "php_mvc");

?>
