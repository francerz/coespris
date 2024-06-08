<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$servicio = $_POST['i'];
$title="Modificar servicio";

$result = mysql_query("SELECT sr.* FROM servicio sr WHERE sr.id_servicio = '$servicio'");
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
              <h2>Modificar servicio</h2>
            </div>
          </div>
          <div class="row">
          <form id='form_reset' method='POST' action='servicio_detalle.php'>
          <input type="hidden" name="i" value="<?php echo "$servicio"; ?>"/>
            <div class="col-md-12">
            <br><br>
                <div class="col-md-4">
                <label for='inID'>ID</label>
                <input readonly type="text" class="form-control"  name="i" value="<?php echo "$servicio";?>"/>
                <br/>
                <label for='inEmpleado'>Nombre</label>
                <textarea  type="text" rows = "5" cols="80" name="nombre" autofocus value="<?=$row['sr_nombre']?>"><?=$row['sr_nombre']?></textarea>
                <br/>
                <label for='inEmpleado'>Cantidad de salarios mínimos</label>
                <input type="text" class="form-control"  name="cantmin" autofocus value="<?=$row['sr_cant_sal_min']?>" placeholder="cantidad de salarios mínimos"/>
                <br>
                </div>
                 <div class="col-md-4">
                <label for='inRol'>Tipo de servicio</label>
                <br/>
                <select class="form-control" name="tipo" tabindex="6" class="select">
                  <option value="asesoria">Asesoría</option>
                  <option value="opinion">Opinión</option>
                  <option value="autorizacion">Autorización</option>
                  <option value="visita">Visita</option>
                  <option value="curso">Curso</option>
                  <option value="constancia">Constancia</option>
                </select>
                <br/><br>
              </div>
              <br><br><br><br><br><br><br><br><br><br><br><br>
              <div class="col-md-12">
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' formaction="servicio_general.php"/>Regresar</button>
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
      include ('servicio_detalle.php');
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