<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$nombre = strtoupper($_POST['nombre']);
$duracion = $_POST['duracion'];
$empleado = strtoupper($_POST['empleado']);
require("conexion.php");
mysql_query("INSERT INTO curso VALUES ('', '$nombre', '$duracion', '$empleado')")or die(mysql_error());
echo '<script language="javascript">alert("Curso registrado con exito");</script>';
mysql_close($dbConn);
header("Location: curso_registrar.php");
?>
