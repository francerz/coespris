<?php

session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
require_once("conexion.php");

$query = "SELECT * FROM cliente ct INNER JOIN colonia cl ON ct.id_colonia = cl.id_colonia INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos";
$result = mysql_query($query,$dbConn);?>
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
            <h2>Clientes</h2>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>A. Paterno</th>
                  <th>A. Materno</th>
                  <th>Calle</th>
                  <th>Número</th>
                  <th>Código Postal</th>
                  <th>Colonia</th>
                  <th>Datos Fiscales</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
              <?php while($row = mysql_fetch_array($result)):
                $id = $row['id_cliente'];?>
                <tr class="odd gradeX">
                <form action='' method='POST'>
                  <input type='hidden' name='i' value='<?=$id?>'/>
                  <input type='hidden' name='regresar_a' value='cliente_general.php'/>
                  <td><?=$row['ct_nombre']?></td>
                  <td><?=$row['ct_apaterno']?></td>
                  <td><?=$row['ct_amaterno']?></td>
                  <td><?=$row['ct_calle']?></td>
                  <td><?=$row['ct_numero']?></td>
                  <td><?=$row['cp_cod_pos']?></td>
                  <td><?=$row['cl_nombre']?></td>
                  <td><button type='submit' class='btn btn-danger' formaction="cliente_detalle.php"><i class="glyphicon glyphicon-user"></i>  Ver</button></td>
                  <td><button type='submit' class='btn btn-warning btn-circle' formaction="cliente_modificar.php"><i class="glyphicon glyphicon-pencil"></i></button></td>
                </form>
                </tr>    
              <?php endwhile; ?>
              </tbody>
              </table>
            </div>
          </div>
        </div>
        <div align='right'>
          <form>
            <button class="btn btn-negro" type='submit' value='Regresar' formaction="catalogo_menu.php"/>Regresar</button>
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