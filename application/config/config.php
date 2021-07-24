
<?php

/**
 * @package		ATS PHP MVC
 * @author		Atish Chandole
 * @since       31 May 2021
 */

// ---------------Set Base URL----------------
function baseUrl(){
	if (isset($_SERVER['HTTP_HOST'])) {
		$http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$hostname = $_SERVER['HTTP_HOST'];
		$dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

		$tmplt = "%s://%s%s";
		$end = $dir;
		$baseUrl = sprintf( $tmplt, $http, $hostname, $end );
	}
	else $baseUrl = 'http://localhost/';

	return $baseUrl;
}

$baseUrl = baseUrl();
define("BASEURL", $baseUrl);

// ---------------DB Setting----------------
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "root");
define("DATABASE", "PhpMvc");

?>
