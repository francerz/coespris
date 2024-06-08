<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require("conexion.php");

$id = $_POST['i'];
$lema = $_POST['lema'];
$vigenc = $_POST['vigencia'];
$estatus = $_POST['status'];

mysql_query("UPDATE lema SET anio_lema = '$vigenc', lema_texto = '$lema', lema_estatus = '$estatus'
	 where id_lema = '$id'")or die(mysql_error());
mysql_close($dbConn);
header("Location: lema_general.php");
?>
