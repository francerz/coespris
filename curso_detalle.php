<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$id= $_POST['id'];
$c_nombre = strtoupper($_POST['c_nombre']);
$dura = $_POST['duracion'];
$empl = $_POST['emp'];
require("conexion.php");
mysql_query("UPDATE curso SET c_nombre = '$c_nombre', c_duracion = '$dura', id_empleado = '$empl'
	 where id_curso = '$id'")or die(mysql_error());
mysql_close($dbConn);
?>