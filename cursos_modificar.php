<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
  require_once("conexion.php");
  $grupo = $_POST['grupo'];

  $query = "SELECT id_curso, c_nombre FROM curso";
  $result = mysql_query($query);

  $query = "SELECT id_empleado, em_nombres, em_apaterno, em_amaterno FROM empleado WHERE id_puesto = 2";
  $result2 = mysql_query($query);

  $query = "SELECT c.id_curso, gr.det_fecha_inicio, gr.det_fecha_fin, gr.det_sede, c.c_nombre, c.c_duracion, em.em_nombres, em.em_apaterno, em.em_amaterno, em.id_empleado
  FROM grupo AS gr INNER JOIN curso AS c ON gr.id_curso = c.id_curso INNER JOIN empleado AS em ON gr.id_empleado = em.id_empleado
  WHERE gr.id_grupo = '$grupo'";
  $result3 = mysql_query($query);
  $row3 = mysql_fetch_array($result3);
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
            <div class="panel-body">
              <h2>Modificar Curso</h2>
            </div>
          </div>
        </div>
        <form method='POST' action='cursos_editar.php'>
          <input type='hidden' value='<?=$grupo?>' name='grupo'>
          <div class="row">
            <div class="col-md-6">
              <div class="panel-body">
                <h4>Seleccionar curso</h4>
                <select name='curso' style="width:100%;">
                  <option selected onclick = 'habilita()' value='otro'>Otro</option>
                  <?php while($row = mysql_fetch_array($result)):
                    if($row['id_curso'] == $row3['id_curso']){$selected='selected';}else{$selected='';}?>
                    <option value='<?=$row['id_curso']?>' <?=$selected?> onclick = 'deshabilita()'><?=$row['c_nombre']?></option>
                  <?php endwhile;?>
                </select>
                <h4>Nombre del nuevo Curso</h4>
                <input type='text' name='nombre' required id='nombre' disabled style="width:100%;">
                <h4>Horas del Curso</h4>
                <input type='number' name='hora' id='hora' required style="width:100%;" value='<?=$row3['c_duracion']?>'>
              </div>
            </div>
            <script language="JavaScript">
              function habilita(){
                document.getElementById('nombre').disabled = false;
              }
              function deshabilita(){
                document.getElementById('nombre').disabled = true;
              }
            </script>
            <div class="col-md-6">
              <div class="panel-body">
                <h4>Instructor</h4>
                <select name='empleado' style="width:100%;">
                  <?php while($row = mysql_fetch_array($result2)):
                    if($row['id_empleado'] == $row3['id_empleado']){$selected='selected';}else{$selected='';}?>
                    <option value='<?=$row['id_empleado']?>'><?=$row['em_nombres']?> <?=$row['em_apaterno']?> <?=$row['em_amaterno']?></option>
                  <?php endwhile;?>
                </select>
                <h4>Sede</h4>
                <input type='text' name='sede' required style="width:100%;" value='<?=$row3['det_sede']?>'>
                <table style="width:100%;">
                  <tr>
                    <td style="width:50%;"><h4>Fecha de Inicio</h4></td>
                    <td style="width:50%;"><h4>Fecha Fin</h4></td>
                  </tr><tr>
                    <td><input type="date" required value='<?=$row3['det_fecha_inicio']?>' min='<?=date('Y-m-d')?>' name='inicio'></td>
                    <td><input type="date" required value='<?=$row3['det_fecha_fin']?>' min='<?=date('Y-m-d')?>' name='fin'></td>
                  </tr>
                </table><br>
              </div>
            </div>
          </div>
        <div class="col-md-6" align='right'>
          <input type="submit" class='btn btn-success' value="Modificar"/>
        </div>
        </form>
        <div class='row'>
          <div class="col-md-6 col-sm-6 col-xs-6">
            <form action='cursos_administrar.php' method='GET'>
              <input type='hidden' value='<?=$grupo?>' name='grupo'>
              <input type='submit' value='Regresar' class="btn btn-negro">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php mysql_close($dbConn);?>
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