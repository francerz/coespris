<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$rol = strtoupper($_POST['rol']);
require("conexion.php");
mysql_query("INSERT INTO rol VALUES ('', '$rol')")or die(mysql_error());
echo '<script language="javascript">alert("Rol registrado con exito");</script>';
mysql_close($dbConn);
header("Location: rol_registrar.php");
?>
