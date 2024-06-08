<?php
    session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }

	$_SESSION['usuario'] = 'Usuario';
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
					<h2 align="center">Catálogos</h2>
					<hr/>
					<a href="cliente_general.php">
	            		<div class="col-md-3 col-sm-6 col-xs-6">           
							<div class="panel panel-back noti-box">
				                <span class="icon-box bg-color-red set-icon">
				                    <i class="fa fa-user"></i>
				                </span>
				                <div class="text-box" >
				                	<br><br><br>
				                    <p class="main-text">Clientes</p>
				                </div>
	             			</div>
			     		</div>
			     	</a>
			     	<a href="estado_general.php">
		                <div class="col-md-3 col-sm-6 col-xs-6">           
							<div class="panel panel-back noti-box">
				                <span class="icon-box bg-color-blue set-icon">
				                    <i class="fa fa-building-o"></i>
				                </span>
				                <div class="text-box" >
				                	<br><br><br>
				                    <p class="main-text">Direcciones</p>
				                </div>
	             			</div>
					    </div>
					</a>
					<a href="servicio_general.php">
		                <div class="col-md-3 col-sm-6 col-xs-6">           
							<div class="panel panel-back noti-box">
				                <span class="icon-box bg-color-green set-icon">
				                	<i class="fa fa-folder-open"></i>
				                </span>
				                <div class="text-box" >
				                	<br><br><br>
				                    <p class="main-text">Servicios</p>
				                </div>
				            </div>
					    </div>
					</a>
				</div>
		     	<div class="row">
					<h2 align="center">Administrativos</h2>
					<hr/>
		     		<div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
			                <span class="icon-box bg-color-brown set-icon">
			                	<i class="fa fa-usd"></i>
			                </span>
			                <div class="text-box" >
			                	<br><br><br>
			                    <p class="main-text">Cuenta</p>
			                    <br>
			                    <a href="cuenta_general.php"> <button type='submit' class="btn btn-successbrown">Consulta</button></a>
			                    <br><br>
			                    <a href="cuenta_registrar.php"> <button type='submit' class="btn btn-successbrown">Agregar</button></a>     
			                </div>
			            </div>
				    </div>
	                <div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
			                <span class="icon-box bg-color-brown set-icon">
			                	<i class="fa fa-archive"></i>
			                </span>
			                <div class="text-box" >
			                	<br><br><br>
			                    <p class="main-text">Oficinas</p>
			                    <br>
			                    <a href="oficina_general.php"> <button type='submit' class="btn btn-successbrown">Consulta</button></a>
			                    <br><br>
			                    <a href="oficina_registrar.php"> <button type='submit' class="btn btn-successbrown">Agregar</button></a>  
			                </div>
			            </div>
				    </div>
	                <div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
			                <span class="icon-box bg-color-brown set-icon">
			                	<i class="fa fa-money"></i>
			                </span>
			                <div class="text-box" >
			                	<br><br><br>
			                    <p class="main-text">Salario mínimo</p>
			                    <br>
			                    <a href="salario_minimo_general.php"> <button type='submit' class="btn btn-successbrown">Consulta</button></a>
			                    <br><br>
			                    <a href="salario_minimo_registrar.php"> <button type='submit' class="btn btn-successbrown">Agregar</button></a>   
			                </div>
			            </div>
				    </div>
				    <div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
			                <span class="icon-box bg-color-brown set-icon">
			                	<i class="fa fa-book"></i>
			                </span>
			                <div class="text-box" >
			                	<br><br><br>
			                    <p class="main-text">Lemas</p>
			                    <br>
			                     <a href="lema_general.php"> <button type='submit' class="btn btn-successbrown">Consulta</button></a>
			                    <br><br>
			                    <a href="lema_registrar.php"> <button type='submit' class="btn btn-successbrown">Agregar</button></a>    
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