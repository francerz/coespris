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
    			<?php switch ($row['s_estatus']) {
    			case 'ASESORIA':
    				//Datos de Cuenta
    				$query = "SELECT cn.id_cuenta, cn.cn_razon_social_banco, cn.cn_cuentahabiente, cn.cn_numero_cuenta, cn.cn_clabe FROM solicitud sl INNER JOIN oficina of ON sl.id_oficina=of.id_oficina INNER JOIN cuenta cn ON of.id_cuenta=cn.id_cuenta WHERE sl.id_solicitud='$solicitud'";
					$result_cuenta = mysql_query($query);
					$row_cuenta = mysql_fetch_array($result_cuenta);
					$cuenta = $row_cuenta['id_cuenta'];
					//Requisitos del Servicio
					$query= "SELECT rq.rq_nombre, rq.id_requisito, rs.rsv_cantidad FROM solicitud s INNER JOIN servicio sr ON s.id_servicio = sr.id_servicio INNER JOIN requisito_servicio rs ON sr.id_servicio = rs.id_servicio INNER JOIN requisito rq ON rs.id_requisito = rq.id_requisito WHERE s.id_solicitud = '$solicitud'";
					$result_requisitos = mysql_query($query);?>
    				<div class='row'>
	    				<div class="col-md-7 col-sm-6 col-xs-6">
		        			<div class="panel panel-default">
		        				<div class="panel-heading">
		                            <label>Generar orden pago</label>
		                        </div>
		        				<div class="panel-body">
		        					<div class="table-responsive">
		        					<form action='orden_pago_insertar.php' target='_blank' method ='POST'>
		        						<input value = '<?=$solicitud?>' type = 'hidden' name = 'solicitud'>
		        						<input value = '<?=$cuenta?>' type = 'hidden' name = 'cuenta'>
		        						<input value = '<?=$servicio?>' type = 'hidden' name = 'servicio'>
		        						<table class="table">
		        							<thead>
		        								<tr>
		            								<th>Requisito</th>
		            								<th>Cantidad</th>
		            								<th>Recibido</th>
		            							</tr>
		        							</thead>
		        							<tbody>
		        								<?php $cont = 0;
		        								while($row_requisitos = mysql_fetch_array($result_requisitos)):
		        								echo "<tr>";
		        									echo "<input value = '{$row_requisitos['id_requisito']}' type = 'hidden' name = 'requisito_{$cont}'>";
		        									echo "<td>{$row_requisitos['rq_nombre']}</td>";
		        									echo "<td align='right'>{$row_requisitos['rsv_cantidad']}</td>";
		        									echo "<td><input min = '{$row_requisitos['rsv_cantidad']}' required type = 'number' name = 'cantidad_{$cont}' placeholder = 'Ingrese la cantidad'></td>";
		        								echo "</tr>";
		        								$cont++;
		        								endwhile;
		        								$cont--;?>
		        								<input value = '<?=$cont?>' type = 'hidden' name = 'cont'>
		        							</tbody>
		        						</table>
			            				<input type='submit' id='orden' value='Generar Orden' class="btn btn-warning">
			            			</form>
			            			</div>
			            			<br>
			            		</div>
			            	</div>
			            </div>
	    				<div class="col-md-5 col-sm-6 col-xs-6">            			
	            			<div class="panel panel-default">
	    						<div class="panel-heading">
		                            <label>Datos de la Cuenta</label>
		                        </div>
	            				<div class="panel-body">
	            					<div class="alert alert-warning">
		            					<h4>Razón Social del Banco:</h4>
					            		<h5><?=$row_cuenta['cn_razon_social_banco']?></h5>
					            		<h4>Número de Cuentahabiente:</h4>
				            			<h5><?=$row_cuenta['cn_cuentahabiente']?></h5>
				            			<h4>Número de Cuenta:</h4>
				            			<h5><?=$row_cuenta['cn_numero_cuenta']?></h5>
				            			<h4>CLABE:</h4>
				            			<h5><?=$row_cuenta['cn_clabe']?></h5>
			            			</div>
			            		</div>
	    					</div>
	    				</div>
    				</div>
    				<div class="row">
	            		<div align='right' class="col-md-7 col-sm-6 col-xs-6">
	    					<form action='menu.php'>
	            				<input  type='submit' value='Regresar' class="btn btn-negro">
	            			</form>
	        			</div>
	        			<div class="col-md-5 col-sm-5 col-xs-5">
	        			</div>
	        		</div>
	        		<hr>
    				<?php break;
    			case 'ORDEN PAGO':
    				//Orden de Pago
    				$query = "SELECT * FROM orden_pago where id_solicitud = '$solicitud'";
    				$result_orden = mysql_query($query);
					$row_orden = mysql_fetch_array($result_orden);
    				//Formato
				    $query = "SELECT fr.id_formato, sr.sr_nombre FROM solicitud s INNER JOIN servicio sr ON s.id_servicio = sr.id_servicio INNER JOIN formato fr ON sr.id_formato_recibo = fr.id_formato WHERE s.id_solicitud = '$solicitud'";
					$result_orden = mysql_query($query);
					$row_formato = mysql_fetch_array($result_orden);
					//Autorizo
					$result_autorizo = mysql_query("SELECT id_empleado, em_nombres, em_apaterno, em_amaterno FROM empleado WHERE id_puesto = 6");?>
					<div class="row">
				        <div class="col-md-7 col-sm-6 col-xs-6">
				        	<div class = "form-group">
				            	<div class="panel panel-default">
				               		<div class="panel-heading">
				            			<label>Recibo Pago</label>
				            		</div>
				                	<div class="panel-body">
					                  	<form method="POST" role="form" target='_blank' action="recibo_pago_insertar.php">
					                    	<input type='hidden' name='i' value='<?=$solicitud?>'>
					                    	<input type='hidden' name='servicio' value='<?=$servicio?>'>
					                    	<input type='hidden' name='orden_pago' value='<?=$row_orden['id_folio_orden']?>'>
					                    	<input type='hidden' name='formato' value='<?=$row_formato['id_formato']?>'>
									        <h3>Fecha de Voucher</h3>
									        <input class="form-control" type="date" value='<?=date('Y-m-d')?>' max='<?=date('Y-m-d')?>' name="voucher" required placeholder="aaaa-mm-dd"/>
									        <h3>Referencia</h3>
									        <input class="form-control" type="text" required name="referencia" required placeholder="Referencia"/>
									        <h3>Importe Voucher</h3>
					                    	<div class="form-group input-group">
									              <span class="input-group-addon">$</span><input step="any" value='<?=round($row_orden['op_total'])?>' required class="form-control" type="number" name="importe" placeholder="Importe del Voucher"/>
					                    	</div>
					                    	<h3>Autorizó</h3>
					                    	<?php $autorizo = mysql_fetch_array($result_autorizo);?>
					                    	<input class="form-control" name='autorizo' type='text' value='<?=$autorizo['em_nombres']?> <?=$autorizo['em_apaterno']?> <?=$autorizo['em_amaterno']?>' readonly>
					                    	<div class="form-group input-group">
					                    		<span class="input-group-addon"><input name='factura' type='checkbox' value='1'></span>
					                    		<lavel class='form-control'>Factura</lavel>
					                    	</div>
									        <input class="btn btn-info" type="submit" name="submit" id='recibo' value="Generar Recibo">
					                  	</form>
				                	</div>
								</div>
				            </div>
				        </div>
				        <div class="col-md-5 col-sm-5 col-xs-5">
				            <div class="panel panel-default">
					            <div class="panel-heading">
					              	<label>Datos de la Orden de Pago</label>
					            </div>
				            	<div class="panel-body">
				            		<div class="alert alert-warning">
					          			<h4>Nombre del Servicio:</h4>
								       	<h5><?=$row_formato['sr_nombre']?></h5>
								        <h4>Fecha de Orden de pago:</h4>
							            <h5><?=$row_orden['op_fecha']?></h5>
							            <h4>Total de Orden de pago:</h4>
							            <h5>$<?=round($row_orden['op_total'],2)?></h5>
						            </div>
						        </div>
						    </div>
						</div>
				    </div>
				    <div class="row">
	            		<div align='right' class="col-md-7 col-sm-6 col-xs-6">
	    					<form action='menu.php'>
	            				<input  type='submit' value='Regresar' class="btn btn-negro">
	            			</form>
	        			</div>
	        			<div class="col-md-5 col-sm-5 col-xs-5">
	        			</div>
	        		</div>
	        		<hr>
    			<?php break;
    			case 'PAGADO':
    				//Recibo
    				$query = "SELECT rp.rp_fecha_emision, rp.rp_fecha_voucher, rp.rp_referencia, rp.rp_importe_voucher, rp.id_folio FROM orden_pago op INNER JOIN recibo_pago rp ON rp.id_orden_pago = op.id_folio_orden WHERE op.id_solicitud = '$solicitud'";
    				$result_recibo = mysql_query($query);
    				$row_recibo = mysql_fetch_array($result_recibo);
    				//datos secundarios
    				$query = "SELECT ds.* FROM dsa_servicio dsa INNER JOIN datos_secundarios_autorizacion ds ON dsa.id_dat_sec_aut = ds.id_dat_sec_autorizacion WHERE dsa.id_servicio = '$servicio'";
					$result_sec = mysql_query($query,$dbConn);
					$result_autorizo = mysql_query("SELECT id_empleado, em_nombres, em_apaterno, em_amaterno FROM empleado WHERE id_puesto = 6");?>
    				<div class="row">
				        <div class="col-md-7 col-sm-6 col-xs-6">
				        	<div class = "form-group">
				            	<div class="panel panel-default">
				               		<div class="panel-heading">
				            			<label>Autorización</label>
				            		</div>
				                	<div class="panel-body">
					                  	<form method="POST" target='_blank' action="autorizacion_insertar.php">
					                    	<input type='hidden' name='servicio' value='<?=$servicio?>'>
					                  		<input type='hidden' name='solicitud' value='<?=$solicitud?>'>
					                  		<input type='hidden' name='recibo' value='<?=$row_recibo['id_folio']?>'>
					                  		<?php if(mysql_num_rows($result_sec)!=0){ ?>
						                  		<table class='table'>
													<thead>
														<tr>
															<th width = '50%'><h4><font color='#47a447'>Requisitos</font></h4></th>
															<th width = '50%' style="text-align:right">Capturar datos</th>
														</tr>
													</thead>
													<tbody>
														<?php $cont = 0;
														while($row_sec = mysql_fetch_array($result_sec)):
															echo "<tr>";
															if($row_sec['dsa_extras']=='required'){$required = 'required';}else{$required='';}
															switch ($row_sec['dsa_tipo_dato']){
																case 'fecha':
																	echo "<td><input type='hidden' value='{$row_sec['id_dat_sec_autorizacion']}' name='dato_sec_{$cont}'/><label for='{$row_sec['id_dat_sec_autorizacion']}'>{$row_sec['dsa_nombre']}</label></td><td><input id='{$row_sec['id_dat_sec_autorizacion']}' name='dat_{$cont}' type='date' {$required}/></td>";
																	break;
																case 'texto':
																	echo "<td><input type='hidden' value='{$row_sec['id_dat_sec_autorizacion']}' name='dato_sec_{$cont}'/><label for='{$row_sec['id_dat_sec_autorizacion']}'>{$row_sec['dsa_nombre']}</label></td><td><input class='form-control' id='{$row_sec['id_dat_sec_autorizacion']}' name='dat_{$cont}' type='text' {$row_sec['dsa_extras']}/><td>";
																	break;
																case 'tex_largo':
																	echo "<td><input type='hidden' value='{$row_sec['id_dat_sec_autorizacion']}' name='dato_sec_{$cont}'/><label for='{$row_sec['id_dat_sec_autorizacion']}'>{$row_sec['dsa_nombre']}</label></td><td><textarea class='form-control' id='{$row_sec['id_dat_sec_autorizacion']}' name='dat_{$cont}' {$required}/></textarea><td>";
																	break;
																case 'boolean':
																	if ($row_sec['dsa_extras'] != "") {
																		echo "<td><label>{$row_sec['dsa_extras']}</label></td><td></td></tr><tr>";
																	}
																	echo "<td><input type='hidden' value='{$row_sec['id_dat_sec_autorizacion']}' name='dato_sec_{$cont}'/><label for='{$row_sec['id_dat_sec_autorizacion']}'>{$row_sec['dsa_nombre']}</label></td><td><input type='checkbox' id='{$row_sec['id_dat_sec_autorizacion']}' name='dat_{$cont}' type='checkbox' value='{$row_sec['dsa_nombre']}'/></td>";
																	break;
																case 'int':
																	echo "<td><input type='hidden' value='{$row_sec['id_dat_sec_autorizacion']}' name='dato_sec_{$cont}'/><label for='{$row_sec['id_dat_sec_autorizacion']}'>{$row_sec['dsa_nombre']}</label></td><td><input min='0' class='form-control' id='{$row_sec['id_dat_sec_autorizacion']}' name='dat_{$cont}' type='number' {$required}/></td>";
																	break;
																case 'radio':
																	echo "<td><input type='hidden' value='{$row_sec['id_dat_sec_autorizacion']}' name='dato_sec_{$cont}'/><label for='{$row_sec['id_dat_sec_autorizacion']}'>{$row_sec['dsa_nombre']}</label></td>";
																	$temporal = explode(";", $row_sec['dsa_extras']);
																	$tam = sizeof($temporal)-1;
																	echo "<td>";
																	for ($i=0; $i < $tam; $i++){
																		$val = $temporal[$i];
																		switch ($row_sec['id_dat_sec_autorizacion']){
																			case 18:
																				if ($i==1) {
																					echo "<input onclick = 'deshabilita()' name='dat_{$cont}' type='radio' value='{$val}' id='{$row_sec['id_dat_sec_autorizacion']}' required/>{$val}<br>";
																				}else{
																					echo "<input checked onclick = 'habilita()' name='dat_{$cont}' type='radio' value='{$val}' id='{$row_sec['id_dat_sec_autorizacion']}' required/>{$val}<br>";
																				} ?>
																				<script language="JavaScript">
																					function habilita(){
																						document.getElementById('35').disabled = false;
																						document.getElementById('36').disabled = false;
																						document.getElementById('37').disabled = false;
																					}
																 					function deshabilita(){
																 						document.getElementById('35').disabled = true;
																						document.getElementById('36').disabled = true;
																						document.getElementById('37').disabled = true;
																					}
																				</script>
																			<?php break;
																			case 5:
																				if ($i==0) {
																					echo "<input checked onclick = 'habilita2()' name='dat_{$cont}' type='radio' value='{$val}' id='{$row_sec['id_dat_sec_autorizacion']}' required/>{$val}<br>";
																				}elseif($i==1){
																					echo "<input onclick = 'habilita3()' name='dat_{$cont}' type='radio' value='{$val}' id='{$row_sec['id_dat_sec_autorizacion']}' required/>{$val}<br>";
																				}elseif($i==2) {
																					echo "<input onclick = 'habilita4()' name='dat_{$cont}' type='radio' value='{$val}' id='{$row_sec['id_dat_sec_autorizacion']}' required/>{$val}<br>";
																				}elseif($i==3) {
																					echo "<input onclick = 'habilita5()' name='dat_{$cont}' type='radio' value='{$val}' id='{$row_sec['id_dat_sec_autorizacion']}' required/>{$val}<br>";
																				}else{
																					echo "string";
																				} ?>
																				<script language="JavaScript">
																					function habilita2(){
																						document.getElementById('38').disabled = false;
																						document.getElementById('39').disabled = false;
																						document.getElementById('40').disabled = false;
																						document.getElementById('41').disabled = false;
																						document.getElementById('42').disabled = true;
																						document.getElementById('43').disabled = true;
																						document.getElementById('44').disabled = true;
																						document.getElementById('45').disabled = true;
																						document.getElementById('46').disabled = true;
																						document.getElementById('47').disabled = true;
																						document.getElementById('48').disabled = true;
																						document.getElementById('49').disabled = true;
																						document.getElementById('50').disabled = true;
																						document.getElementById('51').disabled = true;
																					}
																 					function habilita3(){
																 						document.getElementById('38').disabled = true;
																						document.getElementById('39').disabled = true;
																						document.getElementById('40').disabled = true;
																						document.getElementById('41').disabled = true;
																						document.getElementById('42').disabled = false;
																						document.getElementById('43').disabled = false;
																						document.getElementById('44').disabled = false;
																						document.getElementById('45').disabled = true;
																						document.getElementById('46').disabled = true;
																						document.getElementById('47').disabled = true;
																						document.getElementById('48').disabled = true;
																						document.getElementById('49').disabled = true;
																						document.getElementById('50').disabled = true;
																						document.getElementById('51').disabled = true;
																					}
																 					function habilita4(){
																 						document.getElementById('38').disabled = true;
																						document.getElementById('39').disabled = true;
																						document.getElementById('40').disabled = true;
																						document.getElementById('41').disabled = true;
																						document.getElementById('42').disabled = true;
																						document.getElementById('43').disabled = true;
																						document.getElementById('44').disabled = true;
																						document.getElementById('45').disabled = false;
																						document.getElementById('46').disabled = false;
																						document.getElementById('47').disabled = false;
																						document.getElementById('48').disabled = true;
																						document.getElementById('49').disabled = true;
																						document.getElementById('50').disabled = true;
																						document.getElementById('51').disabled = true;
																					}
																 					function habilita5(){
																 						document.getElementById('38').disabled = true;
																						document.getElementById('39').disabled = true;
																						document.getElementById('40').disabled = true;
																						document.getElementById('41').disabled = true;
																						document.getElementById('42').disabled = true;
																						document.getElementById('43').disabled = true;
																						document.getElementById('44').disabled = true;
																						document.getElementById('45').disabled = true;
																						document.getElementById('46').disabled = true;
																						document.getElementById('47').disabled = true;
																						document.getElementById('48').disabled = false;
																						document.getElementById('49').disabled = false;
																						document.getElementById('50').disabled = false;
																						document.getElementById('51').disabled = false;
																					}
																				</script>
																			<?php break;
																			default:
																				echo "<input name='dat_{$cont}' type='radio' value='{$val}' id='{$row_sec['id_dat_sec_autorizacion']}' required/>{$val}<br>";
																				break;
																		}
																	} ?>
																	</td>";
																<?php break;
																case 'lista':
																	echo "<td><input type='hidden' value='{$row_sec['id_dat_sec_autorizacion']}' name='dato_sec_{$cont}'/><label>{$row_sec['dsa_nombre']}</label></td><td>";
																	$tabla = $row_sec['dss_extras'];
																	switch ($tabla) {
																		case 'empleado':
																			$puesto = $row_sec['dsa_nombre'];
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
																		case 'grupo':
																			$query = "SELECT gr.id_grupo, gr.det_fecha_inicio gr.det_sede, c.c_nombre FROM grupo AS gr
																			INNER JOIN curso AS c ON gr.id_curso = c.id_curso INNER JOIN servicio_curso AS sc ON sc.id_curso = c.id_curso
																			WHERE gr.det_fecha_inicio >= now() AND sc.id_servicio = '$servicio'";
																			$result = mysql_query($query);
																			echo "<select name='dat_{$cont}' class='form-control' {$required}>";
																			while ($row2 = mysql_fetch_array($result)){
																				echo "<option value='{$row2['id_grupo']}'>{$row2['c_nombre']} Sede: {$row2['det_sede']} Fecha de Inicio: {$row2['det_fecha_inicio']}</option>";
																			}
																			echo "</select>";
																			break;
																		default:
																		echo "ERROR";
																			break;
																	}
																	echo "</td>";
																	break;
																default:
																	echo "Error tipo de dato: {$row_sec['dsa_tipo_dato']}<br>";
																	break;
															}
															$cont++;
															echo "</tr>";
														endwhile;?>
													</tbody>
												</table>
											<input type='hidden' value='<?=$cont?>' name='datos_sec'/>
											<?php }
											$autorizo = mysql_fetch_array($result_autorizo);?>
					                    	<h4>Autorizó</h4>
					                    	<input class="form-control" name='comisionado' type='text' value='<?=$autorizo['em_nombres']?> <?=$autorizo['em_apaterno']?> <?=$autorizo['em_amaterno']?>' readonly>
					                    	<br>
					                    	<div class="input-group">
												<span class='form_group input-group-btn'>
													<button type='submit' name='imprimir_autorizacion' id='autorizacion' class='btn btn-success'>
														<i class='glyphicon glyphicon-file'></i>
														Imprimir
													</button>
												</span>
												<label class='form-control'>Autorización de Solicitud N° <?=$solicitud?></label>
											</div>
					                  	</form>
				                	</div>
								</div>
				            </div>
				        </div>
				        <div class="col-md-5 col-sm-5 col-xs-5">
				            <div class="panel panel-default">
					            <div class="panel-heading">
					              	<label>Datos del recibo de pago</label>
					            </div>
				            	<div class="panel-body">
				            		<div class="alert alert-warning">
					          			<h4>Fecha de Emisión:</h4>
								       	<h5><?=$row_recibo['rp_fecha_emision']?></h5>
								        <h4>Fecha de Voucher:</h4>
							            <h5><?=$row_recibo['rp_fecha_voucher']?></h5>
							            <h4>Referencia:</h4>
							            <h5><?=$row_recibo['rp_referencia']?></h5>
							            <h4>Importe del Voucher:</h4>
							            <h5>$<?=$row_recibo['rp_importe_voucher']?></h5>
						            </div>
						        </div>
						    </div>
						</div>
				    </div>
				    <div class="row">
	            		<div align='right' class="col-md-7 col-sm-6 col-xs-6">
	    					<form action='menu.php'>
	            				<input  type='submit' value='Regresar' class="btn btn-negro">
	            			</form>
	        			</div>
	        			<div class="col-md-5 col-sm-5 col-xs-5">
	        			</div>
	        		</div>
	        		<hr>
    			<?php break;
    			case 'FINALIZADO'; ?>
    				<div class="row">
				        <div class="col-md-12 col-sm-12 col-xs-12">
				        	<div class = "form-group">
				            	<div class="panel panel-default">
				               		<div class="panel-heading">
				            			<label>Confirmar Entrega</label>
				            		</div>
				                	<div class="panel-body">
					                  	<form method="POST" role="form" action="entrega_insertar.php">
					                  		<input type='hidden' name='solicitud' value='<?=$solicitud?>'>
					                    	<div class="input-group">
												<label class='form-control'>Entrega de Solicitud N° <?=$solicitud?> al Cliente: <?=$row['ct_nombre']?> <?=$row['ct_apaterno']?> <?=$row['ct_amaterno']?></label>
												<span class='form_group input-group-btn'>
													<button id='print_auth' type='submit' class='btn btn-danger'>
														<i class='fa fa-check-circle'></i>
														Confirmar
													</button>
												</span>
											</div>
					                  	</form>
				                	</div>
								</div>
				            </div>
				        </div>
				    </div>
				    <div class="row">
	            		<div align='right' class="col-md-7 col-sm-6 col-xs-6">
	    					<form action='menu.php'>
	            				<input  type='submit' value='Regresar' class="btn btn-negro">
	            			</form>
	        			</div>
	        			<div class="col-md-5 col-sm-5 col-xs-5">
	        			</div>
	        		</div>
	        		<hr>
    			<?php break;
    			default:
					break;
    			}?>
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
            								<th>Atendió</th>
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
					            			<td><?php echo $row['s_cantidad']; if($servicio == 7||$servicio == 8||$servicio == 9){echo " metros";}?></td>
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
									<h5><label>Atendió: </label> <?=$atendio['em_nombres']?> <?=$atendio['em_apaterno']?> <?=$atendio['em_amaterno']?></h5>
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
										}?>
									</tbody>
								</table>
								<?php if($row['s_estatus']=='ASESORIA'){
								$result = mysql_query("SELECT fr_ruta_pdf FROM servicio INNER JOIN formato ON id_formato_solicitud = id_formato WHERE id_servicio = '$servicio'");
								$row_solicitud = mysql_fetch_array($result);
								mysql_close($dbConn);?>
								<form action='<?=$row_solicitud['fr_ruta_pdf']?>' method='POST'>
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
            				<input type='submit' value='Regresar' class="btn btn-negro">
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