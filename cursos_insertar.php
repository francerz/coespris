<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$curso = $_POST['curso'];
if ($curso == 'otro'){
	$nombre = $_POST['nombre'];
	$hora = $_POST['hora'];
	mysql_query("INSERT INTO curso(c_nombre, c_duracion) VALUES('$nombre','$hora')");
	$curso = mysql_insert_id($dbConn);
	mysql_query("INSERT INTO servicio_curso VALUES('$curso','34')");
}
$inicio = $_POST['inicio'];
$fin = $_POST['fin'];
$sede = $_POST['sede'];
$empleado = $_POST['empleado'];
mysql_query("INSERT INTO grupo(det_fecha_inicio, det_fecha_fin, det_sede, id_curso, id_empleado, det_estatus) VALUES ('$inicio', '$fin', '$sede', '$curso', '$empleado', 1)");
$grupo = mysql_insert_id($dbConn);
mysql_close($dbConn);
header("Location: cursos_administrar.php?grupo=$grupo");
?>