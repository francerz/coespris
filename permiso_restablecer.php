<?php

session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$permiso = $_POST['i'];

require_once("conexion.php");
$title="Modificar Permiso";

$result = mysql_query("SELECT per.* FROM permiso per WHERE per.id_permiso = '$permiso'");
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
              <h2>Modificar Permiso</h2>
            </div>
          </div>
          <div class="row">
          <form id='form_reset' method='POST' action='permiso_detalle.php'>
            <div class="col-md-12">
              <h3>Datos del Permiso</h3>
                <div class="col-md-4">
                <label for='inEmpleado'>Nombre permiso</label>
                <input type="text" class="form-control" name="per_nombre" tabindex="1" autofocus value="<?=$row['per_nombre']?>"  placeholder="Nombre del Permiso"/>
                <br>
              </div>
              <div class="col-md-4">
                <label for='inEmpleado'>Nombre archivo</label>
                <input type="text" class="form-control" name="per_archivo" tabindex="2" autofocus value="<?=$row['per_archivo']?>" placeholder="Nombre del Archivo"/>
                <br>
              </div>

              <br><br><br><br><br><br><br><br><br><br><br><br>
               <div align="right">
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit" tabindex="3"  value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' tabindex="4" formaction="permiso_general.php"/>Regresar</button>
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
      include ('permiso_detalle.php');
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