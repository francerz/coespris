<?php
	require_once("conexion.php");

	// $_POST es un arreglo asociativo.
	// Los arreglos asociativos permiten utilizar cadenas como índices.
	// En lugar de $arreglo[0] puede ser $arreglo['primero']

	/* EN JAVA:
	 * int numeros = new int[10];
	 * numeros[0] = 15;
	 * numeros[1] = 43;
	 * numero =  numeros[0];
	 * numero2 = numeros[1];
	 */

	/* EN PHP:
	 * $numeros = array();
	 * $numeros['dia'] = 15;
	 * $numeros['semana'] = 43;

	 * $dia = $numeros['dia'];
	 * $semana = $numero['semana'];
	 */

	$nombre = $_POST['nombre'];

	// INSERT INTO <nombre_tabla> [(<nom_attr1> [, <nom_attr2>])] 
	//	VALUES ('val1'[,'val2'])
	$query = "INSERT INTO estado (es_nombre) VALUES ('{$nombre}')";
	mysql_query($query,$dbConn);
	// $query = 'INSERT INTO estado (es_nombre) VALUES ('.$nombre.')';

	// CON . se concatena
	// JAVA: cadena1 + cadena2;
	// PHP : $cadena1.$cadena2;

?>