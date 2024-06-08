<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$curso = $_POST['curso'];
$grupo = $_POST['grupo'];
if ($curso == 'otro'){
	$nombre = $_POST['nombre'];
	$hora = $_POST['hora'];
	mysql_query("INSERT INTO curso(c_nombre, c_duracion) VALUES('$nombre','$hora')");
	$curso = mysql_insert_id($dbConn);
	mysql_query("INSERT INTO servicio_curso VALUES('$curso','34')");
}else{
	$hora = $_POST['hora'];
	mysql_query("UPDATE curso SET c_duracion = '$hora' WHERE id_curso = '$curso'");
}
$inicio = $_POST['inicio'];
$fin = $_POST['fin'];
$sede = $_POST['sede'];
$empleado = $_POST['empleado'];
mysql_query("UPDATE grupo SET det_fecha_inicio = '$inicio', det_fecha_fin = '$fin', det_sede = '$sede', id_curso = '$curso', id_empleado = '$empleado' WHERE id_grupo = '$grupo'");
mysql_close($dbConn);
header("Location: cursos_administrar.php?grupo=$grupo");
?>