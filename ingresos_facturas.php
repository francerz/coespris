<?php
	session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
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
            	<?php
            	require_once("conexion.php");
            	$query = "SELECT ct.ct_nombre, ct.ct_apaterno, ct.ct_amaterno, s.id_solicitud, rp.rp_fecha_voucher, fc.fc_estatus
            	FROM solicitud s INNER JOIN orden_pago op ON s.id_solicitud = op.id_solicitud
            	INNER JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago
            	INNER JOIN factura fc ON rp.id_folio = fc.id_folio
            	INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente WHERE fc.fc_estatus = 0 ORDER BY ct.ct_nombre";
				$result = mysql_query($query,$dbConn);
				?>
            	<div class="row">
					<div class="col-md-12">
	                    <div class="panel-body">
	                    	<h3>Facturas <font color='#47a447'>Pendientes</font></h3>
	                    	<hr>
	                        <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th>N° Solicitud</th>
											<th>Cliente</th>
											<th>Fecha de Voucher</th>
											<th>Ver Detalle</th>
										</tr>
									</thead>
									<tbody>
										<?php while($row = mysql_fetch_array($result)):?>
										<tr class="gradeX">
											<td><?=$row['id_solicitud']?></td>
											<td><?=$row['ct_nombre']?> <?=$row['ct_apaterno']?> <?=$row['ct_amaterno']?></td>
											<td><?=$row['rp_fecha_voucher']?></td>
											<td><form method='post' action='solicitud_factura.php'>
												<input type='hidden' name='i' value='<?=$row['id_solicitud']?>'/>
												<input type='submit' value='Detalle' class='btn btn-morado'/>
											</form></td>
										</tr>
									<?php endwhile; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
        			<div class="col-md-12 col-sm-12 col-xs-12" align='right'>
        				<div class="panel-body">
	    					<form action='ingresos_menu.php'>
	            				<input type='submit' value='Regresar' class="btn btn-negro">
	            			</form>
	            		</div>
        			</div>
	        	</div>
				<hr>
				<?php
				$query = "SELECT ct.ct_nombre, ct.ct_apaterno, ct.ct_amaterno, s.id_solicitud, rp.rp_fecha_voucher, fc.fc_estatus
            	FROM solicitud s INNER JOIN orden_pago op ON s.id_solicitud = op.id_solicitud
            	INNER JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago
            	INNER JOIN factura fc ON rp.id_folio = fc.id_folio
            	INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente WHERE fc.fc_estatus = 1 ORDER BY fc.id_folio DESC LIMIT 10";
				$result = mysql_query($query,$dbConn);
				?>
            	<div class="row">
					<div class="col-md-12">
	                    <div class="panel-body">
	                    	<h3>Facturas <font color='#47a447'>Enviadas</font></h3>
	                    	<hr>
	                        <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th>N° Solicitud</th>
											<th>Cliente</th>
											<th>Fecha de Voucher</th>
											<th>Ver Detalle</th>
										</tr>
									</thead>
									<tbody>
										<?php while($row = mysql_fetch_array($result)):?>
										<tr class="gradeX">
											<td><?=$row['id_solicitud']?></td>
											<td><?=$row['ct_nombre']?> <?=$row['ct_apaterno']?> <?=$row['ct_amaterno']?></td>
											<td><?=$row['rp_fecha_voucher']?></td>
											<td><form method='post' action='solicitud_factura.php'>
												<input type='hidden' name='i' value='<?=$row['id_solicitud']?>'/>
												<input type='submit' value='Detalle' class='btn btn-primary'/>
											</form></td>
										</tr>
									<?php endwhile; mysql_close($dbConn);?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
        			<div class="col-md-12 col-sm-12 col-xs-12" align='right'>
        				<div class="panel-body">
	    					<form action='ingresos_menu.php'>
	            				<input type='submit' value='Regresar' class="btn btn-negro">
	            			</form>
	            		</div>
        			</div>
	        	</div>
	        	<hr>
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