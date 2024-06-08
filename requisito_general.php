<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$id = $_POST['id'];

if (isset($_POST['guardar'])) {
  $requisito = $_POST['requisito'];
  $cantidad = $_POST['cantidad'];
  mysql_query("INSERT INTO requisito_servicio VALUES ('$requisito','$id','$cantidad')");?>
  <script type="text/javascript">
    alert("Requisito Guardado");
  </script>
<?php }

if (isset($_POST['nuevo'])) {
  $nombre = $_POST['nombre'];
  $cantidad = $_POST['cantidad'];
  mysql_query("INSERT INTO requisito VALUES ('','$nombre')");
  $requisito = mysql_insert_id($dbConn);
  mysql_query("INSERT INTO requisito_servicio VALUES ('$requisito','$id','$cantidad')");?>
  <script type="text/javascript">
    alert("Requisito Guardado");
  </script>
<?php }

if (isset($_POST['eliminar'])) {
  $requisito = $_POST['requisito'];
  mysql_query("DELETE FROM requisito_servicio WHERE id_requisito = '$requisito' AND id_servicio = '$id'");?>
  <script type="text/javascript">
    alert("Requisito Eliminado");
  </script>
<?php }

$query = "SELECT * FROM requisito";
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
              <h2>Requisitos</h2>
            </div>
          </div>
          <form action="" method="POST">
            <input type='hidden' value='<?=$id?>' name='id'/>
            <div class="col-md-5">
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                      <tr>
                         <th width='80%'>Nombre</th>
                         <th width='20%'>Seleccionar</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while($row = mysql_fetch_array($result)):?>
                      <tr class="odd gradeX">
                          <td><?=$row['rq_nombre']?></td>
                          <td style="text-align:center"><input type='radio' value='<?=$row['id_requisito']?>' name='requisito'/></td>
                      </tr>
                    <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
                <h4>Cantidad</h4>
                <input type='number' name='cantidad' min="1" class="form-control" required/><br>
                <div align='right'><input type='submit' value='Guardar' name='guardar' class="btn btn-primary"></div>
              </div>
            </div>
          </form>
          <form action='' method='POST'>
            <input type='hidden' value='<?=$id?>' name='id'/>
            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3>Nuevo</h3>
                </div>
                <div class="panel-body">                
                  <h4>Nombre</h4>
                  <input type='text' name='nombre' class="form-control" required>
                  <h4>Cantidad</h4>
                  <input type='number' name='cantidad' class="form-control" required><br>
                  <div align='right'><input type='submit' name='nuevo' class='btn btn-success' value='Nuevo'></div>
                </div>
              </div>
            </div>
          </form>
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">
            <?php $result = mysql_query("SELECT rsv.rsv_cantidad, rq.rq_nombre, rsv.id_requisito FROM requisito_servicio AS rsv INNER JOIN requisito AS rq ON rsv.id_requisito = rq.id_requisito WHERE rsv.id_servicio = '$id'");?>
                <h3>Requisitos de Solicitud</h3>
              </div>
              <div class="panel-body">
                <table class='table'>
                  <thead>
                    <tr>
                      <th>Requisito</th>
                      <th colspan="2">Cantidad</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysql_fetch_array($result)):?>
                    <form action='' method='POST'>
                      <input value='<?=$id?>' name='id' type='hidden'>
                      <input value='<?=$row['id_requisito']?>' name='requisito' type='hidden'>
                      <tr>
                        <td><?=$row['rq_nombre']?></td>
                        <td><?=$row['rsv_cantidad']?></td>
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