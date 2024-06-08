<?php
$salario = $_POST['i'];
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$title="Modificar Salario Minimo";

$result = mysql_query("SELECT sm.* FROM salario_minimo sm WHERE sm.id_salario_minimo = '$salario'");
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
              <h2>Modificar salario mínimo</h2>
            </div>
          </div>
          <div class="row">
       
          <form id='form_reset' method='POST' action='salario_minimo_detalle.php'>
            <input type="hidden" name="i" value="<?php echo "$salario";  ?>"/>
            <div class="col-md-12">
              <h3>Datos del salario mínimo</h3>
                <div class="col-md-4">
     
                <label for='inEmpleado'>Importe</label>
                <input type="text" class="form-control" name="importe" autofocus value="<?=$row['sm_importe']?>" placeholder="Importe"/>
                <br/>
                <label for='inEmpleado'>Año de Vigencia</label>
                <input class="form-control" type="date" max='<?=date('Y-m-d')?>' name="vigencia" autofocus value="<?=$row['sm_anio_vigencia']?>" placeholder="aaaa-mm-dd"/>
                <br>
              </div>
              <br><br><br><br><br><br><br><br><br><br><br><br>
              <div align="right">
                <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
                <button class="btn btn-negro" type='submit' value='Regresar' formaction="salario_minimo_general.php"/>Regresar</button>
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
      include ('salario_minimo_detalle.php');
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