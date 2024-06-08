<?php
ob_start();
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}
require_once("conexion.php");
switch ($_POST['rango']) {
case 'per':
	$inicio = $_POST['inicio'];
	$fin = $_POST['fin'];
	$inicio2 = $inicio;
	$fin2 = $fin;
	break;
case 'hoy':
	$inicio = date('Y-d-m', strtotime('-1 day'));
	$fin = date('Y-d-m');
	$inicio2 = date('d-m-Y', strtotime('-1 day'));
	$fin2 = date('d-m-Y');
	break;
case 'sem':
	$inicio = date('Y-d-m', strtotime('-1 week'));
	$fin = date('Y-d-m');
	$inicio2 = date('d-m-Y', strtotime('-1 week'));
	$fin2 = date('d-m-Y');
	break;
case 'mes':
	$inicio = date('Y-d-m', strtotime('-1 month'));
	$fin = date('Y-d-m');
	$inicio2 = date('d-m-Y', strtotime('-1 month'));
	$fin2 = date('d-m-Y');
	break;
case 'año':
	$inicio = date('Y-d-m', strtotime('-1 year'));
	$fin = date('Y-d-m');
	$inicio2 = date('d-m-Y', strtotime('-1 year'));
	$fin2 = date('d-m-Y');
	break;
default:
	echo "ERROR";
	break;
}
if (isset($_POST['empleado'])) {
	if ($_SESSION['rol']=='VENTANILLA') {
		$id_empleado = $_SESSION['empleado'];
	}else{
		$id_empleado = $_POST['empleado'];
	}
	$query = "SELECT ct.ct_nombre, ct.ct_apaterno, ct.ct_amaterno, rp.rp_fecha_voucher, sr.sr_nombre, rp.rp_importe_voucher FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio LEFT JOIN orden_pago op ON s.id_solicitud = op.id_solicitud LEFT JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente WHERE rp.rp_fecha_voucher >= '$inicio' AND rp.rp_fecha_voucher <= '$fin' AND rp.id_empleado = '$id_empleado'";
	$result = mysql_query($query,$dbConn);
	$query = "SELECT sum(rp.rp_importe_voucher) total FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio LEFT JOIN orden_pago op ON s.id_solicitud = op.id_solicitud LEFT JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago WHERE rp.rp_fecha_voucher >= '$inicio' AND rp.rp_fecha_voucher <= '$fin' AND rp.id_empleado = '$id_empleado'";
	$result2 = mysql_query($query,$dbConn);
	$total = mysql_fetch_array($result2);
}else{
	$query = "SELECT ct.ct_nombre, ct.ct_apaterno, ct.ct_amaterno, rp.rp_fecha_voucher, sr.sr_nombre, rp.rp_importe_voucher, of.of_nombre FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio LEFT JOIN orden_pago op ON s.id_solicitud = op.id_solicitud LEFT JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente INNER JOIN oficina of ON s.id_oficina = of.id_oficina WHERE rp.rp_fecha_voucher >= '$inicio' AND rp.rp_fecha_voucher <= '$fin'";
	if($_POST['servicio']!='TODOS'){
	$servicio = $_POST['servicio'];
	$query = $query." AND sr.id_servicio = '$servicio'";
	}
	if($_POST['oficina']!='GENERAL'){
	$oficina = $_POST['oficina'];
	$query = $query."AND s.id_oficina = '$oficina'";
	}
	$result = mysql_query($query,$dbConn);
	$query = "SELECT sum(rp.rp_importe_voucher) total FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio LEFT JOIN orden_pago op ON s.id_solicitud = op.id_solicitud LEFT JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago WHERE rp.rp_fecha_voucher >= '$inicio' AND rp.rp_fecha_voucher <= '$fin'";
	if($_POST['servicio']!='TODOS'){
	$query = $query." AND sr.id_servicio = '$servicio'";
	}
	if($_POST['oficina']!='GENERAL'){
	$query = $query."AND s.id_oficina = '$oficina'";
	}
	$result2 = mysql_query($query,$dbConn);
	$total = mysql_fetch_array($result2);
} ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ingresos Periodo - </title>
</head>
<body>
	<header>
		<img class="imagen" src="images/encabezado.png"/>
		<img class="peq" src="assets/img/logocolima.jpg"/>
		<div class="row">
			<div class="col-md-12">
		        <div class="panel-body">
		        	<?php 
		        	if(isset($id_empleado)){
			        	if ($_SESSION['rol']=='CONTADOR'||$_SESSION['rol']=='ADMINISTRADOR') {
                    		$empleado = mysql_fetch_array(mysql_query("SELECT em_nombres, em_amaterno, em_apaterno FROM empleado WHERE id_empleado = '$id_empleado'")); ?>
                    		<h5><font color='#47a447'>Empleado:</font> <?=$empleado['em_nombres']?> <?=$empleado['em_apaterno']?> <?=$empleado['em_amaterno']?></h5>
                    	<?php }
	                }else{
			        	if(isset($servicio)){
			        		$row = mysql_fetch_array(mysql_query("SELECT sr_nombre FROM servicio WHERE id_servicio = '$servicio'"));
			        		$sr_nombre = $row['sr_nombre'];?>
			        		<h5><font color='#47a447'>Ingresos del Servicio:</font> <?=$sr_nombre?></h5>
			        		<h5><font color='#47a447'>Periodo:</font> <?=$inicio2?> hasta <?=$fin2?></h5>
			        	<?php }else{ ?>
			        		<h5><font color='#47a447'>Ingresos del Periodo:</font> <?=$inicio2?> hasta <?=$fin2?></h5>
			        	<?php }
			        	if(isset($oficina)){
			        		$row = mysql_fetch_array(mysql_query("SELECT of_nombre FROM oficina WHERE id_oficina = '$oficina'"));
			        		$of_nombre = $row['of_nombre'];?>
			        		<h5><font color='#47a447'>Oficina:</font> <?=$of_nombre?></h5>
			        	<?php }
		        	}?>
		        </div>
		    </div>
		</div>
	</header>
	<div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped">
						<thead class="encabezado">
							<tr>
								<th>No</th>
								<?php if(empty($id_empleado)){ if(empty($servicio)){?>
									<th>Servicio</th>
								<?php } ?>
								<?php if(empty($oficina)){?>
									<th>Oficina</th>
								<?php } } ?>
								<th>Cliente</th>
								<th>Fecha</th>
								<th>Ingreso</th>
							</tr>
						</thead>
						<tbody class='contenido'>
							<?php 
							$no = 1;
							while($row = mysql_fetch_array($result)): ?>
							<tr>
								<td><?=$no?></td>
								<?php if(empty($id_empleado)){ if(empty($servicio)){?>
									<td><?=$row['sr_nombre']?></td>
								<?php } ?>
								<?php if(empty($oficina)){?>
									<td><?=$row['of_nombre']?></td>
								<?php } } ?>
								<td><?=$row['ct_nombre']?> <?=$row['ct_apaterno']?> <?=$row['ct_amaterno']?></td>
								<td><?=$row['rp_fecha_voucher']?></td>
								<td>$<?=$row['rp_importe_voucher']?></td>
							</tr>
							<?php
							$no++;
							endwhile;
							mysql_close($dbConn);?>
						</tbody>
					</table>
					<div align='right' class="col-md-12 col-sm-12 col-xs-12">
						<br>
						<h3><font color='#47a447'>Total de Ingresos:</font> $<?=round($total['total'],2)?></h3>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
		.imagen{
			width: 100%;
			top: 10px;
			left: 0;
			right: 0;
		}
		.peq{
			width: 100px;
			left: 10px;
			opacity: 0.2;
			position: absolute;
		}
		.nombre{
			text-align: center;
			font-family: 'Calibri', Helvetica, Arial, sans-serif;
		}
		.encabezado{
			font-size: 15px;
		}
		.contenido{
			font-size: 10px;
		}
	</style>
</body>
</html>
<?php
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "Ingresos".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>