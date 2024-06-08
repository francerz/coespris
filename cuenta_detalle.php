<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$id = $_POST['i'];
$razon = strtoupper($_POST['razon']);
$chab = strtoupper($_POST['cuentaha']);
$clabe = $_POST['clabe'];
$nucuenta = $_POST['nucuenta'];
require("conexion.php");
mysql_query("UPDATE cuenta SET cn_razon_social_banco  = '$razon', cn_cuentahabiente = '$chab', cn_numero_cuenta = '$nucuenta', cn_clabe = '$clabe'
	 where id_cuenta = '$id'")or die(mysql_error());

mysql_close($dbConn);
header("Location: cuenta_general.php");
?>