<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
		require_once('conexion.php');
		$nombre=strtoupper($_POST['nombre']);
		$archivo=strtoupper($_POST['archivo']);

		$query=("INSERT INTO permiso(per_nombre,per_archivo) 
			VALUES('$nombre','$archivo')") or die (mysql_error());


		mysql_query($query,$dbConn);

header("Location: permiso_registrar.php");

?>