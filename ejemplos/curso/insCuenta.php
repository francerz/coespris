<?php
	require_once("conexion.php");

	// EXTRAER LAS VARIABLES DENTRO DE $_POST
	// Forma extendida, recomendada por legibilidad del código.
	/**
	 *	$banco 			= $_POST['banco'];
	 *	$cuentahabiente = $_POST['cuentahabiente'];
	 *	$cuenta 		= $_POST['cuenta'];
	 *	$clabe 			= $_POST['clabe'];
	 */
	// Otra forma de extraerlas usando una función, más práctica.
	extract($_POST);

	// CREAR Y EJECUTAR LA INSERCIÓN
	$query = "INSERT INTO cuenta (cn_razon_social_banco, cn_cuentahabiente, cn_numero_cuenta, cn_clabe)
		VALUES ('$banco','{$cuentahabiente}','{$cuenta}','{$clabe}')";
	mysql_query($query,$dbConn) or die(mysql_error());

	// IMPORTANTE CERRAR LAS CONEXIONES ACTIVAS
	mysql_close($dbConn);
?>