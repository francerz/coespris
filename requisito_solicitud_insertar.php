<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
 
 $cantidad =$_POST['cantidad'];
 $requisito   =strtoupper($_POST['requisito']);
 $solicitud =strtoupper($_POST['solicitud']);
 	
 $query = ("INSERT INTO requisito_solicitud(rso_cantidad,id_requisito,id_solicitud) VALUES ('$cantidad','$requisito','$solicitud')") or die(mysql_error());
mysql_query($query,$dbConn);

header("Location: requisito_solicitud_registrar.php");
?>

