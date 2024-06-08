<?php

require_once("conexion.php");
 
 $cantidad =$_POST['cantidad'];
 $requisito   =strtoupper($_POST['requisito']);
 $servicio =strtoupper($_POST['servicio']);
 	
 $query = ("INSERT INTO requisito_servicio VALUES ('$cantidad','$requisito','$servicio')") or die(mysql_error());
mysql_query($query,$dbConn);

header("Location: requisito_servicio_registrar.php");
?>