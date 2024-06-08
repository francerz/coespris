<?php
	// $<nombre_variable> [= <valor>];
	$dbHost = 'localhost';
	$dbUser = 'coespris';
	$dbPass = 'nb7ke5ZiL8';
	$dbName = 'coespris_coespris';

	// mysql_connect(<servidor>,<usuario>,<contraseña>);
	$dbConn = mysql_connect($dbHost, $dbUser, $dbPass);
	// mysql_select_db(<nombre_db>,<conexion>);
	mysql_set_charset('utf8');
	mysql_select_db($dbName,$dbConn);
?>