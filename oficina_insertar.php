<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$nombre = strtoupper($_POST['nombre']);
$calle = strtoupper($_POST['calle']);
$numero = $_POST['numero'];
$nomen = strtoupper($_POST['nomenclatura']);
$direccion = strtoupper($_POST['direccion']);
$rfc = strtoupper($_POST['rfc']);  
$colonia = strtoupper($_POST['colonia']);
$cuenta = $_POST['cuenta'];

require("conexion.php");
mysql_query("INSERT INTO oficina VALUES ('', '$nombre','$calle','$numero','$colonia','$cuenta','$nomen','$direccion','$rfc')")or die(mysql_error());
mysql_close($dbConn);

header("Location: oficina_registrar.php");
?>
