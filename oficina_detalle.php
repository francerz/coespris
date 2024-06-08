<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$id= $_POST['id'];
$nombr = strtoupper($_POST['nombre']);
$call = strtoupper($_POST['calle']);
$numer = $_POST['numero'];
$nomen = strtoupper($_POST['nomenclatura']);
$direccion = strtoupper($_POST['direccion']); 
$rfc = strtoupper($_POST['rfc']); 
$colon = $_POST['colonia'];
$cuent = $_POST['cuenta'];

require("conexion.php");
mysql_query("UPDATE oficina SET of_nombre = '$nombr', of_calle = '$call', of_numero = '$numer', of_nomenclatura = '$nomen', of_dir_relativa = '$direccion', 
	of_rfc = '$rfc', id_colonia = '$colon', id_cuenta = '$cuent'
	 where id_oficina = '$id'")or die(mysql_error());

mysql_close($dbConn);
header("Location: oficina_general.php");
?>