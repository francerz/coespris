<?php
$id= $_POST['i'];
$r_nombre = strtoupper($_POST['nombre']);
$cantmin = $_POST['cantmin'];
$tipo = $_POST['tipo'];

require("conexion.php");
mysql_query("UPDATE servicio SET sr_nombre = '$r_nombre' , sr_cant_sal_min = '$cantmin' , sr_tipo = '$tipo' where id_servicio = '$id'")or die(mysql_error());
mysql_close($dbConn);
header("Location: servicio_general.php");
?>