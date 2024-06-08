<?php
	session_start();
	session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }

	$_SESSION['usuario'] = 'Usuario';
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
			    	<div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
		        	        <span class="icon-box bg-color-blue set-icon">
		                       <i class="fa fa-users"></i>
		            	    </span>
		                	<div class="text-box" >
		                	<br><br><br>
		                	<p class="main-text">Empleados</p>
		                	<br>
			                    <a href="empleado_general.php"> <button type='submit' class="btn btn-successviolet">Consulta</button></a>
			                    <br><br>
			                    <a href="empleado_registrar.php"> <button type='submit' class="btn btn-successviolet">Agregar</button></a>
		                	</div>
		             	</div>
				     </div>
	                <div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
			                <span class="icon-box bg-color-blue set-icon">
			                	<i class="fa fa-refresh"></i>
			                </span>
			                <div class="text-box" >
			                <br><br><br>
			                    <p class="main-text">Roles</p>
			                    <br>
			                    <a href="rol_general.php"> <button type='submit' class="btn btn-successviolet">Consulta</button></a>
			                    <br><br>
			                    <a href="rol_registrar.php"> <button type='submit' class="btn btn-successviolet">Agregar</button></a>    
			                </div>
			            </div>
				    </div>			     
	                <div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
			                <span class="icon-box bg-color-blue set-icon">
			                	<i class="fa fa-user"></i>
			                </span>
			                <div class="text-box" >
			                <br><br><br>
			                    <p class="main-text">Usuarios</p>
			                    <br>
			                    <a href="usuario_general.php"> <button type='submit' class="btn btn-successviolet">Consulta</button></a>
			                    <br><br>
			                    <a href="usuario_registrar.php"> <button type='submit' class="btn btn-successviolet">Agregar</button></a>    
			                </div>
			            </div>
				    </div>
				    <div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
			                <span class="icon-box bg-color-blue set-icon">
			                	<i class="fa fa-sitemap"></i>
			                </span>
			                <div class="text-box" >
			                	<br><br><br>
			                    <p class="main-text">Puestos</p>
			                    <br>
			                    <a href="puesto_general.php"> <button type='submit' class="btn btn-successviolet">Consulta</button></a>
			                    <br><br>
			                    <a href="puesto_registrar.php"> <button type='submit' class="btn btn-successviolet">Agregar</button></a>   
			                </div>
			            </div>
				    </div>
				    <div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
			                <span class="icon-box bg-color-blue set-icon">
			                	<i class="fa fa-unlock-alt"></i>
			                </span>
			                <div class="text-box" >
			                	<br><br><br>
			                    <p class="main-text">Permisos</p>
			                    <br>
			                    <a href="permiso_general.php"> <button type='submit' class="btn btn-successviolet">Consulta</button></a>
			                    <br><br>
			                    <a href="permiso_registrar.php"> <button type='submit' class="btn btn-successviolet">Agregar</button></a>  
			                </div>
			            </div>
				    </div>
	                
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