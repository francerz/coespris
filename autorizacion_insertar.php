<?php
require("conexion.php");

session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
$solicitud = $_POST['solicitud'];
$servicio = $_POST['servicio'];
$folio = $_POST['recibo'];
$comisionado = $_POST['comisionado'];
date_default_timezone_set("America/Mexico_City");
$fecha = date('Y-m-d H:i:s');
$empleado = $_SESSION['empleado'];
//Estatus
mysql_query("UPDATE solicitud SET s_estatus = 'FINALIZADO' WHERE id_solicitud = '$solicitud'");
//Formato
$result = mysql_query("SELECT fr_ruta_pdf, id_formato FROM servicio INNER JOIN formato ON id_formato_autoriza = id_formato WHERE id_servicio = '$servicio'");
$row = mysql_fetch_array($result);
$formato = $row['id_formato'];
//Autorizacion
$existente = mysql_num_rows(mysql_query("SELECT * FROM autorizacion WHERE id_folio = '$folio'"));
if($existente == 0){
	$query = "INSERT INTO autorizacion (au_fecha, au_comisionado, id_formato, id_folio, id_empleado) VALUES ('$fecha','$comisionado','$formato','$folio','$empleado')";
	mysql_query($query,$dbConn);
	//DATOS SECUNDARIOS
	$autorizacion = mysql_insert_id($dbConn);
	$total_datos = $_POST['datos_sec']-1;
	for ($total_datos; $total_datos >= 0; $total_datos--) {
		$dat_sec_aut = $_POST["dato_sec_{$total_datos}"];
		$valor_capturado = strtoupper($_POST["dat_{$total_datos}"]);
		if ($valor_capturado !== "") {
			$query = "INSERT INTO dsa_autorizacion (id_dat_sec_aut, id_autorizacion, valor_capturado) VALUES ('$dat_sec_aut','$autorizacion','$valor_capturado')";
			mysql_query($query);
		}
	}
}else{
	$existente = mysql_fetch_array(mysql_query("SELECT id_autorizacion FROM autorizacion WHERE id_folio = '$folio'"));
	$autorizacion = $existente['id_autorizacion'];
}
mysql_close($dbConn);
?>
<script type='text/javascript'>
	if (<?=$solicitud?> == 35) {window.location="au.php/?i=<?=$solicitud?>&a=<?=$autorizacion?>";};
	document.location.href = "<?=$row['fr_ruta_pdf']?>/?i=<?=$solicitud?>&a=<?=$autorizacion?>";
</script>