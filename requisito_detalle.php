<?php
$id= $_POST['i'];
$r_nombre = strtoupper($_POST['requisito']);
require("conexion.php");
mysql_query("UPDATE requisito SET rq_nombre = '$r_nombre' where id_requisito = '$id'")or die(mysql_error());
mysql_close($dbConn);
header("Location: requisito_general.php");
?>