<?php
$id= $_POST['id'];
$nombr = strtoupper($_POST['nombre']);
$muni = $_POST['municipio'];
require("conexion.php");
mysql_query("UPDATE localidad SET lc_nombre = '$nombr', id_municipio = '$muni'
	 where id_localidad = '$id'")or die(mysql_error());

mysql_close($dbConn);

?>
