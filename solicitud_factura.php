<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$solicitud = $_POST['i'];
	if (isset($_POST['confirmacion'])) {
		mysql_query("UPDATE factura SET fc_estatus = 1 WHERE id_factura = {$_POST['id_factura']}");
		header("Location: {$_POST['anterior']}");
	}elseif (isset($_POST['restaurar'])) {
		mysql_query("UPDATE factura SET fc_estatus = 0 WHERE id_factura = {$_POST['id_factura']}");
		header("Location: {$_POST['anterior']}");
	}
	$result = mysql_query("SELECT rp.rp_fecha_emision, rp.rp_fecha_voucher, rp.rp_referencia, rp.rp_importe_voucher,
	sr.sr_nombre, df.df_rfc, df.df_razon_social, df.df_calle, df.df_numero, df.correo_electronico ,cl.cl_nombre, ct.ct_nombre, ct.ct_apaterno,
	ct.ct_amaterno, fc.fc_estatus, fc.id_factura, cp.cp_cod_pos, lc.lc_nombre, mp.mp_nombre, es.es_nombre
	FROM solicitud s INNER JOIN orden_pago op ON s.id_solicitud = op.id_solicitud
	INNER JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago INNER JOIN factura fc ON rp.id_folio = fc.id_folio
	INNER JOIN cliente ct ON s.id_cliente = ct.id_cliente INNER JOIN datos_fiscales df ON ct.id_cliente = df.id_cliente
	INNER JOIN colonia cl ON df.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos
	INNER JOIN localidad lc ON cl.id_localidad = lc.id_localidad INNER JOIN servicio sr ON s.id_servicio = sr.id_servicio 
	INNER JOIN municipio mp ON lc.id_municipio = mp.id_municipio INNER JOIN estado es ON mp.id_estado = es.id_estado
	WHERE s.id_solicitud = '$solicitud'");
	$row = mysql_fetch_array($result);
	mysql_close($dbConn);
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
	        				<h2>Datos de Factura</h2>
	        				<table class='table'>
	    						<thead>
	    							<tr>
    									<th>Servicio</th>
    								</tr>
    							</thead>
    							<tbody>
    								<tr>
    									<td><?=$row['sr_nombre']?></td>
    								</tr>
    							</thead>
							</table>
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
    							</thead>
							</table>
	        			</div>
	            		<div class="col-md-6 col-sm-6 col-xs-6">
	            			<div class="panel panel-default">
		                        <div class="panel-heading">
		                            Datos del Recibo de Pago
		                        </div>
	            				<div class="panel-body">
			    					<table class='table'>
			    						<thead>
			    							<tr>
			    								<th>Fecha de Emisión</th>
							        			<th>Fecha de Voucher</th>
							        		</tr>
							        	</thead>
			    						<tbody>
			    							<tr>
			    								<td><?=$row['rp_fecha_emision']?></td>
												<td><?=$row['rp_fecha_voucher']?></td>
											</tr>
										</tbody>
									</table>
									<table class='table'>
										<thead>
							        		<tr>
							        			<th>Referencia</th>
							        			<th>Importe del Voucher</th>
			    							</tr>
			    						</thead>
			    						<tbody>
			    							<tr>
						            			<td><?=$row['rp_referencia']?></td>
						            			<td><b>$<?=round($row['rp_importe_voucher'],2)?></b></td>
			    							</tr>
			    						</tbody>
			    					</table>
			            		</div>
			            	</div>
	            		</div>     
	            		<div class="col-md-6 col-sm-6 col-xs-6">
	            			<div class="panel panel-info">
	                        	<div class="panel-heading">
	            					Datos Fiscales
	            				</div>
	                        	<div class="panel-body">
									<table class='table'>
										<thead>
							        		<tr>
							        			<th>Razón Social</th>
							        			<th>RFC</th>
			    							</tr>
			    						</thead>
			    						<tbody>
						            			<td><?=$row['df_razon_social']?></td>
						            			<td><?=$row['df_rfc']?></td>
			    							</tr>
			    						</tbody>
										<thead>
							        		<tr>
							        			<th>Estado</th>
							        			<th>Correo electrónico</th>
			    							</tr>
			    						</thead>
			    						<tbody>
						            			<td><?=$row['es_nombre']?></td>
						            			<td><?=$row['correo_electronico']?></td>
			    							</tr>
			    						</tbody>
									</table>
									<table class='table'>
			    						<thead>
							        		<tr>
							        			<th>Calle</th>
							        			<th>Número</th>
							        			<th>Colonia</th>
			    							</tr>
			    						</thead>
			    						<tbody>
						            			<td><?=$row['df_calle']?></td>
						            			<td><?=$row['df_numero']?></td>
						            			<td><?=$row['cl_nombre']?></td>
			    							</tr>
			    						</tbody>
			    						<thead>
							        		<tr>
							        			<th>Municipio</th>
							        			<th>Localidad</th>
							        			<th>Código Postal</th>
			    							</tr>
			    						</thead>
			    						<tbody>
			    								<td><?=$row['mp_nombre']?></td>
			    								<td><?=$row['lc_nombre']?></td>
						            			<td><?=$row['cp_cod_pos']?></td>
			    							</tr>
			    						</tbody>
			    					</table>
								</div>
							</div>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6 col-sm-6 col-xs-6" align='right'>
	    					<form action='' method='post'>
	    						<input name='anterior' value='<?=$_SERVER['HTTP_REFERER']?>' type='hidden'>
	    						<input name='i' value='<?=$solicitud?>' type='hidden'>
	    						<input name='id_factura' value='<?=$row['id_factura']?>' type='hidden'>
	    						<?php
	    						if($row['fc_estatus']==0){ ?>
	            					<button type='submit' name='confirmacion' class="btn btn-morado"><i class='fa fa-check-circle'></i> Confirmar Factura</button>
	            				<?php }else{ ?>
	            					<button type='submit' name='restaurar' class="btn btn-primary"><i class='fa fa-mail-reply'></i> Restaurar Estatus</button>
	            				<?php } ?>
	            			</form>
	        			</div>
	        			<div align="right">
	        			<div class="col-md-6 col-sm-6 col-xs-6">
	    					<form action='<?=$_SERVER['HTTP_REFERER']?>'>
	            				<input type='submit' value='Regresar' class="btn btn-negro">
	            			</form>
	        			</div>
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