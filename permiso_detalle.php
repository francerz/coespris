<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$id = $_POST['i'];
$per_nom = strtoupper($_POST['per_nombre']);
$per_arch = strtoupper($_POST['per_archivo']);
require("conexion.php");
mysql_query("UPDATE permiso SET per_nombre = '$per_nom', per_archivo = '$per_arch'
	 where id_permiso = '$id'")or die(mysql_error());

mysql_close($dbConn);
header("Location: permiso_general.php");
?>