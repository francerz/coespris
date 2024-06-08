<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$id = $_POST['id'];

if (isset($_POST['guardar'])) {
  $dato_sec = $_POST['dato_sec'];
  mysql_query("INSERT INTO dsa_servicio VALUES ('$dato_sec','$id')");?>
  <script type="text/javascript">
    alert("Dato Secundario Guardado");
  </script>
<?php }

if (isset($_POST['nuevo'])) {
  $nombre = $_POST['nombre'];
  $tipo = $_POST['tipo'];
  $clave = $_POST['clave'];
  $extra = $_POST['extra'];
  mysql_query("INSERT INTO datos_secundarios_autorizacion VALUES ('','$nombre','$tipo','$extra','$clave')");
  $dato_sec = mysql_insert_id($dbConn);
  mysql_query("INSERT INTO dsa_servicio VALUES ('$dato_sec','$id')");?>
  <script type="text/javascript">
    alert("Dato Secundario Guardado");
  </script>
<?php }

if (isset($_POST['eliminar'])) {
  $dato_sec = $_POST['dato_sec'];
  mysql_query("DELETE FROM dsa_servicio WHERE id_dat_sec_aut = '$dato_sec' AND id_servicio = '$id'");?>
  <script type="text/javascript">
    alert("Dato Secundario Eliminado");
  </script>
<?php }

$query = "SELECT * FROM datos_secundarios_autorizacion";
$result = mysql_query($query,$dbConn);
?>

<!DOCTYPE HTML>
<html lang='es'> 
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
              <h2>Datos Secundarios de Autorizacion</h2>
            </div>
          </div>
          <form action="" method="POST">
            <input type='hidden' value='<?=$id?>' name='id'/>
            <div class="col-md-12">
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                      <tr>
                         <th>Nombre</th>
                         <th>Tipo</th>
                         <th>Extras</th>
                         <th>Clave</th>
                         <th>Seleccionar</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while($row = mysql_fetch_array($result)):?>
                      <tr class="odd gradeX">
                          <td><?=$row['dsa_nombre']?></td>
                          <td><?=$row['dsa_tipo_dato']?></td>
                          <td><?=$row['dsa_extras']?></td>
                          <td><?=$row['dsa_clave']?></td>
                          <td style="text-align:center"><input type='radio' value='<?=$row['id_dat_sec_autorizacion']?>' name='dato_sec'/></td>
                      </tr>
                    <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
                <div align='right'><input type='submit' value='Guardar' name='guardar' class="btn btn-primary"></div>
              </div>
            </div>
          </form>
          <form action='' method='POST'>
            <input type='hidden' value='<?=$id?>' name='id'/>
            <div class="col-md-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3>Nuevo</h3>
                </div>
                <div class="panel-body">                
                  <h4>Nombre</h4>
                  <input type='text' name='nombre' class="form-control" required>
                  <div class="col-md-6">
                    <h4>Tipo</h4>
                    <select name='tipo' class='form-control' required>
                      <option value='texto'>Texto</option>
                      <option value='int'>Int</option>
                      <option value='radio'>Radio</option>
                      <option value='boolean'>Boolean</option>
                      <option value='fecha'>Fecha</option>
                      <option value='lista'>Lista</option>
                    </select><br>
                  </div>
                  <div class="col-md-6">
                    <h4>Clave</h4>
                    <input type='text' name='clave' class="form-control" required><br>
                  </div>
                  <h4>Extras</h4>
                  <textarea class="form-control" name='extra' style="max-width: 100%;" required>required</textarea>
                  <br>
                  <div align='right'><input type='submit' name='nuevo' class='btn btn-success' value='Nuevo'></div>
                </div>
              </div>
            </div>
          </form>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
            <?php $result = mysql_query("SELECT dsa.dsa_nombre, dsa.dsa_tipo_dato, dsa.id_dat_sec_autorizacion FROM datos_secundarios_autorizacion AS dsa INNER JOIN dsa_servicio AS ds ON dsa.id_dat_sec_autorizacion = ds.id_dat_sec_aut WHERE ds.id_servicio = '$id'");?>
                <h3>Datos de Solicitud</h3>
              </div>
              <div class="panel-body">
                <table class='table'>
                  <thead>
                    <tr>
                      <th>Dato Secundario</th>
                      <th colspan="2">Tipo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysql_fetch_array($result)):?>
                    <form action='' method='POST'>
                      <input value='<?=$id?>' name='id' type='hidden'>
                      <input value='<?=$row['id_dat_sec_sol']?>' name='dato_sec' type='hidden'>
                      <tr>
                        <td><?=$row['dsa_nombre']?></td>
                        <td><?=$row['dsa_tipo_dato']?></td>
                        <td><button class='btn btn-default btn-circle' style='height:30px;width:40px;' type='submit' name='eliminar'><i class="glyphicon glyphicon-minus fa-1x"></i></button></td>
                      </tr>
                    </form>
                    <?php endwhile;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" align='right'>
            <div class="panel-body">
              <form action='servicio_general.php' method='POST'>
                <input type='hidden' name='id' value='<?=$id?>'>
                <button class="btn btn-negro" type='submit' value='Regresar'>Regresar</button>
              </form>
            </div>
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