<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$nombre = strtoupper($_POST['nombre']);
$apaterno = strtoupper($_POST['apaterno']);
$amaterno = strtoupper($_POST['amaterno']);
$tpem = $_POST['tpem'];
$puesto = $_POST['puesto'];
$oficina = $_POST['oficina'];
require("conexion.php");
mysql_query("INSERT INTO empleado VALUES ('', '$nombre','$apaterno','$amaterno','$tpem', '$puesto','$oficina')")or die(mysql_error());
mysql_close($dbConn);
header("Location: catalogo_usuarios_permisos.php");
echo "<script language=Javascript> location.href=\"catalogo_usuarios_permisos.php\"; </script>"; 

?>
