<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$id= $_POST['i'];
$p_nombre = strtoupper($_POST['p_nombre']);
require("conexion.php");
mysql_query("UPDATE puesto SET pu_nombre = '$p_nombre'
	 where id_puesto = '$id'")or die(mysql_error());
mysql_close($dbConn);
header("Location: puesto_general.php");
?>