<?php
$id= $_POST['id'];
$nombr = strtoupper($_POST['nombre']);
require("conexion.php");
mysql_query("UPDATE estado SET es_nombre = '$nombr'
	 where id_estado = '$id'")or die(mysql_error());

mysql_close($dbConn);

?>