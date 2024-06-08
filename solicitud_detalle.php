<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$solicitud = $_GET['i'];
	date_default_timezone_set("America/Mexico_City");
	//Datos de Solicitud
	$query = "SELECT fr.fr_nombre, sr.id_servicio, sr.sr_cant_sal_min, sm.sm_importe, s.s_estatus, s.s_fecha, s.s_cantidad,
	ct.ct_nombre, ct.ct_apaterno, ct.ct_amaterno, ct.ct_calle, ct.ct_numero, ct.id_cliente, cl.cl_nombre, cp.cp_cod_pos,
	lc.lc_nombre, mp.mp_nombre, es.es_nombre, s.id_solicitud, s.id_empleado FROM formato fr
	INNER JOIN servicio sr ON fr.id_formato = sr.id_formato_solicitud INNER JOIN salario_minimo sm ON sr.id_salario_minimo = sm.id_salario_minimo
	INNER JOIN solicitud s ON s.id_servicio = sr.id_servicio INNER JOIN cliente ct ON s.id_cliente = ct.id_cliente
	INNER JOIN colonia cl ON ct.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos
	INNER JOIN localidad lc ON cl.id_localidad = lc.id_localidad INNER JOIN municipio mp ON lc.id_municipio = mp.id_municipio
	INNER JOIN estado es ON mp.id_estado = es.id_estado WHERE fr.estatus = 'Habilitado' AND s.id_solicitud = '$solicitud'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$servicio = $row['id_servicio'];
	$total = $row['sm_importe'] * $row['sr_cant_sal_min'];
	//Datos secundarios de solicitud
	$query = "SELECT dss.valor_capturado, ds.dss_nombre  FROM solicitud s INNER JOIN dss_solicitud dss ON s.id_solicitud = dss.id_solicitud INNER JOIN datos_secundarios_solicitud ds ON dss.id_dat_sec_sol = ds.id_dat_sec_sol WHERE s.id_solicitud = '$solicitud'";
	$result = mysql_query($query);
?>
<!DOCTYPE html>
<html lang='es'>
<head>
	<?php include ("sec_head.inc.php"); ?>
