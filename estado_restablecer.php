<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$estado = $_POST['i'];
$title="Modificar Estado";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include ("sec_head.inc.php"); ?>
  </head>
<body>
  <?php include ("sec_encabezado.inc.php"); ?>
  <div class='wrapper'>
    <div id="page-wrapper" >
      <div id="page-inner">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <h2>Modificar Estado</h2>
            </div>
          </div>
          <div class="row">
           <?php
    if(isset($_POST['submit']))
    {
require("estado_detalle.php");
      ?>

      <div class="alert alert-success alert-dismissable" id="reg">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Bien Hecho!</strong> La modificación se ha hecho con éxito.
</div>

<script type="text/javascript">
  setTimeout(function(){
$('#reg').fadeOut();
  },4000);
</script>

   <?php }
  ?>
          <form id='form_reset' method='POST' action='estado_restablecer.php'>
          <input type="hidden" name="i" value="<?php echo "$estado";  ?>"/>
            <div class="col-md-12">
              <h3>Datos del Estado</h3>
              <div class="col-md-4">
                <label for='inRol'>ID</label>
                <input type="text" class="form-control"  name="id" value="<?php echo "$estado";  ?>" placeholder="Estado"/>
                <br/>
                <label for='inRol'>Nombre</label>
                <input type="text" class="form-control"  name="nombre" autofocus placeholder="Nombre"/>
                <br>
              <br><br><br><br><br><br><br><br><br><br><br><br>
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-default" type='submit' value='Regresar' formaction="estado_general.php"/>Regresar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(isset($_POST['submit'])){
      include ('estado_detalle.php');
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
  <!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>