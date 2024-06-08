<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$nom = $_POST['nom'];
$mun = $_POST['mun'];
$loc = $_POST['loc'];
$estado = $_POST['estado'];
$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];

require("conexion.php");
mysql_query("INSERT INTO codigo_postal VALUES ('', '$codigo')");
$cod = mysql_insert_id($dbConn);
mysql_query("INSERT INTO colonia VALUES ('', '$nombre','$cod','$loc')");
mysql_close($dbConn);
header("Location: estado_general.php?estado=$estado&nom=$nom&mun=$mun&loc=$loc");
?>
