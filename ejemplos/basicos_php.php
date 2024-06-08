<?php
	// DECLARACIÓN DE VARIABLES EN PHP
	/**	El formato para declarar una variable es:
	  * 	$<nombre_variable>
	  *	Una variable no está ligada a un tipo de dato, eso significa que es
	  *	posible asignarle valores de tipos distintos sin que existan errores.
	  *		$respuesta = 0;
	  *		$respuesta = true;
	  *		$respuesta = "Sí";
	  */
	$variable = 50;
	
	// LOS NOMBRE DE VARIABLES SON CaseSensitive
	/**	Las variables son sensibles a mayúsculas y minúsculas, lo que significa
	  *	que es posible utilizar dos variables con el mismo nombre, sólo	-------
	  * variando las mayúsculas.
	  */
	
	$foo = "Hola ";
	$Bar = "casa";
	$bar = "mundo";
	
	echo $foo.$bar;		// Resultado impreso 'Hola mundo';
	echo $foo.$Bar;		// Resultado impreso 'Hola casa';
	
	//	EN PHP LAS CONDICIONES NO SON EXTRICTAMENTE BOOLEANAS
	/**	Si una variable es numérica, los valores disintos a 0 son considerados
	  *	verdaderos, mientras que el 0 es falso.
	  *
	  *	Si la variable es cadena, los valores que retornan falso son:
	  *		- "";		// Cadena vacía
	  *		- "false";	// Cadena con palabra false
	  *	Los arreglos son considerados como 'true' sólo si tienen elementos
	  */
	var_dump((bool) "");        // bool(false)
	var_dump((bool) 1);         // bool(true)
	var_dump((bool) -2);        // bool(true)
	var_dump((bool) "foo");     // bool(true)
	var_dump((bool) 2.3e5);     // bool(true)
	var_dump((bool) array(12)); // bool(true)
	var_dump((bool) array());   // bool(false)
	var_dump((bool) "false");   // bool(true)
	
	///////////////////////////////////////////////////////////////////////////
	/**	VARIABLES DE ARREGLOS
	  *	Es bastante común considerar que en un lenguaje no se puede manejar
	  * variables únicas que sólo puedan ser definidas en la forma que fueron
	  * declaradas. Sino que existan variables que representen colecciones de
	  * datos.
	  * Una de las colecciones más comunes en los lenguajes son los arreglos.
	  *
	  *	Los arreglos en PHP tienen como virtud de que no cuentan con una longi-
	  *	tud fija y los elementos almacenados pueden ser representados mediante
	  * un índice personalizado (puede o no ser numérico).
	  */
	
	// Declaración de un arreglo
	$arreglo = array();
	
	// Llenado de datos de un arreglo.
	$arreglo[] = "Primero";
	$arreglo[] = "Segundo";
	$arreglo[] = "Tercero";
	
	// Recuperando el dato almacenado en el arreglo
	echo $arreglo[1]; // Salida: Y la respuesta es: Segundo
	echo $arreglo[5]; // WARNING: undefined index '5'.
	
	
	// Utilizando un índice para asignar un campo a una posición.
	$arreglo[3]	= "Cuarto";
	$arreglo[4]	= "Quinto";
	
	// Utilizando índices de cadenas
	$arreglo['nombre']	= "Francisco";
	$arreglo['apaterno']= "Cervantes";
	
	// Recuperando el dato almacenado en un arreglo utilizando índice de cadena
	// Salida: Mi nombre es Francisco Cervantes.
	echo "Mi nombre es {$arreglo['nombre']} {$arreglo['apaterno']}.";
	
	// Declarando y asignando un arreglo 'inline'
	/** Algunas veces es necesario declarar un arreglo y asignar valores de ---
	  * forma predeterminada sin necesidad de crear el arreglo y hacer las ----
	  * asignaciones. A esto se le llama declaración 'inline'.
	  */
	$arreglo = array("Primero", "Segundo", "Tercero");
	$arreglo[] = "Cuarto";
	
	
	echo $arreglo[0];	// Salida: Primero
	echo $arreglo[2];	// Salida: Tercero
	echo $arreglo[3];	// Salida: Cuarto
	
	// Declaración inline utilizando índices específicos.
	/** La declaración inline de un arreglo también permite la asignación de --
	  * índices para los campos.
	  *		<indice>	=> <valor>,
	  */
	$arreglo = array(
		0		=> "Primero",
		1		=> "Segundo",
		3		=> "Cuarto",
		'foo'	=> "bar"
	);
	
	echo $arreglo[0];		// Salida: Primero
	echo $arreglo[3];		// Salida: Cuarto
	echo $arreglo['foo'];	// Salida: bar
	echo $arreglo[4];		// WARNING: undefined index '4'
	
	///////////////////////////////////////////////////////////////////////////
	//
	//	CONTROL DE FLUJO DEL CÓDIGO SELECTIVO
	//
	///////////////////////////////////////////////////////////////////////////
	/**	En PHP como en todo lenguaje de programación es posible dirigir los
	  *	flujos de código de la aplicación para decidir las operaciones que se
	  * deben realizar para concluir la aplicación.
	  */
	//	FLUJO SIMPLE DE CÓDIGO SELECTIVO
	//	Es posible utilizar la sentencia 'if' cuando deseamos que una parte
	//	de nuestro código queremos que se ejecute al cumplirse determinada
	//	condición.
	if ($edad > 18) {
		echo "Tiene la mayoría de edad";
	}
	//	FLUJO ALTERNATIVO DE CÓDIGO SELECTIVO
	//	Es posible utilizar las sentencias 'if'-'else' cuando deseamos que una
	//	parte de nuestro código se ejecute en caso de cumplir una condición y
	//	en caso de no cumplir esa condición ejecutar otro código.
	if	($contraenia == $resultado) {
		echo "Puede ingresar";
	} else {
		echo "La contraseña es incorrecta";
	}
	//	FLUJO DE SELECCIÓN EXTENDIDA.
	//	Se utiliza la conjunción de sentencias 'if'-'else if' para realizar
	//	múltiples evaluaciones de un resultado.
	if ($edad < 18) {
		echo "No es mayor de edad";
	} else if ($edad < 65) {
		echo "Tiene la mayoría de edad";
	} else {
		echo "Es de la tercera edad"
	}
	//	FLUJO DE SELECCIÓN ESPECÍFICA
	//	En algunas ocasiones es necesario determinar si una variable cumple
	//	con un valor específico de un grupo de posibles valores y descartar
	//	el resto de los valores. La sentencia 'switch-case' permite que se
	//	realicen selecciones con esa intención.
	switch ($tipo_usuario) {
		case 'administrador':
			// Enviar al panel de administración.
			break;
		case 'comisionado': case 'encargado':
			// Enviar a pantalla del empleado interno.
			break;
		case 'contador':
			// Enviar a pantalla de consulta fiscal.
			break;
		default:
			// Enviar a la pantalla de presentación.
			break;
	}
	
	///////////////////////////////////////////////////////////////////////////
	//
	//	CONTROL DE FLUJO POR BUCLES
	//
	///////////////////////////////////////////////////////////////////////////
	/**	En PHP es común encontrar diferentes bucles de control para realizar
	  *	operaciones repetitivas o en las que se desconoce certeramente el número
	  * de condicionantes posibles.
	  */
	//	BUCLE WHILE
	//	El bucle 'while' permite realizar iteraciones, evaluando antes de 
	//	iniciar cada iteración.
	$contador = 100;
	while ($contador > 0) {
		echo $contador;		// SALIDA números del 100 al 1.
		$contador--;
	}
	//	BUCLE DO-WHILE
	//	El bucle 'do'-'while' permite realizar iteraciones, evaluando en cada
	//	ocación después de haber ejecutado el código.
	$contador = 100;
	do {
		echo $contador;		// SALIDA: 100
		$contador--;		
	} while ($contador < 10);	// El número es 99, no se cumple la condición, termina ciclo.
	
	//	BUCLE FOR
	//	El bucle 'for' permite realizar iteraciones, evaluando antes de
	//	iniciar cada iteración. Se delimita mediante una condición contable.
	for ($i = 0; $i < 10; $i++) {
		echo $i;	// SALIDA números del 0 al 9	
	}
	
	//	BUCLE FOREACH
	//	El bucle 'foreach' permite realizar iteraciones en colecciones de datos
	//	pudiendo iterar incluso por arreglos con índices de cadena.
	foreach ($arreglo as $indice => $valor) {
		echo "El índice es $indice y el valor es $valor";
	}
?>