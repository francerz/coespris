<?php
    session_start();
    if (!isset($_SESSION['username'])) {
       header("Location: index.php");
    }
require_once("conexion.php");
$grupo = $_POST['grupo'];
$solicitud = $_POST['solicitud'];
$cantidad = $_POST['cantidad'];

for ($i=0; $i < $cantidad; $i++) { 
	$nombre = strtoupper($_POST["nombre{$i}"]);
	mysql_query("INSERT INTO asistentes VALUES ('','$grupo','$nombre','ACTIVO','$solicitud')");
}
mysql_query("INSERT INTO solicitud_grupo VALUES ('$solicitud','$grupo')");
mysql_query("UPDATE solicitud SET s_estatus = 'ENTREGADO' WHERE id_solicitud = '$solicitud'");
mysql_close($dbConn);

header("Location: cursos_administrar.php?grupo=$grupo");
?>