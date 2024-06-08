<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$id= $_POST['i'];
$r_nombre = strtoupper($_POST['r_nombre']);
require("conexion.php");
mysql_query("UPDATE rol SET rol_nombre = '$r_nombre'
	 where id_rol = '$id'")or die(mysql_error());
mysql_close($dbConn);
?>