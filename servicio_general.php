<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
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
        <?php if(isset($_POST['id'])){
          $id = $_POST['id'];

          if (isset($_POST['eliminarR'])) {
            $requisito = $_POST['requisito'];
            mysql_query("DELETE FROM requisito_servicio WHERE id_requisito = '$requisito' AND id_servicio = '$id'");?>
            <script type="text/javascript">
              alert("Requisito Eliminado");
            </script>
          <?php }

          $row = mysql_fetch_array(mysql_query("SELECT sm_importe FROM salario_minimo WHERE vigente = 1"));
          $salario = $row['sm_importe'];
          $row = mysql_fetch_array(mysql_query("SELECT sr.sr_nombre, sr.sr_cant_sal_min, sr.sr_tipo, sr.sr_imagen
          FROM servicio AS sr LEFT JOIN formato AS fr ON sr.id_formato_solicitud = fr.id_formato WHERE sr.id_servicio = '$id'"));
          $tipo = $row['sr_tipo']; ?>
          <div class="row">
            <div class="col-md-12">
              <h2>Servicio</h2>
              <h4><?=$row['sr_nombre']?></h4>
            </div>
          </div>
          <div class="row">
            <?php if($tipo == "autorizacion"){?><div class="col-md-3"><?php }else{?><div class="col-md-4"><?php }?>
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <form action='servicio_modificar.php' method='POST'>
                    <input value='<?=$id?>' name='id' type='hidden'>
                    <button type='submit' class='btn btn-default btn-circle'><i class="glyphicon glyphicon-pencil"></i></button>
                    Datos del Servicio
                  </form>
                </div>
                <div class="panel-body">
                  <label>Cantidad de Salarios</label><br>
                  <?=$row['sr_cant_sal_min']?><br><br>
                  <label>Costo Total Aproximado</label><br>
                  <?=$row['sr_cant_sal_min']*$id?><br><br>
                  <label>Tipo de Servicio</label><br>
                  <?=$row['sr_tipo']?><br><br>
                  <label>Imagen del Servicio</label><br>
                  <i class='<?=$row['sr_imagen']?> fa-4x'></i>
                </div>
              </div>
            </div>
            <?php if($tipo == "autorizacion"){?><div class="col-md-3"><?php }else{?><div class="col-md-4"><?php }
            $result = mysql_query("SELECT rsv.rsv_cantidad, rq.rq_nombre, rsv.id_requisito FROM requisito_servicio AS rsv INNER JOIN requisito AS rq ON rsv.id_requisito = rq.id_requisito WHERE rsv.id_servicio = '$id'");?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <form action='requisito_general.php' method='POST'>
                    <input value='<?=$id?>' name='id' type='hidden'>
                    <button type='submit' class='btn btn-success btn-circle'><i class="glyphicon glyphicon-plus"></i></button>
                    Requisitos
                  </form>
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
                          <td><button class='btn btn-default btn-circle' name='eliminarR' style='height:30px;width:40px;' type='submit'><i class="glyphicon glyphicon-minus fa-1x"></i></button></td>
                        </tr>
                      </form>
                      <?php endwhile;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php if($tipo == "autorizacion"){?><div class="col-md-3"><?php }else{?><div class="col-md-4"><?php }
            $result = mysql_query("SELECT dss.id_dat_sec_sol, dss.dss_nombre, dss.dss_tipo_dato FROM dss_servicio AS ds INNER JOIN datos_secundarios_solicitud AS dss ON ds.id_dat_sec_sol = dss.id_dat_sec_sol WHERE ds.id_servicio = '$id'");?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <form action='dat_sec_sol_general.php' method='POST'>
                    <input value='<?=$id?>' name='id' type='hidden'>
                    <button type='submit' class='btn btn-success btn-circle'><i class="glyphicon glyphicon-plus"></i></button>
                    Datos Secundarios Solicitud
                  </form>
                </div>
                <div class="panel-body">
                  <table class='table'>
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th colspan="2">Tipo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($row = mysql_fetch_array($result)):?>
                      <form action='dat_sec_sol_modificar.php' method='POST'>
                        <input value='<?=$id?>' name='id' type='hidden'>
                        <input value='<?=$row['id_dat_sec_sol']?>' name='dato_sec' type='hidden'>
                        <tr>
                          <td><?=$row['dss_nombre']?></td>
                          <td><?=$row['dss_tipo_dato']?></td>
                          <td><button class='btn btn-default btn-circle' style='height:30px;width:40px;' type='submit'><i class="glyphicon glyphicon-pencil fa-1x"></i></button></td>
                        </tr>
                      </form>
                      <?php endwhile;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php if($tipo == "autorizacion"){
              $result = mysql_query("SELECT dsa.id_dat_sec_autorizacion, dsa.dsa_nombre, dsa.dsa_tipo_dato FROM dsa_servicio AS ds INNER JOIN datos_secundarios_autorizacion AS dsa ON ds.id_dat_sec_aut = dsa.id_dat_sec_autorizacion WHERE ds.id_servicio = '$id'");?>
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <form action='dat_sec_aut_general.php' method='POST'>
                      <input value='<?=$id?>' name='id' type='hidden'>
                      <button type='submit' class='btn btn-success btn-circle'><i class="glyphicon glyphicon-plus"></i></button>
                      Datos Secundarios Autorizacion
                    </form>
                  </div>
                  <div class="panel-body">
                    <table class='table'>
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th colspan="2">Tipo</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while($row = mysql_fetch_array($result)):?>
                        <form action='dat_sec_aut_modificar.php' method='POST'>
                          <input value='<?=$id?>' name='id' type='hidden'>
                          <input value='<?=$row['id_dat_sec_autorizacion']?>' name='dato_sec' type='hidden'>
                          <tr>
                            <td><?=$row['dsa_nombre']?></td>
                            <td><?=$row['dsa_tipo_dato']?></td>
                            <td><button class='btn btn-default btn-circle' style='height:30px;width:40px;' type='submit'><i class="glyphicon glyphicon-pencil fa-1x"></i></button></td>
                          </tr>
                        </form>
                        <?php endwhile;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h3>Formatos</h3>
              <table class='table table-bordered table-hover'>
                <thead>
                  <tr>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Contenido</th>
                    <th>Archivo</th>
                    <th>PDF</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $row = mysql_fetch_array(mysql_query("SELECT fr.* FROM servicio AS sr INNER JOIN formato AS fr ON sr.id_formato_solicitud = fr.id_formato WHERE sr.id_servicio = '$id' AND fr.estatus = 'Habilitado'"));?>
                  <tr>
                    <td><?=$row['fr_tipo']?></td>
                    <td><?=$row['fr_nombre']?></td>
                    <td><?=$row['fr_contenido']?></td>
                    <td><a href="<?=$row['fr_ruta']?>">Descargar</a></td>
                    <td><?=$row['fr_ruta_pdf']?></td>
                    <td>
                      <button type='submit' class='btn btn-default btn-circle'><i class="glyphicon glyphicon-pencil"></i></button>
                      <button type='submit' class='btn btn-success btn-circle'><i class="glyphicon glyphicon-plus"></i></button>
                    </td>
                  </tr>
                  <?php $row = mysql_fetch_array(mysql_query("SELECT fr.* FROM servicio AS sr INNER JOIN formato AS fr ON sr.id_folio_orden = fr.id_formato WHERE sr.id_servicio = '$id' AND fr.estatus = 'Habilitado'"));?>
                  <tr>
                    <td><?=$row['fr_tipo']?></td>
                    <td><?=$row['fr_nombre']?></td>
                    <td><?=$row['fr_contenido']?></td>
                    <td><a href="<?=$row['fr_ruta']?>">Descargar</a></td>
                    <td><?=$row['fr_ruta_pdf']?></td>
                    <td>
                      <button type='submit' class='btn btn-default btn-circle'><i class="glyphicon glyphicon-pencil"></i></button>
                      <button type='submit' class='btn btn-success btn-circle'><i class="glyphicon glyphicon-plus"></i></button>
                    </td>
                  </tr>
                  <?php $row = mysql_fetch_array(mysql_query("SELECT fr.* FROM servicio AS sr INNER JOIN formato AS fr ON sr.id_formato_recibo = fr.id_formato WHERE sr.id_servicio = '$id' AND fr.estatus = 'Habilitado'"));?>
                  <tr>
                    <td><?=$row['fr_tipo']?></td>
                    <td><?=$row['fr_nombre']?></td>
                    <td><?=$row['fr_contenido']?></td>
                    <td><a href="<?=$row['fr_ruta']?>">Descargar</a></td>
                    <td><?=$row['fr_ruta_pdf']?></td>
                    <td>
                      <button type='submit' class='btn btn-default btn-circle'><i class="glyphicon glyphicon-pencil"></i></button>
                      <button type='submit' class='btn btn-success btn-circle'><i class="glyphicon glyphicon-plus"></i></button>
                    </td>
                  </tr>
                  <?php if($tipo == "autorizacion"){
                    $row = mysql_fetch_array(mysql_query("SELECT fr.* FROM servicio AS sr INNER JOIN formato AS fr ON sr.id_formato_autoriza = fr.id_formato WHERE sr.id_servicio = '$id' AND fr.estatus = 'Habilitado'"));?>
                    <tr>
                      <td><?=$row['fr_tipo']?></td>
                      <td><?=$row['fr_nombre']?></td>
                      <td><?=$row['fr_contenido']?></td>
                      <td><a href="<?=$row['fr_ruta']?>">Descargar</a></td>
                      <td><?=$row['fr_ruta_pdf']?></td>
                      <td>
                        <button type='submit' class='btn btn-default btn-circle'><i class="glyphicon glyphicon-pencil"></i></button>
                        <button type='submit' class='btn btn-success btn-circle'><i class="glyphicon glyphicon-plus"></i></button>
                      </td>
                    </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6" align='right'>
              <form>
                <button class="btn btn-success" type='submit' formaction="servicio_general.php"/>Servicios</button>
              </form>
            </div>
            <div class="col-md-6">
              <form>
                <button class="btn btn-negro" type='submit' formaction="catalogo_menu.php"/>Regresar</button>
              </form>
            </div>
          </div>
        <?php }else{
          $row = mysql_fetch_array(mysql_query("SELECT sm_importe FROM salario_minimo WHERE vigente = 1"));
          $salario = $row['sm_importe'];
          $query = "SELECT * FROM servicio";
          $result = mysql_query($query,$dbConn);?>
          <div class="row">
            <div class="col-md-12">
              <h2>Servicios</h2>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Cant. SM</th>
                      <th>Costo</th>
                      <th>Tipo</th>
                      <th>Icono</th>
                      <th>Detalle</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while($row = mysql_fetch_array($result)):?>
                    <tr class="odd gradeX">
                      <td><?=$row['sr_nombre']?></td>
                      <td><?=$row['sr_cant_sal_min']?></td>
                      <td>$<?=$row['sr_cant_sal_min']*$salario?></td>
                      <td><?=$row['sr_tipo']?></td>
                      <td align='center'><i class='<?=$row['sr_imagen']?> fa-3x'></i></td>
                      <td align='center'>
                        <form action='' method='POST'>
                          <?php $id = $row['id_servicio'];?>
                          <input type='hidden' value='<?=$id?>' name='id'>
                          <button type='submit' class='btn btn-warning btn-circle'><i class="glyphicon glyphicon-pencil"></i></button>
                        </form>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class='row'>
            <div align='right' class='col-md-6'>
              <form action='servicio_registrar.php'>
                <button class="btn btn-success" type='submit'/>Nuevo Servicio</button>
              </form>
            </div>
            <div align='right' class='col-md-6'>
              <form>
                <button class="btn btn-negro" type='submit' formaction="catalogo_menu.php"/>Regresar</button>
              </form>
            </div>
          </div>
        <?php } ?>
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
  <script src="assetsßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßßß