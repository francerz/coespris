<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$puesto = strtoupper($_POST['puesto']);
/*

*/
//extract($_POST); nos ayuda a tomar todos los post
require("conexion.php");
mysql_query("INSERT INTO puesto VALUES ('','$puesto')")or die(mysql_error());
echo '<script language="javascript">alert("Puesto registrado con exito");</script>';
mysql_close($dbConn);
	
header("Location: puesto_registrar.php");
?>
