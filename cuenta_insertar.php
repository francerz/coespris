<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");

 $razonsocial =strtoupper($_POST['razonsocial']);
 $cuentahabiente =strtoupper($_POST['cuentahabiente']);
 $numerocuenta =strtoupper($_POST['numerocuenta']);
 $clabe =strtoupper($_POST['clabe']);

 
mysql_query("INSERT INTO cuenta VALUES ('','$razonsocial','$cuentahabiente','$numerocuenta','$clabe')")or die(mysql_error());
echo '<script language="javascript">alert("Cuenta registrada con exito");</script>';

mysql_close($dbConn);
header("Location: cuenta_registrar.php");
?>