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
            	<?php if (isset($_POST['rango'])){ 
            	require_once("conexion.php");
            	switch ($_POST['rango']) {
            		case 'per':
            			$inicio = $_POST['Finicio'];
            			$fin = $_POST['Ffin'];
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
    			$total = mysql_fetch_array($result2); ?>
            	<div class="row">
            		<div class="col-md-10">
	                    <div class="panel-body">
	                    	<?php
	                    	if(isset($servicio)){
	                    		$row = mysql_fetch_array(mysql_query("SELECT sr_nombre FROM servicio WHERE id_servicio = '$servicio'"));
	                    		$sr_nombre = $row['sr_nombre'];?>
	                    		<h4><font color='#47a447'>Ingresos del Servicio:</font> <?=$sr_nombre?></h4>
	                    		<h4><font color='#47a447'>Periodo:</font> <?=$inicio2?> hasta <?=$fin2?></h4>
	                    	<?php }else{ ?>
	                    		<h4><font color='#47a447'>Ingresos del Periodo:</font> <?=$inicio2?> hasta <?=$fin2?></h4>
	                    	<?php }
	                    	if(isset($oficina)){
	                    		$row = mysql_fetch_array(mysql_query("SELECT of_nombre FROM oficina WHERE id_oficina = '$oficina'"));
	                    		$of_nombre = $row['of_nombre'];?>
	                    		<h4><font color='#47a447'>Oficina:</font> <?=$of_nombre?></h4>
	                    	<?php }?>
	                    </div>
	                </div>
            		<div class="col-md-2" align='right'>
						<form method='post' action=''>
							<input type='hidden' name='rango' value='<?=$_POST['rango']?>'>
							<input type='hidden' name='inicio' value='<?=$inicio?>'>
        					<input type='hidden' name='fin' value='<?=$fin?>'>
        					<input type='hidden' name='servicio' value='<?=$_POST['servicio']?>'>
        					<input type='hidden' name='oficina' value='<?=$_POST['oficina']?>'>
        	    			<div class="panel-body">
            					<label>PDF
									<button type='submit' formtarget="_blank" formaction="ingresos_pdf.php" class='btn btn-default btn-circle'><i class="glyphicon glyphicon-file"></i></button>
								</label>
								<br><label>Gráfica
									<button type='submit' class='btn btn-default btn-circle'><i class="glyphicon glyphicon-usd"></i></button>
								</label>
							</div>
						</form>
					</div>
				</div>
				<hr>
				<div class="row">
	                <div class="col-md-12">
	                    <div class="panel-body">
	                        <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th>No</th>
											<?php if(empty($servicio)){?>
												<th>Servicio</th>
											<?php } ?>
											<?php if(empty($oficina)){?>
												<th>Oficina</th>
											<?php } ?>
											<th>Cliente</th>
											<th>Fecha</th>
											<th>Ingreso</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 1;
										while($row = mysql_fetch_array($result)): ?>
										<tr class="gradeX">
											<td><?=$no?></td>
											<?php if(empty($servicio)){?>
												<td><?=$row['sr_nombre']?></td>
											<?php } ?>
											<?php if(empty($oficina)){?>
												<td><?=$row['of_nombre']?></td>
											<?php } ?>
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
									<h3><font color='#47a447'>Total de Ingresos:</font> $<?=round($total['total'],2)?></h3>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class='row'>
				  <div align="right">
					<div class="col-md-6 col-sm-12 col-xs-12" align='right'>
    					<form action='ingresos_servicio.php'>
            				<input type='submit' value='Cambiar Periodo' class="btn btn-danger">
            			</form>
        			</div>
        			<div class="col-md-6 col-sm-12 col-xs-12">
    					<form action='ingresos_menu.php'>
            				<input type='submit' value='Regresar' class="btn btn-negro">
            			</form>
        			</div>
        		  </div>
	        	</div>
            	<?php }else{?>
            	<div class="row">
					<div class="col-md-12">
	                    <div class="panel-body">
	                    	<h2>Ingresos por periodo</h2>
	                    	<hr>
	                    	<form method='post' action=''>
	                    		<input checked type='radio' required name='rango' value='año' id='año' onclick = 'deshabilita()'> <label for='año'>Último año</label></br>
            					<input type='radio' required name='rango' value='mes' id='mes' onclick = 'deshabilita()'> <label for='mes'>Último mes</label></br>
            					<input type='radio' required name='rango' value='sem' id='sem' onclick = 'deshabilita()'> <label for='sem'>Última semana</label></br>
            					<input type='radio' required name='rango' value='hoy' id='hoy' onclick = 'deshabilita()'> <label for='hoy'>Hoy</label></br>
	                    		<input type='radio' required name='rango' value='per' id='per' onclick = 'habilita()'> <label for='per'>Personalizado</label>
            					<table class='table'>
            						<thead>
            							<tr>
            								<th width='50%'><label for='Finicio'>Fecha de inicio: </label></th>
            								<th width='50%'><label for='Ffin'>Fecha de fin: </label></th>
            							</tr>
            						</thead>
            						<tbody>
            							<tr>
            								<td><input disabled type='date' required id='Finicio' name='Finicio' class="form-control" placeholder="aaaa-mm-dd"/></td>
            								<td><input disabled max='<?=date('Y-m-d')?>' type='date' required id='Ffin' name='Ffin' class="form-control" placeholder="aaaa-mm-dd"/></td>
            							</tr>
            						</tbody>
            						<thead>
            							<tr>
            								<td><label for='ser'>Servicio: </label></td>
            								<td><label for='ser'>Oficina: </label></td>
            							</tr>
            						</thead>
            						<tbody>
            							<tr>
            								<td><?php
	                    					require_once("conexion.php");
	                    					$query = "SELECT sr_nombre, id_servicio FROM servicio";
	                    					$result = mysql_query($query,$dbConn); ?>
	                    					<select name='servicio' id='ser' class='form-control' required>
	                    						<option selected value='TODOS'>TODOS</option>
	                    						<?php while($row = mysql_fetch_array($result)):
	                    							?><option value='<?=$row['id_servicio']?>'><?=$row['sr_nombre']?></option>
	                    						<?php endwhile; ?>
	                    					</select></td>
	                    					<td><?php
	                    					$query = "SELECT of_nombre, id_oficina FROM oficina";
	                    					$result = mysql_query($query,$dbConn); ?>
	                    					<select name='oficina' id='of' class='form-control' required>
	                    						<option selected value='GENERAL'>GENERAL</option>
	                    						<?php while($row = mysql_fetch_array($result)):
	                    							?><option value='<?=$row['id_oficina']?>'><?=$row['of_nombre']?></option>
	                    						<?php endwhile; ?>
	                    					</select>
	                    					<?php mysql_close($dbConn);
	                    					?></td>
            							</tr>
            						</tbody>
            					</table>
            					<div align="right">
            					<div class="col-md-6 col-sm-6 col-xs-6" align='right'>
            						<input type='submit' name='consultar' value='Consultar' class="btn btn-warning">
            					</div>
	                    	</form>
	                    	<script language="JavaScript">
								function habilita(){
									document.getElementById('Finicio').disabled = false;
									document.getElementById('Ffin').disabled = false;
								}
			 					function deshabilita(){
			 						document.getElementById('Finicio').disabled = true;
									document.getElementById('Ffin').disabled = true;
								}
							</script>
							<div class="col-md-6 col-sm-6 col-xs-6">
		    					<form action='ingresos_menu.php'>
		            				<input type='submit' value='Regresar' class="btn btn-negro">
		            			</form>
		        			</div>
		        			</div>
	                    </div>
					</div>
				</div>
				<?php }?>
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