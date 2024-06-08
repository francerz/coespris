<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require("conexion.php");
date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d H:i:s');
$cuenta = $_POST['cuenta'];
$servicio = $_POST['servicio'];
$solicitud = strtoupper($_POST['solicitud']);
$empleado = $_SESSION['empleado'];

$existente = mysql_num_rows(mysql_query("SELECT * FROM orden_pago WHERE id_solicitud = '$solicitud'"));
if($existente == 0){
	$result = mysql_query("SELECT sr.sr_cant_sal_min, sr.id_folio_orden, sm.sm_importe, s.s_cantidad FROM solicitud s INNER JOIN servicio sr ON s.id_servicio = sr.id_servicio INNER JOIN salario_minimo sm ON sr.id_salario_minimo = sm.id_salario_minimo WHERE s.id_solicitud = '$solicitud'");
	$row = mysql_fetch_array($result);
	$formato = $row['id_folio_orden'];
	$importe = $row['sr_cant_sal_min'] * $row['sm_importe'];
	$total = $importe * $row['s_cantidad'];
	$total = round($total);

	mysql_query("INSERT INTO orden_pago VALUES ('', '$fecha','$importe', '$total','$solicitud','$cuenta','$formato','$empleado')");

	$cont = $_POST['cont'];
	for ($cont; $cont >= 0; $cont--) { 
		$requisito = $_POST["requisito_{$cont}"];
		$cantidad = $_POST["cantidad_{$cont}"];
		mysql_query("INSERT INTO requisito_solicitud VALUES ('$requisito','$solicitud','$cantidad')");
	}

	mysql_query("UPDATE solicitud SET s_estatus = 'ORDEN PAGO' WHERE id_solicitud = '$solicitud'");
}
//Formato
$result = mysql_query("SELECT fr_ruta_pdf FROM servicio INNER JOIN formato ON id_folio_orden = id_formato WHERE id_servicio = '$servicio'");
$row = mysql_fetch_array($result);

mysql_close($dbConn);
?>
<script type='text/javascript'>
	document.location.href = "<?=$row['fr_ruta_pdf']?>/?i=<?=$solicitud?>";
</script>