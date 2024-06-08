<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$id= $_POST['i'];
$nombrz = strtoupper($_POST['nombres']);
$apater = strtoupper($_POST['apaterno']);
$amater = strtoupper($_POST['amaterno']);
$tpo = strtoupper($_POST['tipo']);
$puest = $_POST['puesto'];
$ofic = $_POST['oficina'];

require("conexion.php");
mysql_query("UPDATE empleado SET em_nombres = '$nombrz', em_apaterno = '$apater', em_amaterno = '$amater', 
	em_tipo_empleado = '$tpo', id_puesto = '$puest', id_oficina = '$ofic'
	 where id_empleado = '$id'")or die(mysql_error());
mysql_close($dbConn);
?>