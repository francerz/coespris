<?php

require_once("conexion.php");

 $nombre =strtoupper($_POST['nombre']);

 $query = ("INSERT INTO requisito(rq_nombre) values ('{$nombre}')") or die(mysql_error());


 mysql_query($query,$dbConn);
header("Location: requisito_registrar.php");
?>