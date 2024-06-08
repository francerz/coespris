<?php
	session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
	require_once("conexion.php");
	if (isset($_POST['s'])) {
		$servicio = $_POST['s'];
	}
	$cliente = $_POST['i'];
	//Cliente
	$query = "SELECT ct.ct_nombre, ct.ct_apaterno, ct.ct_amaterno, ct.ct_calle, ct.ct_numero, cp.cp_cod_pos, cl.cl_nombre,
	lc.lc_nombre, mp.mp_nombre, es.es_nombre FROM cliente ct
	INNER JOIN colonia cl ON ct.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cp.id_cod_pos = cl.id_cod_pos
	INNER JOIN localidad lc ON lc.id_localidad = cl.id_localidad INNER JOIN municipio mp ON lc.id_municipio = mp.id_municipio
	INNER JOIN estado es ON mp.id_estado = es.id_estado WHERE ct.id_cliente = '$cliente'";
	$result = mysql_query($query);
	$row_ct = mysql_fetch_array($result);
	//Datos Fiscales
	$query = "SELECT df.df_rfc, df.df_razon_social, df.df_calle, df.df_numero, df.correo_electronico, cp.cp_cod_pos, cl.cl_nombre, lc.lc_nombre,
	mp.mp_nombre, es.es_nombre FROM datos_fiscales df INNER JOIN colonia cl ON df.id_colonia = cl.id_colonia
	INNER JOIN codigo_postal cp ON cp.id_cod_pos = cl.id_cod_pos INNER JOIN localidad lc ON lc.id_localidad = cl.id_localidad
	INNER JOIN municipio mp ON lc.id_municipio = mp.id_municipio INNER JOIN estado es ON mp.id_estado = es.id_estado
	WHERE df.id_cliente = '$cliente'";
	$result = mysql_query($query);
	$row_df = mysql_fetch_array($result);
	//Solicitudes
	$query = "SELECT s.id_solicitud, s.s_fecha, s.s_cantidad, s.s_estatus, sr.sr_nombre FROM solicitud s
	INNER JOIN servicio sr ON s.id_servicio = sr.id_servicio WHERE s.id_cliente = '$cliente'";
	$result = mysql_query($query);

	if (isset($_POST['regresar_a'])) {
		$regresar_a = $_POST['regresar_a'];
	}elseif(strpos($_SERVER['HTTP_REFERER'],'solicitud_desambiguar_cliente.php') !== false){
	    $regresar_a = 'solicitud_desambiguar_cliente.php';
	}else{
		$regresar_a = 'cliente_general.php';
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
	            <div class="panel-body">
	        		<div class="row">
	        		<form method = 'POST' action='cliente_modificar.php'>
	        			<input type = 'hidden' value='<?=$cliente?>' name = 'i'>
	        			<input type = 'hidden' value='<?=$servicio?>' name = 's'>
	        			<input type = 'hidden' value='<?=$regresar_a?>' name = 'regresar_a'>
	            		<div class="col-md-6 col-sm-6 col-xs-6">
	            			<div class="panel panel-default">
		                        <div class="panel-heading">
		            				<button type='submit' class='btn btn-default btn-circle'><i class="glyphicon glyphicon-pencil"></i></button>
		            				Datos del Cliente
		            			</div>
			            		<div class="panel-body">
			            			<h4>Nombre del cliente</h4>
			            			<label><?php echo $row_ct['ct_nombre']." ".$row_ct['ct_apaterno']." ".$row_ct['ct_amaterno'];?></label>
			            			<h4>Dirección</h4>
			            			<table class="table">
			            				<tr>
											<td><label>Estado: </label> <?=$row_ct['es_nombre']?></td>
											<td><label>Municipio: </label> <?=$row_ct['mp_nombre']?></td>
										</tr>
										<tr>
											<td><label>Colonia: </label> <?=$row_ct['cl_nombre']?></td>
											<td><label>Localidad: </label> <?=$row_ct['lc_nombre']?></td>
					            		</tr>
										<tr>
					            			<td><label>Número: </label> <?=$row_ct['ct_numero']?></td>
					            			<td><label>Calle: </label> <?=$row_ct['ct_calle']?></td>
					            		</tr>
										<tr>
					            			<td><label>Código postal: </label> <?=$row_ct['cp_cod_pos']?></td>
					            			
					            			<td></td>
					            		</tr>
									</table>
			            		</div>
			            	</div>
	            		</div>
	            		<div class="col-md-6 col-sm-6 col-xs-6">
	            			<div class="panel panel-info">
		                        <div class="panel-heading">
		            				<button type='submit' class='btn btn-default btn-circle'><i class="glyphicon glyphicon-pencil"></i></button>
		            				Datos Fiscales
		            			</div>
			            		<div class="panel-body">
			            			<table class="table">
			            				<thead>
			            					<th><h4>Razón Social</h4></th>
			            					<th><h4>RFC</h4></th>
			            				</thead>
			            				<tbody>
					            			<td><label><?=$row_df['df_razon_social']?></label></td>
					            			<td><label><?=$row_df['df_rfc']?></label></td>
				            			</tbody>
				            		</table>
			            			<h4>Dirección</h4>
			            			<table class="table">
			            				<tr>
											<td><label>Estado: </label> <?=$row_df['es_nombre']?></td>
											<td><label>Municipio: </label> <?=$row_df['mp_nombre']?></td>
										</tr>
										<tr>
											<td><label>Colonia: </label> <?=$row_df['cl_nombre']?></td>
											<td><label>Localidad: </label> <?=$row_df['lc_nombre']?></td>
					            		</tr>
										<tr>
					            			<td><label>Número: </label> <?=$row_df['df_numero']?></td>
					            			<td><label>Calle: </label> <?=$row_df['df_calle']?></td>
					            		</tr>
										<tr>
					            			<td><label>Código postal: </label> <?=$row_df['cp_cod_pos']?></td>
					            			<td><label>Correo electrónico: </label> <?=$row_df['correo_electronico']?></td>
					            			<td></td>
					            		</tr>
									</table>
			            		</div>
			            	</div>
	            		</div>
					</form>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-6 col-sm-6 col-xs-6" align='right'>
	            			<?php if ($regresar_a == 'solicitud_desambiguar_cliente.php') {?>
		            		<form action='solicitud_registrar.php' method='POST'>
		            			<input type='hidden' value='<?=$servicio?>' name='s'>
		            			<input type='hidden' value='<?=$cliente?>' name='i'>
					          	<input class="btn btn-success" type='submit' value='Continuar'/>
					        </form>
					        <?php }?>
					    </div>
					    <div class="col-md-6 col-sm-6 col-xs-6">
		            		<form action='<?=$regresar_a?>' method='POST'>
		            			<input type='hidden' value='<?=$servicio?>' name='servicio'>
		            			<div align="right">
					          	<input class="btn btn-negro" type='submit' value='Regresar'/>
					            </div>
					        </form>
					    </div>
	            	</div>
	            	<hr>
	            	<div class="row">
	            		<div class="col-md-12 col-sm-12 col-xs-12">
	            			<h3>Histórico de Solicitudes</h3>
	            			<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
									<tr>
										<th>Folio</th>
										<th>Servicio</th>
										<th>Cantidad</th>
										<th>Fecha</th>
										<th>Estatus</th>
									</tr>
									</thead>
									<tbody>
							<?php while ($row = mysql_fetch_array($result)):?>
									<tr class="gradeX">
										<td><label for='sol_<?=$row['id_solicitud']?>'><?=$row['id_solicitud']?></label></td>
										<td><label for='sol_<?=$row['id_solicitud']?>'><?=$row['sr_nombre']?></label></td>
										<td><label for='sol_<?=$row['id_solicitud']?>'><?=$row['s_cantidad']?></label></td>
										<td><label for='sol_<?=$row['id_solicitud']?>'><?=$row['s_fecha']?></label></td>
										<td><label for='sol_<?=$row['id_solicitud']?>'><?=$row['s_estatus']?></label></td>
									</tr>
							<?php endwhile;	mysql_close($dbConn);?>
									</tbody>
								</table>
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