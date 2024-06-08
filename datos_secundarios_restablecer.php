<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$dato = $_POST['i'];
$title="Modificar Datos Secundarios Solicitud";
session_start();
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
              <h2>Modificar Datos Secundarios de la Solicitud</h2>
            </div>
          </div>
          <div class="row">
          <form id='form_reset' method='POST' action='datos_secundarios_solicitud_detalle.php'>
            <div class="col-md-12">
              <h3>Datos del Dato Secundario</h3>
                <div class="col-md-4">
                <label for='inID'>ID</label>
                <input readonly type="text" class="form-control"  name="id" value="<?php echo "$dato";?>"/>
                <br/>
                <label for='inEmpleado'>Nombre</label>
                <input type="text" class="form-control"  name="dato"  placeholder="Nombre"/>
                <br>
              </div>
                <div class="col-md-4">
                <label for='inID'>Tipo de Dato</label>
                <input type="text" class="form-control"  name="tipo"  placeholder="Tipo de Dato"/>
                <br/>
                <label for='inEmpleado'>Extras</label>
                <input type="text" class="form-control"  name="extra"  placeholder="Extras"/>
                <br>
              </div>
              <br><br><br><br><br><br><br><br><br><br><br><br>
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-default" type='submit' value='Regresar' formaction="datos_secundarios_solicitud_general.php"/>Regresar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(isset($_POST['submit'])){
      include ('requisito_detalle.php');
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