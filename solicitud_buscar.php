<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
    require_once("conexion.php");
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
				<div class="row">
					<div class='col-md-12'>
                        <h2>Buscar solicitud</h2>
					</div>
				</div>
				<div class="row">
					<form method='GET' action=''>
						<?php if(isset($_GET['nombre'])){
							$nombre=$_GET['nombre'];
						}else{
							$nombre='';
						}?>
						<div class="col-md-6">
							<h3>Nombre del cliente</h3>
							<div class="input-group">
								<input type='text' name='nombre' value='<?=$nombre?>' class='form-control'>
								<span class='form_group input-group-btn'>
									<button type='submit' name='buscar_nombre' class='btn btn-primary'>
										<i class='glyphicon glyphicon-search'></i>
									</button>
								</span>
							</div>
						</div>
					</form>
					<form method='GET' action=''>
						<?php if(isset($_GET['numero'])){
							$solicitud=$_GET['numero'];
						}else{
							$solicitud='';
						}?>
						<div class='col-md-6'>
							<h3>N√∫mero de la solicitud</h3>
							<div class="input-group">
								<input type='text' name='numero' value='<?=$solicitud?>' class='form-control'>
								<span class='form_group input-group-btn'>
									<button type='submit' name='buscar_numero' class='btn btn-primary'>
										<i class='glyphicon glyphicon-search'></i>
									</button>
								</span>
							</div>
						</div>
					</form>
				</div>
				<hr>
			<?php if(isset($_GET['nombre'])||isset($_GET['numero'])){
				require_once("conexion.php");
				if (isset($_GET['buscar_nombre'])||isset($_GET['filtro'])&&isset($_GET['nombre'])&&$_GET['nombre']!=""){
					$nombre = $_GET['nombre'];
					switch ($_SESSION['rol']) {
						case 'VENTANILLA':
							$query = "SELECT ct.*, cl.cl_nombre, cp.cp_cod_pos, s.s_estatus, s.id_solicitud, s.s_fecha, sr.sr_nombre FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente INNER JOIN colonia cl ON ct.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos WHERE concat(ct.ct_nombre,' ',ct.ct_apaterno,' ',ct.ct_amaterno) LIKE '%$nombre%' AND s.s_estatus = 'ASESORIA' || s.s_estatus = 'ORDEN PAGO' || s.s_estatus = 'FINALIZADO' || s.s_estatus = 'ENTREGADO'";
							break;
						case 'CONTADOR':
							$query = "SELECT ct.*, cl.cl_nombre, cp.cp_cod_pos, s.s_estatus, s.id_solicitud, s.s_fecha, sr.sr_nombre, fc.fc_estatus FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio INNER JOIN orden_pago op ON s.id_solicitud = op.id_solicitud INNER JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago INNER JOIN factura fc ON rp.id_folio = fc.id_folio INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente INNER JOIN colonia cl ON ct.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos WHERE concat(ct.ct_nombre,' ',ct.ct_apaterno,' ',ct.ct_amaterno) LIKE '%$nombre%' AND s.s_estatus = 'PAGADO' || s.s_estatus = 'FINALIZADO' || s.s_estatus = 'ENTREGADO'";
							break;
						case 'ADMINISTRADOR':
							$query = "SELECT ct.*, cl.cl_nombre, cp.cp_cod_pos, s.s_estatus, s.id_solicitud, s.s_fecha, sr.sr_nombre, fc.fc_estatus FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio LEFT JOIN orden_pago op ON s.id_solicitud = op.id_solicitud LEFT JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago LEFT JOIN factura fc ON rp.id_folio = fc.id_folio INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente INNER JOIN colonia cl ON ct.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos WHERE concat(ct.ct_nombre,' ',ct.ct_apaterno,' ',ct.ct_amaterno) LIKE '%$nombre%' AND (s.s_estatus = 'ASESORIA' || s.s_estatus = 'ORDEN PAGO' || s.s_estatus = 'FINALIZADO' || s.s_estatus = 'ENTREGADO' || s.s_estatus = 'PAGADO')";
							break;
						default:
							break;
					}
				}else{
					$numero = $_GET['numero'];
					switch ($_SESSION['rol']) {
						case 'VENTANILLA':
							$query = "SELECT ct.*, cl.cl_nombre, cp.cp_cod_pos, s.s_estatus, s.id_solicitud, s.s_fecha, sr.sr_nombre FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente INNER JOIN colonia cl ON ct.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos WHERE s.id_solicitud = '$numero' AND s.s_estatus = 'ASESORIA' || s.s_estatus = 'ORDEN PAGO' || s.s_estatus = 'FINALIZADO' || s.s_estatus = 'ENTREGADO'";
							break;
						case 'CONTADOR':
							$query = "SELECT ct.*, cl.cl_nombre, cp.cp_cod_pos, s.s_estatus, s.id_solicitud, s.s_fecha, sr.sr_nombre, fc.fc_estatus FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio INNER JOIN orden_pago op ON s.id_solicitud = op.id_solicitud INNER JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago INNER JOIN factura fc ON rp.id_folio = fc.id_folio INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente INNER JOIN colonia cl ON ct.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos WHERE s.id_solicitud = '$numero' AND s.s_estatus = 'PAGADO' || s.s_estatus = 'FINALIZADO' || s.s_estatus = 'ENTREGADO'";
							break;
						case 'ADMINISTRADOR':
							$query = "SELECT ct.*, cl.cl_nombre, cp.cp_cod_pos, s.s_estatus, s.id_solicitud, s.s_fecha, sr.sr_nombre, fc.fc_estatus FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio LEFT JOIN orden_pago op ON s.id_solicitud = op.id_solicitud LEFT JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago LEFT JOIN factura fc ON rp.id_folio = fc.id_folio INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente INNER JOIN colonia cl ON ct.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos WHERE s.id_solicitud = '$numero' AND (s.s_estatus = 'ASESORIA' || s.s_estatus = 'ORDEN PAGO' || s.s_estatus = 'FINALIZADO' || s.s_estatus = 'ENTREGADO' || s.s_estatus = 'PAGADO')";
							break;
						default:
							break;
					}
				}
				?>
				<div class="row">
					<div class="col-md-12">
					<form method='GET' action=''>
						<?php if($nombre!=''){?>
						<input type='hidden' name='nombre' value='<?=$nombre?>'>
						<?php } else{?>
						<input type='hidden' name='numero' value='<?=$numero?>'>
						<?php }?>
					<?php if($_SESSION['rol']!='CONTADOR'){ ?>	
						<div class="col-md-3">
							<div class="input-group">
								<span class='form_group input-group-btn'>
									<button class='btn btn-warning' name='filtro' value='1'>
										<i class='glyphicon'></i>
									</button>
								</span>
								<lavel class='form-control'>Generar orden de pago</lavel>
							</div>
						</div>
						<div class="col-md-3">
							<div class="input-group">
								<span class='form_group input-group-btn'>
									<button class='btn btn-info' name='filtro' value='2'>
										<i class='glyphicon'></i>
									</button>
								</span>
								<lavel class='form-control'>Generar recibo de pago</lavel>
							</div>
						</div>
					<?php } if($_SESSION['rol']=='ADMINISTRADOR'){ ?>
						<div class="col-md-3">
							<div class="input-group">
								<span class='form_group input-group-btn'>
									<button class='btn btn-success' name='filtro' value='3'>
										<i class='glyphicon'></i>
									</button>
								</span>
								<lavel class='form-control'>Generar autorizaci√≥n</lavel>
							</div>
						</div>
					<?php } if($_SESSION['rol']!='CONTADOR'){ ?>
						<div class="col-md-3">
							<div class="input-group">
								<span class='form_group input-group-btn'>
									<button class='btn btn-danger' name='filtro' value='4'>
										<i class='glyphicon'></i>
									</button>
								</span>
								<lavel class='form-control'>Confirmar entrega</lavel>
							</div>
						</div>
					<?php } if($_SESSION['rol']!='VENTANILLA'){ ?>
						<div class="col-md-3">
							<div class="input-group">
								<span class='form_group input-group-btn'>
									<button class='btn btn-morado' name='filtro' value='5'>
										<i class='glyphicon'></i>
									</button>
								</span>
								<lavel class='form-control'>Facturar</lavel>
							</div>
						</div>
						<div class="col-md-3">
							<div class="input-group">
								<span class='form_group input-group-btn'>
									<button class='btn btn-primary' name='filtro' value='6'>
										<i class='glyphicon'></i>
									</button>
								</span>
								<lavel class='form-control'>Facturado</lavel>
							</div>
						</div>
					<?php } if($_SESSION['rol']!='CONTADOR'){ ?>
						<div class="col-md-3">
							<div class="input-group">
								<span class='form_group input-group-btn'>
									<button class='btn btn-default' name='filtro' value='7'>
										<i class='glyphicon'></i>
									</button>
								</span>
								<lavel class='form-control'>Tr√°mite terminado</lavel>
							</div>
						</div>
					<?php } if(isset($_GET['filtro'])&&$_GET['filtro']!='8') { ?>
						<div class="col-md-3">
							<button class='btn btn-negro' name='filtro' value='8'>
								Restaurar Filtro
							</button>
						</div>
					<?php $query = "SELECT ct.*, cl.cl_nombre, cp.cp_cod_pos, s.s_estatus, s.id_solicitud, s.s_fecha, sr.sr_nombre, fc.fc_estatus FROM servicio sr INNER JOIN solicitud s ON sr.id_servicio = s.id_servicio INNER JOIN orden_pago op ON s.id_solicitud = op.id_solicitud INNER JOIN recibo_pago rp ON op.id_folio_orden = rp.id_orden_pago INNER JOIN factura fc ON rp.id_folio = fc.id_folio INNER JOIN cliente ct ON ct.id_cliente = s.id_cliente INNER JOIN colonia cl ON ct.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos WHERE concat(ct.ct_nombre,' ',ct.ct_apaterno,' ',ct.ct_amaterno) LIKE '%$nombre%'";
						switch ($_GET['filtro']){
							case '1':
								$query = $query." AND s.s_estatus = 'ASESORIA'";
								break;
							case '2':
								$query = $query." AND s.s_estatus = 'ORDEN PAGO'";
								break;
							case '3':
								$query = $query." AND s.s_estatus = 'PAGADO'";
								break;
							case '4':
								$query = $query." AND s.s_estatus = 'FINALIZADO'";
								break;
							case '5':
								$query = $query." AND fc.fc_estatus = '0'";
								break;
							case '6':
								$query = $query." AND fc.fc_estatus = '1'";
								break;
							case '7':
								$query = $query." AND s.s_estatus = 'ENTREGADO'";
								break;							
							default:
								break;
						}
					}
					$query = $query." ORDER BY ct.ct_nombre";
					$cliente = mysql_query($query,$dbConn);?>
					</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
	                    <div class="panel-body">
	                        <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
									<tr>
										<th>Nombre del cliente</th>
										<th>Direcci√≥n</th>
										<th>C√≥digo postal</th>
										<th>Servicio</th>
										<th>Folio</th>
										<th>Fecha</th>
										<th>Estatus</th>
										<th></th>
									</tr>
									</thead>
									<tbody>
							<?php while ($row_cliente = mysql_fetch_array($cliente)):
							$solicitud = $row_cliente['id_solicitud'];
							if($row_cliente['s_estatus']!='CANCELADO'){
							?>
								<tr class="gradeX">
									<td><label><?=$row_cliente['ct_nombre']?> <?=$row_cliente['ct_apaterno']?> <?=$row_cliente['ct_amaterno']?></label></td>
									<td><label><?=$row_cliente['ct_calle']?> <?=$row_cliente['ct_numero']?></label></td>
									<td><label><?=$row_cliente['cp_cod_pos']?></label></td>
									<td><label><?=$row_cliente['sr_nombre']?></label></td>
									<td><label><?=$solicitud?></label></td>
									<td><label><?=$row_cliente['s_fecha']?></label></td>
									<td><label>
										<?php if($_SESSION['rol']!='CONTADOR'){?>
											<?=$row_cliente['s_estatus']?>
										<?php } if(isset($row_cliente['fc_estatus'])&&$row_cliente['fc_estatus']=='0'&&$_SESSION['rol']!='VENTANILLA'){
											echo "<br>POR FACTURAR";
										}elseif(isset($row_cliente['fc_estatus'])&&$row_cliente['fc_estatus']=='1'&&$_SESSION['rol']!='VENTANILLA'){
											echo "<br>FACTURADO";
										}?></label></td>
									<td>
									<form method='GET'>
									<input type='hidden' name='i' value='<?=$solicitud?>'/>
									<?php switch ($row_cliente['s_estatus']) {
										case 'ASESORIA': ?>
											<input type='submit' value='Consultar Solicitud' formaction='solicitud_asesoria.php' class='btn btn-warning'/>
										<?php break;
										case 'ORDEN PAGO': ?>
											<input type='submit' value='Consultar Solicitud' formaction='solicitud_asesoria.php' class='btn btn-info'/>
										<?php break;
										case 'PAGADO':
											if($_SESSION['rol']!='CONTADOR'){?>
												<input type='submit' value='Consultar Solicitud' formaction = 'solicitud_asesoria.php' class='btn btn-success'/>
											<?php }if($_SESSION['rol']!='VENTANILLA'){
												if ($row_cliente['fc_estatus'] == '0') { ?>
													<input type='submit' value='Consultar Datos' formmethod="POST" formaction = 'solicitud_factura.php' class='btn btn-morado'/>
											<?php }else{ ?>
													<input type='submit' value='Consultar Datos' formmethod="POST" formaction = 'solicitud_factura.php' class='btn btn-primary'/>
										<?php 	}
											} break;
										case 'FINALIZADO':
											if($_SESSION['rol']!='CONTADOR'){?>
												<input type='submit' value='Consultar Solicitud' formaction = 'solicitud_asesoria.php' class='btn btn-danger'/>
											<?php }if($_SESSION['rol']!='VENTANILLA'){
												if ($row_cliente['fc_estatus'] == '0') { ?>
													<input type='submit' value='Consultar Datos' formmethod="POST" formaction = 'solicitud_factura.php' class='btn btn-morado'/>
											<?php }else{ ?>
													<input type='submit' value='Consultar Datos' formmethod="POST" formaction = 'solicitud_factura.php' class='btn btn-primary'/>
										<?php 	}
											} break;
										case 'ENTREGADO':?>
										<?php
											if ($_SESSION['rol']!='CONTADOR') { ?>
												<input type='submit' value='Consultar Solicitud' formaction = 'solicitud_asesoria.php' class='btn btn-default'/>
											<?php }if($_SESSION['rol']!='VENTANILLA'){
												if ($row_cliente['fc_estatus'] == '0') { ?>
													<input type='submit' value='Consultar Datos' formmethod="POST" formaction = 'solicitud_factura.php' class='btn btn-morado'/>
											<?php }else{ ?>
													<input type='submit' value='Consultar Datos' formmethod="POST" formaction = 'solicitud_factura.php' class='btn btn-primary'/>
										<?php 	}
											} break;
										default:
											echo ":( ERROR ):";
											break;
										}?>
									</form>
									</td>
								</tr>
							<?php }
							endwhile ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<hr>
			<?php mysql_close($dbConn); }?>
				<div class='row'>
					<div class="col-md-12 col-sm-12 col-xs-12" align='right'>
    					<form action='menu.php'>
            				<input type='submit' value='Regresar' class="btn btn-negro">
            			</form>
        			</div>
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
	<script srﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂﬂ