<?php
$id= $_POST['id'];
$nombr = strtoupper($_POST['nombre']);
$cp = $_POST['cp'];
$lc = $_POST['lc'];
require("conexion.php");
mysql_query("UPDATE colonia SET cl_nombre = '$nombr', id_cod_pos = '$cp', id_localidad = '$lc'
	 where id_colonia = '$id'")or die(mysql_error());
echo '<script language="javascript">alert("colonia Actualizada Correctamente");</script>';
mysql_close($dbConn);
header("Location: colonia_general.php");
?>
