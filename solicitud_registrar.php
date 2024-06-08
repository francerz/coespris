<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	if (isset($_GET['i'])) {
		//Datos cliente
		$id_cliente = $_GET['i'];
		//Servicio
		$servicio = $_GET['s'];
	}else{
		//Datos cliente
		$id_cliente = $_POST['i'];
		//Servicio
		$servicio = $_POST['s'];
	}
	$query = "SELECT sr.sr_nombre, sr.sr_cant_sal_min, sr.sr_tipo FROM servicio sr WHERE sr.id_servicio = '$servicio'";
	$result = mysql_query($query, $dbConn);
	$sr = mysql_fetch_array($result);
	$query = "SELECT ct.ct_nombre,ct.ct_apaterno,ct.ct_amaterno FROM cliente ct WHERE ct.id_cliente = '$id_cliente'";
	$result = mysql_query($query,$dbConn);
	$datos_cliente = mysql_fetch_array($result);
	//formatos
	$query = "SELECT fr_ruta FROM servicio INNER JOIN formato ON id_formato_solicitud = id_formato WHERE id_servicio = '$servicio'";
	$result = mysql_query($query,$dbConn);
	$formato = mysql_fetch_array($result);
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
		            		<h3><font color='#F00'>Servicio: </font><?=$sr['sr_nombre']?></h3>
	            		</div>
		            </div>
		            <hr>
		            <?php
					$query = "SELECT ds.* FROM dss_servicio dss INNER JOIN datos_secundarios_solicitud ds ON dss.id_dat_sec_sol = ds.id_dat_sec_sol WHERE dss.id_servicio = '$servicio'";
					$result2 = mysql_query($query,$dbConn);
					$tab = 0;
					$cont = 0;
					//IMPORTE
					$query = "SELECT sm.sm_importe FROM salario_minimo sm WHERE sm.vigente = 1";
					$result = mysql_query($query, $dbConn);
					$row = mysql_fetch_array($result);
					$total = $sr['sr_cant_sal_min'] * $row['sm_importe'];?>
		            <div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<h4><font color='#47a447'>CLIENTE: </font><?=$datos_cliente['ct_nombre']?> <?=$datos_cliente['ct_apaterno']?> <?=$datos_cliente['ct_amaterno']?></h4>
							<?php
							$query = "SELECT rq.rq_nombre, rsv.rsv_cantidad FROM requisito_servicio rsv INNER JOIN requisito rq ON rsv.id_requisito = rq.id_requisito WHERE rsv.id_servicio = '$servicio'";
							$result = mysql_query($query, $dbConn);
							if ($result != null){ ?>
							<table class='table'>
								<thead>
									<tr>
										<th><h4>Requisitos</h4></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php while ($row_requisitos = mysql_fetch_array($result)):?>
									<tr>
										<td><?=$row_requisitos['rq_nombre']?></td>
										<td>Cantidad: <?=$row_requisitos['rsv_cantidad']?></td>
									</tr>
									<?php endwhile;?>
								</tbody>
							</table>
							<?php }?>
							<form action='<?=$formato['fr_ruta']?>' method='POST'>
								<div class="input-group">
									<label class='form-control'>Formato de Solicitud</label>
									<span class='form_group input-group-btn'>
										<button type='submit' class='btn btn-success'>
											<i class='glyphicon glyphicon-file'></i>
											Imprimir
										</button>
									</span>
								</div>
	        				</form>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<table class='table'>
								<thead>
									<tr>
										<th width = '50%'><h4>Datos del Servicio</h4></th>
										<th width = '50%'></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Salarios minimos:</td>
										<td><?=$sr['sr_cant_sal_min']?></td>
									</tr>
									<tr>
										<td>Costo total:</td>
										<td><b>$<?=round($total,2)?></b><?php if($servicio == 7||$servicio == 8||$servicio == 9){echo " por metro";}?></td>
									</tr>
								</tbody>
							</table>
							<div align='right'>
								<form method='POST' action='solicitud_desambiguar_cliente.php'>
									<input name='servicio' type='hidden' value='<?=$servicio?>'/>
						          	<input class="btn btn-negro" type='submit' value='Regresar'>
						        </form>
					        </div>
						</div>
					</div>
					<form role="form" method='POST' action='solicitud_insertar.php'>
					<div class="row">
						<input name='cliente' type='hidden' value='<?=$id_cliente?>'/>
						<input name='servicio' type='hidden' value='<?=$servicio?>'/>
						<input type='hidden' name='oficina' value='<?=$_SESSION['oficina']?>'/>
						<input type='hidden' name='empleado' value='<?=$_SESSION['empleado']?>'/>
						<div class="col-md-12 col-sm-12 col-xs-12">
						<table class='table'>
						<thead>
							<tr>
								<th width = '33.33%'><h3><font color='#47a447'>Capturar Datos</font></h3></th>
								<th width = '33.33%' style="text-align:right">CANTIDAD:</th>
								<th width = '33.33%'><?php if($sr['sr_tipo'] != 'curso'){?>
									<input class="form-control" name='cantidad' type='number' value='1' readonly/>
								<?php }else{?>
									<input class="form-control" name='cantidad' type='number' required value='1' maxlength='6' pattern='[0-9]{6}'/>
								<?php }?></th>
							</tr>
						</thead>
						<tbody>
							<?php while ($row = mysql_fetch_array($result2)):
								if($tab == 0){echo "<tr>";}
								if ($row['dss_extras'] =='required') {$required = 'required';}else{$required='';}
								if ($row['dss_extras'] != 'total'){
									echo "<td>";
									switch ($row['dss_tipo_dato']) {
										case 'fecha':
											echo "<input type='hidden' value='{$row['id_dat_sec_sol']}' name='dato_sec_{$cont}'/><label for='{$row['id_dat_sec_sol']}'>{$row['dss_nombre']}</label><input id='{$row['id_dat_sec_sol']}' name='dat_{$cont}' type='date' {$required}/>";
											break;
										case 'texto':
											echo "<input type='hidden' value='{$row['id_dat_sec_sol']}' name='dato_sec_{$cont}'/><label for='{$row['id_dat_sec_sol']}'>{$row['dss_nombre']}</label><input class='form-control' id='{$row['id_dat_sec_sol']}' name='dat_{$cont}' type='text' {$required}/>";
											break;
										case 'boolean':
											echo "<div class='checkbox'><input type='hidden' value='{$row['id_dat_sec_sol']}' name='dato_sec_{$cont}'/><label for='{$row['id_dat_sec_sol']}'>{$row['dss_nombre']}</label><input type='checkbox' id='{$row['id_dat_sec_sol']}' name='dat_{$cont}' type='checkbox'/></div>";
											break;
										case 'int':
											echo "<input type='hidden' value='{$row['id_dat_sec_sol']}' name='dato_sec_{$cont}'/><label for='{$row['id_dat_sec_sol']}'>{$row['dss_nombre']}</label><input min='0' class='form-control' id='{$row['id_dat_sec_sol']}' name='dat_{$cont}' type='number' {$required}/>";
											break;
										case 'radio':
											echo "<input type='hidden' value='{$row['id_dat_sec_sol']}' name='dato_sec_{$cont}'/><label for='{$row['id_dat_sec_sol']}'>{$row['dss_nombre']}</label><br>";
											$temporal = explode(";", $row['dss_extras']);
											$tam = sizeof($temporal)-1;
											for ($i=0; $i < $tam; $i++){
												$val = $temporal[$i];
												switch ($row['id_dat_sec_sol']){
													case 42:
														if ($i==0) {
															echo "<input onclick = 'deshabilita()' name='dat_{$cont}' type='radio' value='{$val}' id='{$row['id_dat_sec_sol']}' required/>{$val}<br>";
														}else{
															echo "<input checked onclick = 'habilita()' name='dat_{$cont}' type='radio' value='{$val}' id='{$row['id_dat_sec_sol']}' required/>{$val}<br>";
														}break;
													default:
														echo "<input name='dat_{$cont}' type='radio' value='{$val}' id='{$row['id_dat_sec_sol']}' required/>{$val}<br>";
														break;
												}
											}?>
											<script language="JavaScript">
												function habilita(){
													document.getElementById('43').disabled = false;
												}
							 					function deshabilita(){
							 						document.getElementById('43').disabled = true;
												}
											</script>
											<?php
											break;
										case 'lista':
											echo "<input type='hidden' value='{$row['id_dat_sec_sol']}' name='dato_sec_{$cont}'/><label>{$row['dss_nombre']}</label>";
											$tabla = $row['dss_extras'];
											switch ($tabla) {
												case 'empleado':
													$puesto = $row['dss_nombre'];
													$query = "SELECT em.em_nombres FROM empleado em INNER JOIN puesto pu ON em.id_puesto = pu.id_puesto WHERE pu.pu_nombre LIKE '%$puesto%'";
													$result = mysql_query($query);
													echo "<select name='dat_{$cont}' class='form-control' {$required}>";
													while ($row2 = mysql_fetch_array($result)){
														echo "<option value='{$row2['em_nombres']}'>{$row2['em_nombres']}</option>";
													}
													echo "</select>";
													break;
												case 'municipio':
													$query = "SELECT * FROM municipio";
													$result = mysql_query($query);
													echo "<select name='dat_{$cont}' class='form-control' {$required}>";
													while ($row2 = mysql_fetch_array($result)){
														echo "<option value='{$row2['mp_nombre']}'>{$row2['mp_nombre']}</option>";
													}
													echo "</select>";
													break;
												default:
												echo "ERROR";
													break;
											}
											break;
										default:
											break;
									}
									echo("</td>");
								}else {
									$tab--;
									echo "<input type='hidden' value='{$row['id_dat_sec_sol']}' name='dato_sec_{$cont}'/><input name='dat_{$cont}' type='hidden' value='total'/>";
								}
								$cont++;
								if($tab == 2){echo "</tr>"; $tab = 0;}
								else{$tab++;}
							endwhile;
							mysql_close($dbConn);?>
						</tbody>
						</table>
						<input type='hidden' value='<?=$cont?>' name='datos_sec'/>
						<div align='right'>
							<input type="submit" class='btn btn-success' value="Guardar Solicitud"/>
						</div>
					</div>
					<hr>
			</div>
			</form>
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