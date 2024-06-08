<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");

$nombre = strtoupper($_POST['nombre']);
$cantidad = $_POST['cantidad'];
$tipo = $_POST['tipo'];
$imagen = $_POST['imagen'];
//Solicitud
$solicitud = $_POST['solicitud'];
if ($solicitud == 0) {
	$solNombre = $_POST['sol-nombre'];
	$solContenido = $_POST['sol-contenido'];
	$archivo = "formatos/".basename( $_FILES['sol-archivo']['name']);
	move_uploaded_file($_FILES['sol-archivo']['tmp_name'], $target_path);
	$pdf = basename( $_FILES['sol-pdf']['name']);
	move_uploaded_file($_FILES['sol-archivo']['tmp_name'], $target_path);
	mysql_query("INSERT INTO formato VALUES ('','$solNombre','$solContenido','Solicitud','Habilitado','$archivo','$pdf')");
	$solicitud = mysql_insert_id($dbConn);
}
//Orden Pago
$orden = $_POST['orden'];
if ($orden == 0) {
	$ordNombre = $_POST['ord-nombre'];
	$ordContenido = $_POST['ord-contenido'];
	$archivo = "formatos/".basename( $_FILES['ord-archivo']['name']);
	move_uploaded_file($_FILES['ord-archivo']['tmp_name'], $target_path);
	$pdf = basename( $_FILES['ord-pdf']['name']);
	move_uploaded_file($_FILES['ord-archivo']['tmp_name'], $target_path);
	mysql_query("INSERT INTO formato VALUES ('','$ordNombre','$ordContenido','Orden','Habilitado','$archivo','$pdf')");
	$orden = mysql_insert_id($dbConn);
}
//Recibo
$recibo = $_POST['recibo'];
if ($recibo == 0) {
	$recNombre = $_POST['rec-nombre'];
	$recContenido = $_POST['rec-contenido'];
	$archivo = "formatos/".basename( $_FILES['rec-archivo']['name']);
	move_uploaded_file($_FILES['rec-archivo']['tmp_name'], $target_path);
	$pdf = basename( $_FILES['rec-pdf']['name']);
	move_uploaded_file($_FILES['rec-archivo']['tmp_name'], $target_path);
	mysql_query("INSERT INTO formato VALUES ('','$recNombre','$recContenido','Recibo','Habilitado','$archivo','$pdf')");
	$recibo = mysql_insert_id($dbConn);
}
//Autorizacion
if($tipo == 'autorizacion'){
	$autorizacion = $_POST['autorizacion'];
	if ($autorizacion == 0) {
		$autNombre = $_POST['aut-nombre'];
		$autContenido = $_POST['aut-contenido'];
		$archivo = "formatos/".basename( $_FILES['aut-archivo']['name']);
		move_uploaded_file($_FILES['aut-archivo']['tmp_name'], $target_path);
		$pdf = basename( $_FILES['aut-pdf']['name']);
		move_uploaded_file($_FILES['aut-archivo']['tmp_name'], $target_path);
		mysql_query("INSERT INTO formato VALUES ('','$autNombre','$autContenido','Autorizacion','Habilitado','$archivo','$pdf')") or die(mysql_error());
		$autorizacion = mysql_insert_id($dbConn);
	}
}else{
	$autorizacion = null;
}
$row = mysql_fetch_array(mysql_query("SELECT id_salario_minimo FROM salario_minimo WHERE vigente = 1"));
$salario = $row['id_salario_minimo'];
mysql_query("INSERT INTO servicio VALUES ('','$nombre','$cantidad','$salario','$orden','$recibo','$autorizacion','$solicitud','$tipo','$imagen')");
mysql_close($dbConn);
header("Location: servicio_general.php");
?>