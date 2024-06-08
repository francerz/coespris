<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$query = "SELECT * FROM estado";
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
            <h2>Estados</h2>
            <div class="table-responsive">
              <table class="table table-bordered table-responsive">
                <thead>
                  <?php
                  $cont = 0;
                  while($row = mysql_fetch_array($result)):
                    $id = $row['id_estado'];
                    if($cont == 0){?><tr><?php }?>
                      <td><a href="estado_general.php?estado=<?=$row['id_estado']?>&nom=<?=$row['es_nombre']?>"><?=$row['es_nombre']?></a></td>
                    <?php if($cont == 7){?></tr>
                    <?php 
                    $cont = 0;
                    }else{ $cont++; }?>
                  <?php endwhile; ?>
                </thead>
              </table>
            </div>
          </div>
        </div>
        <?php if(isset($_GET['estado'])){
          $result = mysql_query("SELECT mp.mp_nombre, mp.id_municipio FROM estado AS es INNER JOIN municipio AS mp ON es.id_estado = mp.id_estado
                                    WHERE es.id_estado = {$_GET['estado']}",$dbConn);?>
          <div class="row">
            <div class="col-md-12">
              <h3><?=$_GET['nom']?></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <table class='table'>
                <thead>
                  <tr>
                    <th><h4>Municipios</h4></th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($row = mysql_fetch_array($result)):?>
                    <tr>
                      <td><a href="estado_general.php?estado=<?=$_GET['estado']?>&nom=<?=$_GET['nom']?>&mun=<?=$row['id_municipio']?>"><?=$row['mp_nombre']?></a></td>
                    </tr>
                  <?php endwhile;?>
                  <form method='POST' action='municipio_insertar.php'>
                    <input type='hidden' value='<?=$_GET['estado']?>' name='estado'>
                    <input type='hidden' value='<?=$_GET['nom']?>' name='nom'>
                    <tr>
                      <td><input type='text' required name='nombre'></td>
                    </tr>
                    <tr align='right'>
                      <td><input class="btn btn-success" value='Nuevo' type='submit'></td>
                    </tr>
                  </form>
                </tbody>
              </table>
            </div>
            <?php if(isset($_GET['mun'])){
              $result = mysql_query("SELECT lc.lc_nombre, lc.id_localidad FROM municipio AS mp INNER JOIN localidad AS lc ON mp.id_municipio = lc.id_municipio
                                    WHERE mp.id_municipio = {$_GET['mun']}",$dbConn);?>
              <div class="col-md-1">
              </div>
              <div class="col-md-2">
                <table class='table'>
                  <thead>
                    <tr>
                      <th><h4>Localidades</h4></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysql_fetch_array($result)):?>
                      <tr>
                        <td><a href="estado_general.php?estado=<?=$_GET['estado']?>&nom=<?=$_GET['nom']?>&mun=<?=$_GET['mun']?>&loc=<?=$row['id_localidad']?>"><?=$row['lc_nombre']?></a></td>
                      </tr>
                    <?php endwhile;?>
                    <form method='POST' action='localidad_insertar.php'>
                      <input type='hidden' value='<?=$_GET['estado']?>' name='estado'>
                      <input type='hidden' value='<?=$_GET['nom']?>' name='nom'>
                      <input type='hidden' value='<?=$_GET['mun']?>' name='mun'>
                      <tr>
                        <td><input type='text' required name='nombre'></td>
                      </tr>
                      <tr align='right'>
                        <td><input class="btn btn-success" value='Nuevo' type='submit'></td>
                      </tr>
                    </form>
                  </tbody>
                </table>
              </div>
              <?php if(isset($_GET['loc'])){ 
                $result = mysql_query("SELECT cl.cl_nombre, cl.id_colonia, cp.cp_cod_pos FROM localidad AS lc INNER JOIN colonia AS cl ON lc.id_localidad = cl.id_localidad
                                    INNER JOIN codigo_postal AS cp ON cl.id_cod_pos = cp.id_cod_pos WHERE lc.id_localidad = {$_GET['loc']}",$dbConn);?>
                <div class="col-md-1">
                </div>
                <div class="col-md-3">
                  <table class='table'>
                    <thead>
                      <tr>
                        <th><h4>Colonias</h4></th>
                        <th><h4>Codigo Postal</h4></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($row = mysql_fetch_array($result)):?>
                        <tr>
                          <td><?=$row['cl_nombre']?></td>
                          <td><?=$row['cp_cod_pos']?></td>
                        </tr>
                      <?php endwhile;?>
                      <form method='POST' action='colonia_insertar.php'>
                        <input type='hidden' value='<?=$_GET['estado']?>' name='estado'>
                        <input type='hidden' value='<?=$_GET['nom']?>' name='nom'>
                        <input type='hidden' value='<?=$_GET['mun']?>' name='mun'>
                        <input type='hidden' value='<?=$_GET['loc']?>' name='loc'>
                        <tr>
                          <td><input type='text' required name='nombre'></td>
                          <td><input type='text' required name='codigo'></td>
                        </tr>
                        <tr align='right'>
                          <td></td>
                          <td><input class="btn btn-success" value='Nuevo' type='submit'></td>
                        </tr>
                      </form>
                    </tbody>
                  </table>
                </div>
            <?php }
            }?>
          </div>
        <?php } ?>
        <div class="row" align='right'>
          <div class="col-md-12">
            <form>
              <button class="btn btn-negro" type='submit' formaction="catalogo_menu.php"/>Regresar</button>
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