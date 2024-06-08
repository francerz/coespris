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
	            	<div class="col-md-12 col-sm-12 col-xs-12">
	            		<div class="panel-body">
	            			<h2 class="title" aline='center'>Administrar Grupo</h2>
	                        <hr>
	            		</div>
    	        	</div>
    	        </div>
    	        <?php if(isset($_GET['grupo'])){
    	        	$id = $_GET['grupo'];
    	        	$query = "SELECT c.id_curso, gr.det_fecha_inicio, gr.det_fecha_fin, gr.det_sede, c.c_nombre, c.c_duracion, em.em_nombres, em.em_apaterno, em.em_amaterno
					FROM grupo AS gr INNER JOIN curso AS c ON gr.id_curso = c.id_curso INNER JOIN empleado AS em ON gr.id_empleado = em.id_empleado
					WHERE gr.id_grupo = '$id'";
					$result = mysql_query($query);
					$row = mysql_fetch_array($result);

					$query = "SELECT asi.as_nombre, asi.estatus FROM asistentes AS asi WHERE asi.id_grupo = '$id'";
					$result = mysql_query($query);?>
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
		        			<div class="panel-body">
								<div class="panel panel-default">
			        				<div class="panel-heading">
										<form action='cursos_modificar.php' method='POST'>
											<input type='hidden' name='grupo' value='<?=$id?>'>
			                            	<button type='submit' class='btn btn-default btn-circle'><i class="glyphicon glyphicon-pencil"></i></button>
			            					<label>Grupo</label>
		                        		</form>
		                        	</div>
		        					<div class="panel-body">
		        						<table class="table">
		        							<thead>
		        								<tr>
		        									<td colspan="2"><?=$row['c_nombre']?></td>
	        									</tr>
		        								<tr>
		                            				<th>Fecha de Inicio</th>
		        									<th>Fecha Fin</th>
		        								</tr>
		        							</thead>
		        							<tbody>
		        								<tr>
		        									<td><?=$row['det_fecha_inicio']?></td>
		        									<td><?=$row['det_fecha_fin']?></td>
		        								</tr>
		        							</tbody>
		        							<thead>
		        								<tr>
		        									<th>Sede</th>
		        									<th>Duración</th>
		        								</tr>
		        							</thead>
		        							<tbody>
		        								<tr>
		        									<td><?=$row['det_sede']?></td>
		        									<td><?=$row['c_duracion']?> Horas</td>
		        								</tr>
		        							</tbody>
		        							<thead>
		        								<tr>
		        									<th colspan="2">Instructor</th>
		        								</tr>
		        							</thead>
		        							<tbody>
		        								<tr>
		        									<td colspan="2"><?=$row['em_nombres']?> <?=$row['em_apaterno']?> <?=$row['em_amaterno']?></td>
		        								</tr>
		        							</tbody>
		        						</table>
									</div>
								</div>
							</div>
			            </div>
			            <div class="col-md-6 col-sm-6 col-xs-6">
		        			<div class="panel-body">
		        				<div class="panel panel-default">
			        				<div class="panel-heading">
										<form action='asistentes_registrar.php' method='POST'>
											<input type='hidden' name='grupo' value='<?=$id?>'>
											<input type='hidden' name='curso' value='<?=$row['id_curso']?>'>
			                            	<button type='submit' class='btn btn-success btn-circle'><i class="glyphicon glyphicon-plus"></i></button>
			            					<label>Integrantes</label>
		                        		</form>
		                        	</div>
		        					<div class="panel-body">
				        				<table class="table">
				        					<thead>
				        						<tr>
				        							<th>Nombre</th>
				        							<th>Esatatus</th>
				        							<th>Editar</th>
				        						</tr>
				        					</thead>
				        					<tbody>
				        						<?php while($row2 = mysql_fetch_array($result)):?>
				        						<tr>
			        							<form method='POST'>
			        								<input type='hidden' value='<?=$id?>' name='grupo'>
			        								<input type='hidden' value='<?=$row2['id_asistente']?>' name='asistente'>
			        								<input type='hidden' value='<?=$row2['estatus']?>' name='estatus'>
				        							<td><h6><?=$row2['as_nombre']?></h6></td>
				        							<td><h6><font color=<?php if($row2['estatus']=="ACTIVO"){ ?>"green"<?php }else{ ?>"red"<?php } ?>><?=$row2['estatus']?></font></h6></td>
				        							<td>
				        								<button type='submit' class='btn btn-warning btn-circle' formaction="asistentes_modificar.php"><i class="glyphicon glyphicon-pencil"></i></button>
				        								<?php if($row2['estatus']=="ACTIVO"){ ?>
					            							<button type='submit' class='btn btn-danger btn-circle' formaction="asistentes_eliminar.php"><i class="glyphicon glyphicon-minus"></i></button>
														<?php }else{ ?>
					        								<button type='submit' class='btn btn-success btn-circle' formaction="asistentes_eliminar.php"><i class="glyphicon glyphicon-plus"></i></button>
														<?php } ?>
					            					</td>
				        						</form>
				        						</tr>
				        						<?php endwhile;?>
				        					</tbody>
				        				</table>
				        			</div>
				        		</div>
		        			</div>
		        		</div>
					</div>
				<div align="right">
				<div class='row'>
					<div class="col-md-6 col-sm-6 col-xs-6" align='right'>
						<form action='cursos_administrar.php'>
            				<input type='submit' value='Ver Grupos' class="btn btn-warning">
            			</form>
            		</div>
            		<div class="col-md-6 col-sm-6 col-xs-6">
    					<form action='cursos_menu.php'>
            				<input type='submit' value='Regresar' class="btn btn-negro">
            			</form>
        			</div>
	        	</div>
	        	</div>
    	        <?php }else{
    	        	$query = "SELECT gr.id_grupo, gr.det_fecha_inicio, gr.det_fecha_fin, gr.det_sede, c.c_nombre, em.em_nombres, em.em_apaterno, em.em_amaterno
					FROM grupo AS gr INNER JOIN curso AS c ON gr.id_curso = c.id_curso INNER JOIN empleado AS em ON gr.id_empleado = em.id_empleado
					WHERE gr.det_fecha_fin > now()";
					$result = mysql_query($query);?>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th></th>
											<th>Curso</th>
											<th>Fecha de Inicio</th>
											<th>Fecha Fin</th>
											<th>Sede</th>
											<th>Instructor</th>
										</tr>
									</thead>
									<tbody>
										<?php while($row = mysql_fetch_array($result)):?>
										<tr>
										<form method='GET' action=''>
											<input type='hidden' name='grupo' value='<?=$row['id_grupo']?>'/>
											<td><button type='submit' class='btn btn-warning btn-circle'><i class="glyphicon glyphicon-pencil"></i></button></td>
											<td><?=$row['c_nombre']?></td>
											<td><?=$row['det_fecha_inicio']?></td>
											<td><?=$row['det_fecha_fin']?></td>
											<td><?=$row['det_sede']?></td>
											<td><?=$row['em_nombres']?> <?=$row['em_apaterno']?> <?=$row['em_amaterno']?></td>
										</form>
										</tr>
										<?php endwhile;?>
									</tbody>
								</table>
							</div>
			            </div>
					</div>
				<div class='row'>
					<div class="col-md-12 col-sm-12 col-xs-12" align='right'>
    					<form action='cursos_menu.php'>
            				<input type='submit' value='Regresar' class="btn btn-negro">
            			</form>
        			</div>
        		</div>
				<?php }
				mysql_close($dbConn);?>
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