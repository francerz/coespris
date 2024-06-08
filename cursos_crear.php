<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$query = "SELECT id_curso, c_nombre FROM curso";
	$result = mysql_query($query);
	$query2 = "SELECT id_empleado, em_nombres, em_apaterno, em_amaterno FROM empleado WHERE id_puesto = 2";
	$result2 = mysql_query($query2);
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
	            	<div class="col-md-12">
	            		<div class="panel-body">
	            			<h2 class="title" aline='center'>Crear Grupo</h2>
	                        <hr>
	            		</div>
    	        	</div>
    	        </div>
            	<form method='POST' action='cursos_insertar.php'>
					<div class="row">
						<div class="col-md-6">
		                    <div class="panel-body">
	                        	<h4>Seleccionar curso</h4>
	                        	<select name="curso"  id="curso" onchange="va(this)" required style="width:100%;">
	                        	<?php while($row = mysql_fetch_array($result)):?>
	                        		<option value='<?=$row['id_curso']?>' onclick = 'deshabilita()'><?=$row['c_nombre']?></option>
	                        	<?php endwhile;?>
	                        	<option value='otro' selected>Otro</option>
	                        	</select>
	                        	<h4>Nombre del nuevo Curso</h4>
	                        	<input type='text' required name='nombre' id='nombre' style="width:100%;">
	                        	<h4>Horas del Curso</h4>
	                        	<input type='number' required name='hora' id='hora' style="width:100%;">
							</div>
						</div>
						<script language="JavaScript">
							function habilita(){
								document.getElementById('nombre').disabled = false;
								document.getElementById('hora').disabled = false;
							}
		 					function deshabilita(){
		 						document.getElementById('nombre').disabled = true;
		 						document.getElementById('hora').disabled = true;
							}
						</script>

						<script type="text/javascript">
						function va(){
						var valor = document.getElementById("curso").value;
							if(valor=='otro'){
						document.getElementById('nombre').disabled = false;
						document.getElementById('hora').disabled = false;

						}else{
						document.getElementById('hora').disabled = true;
						document.getElementById('nombre').disabled = true;

						}
						}
						</script>
						<div class="col-md-6">
							<div class="panel-body">
								<h4>Instructor</h4>
	                        	<select name='empleado' required style="width:100%;">
	                        	<?php while($row = mysql_fetch_array($result2)):?>
	                        		<option value='<?=$row['id_empleado']?>'><?=$row['em_nombres']?> <?=$row['em_apaterno']?> <?=$row['em_amaterno']?></option>
	                        	<?php endwhile;
	                        	mysql_close($dbConn);?>
	                        	</select>
	                        	<h4>Sede</h4>
	                        	<input type='text' name='sede' required style="width:100%;">
	                        	<table style="width:100%;">
	                        		<tr>
										<td style="width:50%;"><h4>Fecha de Inicio</h4></td>
										<td style="width:50%;"><h4>Fecha Fin</h4></td>
									</tr><tr>
										<td><input type="date" required min='<?=date('Y-m-d')?>' name='inicio'></td>
										<td><input type="date" required min='<?=date('Y-m-d')?>' name='fin'></td>
									</tr>
								</table><br>
							</div>
						</div>
					</div>
			<div align="right">		
				<div class="col-md-6" align='right'>
					<input type="submit" class='btn btn-success' value="Crear Grupo"/>
				</div>
                </form>
					<div class="col-md-6 col-sm-6 col-xs-6">
    					<form action='cursos_menu.php'>
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