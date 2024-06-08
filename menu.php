<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    	<?php  include ("sec_head.inc.php");?>
</head>
<body>
<?php include("sec_encabezado.inc.php");?>
	<div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
					<h2 class="title" aline='center'>Menú Principal</h2>
			    </div>
            </div>              
            <!-- /. ROW  -->
            <hr />
            <div class="row">
            	<?php if($_SESSION['rol']!='CONTADOR'){?>
	            	<a href="solicitud_servicios.php">
		                <div class="col-md-3 col-sm-6 col-xs-6">           
							<div class="panel panel-back noti-box">
				                <span class="icon-box bg-color-green set-icon">
				                	<i class="glyphicon glyphicon-plus"></i>
				                </span>
				                <div class="text-box" >
				                	<br><br><br>
				                    <p class="main-text">Solicitud</p>
				                    <!--<p class="text-muted">Solicitud</p>-->
				                </div>
				            </div>
					    </div>
				    </a>
				<?php }?>
			    <a href="solicitud_buscar.php">
			    	<div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
		        	        <span class="icon-box bg-color-red set-icon">
		                	    <i class="glyphicon glyphicon-search"></i>
		            	    </span>
		                	<div class="text-box" >
		                		<br><br><br>
		                    	<p class="main-text">Consultas</p>
		                    <!--<p class="text-muted">Solicitud</p>-->
		                	</div>
		             	</div>
				     </div>
		     	</a>
		     	<?php if($_SESSION['rol']!='CONTADOR'){?>
	            	<a href="cursos_menu.php">
		                <div class="col-md-3 col-sm-6 col-xs-6">           
							<div class="panel panel-back noti-box">
				                <span class="icon-box bg-color-azul set-icon">
				                	<i class="glyphicon glyphicon-edit"></i>
				                </span>
				                <div class="text-box" >
				                	<br><br><br>
				                    <p class="main-text">Grupos</p>
				                    <!--<p class="text-muted">Solicitud</p>-->
				                </div>
				            </div>
					    </div>
				    </a>
				<?php }?>
		     	<a href="ingresos_menu.php">
 			     	<div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
			                <span class="icon-box bg-color-blue set-icon">
			                    <i class="fa fa-usd"></i>
			                </span>
			                <div class="text-box" >
			                	<br><br><br>
			                    <p class="main-text">Ingresos</p>
			                    <!--<p class="text-muted">Consultar</p>-->
			                </div>
             			</div>
		     		</div>
		     	</a>
		     	<?php if($_SESSION['rol']=='ADMINISTRADOR'){?>
		     	<a href="catalogo_menu.php">
		     		<div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
			                <span class="icon-box bg-color-brown set-icon">
			                    <i class="fa fa-list-alt"></i>
			                </span>
			                <div class="text-box" >
			                	<br><br><br>
			                    <p class="main-text">Catálogos</p>
			                   <!--<p class="text-muted">Consultar</p>-->
			                </div>
             			</div>
				    </div>
		     	</a>
		     	<?php }?>
                <!-- /. ROW  -->    
		    </div>
		    <hr>
        <!-- /. PAGE INNER  -->
        </div>
    <!-- /. PAGE WRAPPER  -->
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