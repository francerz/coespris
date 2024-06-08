<?php
	session_start();
	if (!isset($_SESSION['username'])) {
  		header("Location: login.php");
	}
	require_once("conexion.php");
	$query = "SELECT sc.id_servicio, gr.id_grupo, gr.det_fecha_inicio, gr.det_fecha_fin, gr.det_sede, c.c_nombre, em.em_nombres, em.em_apaterno, em.em_amaterno
	FROM grupo AS gr INNER JOIN curso AS c ON gr.id_curso = c.id_curso INNER JOIN servicio_curso AS sc ON sc.id_curso = c.id_curso
	INNER JOIN empleado AS em ON gr.id_empleado = em.id_empleado
	WHERE gr.det_estatus = '1'";
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
            	<div class="row">
	            	<div class="col-md-12 col-sm-12 col-xs-12">
	            		<div class="panel-body">
	            			<h2 class="title" aline='center'>Generar Constancias</h2>
	                        <hr>
	            		</div>
    	        	</div>
    	        </div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>Finalizar</th>
										<th>Curso</th>
										<th>Fecha de Inicio</th>
										<th>Fecha Fin</th>
										<th>Sede</th>
										<th>Instructor</th>
										<th>Asistentes</th>
									</tr>
								</thead>
								<tbody>
									<?php while($row = mysql_fetch_array($result)):
										$grupo = $row['id_grupo'];
										$total = mysql_num_rows(mysql_query("SELECT gr.id_grupo FROM grupo AS gr INNER JOIN asistentes AS asi
										ON gr.id_grupo = asi.id_grupo WHERE gr.id_grupo = '$grupo' AND asi.estatus LIKE 'ACTIVO'"));?>
										<tr>
										<form method='POST' action=''>
											<input type='hidden' name='grupo' value='<?=$grupo?>'/>
											<input type='hidden' name='servicio' value='<?=$row['id_servicio']?>'/>
											<td><button type='submit' name='submit' class='btn btn-success btn-circle'><i class="glyphicon glyphicon-ok-circle"></i></button></td>
											<td><?=$row['c_nombre']?></td>
											<td><?=$row['det_fecha_inicio']?></td>
											<td><?=$row['det_fecha_fin']?></td>
											<td><?=$row['det_sede']?></td>
											<td><?=$row['em_nombres']?> <?=$row['em_apaterno']?> <?=$row['em_amaterno']?></td>
											<td><?=$total?></td>
										</form>
										</tr>
									<?php endwhile;
									if (isset($_POST["submit"])) {
										$id_grupo = $_POST['grupo'];
										$id_servicio = $_POST['servicio'];
										$pdf = mysql_fetch_array(mysql_query("SELECT fr.fr_ruta_pdf FROM formato AS fr INNER JOIN servicio AS sr ON fr.id_formato = sr.id_formato_autoriza WHERE sr.id_servicio = '$id_servicio'"));
										mysql_query("UPDATE grupo SET det_estatus = '0' WHERE id_grupo = '$id_grupo'");?>
										<script type='text/javascript'>
											document.location.href = "<?=$pdf['fr_ruta_pdf']?>/?g=<?=$id_grupo?>";
										</script>
									<?php }
									mysql_close($dbConn);?>
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