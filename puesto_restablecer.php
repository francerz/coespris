<?php
$puesto = $_POST['i'];
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$title="Modificar Puesto";

$result = mysql_query("SELECT pu.* FROM puesto pu WHERE pu.id_puesto = '$puesto'");
$row = mysql_fetch_array($result);
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
              <h2>Modificar Puesto</h2>
            </div>
          </div>
          <div class="row">
          <form id='form_reset' method='POST' action='puesto_detalle.php'>
            <div class="col-md-12">
              <h3>Datos del Puesto</h3>
                <div class="col-md-4">
                <br/>
                <label for='inEmpleado'>Nombre</label>
                <input type="text" class="form-control" name="p_nombre" required autofocus value="<?=$row['pu_nombre']?>"  placeholder="Nombre Puesto"/>
                <br>
              </div>
              <br><br><br><br><br><br><br><br><br><br><br><br>
              <div align="right">
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' formaction="puesto_general.php"/>Regresar</button>
             </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(isset($_POST['submit'])){
      include ('puesto_detalle.php');
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