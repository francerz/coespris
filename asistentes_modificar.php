<?php
session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
$asistente = $_POST['asistente'];
$grupo = $_POST['grupo'];
require("conexion.php");
$result = mysql_query("SELECT a.* FROM asistentes a WHERE a.id_asistente = '$asistente'");
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
        <form method='POST' action='asistentes_editar.php'>
          <div class="row">
            <div class="col-md-12">
              <h2>Modificar Asistente</h2>
            </div>
            <div class="col-md-6">
              <input type='hidden' name='id' value='<?=$asistente?>'/>
              <input type='hidden' name='grupo' value='<?=$grupo?>'/>
              <label for='inNombre'>Nombre</label>
              <input type="text" class="form-control" id='inNombre' name="nombre" value="<?=$row['as_nombre']?>" required placeholder="Nombre"/>
              <br/>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12" align='center'>
              <input class='btn btn-warning' type="submit" name="submit"  value="Guardar">
              <button class="btn btn-negro" type='submit' value='Regresar' formmethod="GET" formaction="cursos_administrar.php"/>Regresar</button>
            </div>
          </div>
        </form>
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