<?php
  session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
  $selected = '';
  $curso = $_POST['i'];
  $regresar_a = $_POST['regresar_a'];
  if (isset($_POST['s'])) {
    $servicio = $_POST['s'];
  }
  require("conexion.php");
  $result = mysql_query("SELECT * FROM curso c inner join empleado e on c.id_curso = e.id_empleado");
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
        <div class="row">
          <div class="col-md-12">
            <h2>Modificar Curso</h2>
          </div>
        </div>
        <div class="row">
        <form method='POST' action=''>
          <div class="col-md-6">
            <input type = 'hidden' value='<?=$regresar_a?>' name = 'regresar_a'>
            <input type='hidden' name='i' value='<?=$curso?>'/>
            <?php if (isset($_POST['s'])) {?>
              <input type='hidden' name='s' value='<?=$servicio?>'/>
            <?php }?>
            <label for='inNombre'>Nombre</label>
            <input type="text" class="form-control" id='inNombre' name="nombre" value="<?=$row['c_nombre']?>" required placeholder="Nombre"/>
            <br/>
            <label for='inDuracion'>Duracion</label>
            <input type="text" class="form-control" id='inDuracion' name="duracion" value="<?=$row['c_duracion']?>" required placeholder="Duracion"/>
            <br/>
            <label for='inEmpleado'>Empleado</label>
            <input type="text" class="form-control" id='inEmpleado' name="empleado" value="<?=$row['em_nombres']?>" required placeholder="Empleado"/>
            <br/>
            <input class='btn btn-warning' type="submit" name="submit"  value="Guardar Cliente">
              <button class="btn btn-default" type='submit' value='Regresar' formaction="curso_general.php"/>Regresar</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(isset($_POST['submit'])){
      include ('curso_editar.php');
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