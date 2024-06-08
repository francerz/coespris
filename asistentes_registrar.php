<?php
session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
require_once("conexion.php");
$grupo = $_POST['grupo'];
$curso = $_POST['curso'];
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
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel-body">
              <h2>Registrar Asistentes</h2>
            </div>
          </div>
        </div>
        <?php if(isset($_POST['solicitud'])){
          $solicitud = $_POST['solicitud'];
          $query = "SELECT s.s_cantidad FROM solicitud AS s WHERE s.id_solicitud = '$solicitud'";
          $result = mysql_query($query);
          $row = mysql_fetch_array($result);?>
          <form method='POST' action='asistentes_insertar.php'>
            <input type='hidden' name='grupo' value='<?=$grupo?>'>
            <input type='hidden' name='solicitud' value='<?=$solicitud?>'>
            <input type='hidden' name='cantidad' value='<?=$row['s_cantidad']?>'>
            <?php for ($i=0; $i < $row['s_cantidad']; $i++) { ?>
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="panel-body">
                    <h4>Cliente N° <strong><?=$i+1?></strong></h4>
                    <div class="col-md-4">
                      <label for='inNombre<?=$i?>'>Nombre</label>
                      <input type="text" class="form-control" id='inNombre<?=$i?>' name="nombre<?=$i?>" required placeholder="Nombre"/>
                    </div>
                  </div>
                </div>
              </div>
            <?php }?>
            <div class="col-md-6 col-sm-6 col-xs-6" align='right'>
              <input type='submit' value='Registrar' class="btn btn-success">
            </div>
          </form>
          <div class="col-md-6 col-sm-6 col-xs-6">
            <form action='cursos_administrar.php' method='GET'>
              <input type='hidden' name='grupo' value='<?=$grupo?>'>
              <input type='submit' value='Regresar' class="btn btn-negro">
            </form>
          </div>
        <?php }else{
          $query = "SELECT ct.ct_nombre, ct.ct_apaterno, ct.ct_amaterno, df.df_razon_social, s.s_cantidad, s.id_solicitud FROM solicitud AS s
          INNER JOIN servicio AS sr ON s.id_servicio = sr.id_servicio INNER JOIN cliente AS ct ON s.id_cliente = ct.id_cliente
          INNER JOIN datos_fiscales AS df ON ct.id_cliente = df.id_cliente INNER JOIN servicio_curso AS sc ON sr.id_servicio = sc.id_servicio
          WHERE sr.sr_tipo = 'curso' AND s.s_estatus = 'C_CURSO' AND sc.id_curso = '$curso'";
          $result = mysql_query($query);?>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="panel-body">
                <h4>Solicitudes Pagadas</h4>
                <table class='table'>
                  <thead>
                    <tr>
                      <th></th>
                      <th>Cliente</th>
                      <th>Datos Fiscales</th>
                      <th>N° Personas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = mysql_fetch_array($result)){ ?>
                    <tr>
                    <form action='' method='POST'>
                      <input type='hidden' value='<?=$row['id_solicitud']?>' name='solicitud'>
                      <input type='hidden' value='<?=$grupo?>' name='grupo'>
                      <input type='hidden' value='<?=$curso?>' name='curso'>
                      <td>
                        <button type='submit' class='btn btn-success btn-circle'><i class="glyphicon glyphicon-ok"></i></button>
                      </td>
                      <td><?=$row['ct_nombre']?> <?=$row['ct_apaterno']?> <?=$row['ct_amaterno']?></td>
                      <td><?=$row['df_razon_social']?></td>
                      <td><?=$row['s_cantidad']?></td>
                    </form>
                    </tr>
                    <?php }?>                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <div class='row'>
          <div class="col-md-12 col-sm-12 col-xs-12" align='right'>
            <div class="panel-body">
              <form action='cursos_administrar.php' method='GET'>
                <input type='hidden' name='grupo' value='<?=$grupo?>'>
                <input type='submit' value='Regresar' class="btn btn-negro">
              </form>
            </div>
          </div>
        </div>
        <?php }
        mysql_close($dbConn);?>
        <hr>
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