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
				<div class="row">
					<div class="col-md-12">
	                    <div class="panel-body">
	                        <h2 class="title" aline='center'>Menú de Ingresos</h2>
	                        <hr>
	                        <?php if($_SESSION['rol']!='VENTANILLA'){?>
	                        <a href="ingresos_servicio.php">
				                <div class="col-md-4 col-sm-4 col-xs-4">           
									<div class="panel panel-back noti-box">
						                <span class="icon-box bg-color-green set-icon">
						                	<i class=" glyphicon glyphicon-calendar"></i>
						                </span>
						                <div class="text-box" >
						                    <p class="main-text">Por periodo</p>
						                </div>
						            </div>
							    </div>
						    </a>
						    <?php }?>
						    <a href="ingresos_empleado.php">
				                <div class="col-md-4 col-sm-4 col-xs-4">           
									<div class="panel panel-back noti-box">
						                <span class="icon-box bg-color-green set-icon">
						                	<i class="glyphicon glyphicon-user"></i>
						                </span>
						                <div class="text-box" >
						                    <p class="main-text">Por usuario</p>
						                </div>
						            </div>
							    </div>
						    </a>
						    <?php if($_SESSION['rol']!='VENTANILLA'){?>
						    <a href="ingresos_facturas.php">
				                <div class="col-md-4 col-sm-4 col-xs-4">           
									<div class="panel panel-back noti-box">
						                <span class="icon-box bg-color-green set-icon">
						                	<i class="glyphicon glyphicon-edit"></i>
						                </span>
						                <div class="text-box" >
						                    <p class="main-text">Facturas</p>
						                </div>
						            </div>
							    </div>
						    </a>
						    <?php }?>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class="col-md-12 col-sm-12 col-xs-12" align='right'>
    					<form action='menu.php'>
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