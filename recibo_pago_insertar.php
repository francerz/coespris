<?php
session_start();
if (!isset($_SESSION['username'])) {
      header("Location: login.php");
  }
require("conexion.php");
$voucher = $_POST['voucher'];
$referencia = strtoupper($_POST['referencia']);
$importe = $_POST['importe'];
$solicitud = $_POST['i'];
$orden_pago = $_POST['orden_pago'];
$formato = $_POST['formato'];
$empleado = $_SESSION['empleado'];
$servicio = $_POST['servicio'];
$autorizo = $_POST['autorizo'];
if(isset($_POST['factura'])){
	$factura = $_POST['factura'];
}
date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d H:i:s');

$existente = mysql_num_rows(mysql_query("SELECT * FROM recibo_pago WHERE id_orden_pago = '$orden_pago'"));
if($existente == 0){
	mysql_query("INSERT INTO recibo_pago VALUES ('', '$fecha','$voucher', '$referencia','$importe','$orden_pago','$formato','$empleado','$autorizo')");
	$recibo = mysql_insert_id($dbConn);
	//SERVICIO
	$tipo = mysql_fetch_array(mysql_query("SELECT sr_tipo FROM servicio WHERE id_servicio = '$servicio'"));
	if($tipo['sr_tipo'] == "autorizacion"){
		mysql_query("UPDATE solicitud SET s_estatus = 'PAGADO' WHERE id_solicitud = '$solicitud'");
	}elseif($tipo['sr_tipo'] == "curso"){
		mysql_query("UPDATE solicitud SET s_estatus = 'C_CURSO' WHERE id_solicitud = '$solicitud'");
	}else{
		mysql_query("UPDATE solicitud SET s_estatus = 'ENTREGADO' WHERE id_solicitud = '$solicitud'");
	}
	//FACTURA
	if (isset($factura)&&$factura==1) {
		mysql_query("INSERT INTO factura VALUES ('','$recibo','0','1')");
	}else{
		mysql_query("INSERT INTO factura VALUES ('','$recibo','0','0')");
	}
}
//Formato
$result = mysql_query("SELECT fr_ruta_pdf FROM servicio INNER JOIN formato ON id_formato_recibo = id_formato WHERE id_servicio = '$servicio'");
$row = mysql_fetch_array($result);

mysql_close($dbConn);
?>
<script type='text/javascript'>
	document.location.href = "<?=$row['fr_ruta_pdf']?>/?i=<?=$solicitud?>&im=<?=$importe?>";
</script>