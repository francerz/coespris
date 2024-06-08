<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
   require_once("conexion.php");
   $querry11 = "select * from puesto";
   $result11 = mysql_query($querry11,$dbConn); 
   $title="Registrar Empleado";


   $query = mysql_query("SELECT * FROM oficina");
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		  <?php include ("sec_head.inc.php"); ?>
	</head>
<body>
<script>
function volver(){
   window.location.assign("catalogo_usuarios_permisos.php")
}
</script>

	<?php include ("sec_encabezado.inc.php"); ?>
    	<div class='wrapper'>
    	  <div id="page-wrapper" >
      		<div id="page-inner">
        		<div class="row">
          			<div class="col-md-12">
						<h2>Nuevo empleado</h2>
                        <form role="form" method='POST' action='empleado_insertar.php'>
					    
	                    <label for='inNombre'>Nombre</label>
	                    <input type="text" class="form-control" name="nombre" required placeholder="Nombre"/>
	                    <br/>
	                    <label for='inApaterno'>Apellido paterno</label>
	                    <input type="text" class="form-control" name="apaterno" required placeholder="Apellido paterno"/>
	                    <br/>
	                    <label for='inMaterno'>Apellido materno</label>
	                    <input type="text" class="form-control" name="amaterno" required placeholder="Apellido materno"/>
	                    <br/>
	                    <label>Tipo de empleado</label>
	                    <br/>
	                    <select name ='tpem' class="form-control">
	                    <option value="Interno">Interno</option>
                     	<option value="Externo">Externo</option>
                     	<br/><br>
	                    </select>
	                    <br>
	                    <label>Puesto</label>
	                    <br/>
	                    <select name='puesto' class="form-control">
                     <?php
                        while ($row = mysql_fetch_array($result11)): ?> 
                            <option value='<?=$row['id_puesto']?>'><?=$row['pu_nombre']?></option>  
                     <?php endwhile; ?>  
                        </select>  
                        <br/>
                         </select>
	                    <label>Oficina</label>
	                    <br/>
	                    <select name='oficina' class="form-control">
                     <?php
                        while ($row2 = mysql_fetch_array($query)): ?> 
                            <option value='<?=$row2['id_oficina']?>'><?=$row2['of_nombre']?></option>  
                     <?php endwhile; ?>  
                        </select>  
                        <br/>
                    <div align="right">  
                      <input id='btn_submit' class='btn btn-default' type="submit" name="submit" style="display:inline" value="Registrar">
                      <input type="button" class="btn btn-negro" id="filter" onclick="volver();"  style="display:inline" name="filter" value="Regresar" />
                      <br><br>
                   </div>
	                </form>
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