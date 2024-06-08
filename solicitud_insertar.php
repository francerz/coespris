<?php
	//SOLICITUD
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$cantidad = $_POST['cantidad'];
	$cliente = strtoupper($_POST['cliente']);
	$oficina = strtoupper($_POST['oficina']);
	$empleado = strtoupper($_POST['empleado']);
	$servicio = strtoupper($_POST['servicio']);
	$estatus = "ASESORIA";
	date_default_timezone_set("America/Mexico_City");
	$fecha = date('Y-m-d H:i:s');
	$query = "INSERT INTO solicitud (s_fecha, s_cantidad, id_cliente, id_oficina, id_empleado, id_servicio, s_estatus) VALUES ('$fecha','$cantidad','$cliente','$oficina','$empleado','$servicio','$estatus')";
	mysql_query($query,$dbConn);
	$solicitud = mysql_insert_id($dbConn);
	//DATOS SECUNDARIOS
	$total_datos = $_POST['datos_sec']-1;
	for ($total_datos; $total_datos >= 0; $total_datos--) {
		$dat_sec_sol = $_POST["dato_sec_{$total_datos}"];
		$valor_capturado = strtoupper($_POST["dat_{$total_datos}"]);
		if ($valor_capturado !== "") {
			if ($valor_capturado=='TOTAL') {
				$id = $dat_sec_sol;
			}else{
				$query = "INSERT INTO dss_solicitud (id_solicitud, id_dat_sec_sol, valor_capturado) VALUES ('$solicitud','$dat_sec_sol','$valor_capturado')";
				mysql_query($query,$dbConn);
			}
		}
	}
	//TOTALES
	if (isset($id)) {
		if($servicio == 7||$servicio == 8||$servicio == 9){
				$valor_capturado = 0;
				$result = mysql_query("SELECT ds.valor_capturado FROM dss_solicitud ds WHERE ds.id_dat_sec_sol IN(8,9,10,11) AND id_solicitud = '$solicitud'");
				while ($row = mysql_fetch_array($result)) {
					$valor_capturado += $row['valor_capturado'];
				}
		}
		$query = "INSERT INTO dss_solicitud (id_solicitud, id_dat_sec_sol, valor_capturado) VALUES ('$solicitud','$id','$valor_capturado')";
		mysql_query($query,$dbConn);
		$query = "UPDATE solicitud SET s_cantidad = '$valor_capturado' WHERE id_solicitud ='$solicitud'";
		mysql_query($query,$dbConn);
	}
	mysql_close($dbConn);
	header("Location: solicitud_asesoria.php?i=$solicitud");
?>