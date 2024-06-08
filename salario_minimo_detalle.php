<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$id = $_POST['id'];
$import = $_POST['importe'];
$vigenc = $_POST['vigencia'];
require("conexion.php");
mysql_query("UPDATE salario_minimo SET sm_importe = '$import', sm_anio_vigencia = '$vigenc'
	 where id_salario_minimo = '$id'")or die(mysql_error());

mysql_close($dbConn);
header("Location: salario_minimo_general.php");
?>