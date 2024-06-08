<?php
require_once("conexion.php");
$nombre = mysql_fetch_array(mysql_query("SELECT ser.sr_nombre FROM solicitud AS sol 
	INNER JOIN servicio AS ser ON sol.id_servicio = ser.id_servicio where sol.id_solicitud = $i"));
?>
<html>
<body>
	<img class = "imagen" src="images/encabezado.png"/>
	<img class="peq" src="assets/img/logocolima.jpg"/>
	<style type="text/css">
		.imagen{
			width: 100%;
			top: 10px;
			left: 0;
			right: 0;
		}
		.peq{
			width: 100px;
			left: 10px;
			opacity: 0.2;
			position: absolute;
		}
		.nombre{
			text-align: center;
			font-family: 'Calibri', Helvetica, Arial, sans-serif;
		}
	</style>
	<p class = "nombre"><?=$nombre['sr_nombre']?></p>
</body>
</html>