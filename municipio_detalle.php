<?php
$id= $_POST['id'];
$nombr = strtoupper($_POST['nombre']);
$estad = $_POST['estado'];
require("conexion.php");
mysql_query("UPDATE municipio SET mp_nombre = '$nombr', id_estado = '$estad'
	 where id_municipio = '$id'")or die(mysql_error());

mysql_close($dbConn);

?>