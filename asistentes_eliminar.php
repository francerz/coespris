<?php
session_start();
if (!isset($_SESSION['username'])) {
   header("Location: index.php");
}
require_once("conexion.php");
$grupo = $_POST['grupo'];
$asistente = $_POST['asistente'];
$estatus = $_POST['estatus'];

if($estatus=="ACTIVO") {
	mysql_query("UPDATE asistentes SET estatus = 'INACTIVO' WHERE id_asistente = '$asistente'");
}else{
	mysql_query("UPDATE asistentes SET estatus = 'ACTIVO' WHERE id_asistente = '$asistente'");
}	
mysql_close($dbConn);

header("Location: cursos_administrar.php?grupo=$grupo");
?>