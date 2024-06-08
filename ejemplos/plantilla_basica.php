<?php
	// Establece conexión con la base de datos.
	// require_once ("conexion.php");
	
	$title = 'Título de la página';
?>
<!DOCTYPE html>
<html lang='es'>
<head>
	<?php include ("sec_head.inc.php"); ?>
</head>
<body>
	<?php // SE TOMA EL ENCABEZADO DESDE UN ARCHIVO ?>
	<?php include ("sec_encabezado.inc.php"); ?>
	<div id='content'>
		<div class='wrapper'>
		<!-- PONER EL CÓDIGO DE HTML AQUÍ -->
		<!-- Puede ser formulario, tabla, consulta, búsqueda, combinación, etc. -->
		</div>
	</div>
	<?php // SE TOMA EL PIE DE PAGINA DESDE UN ARCHIVO ?>
	<?php include ("sec_piepagina.inc.php"); ?>
</body>
</html>