</head>
<body>
<?php include ("sec_encabezado.inc.php"); ?>
	<div class='wrapper'>
    	<div id="page-wrapper" >
    		<div id="page-inner">
    			<div class="panel-body">
				<div class="row">
            		<div class="col-md-12 col-sm-12 col-xs-12">
        				<h2>Detalle de Solicitud</h2>
        			</div>
            		<div class="col-md-6 col-sm-6 col-xs-6">
            			<div class="panel panel-warning">
	                        <div class="panel-heading">
	                            <label>Datos de Solicitud</label>
	                        </div>
            				<div class="panel-body">
            					<table class="table">
            						<thead>
            							<tr>
            								<th>Fecha de Solicitud</th>
            								<th>Atendio</th>
            							</tr>
            						</thead>
            						<tbody>
            							<?php $atendio = mysql_fetch_array(mysql_query("SELECT em_nombres, em_apaterno, em_amaterno FROM empleado WHERE id_empleado = {$row['id_empleado']}"));?>
            							<tr>
            								<td><?=$row['s_fecha']?></td>
            								<td><?=$atendio['em_nombres']?> <?=$atendio['em_apaterno']?> <?=$atendio['em_amaterno']?></td>
            							</tr>
            						</tbody>
            						<thead>
	            						<tr>
			            					<th>Costo del Servicio</th>
			            					<th>Cantidad</th>
            							</tr>
            						</thead>
            						<tbody>
	            						<tr>
					            			<td><b>$<?php echo round($total,2); if($servicio == 25){echo " por metro";}?></b></td>
					            			<td><?php echo $row['s_cantidad']; if($servicio == 25){echo " metros";}?></td>
	            						</tr>
	            					</tbody>
            					</table>
		            			<?php
		            			//Orden de Pago
			    				$query = "SELECT * FROM orden_pago where id_solicitud = '$solicitud'";
			    				$result_orden = mysql_query($query);
			    				$row_orden = mysql_fetch_array($result_orden);
			    				if($row_orden!=null){
			    					$atendio = mysql_fetch_array(mysql_query("SELECT em_nombres, em_apaterno, em_amaterno FROM empleado WHERE id_empleado = {$row_orden['id_empleado']}"));
									?>
									<label>Orden de Pago</label>
									<h5><label>Atendio: </label> <?=$atendio['em_nombres']?> <?=$atendio['em_apaterno']?> <?=$atendio['em_amaterno']?></h5>
									<table class='table'>
										<thead>
											<tr>
												<th>Fecha de Orden de pago</th>
												<th>Total de Orden de pago</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?=$row_orden['op_fecha']?></td>
												<td><b>$<?=round($row_orden['op_total'],2)?></b></td>
											</tr>
										</tbody>
									</table>
								<?php }
								//Recibo Pago
								$query = "SELECT rp.rp_fecha_emision, rp.rp_fecha_voucher, rp.rp_referencia, rp.rp_importe_voucher, fc.fc_estatus, rp.id_empleado FROM orden_pago op INNER JOIN recibo_pago rp ON rp.id_orden_pago = op.id_folio_orden INNER JOIN factura fc ON rp.id_folio = fc.id_folio WHERE op.id_solicitud = '$solicitud'";
			    				$result_recibo = mysql_query($query);
			    				$row_recibo = mysql_fetch_array($result_recibo);
			    				if($row_recibo!=null){
			    					$atendio = mysql_fetch_array(mysql_query("SELECT em_nombres, em_apaterno, em_amaterno FROM empleado WHERE id_empleado = {$row_recibo['id_empleado']}"));
								 	?>
			    					<label>Recibo de Pago</label>
									<h5><label>Atendio: </label> <?=$atendio['em_nombres']?> <?=$atendio['em_apaterno']?> <?=$atendio['em_amaterno']?></h5>
			    					<table class='table'>
										<thead>
											<tr>
												<th>Fecha de Emisión</th>
												<th>Fecha de Voucher</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?=$row_recibo['rp_fecha_emision']?></td>
												<td><?=$row_recibo['rp_fecha_voucher']?></td>
											</tr>
										</tbody>
										<thead>
											<tr>
												<th>Referencia</th>
												<th>Importe del Voucher</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?=$row_recibo['rp_referencia']?></td>
												<td><b>$<?=round($row_recibo['rp_importe_voucher'],2)?></b></td>
											</tr>
										</tbody>
									</table>
						            <label>Factura</label>
						            <h5><?php if($row_recibo['fc_estatus'] == 0){ echo "En proceso";}else{echo "Enviada";}?></h5>
			    				<?php }?>
		            		</div>
		            	</div>
		            	<div class="panel panel-warning">
	                        <div class="panel-heading">
	            				<label>Datos del Cliente</label>
	            			</div>
		            		<div class="panel-body">
	            				<table class='table'>
	            					<thead>
	            						<tr>
	            							<th>Nombre del Cliente</th>
	            						</tr>
	            					</thead>
	            					<tbody>
	            						<tr>
	            							<td><?=$row['ct_nombre']?> <?=$row['ct_apaterno']?> <?=$row['ct_amaterno']?></td>
	            						</tr>
	            					</tbody>
	            				</table>
	            				<label>Dirección</label>
	            				<table class='table'>
	            					<thead>
	            						<tr>
	            							<th>Estado</th>
	            							<th>Municipio</th>
	            							<th>Código Postal</th>
	            					
	            							<th></th>
	            						</tr>
	            					</thead>
	            					<tbody>
	            						<tr>
	            							<td><?=$row['es_nombre']?></td>
	            							<td><?=$row['mp_nombre']?></td>
	            							<td><?=$row['cp_cod_pos']?></td>
	            						
	            							<td></td>
	            							<br/>
	            						</tr>
	            					</tbody>
	            					<thead>
	            						<tr>
	            							<th>Localidad</th>
	            							<th>Colonia</th>
	            							<th>Calle</th>
	            							<th>Número</th>
	            						</tr>
	            					</thead>
	            					<tbody>
	            						<tr>
	            							<td><?=$row['lc_nombre']?></td>
	            							<td><?=$row['cl_nombre']?></td>
	            							<td><?=$row['ct_calle']?></td>
	            							<td><?=$row['ct_numero']?></td>
	            						</tr>
	            					</tbody>
	            				</table>
		            		</div>
		            	</div>
            		</div>     
            		<div class="col-md-6 col-sm-6 col-xs-6">
            			<div class="panel panel-warning">
                        	<div class="panel-heading">
            					<label>Solicitud N° <?=$row['id_solicitud']?></label>
            				</div>
                        	<div class="panel-body">
								<p><?=$row['fr_nombre']?></p>
								<table class='table'>
									<tbody>
										<?php while ($row2 = mysql_fetch_array($result)):?>
											<tr>
												<td><?=$row2['dss_nombre']?></td>
												<td><?=$row2['valor_capturado']?></td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
								<?php $query = "SELECT rq.rq_nombre, rsv.rsv_cantidad FROM requisito_servicio rsv INNER JOIN requisito rq ON rsv.id_requisito = rq.id_requisito WHERE rsv.id_servicio = '$servicio'";
								$result = mysql_query($query, $dbConn);
								if ($result != null){ ?>
								<table class='table'>
									<thead>
										<tr>
											<th>Requisitos</th>
											<th>Cantidad</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while ($row_requisitos = mysql_fetch_array($result)):?>
											<tr>
												<td><?=$row_requisitos['rq_nombre']?></td>
												<td><?=$row_requisitos['rsv_cantidad']?></td>
											</tr>
										<?php endwhile;
										mysql_close($dbConn);
										}?>
									</tbody>
								</table>
								<?php if($row['s_estatus']=='ASESORIA'){?>
								<form action='solicitud_planos.php' method='POST'>
		        					<input type='hidden' value='<?=$solicitud?>' name='i'>
									<div class="input-group">
										<span class='form_group input-group-btn'>
											<button type='submit' class='btn btn-success'>
												<i class='glyphicon glyphicon-file'></i>
												Imprimir
											</button>
										</span>
										<label class='form-control'>Solicitud N° <?=$solicitud?></label>
									</div>
		        				</form>
	            				<?php }?>
							</div>
						</div>
            		</div>
            		<div class="col-md-6 col-sm-6 col-xs-6" align='right'>
    					<form action='menu.php'>
            				<input type='submit' value='Regresar al Menú' class="btn btn-negro">
            			</form>
        			</div>
            	</div>
        		<hr>
            	</div>
            </div>
		</div>
	</div>
	<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<!-- JQUERY SCRIPTS -->
	<script src="assets/js/jquery-1.10.2.js"></script>
	<!-- BOOTSTRAP SCRIPTS -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- METISMENU SCRIPTS -->
	<script src="assets/js/jquery.metisMenu.js"></script>
	<!-- MORRIS CHART SCRIPTS -->
	<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
	<script src="assets/js/morris/morris.js"></script>
	<!-- DATA TABLE SCRIPTS -->
	<script src="assets/js/dataTables/jquery.dataTables.js"></script>
	<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
	<script>
	$(document).ready(function () {
	    $('#dataTables-example').dataTable();
    });
	</script>
	<!-- CUSTOM SCRIPTS -->
	<script src="assets/js/custom.js"></script>
</body>
</html>