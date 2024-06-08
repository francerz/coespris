<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$nom = $_POST['nom'];
$estado = $_POST['estado'];
$nombre = $_POST['nombre'];

require("conexion.php");
mysql_query("INSERT INTO municipio VALUES ('','$nombre','$estado')");
mysql_close($dbConn);
header("Location: estado_general.php?estado=$estado&nom=$nom");
?>