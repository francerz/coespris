<?php
$estado = strtoupper($_POST['estado']);
require("conexion.php");
mysql_query("INSERT INTO estado VALUES ('', '$estado')")or die(mysql_error());
echo '<script language="javascript">alert("Estado registrado con exito");</script>';
mysql_close($dbConn);
header("Location: estado_registrar.php");
?>
