<?php
    session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$query = "SELECT * FROM colonia cl INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos INNER JOIN localidad lc ON cl.id_localidad = lc.id_localidad";
$result = mysql_query($query,$dbConn);
$title="Consulta Colonia";
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
            <h2>Colonia</h2>
            <div class="table-responsive">
              <form action="colonia_restablecer.php" method='POST'>
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Codigo Postal</th>
                  <th>Localidad</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
              <?php while($row = mysql_fetch_array($result)):?>
                <?php $id = $row['id_colonia'];?>
                <tr class="odd gradeX">
                  <td><?=$row['cl_nombre']?></td>
                  <td><?=$row['cp_cod_pos']?></td>
                  <td><?=$row['lc_nombre']?></td>
                  <td><button type='submit' name='i' value='<?=$id?>' class='btn btn-warning btn-circle'><i class="glyphicon glyphicon-pencil"></i></button></td>
                </tr>    
              <?php endwhile; ?>
              </tbody>
              </table>
              </form>
            </div>
          </div>
        </div>
        <form>
          <button class="btn btn-default" type='submit' value='Regresar' formaction="catalogo_menu.php"/>Regresar</button>
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