<?php
$title="Registrar Lema";
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
date_default_timezone_set("America/Mexico_City");
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<?php include ("sec_head.inc.php"); ?>
	</head>
<body>
<script>
function volver(){
   window.location.assign("catalogo_menu.php")
}
</script>

<?php include ("sec_encabezado.inc.php"); ?>
  <div class='wrapper'>
    <div id="page-wrapper" >
      <div id="page-inner">
        <div class="row">
            <form method="POST" role="form" action="">
             <div class="col-md-12">
             <h2>Nuevo lema</h2>
            <br>
              <div class = "form-group">
                <label>Lema</label>
                <input class="form-control" type="text" name="lema" autofocus required placeholder="Lema"/>
              </div>
            
               <div class = "form-group">
                <label>Fecha de inicio del lema</label>
                <input class="form-control" type="date" name="fecha" autofocus required placeholder="aaaa-mm-dd"/>
              </div>
             
              <label>Estado de vigencia</label>
              
              <select name ='status' class="form-control">
              <option value="1">Vigente</option>
              <option value="0">No vigente</option>
              </select>
              <br>
            </div>
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
<?php
if (isset($_POST['submit'])) {
  include("lema_insertar.php");
}
?> 
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