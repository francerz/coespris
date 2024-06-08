<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$id = $_POST['id'];
$dato_sec = $_POST['dato_sec'];

if (isset($_POST['guardar'])) {
  $nombre = $_POST['nombre'];
  $tipo = $_POST['tipo'];
  $clave = $_POST['clave'];
  $extra = $_POST['extra'];
  mysql_query("UPDATE datos_secundarios_autorizacion SET dsa_nombre = '$nombre', dsa_tipo_dato = '$tipo', dsa_extras = '$extra', dsa_clave = '$clave' WHERE id_dat_sec_autorizacion = '$dato_sec'");?>
  <script type="text/javascript">
    alert("Dato Secundario Modificado");
  </script>
<?php }

if (isset($_POST['eliminar'])) {
  $dato_sec = $_POST['dato_sec'];
  mysql_query("DELETE FROM datos_secundarios_autorizacion WHERE id_dat_sec_autorizacion = '$dato_sec'");
  mysql_query("DELETE FROM dsa_servicio WHERE id_dat_sec_aut = '$dato_sec'");?>
  <script type="text/javascript">
    alert("Dato Secundario Eliminado");
  </script>
<?php header("Location: servicio_general.php");
}

$query = "SELECT * FROM datos_secundarios_autorizacion WHERE id_dat_sec_autorizacion = '$dato_sec'";
$row = mysql_fetch_array(mysql_query($query,$dbConn));
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
              <h2>Modificar Dato Secundario</h2>
              <form action='' method='POST'>
                <input type='hidden' value='<?=$id?>' name='id'/>
                <input type='hidden' value='<?=$dato_sec?>' name='dato_sec'/>
                <h4>Nombre</h4>
                <input type='text' name='nombre' class="form-control" value='<?=$row['dsa_nombre']?>' required>
                <div class="col-md-6">
                  <h4>Tipo</h4>
                  <select name='tipo' class='form-control' required>
                    <option <?php if($row['dsa_tipo_dato']=='texto'){echo "selected";}?> value='texto'>Texto</option>
                    <option <?php if($row['dsa_tipo_dato']=='int'){echo "selected";}?> value='int'>Int</option>
                    <option <?php if($row['dsa_tipo_dato']=='radio'){echo "selected";}?> value='radio'>Radio</option>
                    <option <?php if($row['dsa_tipo_dato']=='boolean'){echo "selected";}?> value='boolean'>Boolean</option>
                    <option <?php if($row['dsa_tipo_dato']=='fecha'){echo "selected";}?> value='fecha'>Fecha</option>
                    <option <?php if($row['dsa_tipo_dato']=='lista'){echo "selected";}?> value='lista'>Lista</option>
                  </select><br>
                </div>
                <div class="col-md-6">
                  <h4>Clave</h4>
                  <input type='text' name='clave' value='<?=$row['dsa_clave']?>' class="form-control" required><br>
                </div>
                <h4>Extras</h4>
                <textarea class="form-control" name='extra' style="max-width: 100%;" required><?=$row['dsa_extras']?></textarea>
                <br>
                <div align='right' class='col-md-6'><input type='submit' name='guardar' class='btn btn-success' value='Guardar'></div>
              </form>
              <div class="col-md-6">
                <div class="col-md-6">
                  <form action='servicio_general.php' method='POST'>
                    <input type='hidden' name='id' value='<?=$id?>'>
                    <button class="btn btn-negro" type='submit' value='Regresar'>Regresar</button>
                  </form>
                </div>
                <div align='right' class="col-md-6">
                  <form action='' method='POST'>
                    <input type='hidden' name='id' value='<?=$id?>'>
                    <input type='hidden' name='dato_sec' value='<?=$dato_sec?>'>
                    <button class="btn btn-danger" type='submit' name='eliminar'>Eliminar</button>
                  </form>
                </div>
              </div>
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