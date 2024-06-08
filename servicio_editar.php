<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$id = $_POST['id'];
$nombre = strtoupper($_POST['nombre']);
$cantidad = $_POST['cantidad'];
$tipo = $_POST['tipo'];
$imagen = $_POST['imagen'];
mysql_query("UPDATE servicio SET sr_nombre = '$nombre', sr_cant_sal_min = '$cantidad', sr_tipo = '$tipo', sr_imagen = '$imagen' WHERE id_servicio = '$id'", $dbConn);
mysql_close($dbConn);
header("Location: servicio_general.php");
?>