<?php
	// $<nombre_variable> [= <valor>];
	$dbHost = 'localhost';
	$dbUser = 'root';
	$dbPass = '';
	$dbName = 'coespris';

	// mysql_connect(<servidor>,<usuario>,<contraseña>);
	$dbConn = mysql_connect($dbHost, $dbUser, $dbPass);
	// mysql_select_db(<nombre_db>,<conexion>);
	mysql_select_db($dbName,$dbConn);
?>