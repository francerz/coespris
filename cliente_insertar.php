<?php

    session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	$nombre = strtoupper($_POST['nombre']);
	$apaterno = strtoupper($_POST['apaterno']);
	$amaterno = strtoupper($_POST['amaterno']);
	$calle = strtoupper($_POST['calle']);
	$numero = $_POST['numero'];
	$colonia = $_POST['colonia'];
	

	require("conexion.php");
	$query = "INSERT INTO cliente VALUES ('','$nombre','$apaterno','$amaterno','$calle','$numero','$colonia')";
	mysql_query($query, $dbConn);
	
	$i = mysql_insert_id($dbConn);

	$rfc = strtoupper($_POST['RFC']);
	$razon_social = strtoupper($_POST['RazonSocial']);
	$calle = strtoupper($_POST['Calle']);
	$numero = $_POST['Numero'];
	$colonia = $_POST['Colonia'];
	$correo = $_POST['Correo'];
	if ($correo=="") {
		$correo = "Sin Correo";
	}
	$query2 = "INSERT INTO datos_fiscales VALUES ('$i','$rfc','$razon_social','$calle','$numero','$colonia','$correo')";
	mysql_query($query2, $dbConn);

	mysql_close($dbConn);
	$s = $_POST['s'];
	header("Location: solicitud_registrar.php?i=$i&s=$s");
?>