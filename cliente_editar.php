<?php
session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
	$id = $_POST['i'];
	$nombre = $_POST['nombre'];
	$apaterno = $_POST['apaterno'];
	$amaterno = $_POST['amaterno'];
	$calle = $_POST['calle'];
	$numero = $_POST['numero'];
	$colonia = $_POST['colonia'];

	require("conexion.php");
	$query = "UPDATE cliente SET ct_nombre = '$nombre', ct_apaterno = '$apaterno', ct_amaterno = '$amaterno', ct_calle = '$calle', ct_numero = '$numero', id_colonia = '$colonia' WHERE id_cliente = '$id'";
	mysql_query($query, $dbConn);

	$rfc = $_POST['RFC'];
	$razon_social = $_POST['RazonSocial'];
	$calle = $_POST['Calle'];
	$numero = $_POST['Numero'];
	$colonia = $_POST['Colonia'];

	$query2 = "UPDATE datos_fiscales SET df_rfc = '$rfc', df_razon_social = '$razon_social', df_calle = '$calle', df_numero = '$numero', id_colonia = '$colonia' WHERE id_cliente = '$id'";
	mysql_query($query2, $dbConn);

	echo "<script type='text/javascript'>alert('Cliente Guardado');</script>";
?>