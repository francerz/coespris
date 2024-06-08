<?php
$id = $_POST['id'];
$inicio = $_POST['in'];
$fin = $_POST['fin'];
$sede = strtoupper($_POST['sede']);
require("conexion.php");
mysql_query("UPDATE grupo SET det_fecha_inicio = '$inicio', det_fecha_fin = '$fin', det_sede = '$sede'
	 where id_grupo = '$id'")or die(mysql_error());

mysql_close($dbConn);

?>