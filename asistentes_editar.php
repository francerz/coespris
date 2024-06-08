<?php
    session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php"); 
  }
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$grupo = $_POST['grupo'];

	require("conexion.php");
	$query = "UPDATE asistentes SET as_nombre = '$nombre' WHERE id_asistente = '$id'";
	mysql_query($query, $dbConn);
	mysql_close($dbConn);

	header("Location: cursos_administrar.php?grupo=$grupo");
?>