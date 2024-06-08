<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$id = $_POST['i'];
$nom = strtoupper($_POST['nombre']);
$cont = strtoupper($_POST['area']);
$tp = $_POST['tipo'];
$estad = $_POST['estatus'];
require("conexion.php");
mysql_query("UPDATE formato SET fr_nombre = '$nom', fr_contenido = '$cont', fr_tipo = '$tp', estatus = '$estad'
	 where id_formato = '$id'")or die(mysql_error());

mysql_close($dbConn);
header("Location: formato_general.php");

?>