<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$nombre = strtoupper($_POST['nombre']);
$contenido = strtoupper($_POST['contenido']);
$tipo = strtoupper($_POST['tipo']);
$estatus = strtoupper($_POST['estatus']);

require("conexion.php");
mysql_query("INSERT INTO formato VALUES ('', '$nombre','$contenido','$tipo','$estatus')")or die(mysql_error());
echo '<script language="javascript">alert("formato registrado con exito");</script>';
mysql_close($dbConn);

header("Location: formato_registrar.php");
?>