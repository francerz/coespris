<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$nom = $_POST['nom'];
$mun = $_POST['mun'];
$estado = $_POST['estado'];
$nombre = $_POST['nombre'];


require("conexion.php");
mysql_query("INSERT INTO localidad VALUES ('', '$nombre','$mun')");
mysql_close($dbConn);
header("Location: estado_general.php?estado=$estado&nom=$nom&mun=$mun");
?>