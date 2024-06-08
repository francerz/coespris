<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php"); 

$oficinaz = $_SESSION['oficina'];
$query = "select * from empleado";
$query2 = "select * from rol";
$result = mysql_query($query,$dbConn);
$result2 = mysql_query($query2,$dbConn);
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
						<h2>Nuevo Usuario</h2>
                        <form role="form" method='POST' action='usuario_insertar.php'>
					    
	                    <label for='inNombre'>Nombre</label>
	                    <input type="text" class="form-control" name="usuario" required placeholder="Nombre Usuario"/>
	                    <br/>
	                    <label for='incontrasenia'>Contraseña</label>
	                    <input type="password" class="form-control" name="contrasena" required placeholder="Contraseña"/>
	                    <br>
	                    <label for='inNombre'>Nombre Empleado</label>
	                    <select name='emp' class="form-control">
                        <?php
                              while ($row = mysql_fetch_array($result)): ?> 
                               <option value='<?=$row['id_empleado']?>'><?=$row['em_nombres']?>  <?=$row['em_amaterno']?>  <?=$row['em_apaterno']?></option>
                        <?php endwhile; ?>  
                        </select>
                        <label for='inrol'>Rol</label>
	                    <select name='rol' class="form-control">
                        <?php
                               while ($row = mysql_fetch_array($result2)): ?> 
                                <option value='<?=$row['id_rol']?>'><?=$row['rol_nombre']?></option>
                    
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