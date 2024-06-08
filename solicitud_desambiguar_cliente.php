<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$servicio = $_POST['servicio'];
	$row = mysql_fetch_array(mysql_query("SELECT sr_nombre FROM servicio WHERE id_servicio = '$servicio'"));
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
					<div class="row" style='position:relative;'>
		            	<div class="col-md-12 col-sm-12 col-xs-12">
							<h3><font color='#47a447'>Servicio:</font> <?=$row['sr_nombre']?></h3>
							<hr>
							<table>
								<tbody>
									<tr>
									<form action='' method='POST'>
										<input type='hidden' name='servicio' value='<?=$servicio?>'/>
										<td WIDTH='50%'><h2><font color='#47a447'>Buscar cliente</font></h2></td>
		                        		<td>
		                        			<div class="input-group">
		                        				<input type='text' value='<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];}?>' class='form-control' name='nombre'>
												<span class='form_group input-group-btn'>
		                        					<button type='submit' name='buscar_nombre' class='btn btn-primary'>
														<i class='glyphicon glyphicon-search'></i>
													</button>
		                        				</span>
		                        			</div>
		                        		</td>
		                        	</form>
									</tr>
									<div class="col-md-2 col-sm-2 col-xs-2" style='position:absolute; bottom:5px; right:0px;'>
                    		<form method='POST' action='cliente_registrar.php'>
                    			<input type='hidden' name='s' value='<?=$servicio?>'/>
								<button type='submit' class="btn btn-success">Nuevo cliente</button>
							</form>
						</div>
								</tbody>
							</table>
						</div>
						
					</div>
					<?php if(isset($_POST['nombre'])&&$_POST['nombre']!=""&&$_POST['nombre']!=" "){
						$query = "SELECT ct.*, cl.cl_nombre FROM cliente ct LEFT JOIN colonia cl ON ct.id_colonia = cl.id_colonia WHERE concat(ct.ct_nombre,' ',ct.ct_apaterno,' ',ct.ct_amaterno) LIKE '%{$_POST['nombre']}%' ORDER BY ct.ct_nombre";
						$cliente = mysql_query($query,$dbConn);
						$row = mysql_fetch_array(mysql_query("SELECT sr_nombre FROM servicio WHERE id_servicio = '$servicio'",$dbConn));?>
						<form method='POST' action='cliente_detalle.php'>
							<input type='hidden' name='s' value='<?=$servicio?>'/>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
			                        <div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="dataTables-example">
											<thead>
											<tr>
												<th></th>
												<th>Nombre</th>
												<th>Dirección</th>
												<th>Colonia</th>
												<th>N° de Trámites</th>
											</tr>
											</thead>
											<tbody>
									<?php while ($row_cliente = mysql_fetch_array($cliente)):
											$id = $row_cliente['id_cliente'];
											$result = mysql_query("SELECT s.id_cliente FROM solicitud s WHERE '$id' = s.id_cliente");
											$total = mysql_num_rows($result);?>
											<tr class="gradeX">
												<td><input type='radio' id='cli_<?=$id?>' name='i' value='<?=$id?>' required/></td>
												<td><label for='cli_<?=$id?>'><?=$row_cliente['ct_nombre']?> <?=$row_cliente['ct_apaterno']?> <?=$row_cliente['ct_amaterno']?></label></td>
												<td><label for='cli_<?=$id?>'><?=$row_cliente['ct_calle']?> <?=$row_cliente['ct_numero']?></label></td>
												<td><label for='cli_<?=$id?>'><?=$row_cliente['cl_nombre']?></label></td>
												<td><label for='cli_<?=$id?>'><?=$total?></label></td>
											</tr>
									<?php endwhile;	mysql_close($dbConn);?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<input type='submit' class='btn btn-primary' value='Seleccionar Cliente'/>
								</div>
							</div>
						</form>
						<form action='solicitud_servicios.php'>
							<div class="col-md-6 col-sm-6 col-xs-6" align='right'>
								<input type='submit' class="btn btn-negro" value="Regresar">
							</div>
						</form>
					<?php }else{ ?>
						<form action='solicitud_servicios.php'>
							<div class="col-md-12 col-sm-12 col-xs-12" align='right'>
								<input type='submit' class="btn btn-negro" value="Regresar">
							</div>
						</form>
						<?php }?>
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