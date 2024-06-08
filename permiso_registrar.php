<?php
    $title="Registrar Permiso";
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
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
          <h2>Nuevo permiso</h2>
          <br>
            <form method="post" role="form" action="">
              <div class = "form-group">
                <label>Nombre</label>
                <input class="form-control" type="text" name="nombre" required placeholder="Nombre"/>
              </div>
              <div class = "form-group">
                <label>Archivo</label>
                <input class="form-control" type="text" name="archivo" required placeholder="Archivo"/>
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
  </div>
<?php
if (isset($_POST['submit'])) {
  require("permiso_insertar.php");
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

</div>
</div>
</script>
</body>
</html>