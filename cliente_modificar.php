<?php
  session_start();
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
  }
  $selected = '';
  $cliente = $_POST['i'];
  $regresar_a = $_POST['regresar_a'];
  if (isset($_POST['s'])) {
    $servicio = $_POST['s'];
  }
  require("conexion.php");
  $result = mysql_query("SELECT ct.* FROM cliente ct WHERE ct.id_cliente = '$cliente'");
  $result2 = mysql_query("SELECT df.* FROM datos_fiscales df WHERE df.id_cliente = '$cliente'");
  $row = mysql_fetch_array($result);
  $row3 = mysql_fetch_array($result2);
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
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <h2>Modificar Cliente</h2>
            </div>
          </div>
          <div class="row">
          <form method='POST' action=''>
            <div class="col-md-12">
              <h3>Datos del Cliente</h3>
              <div class="col-md-4">
                <input type = 'hidden' value='<?=$regresar_a?>' name = 'regresar_a'>
                <input type='hidden' name='i' value='<?=$cliente?>'/>
                <?php if (isset($_POST['s'])) {?>
                  <input type='hidden' name='s' value='<?=$servicio?>'/>
                <?php }?>
                <label for='inNombre'>Nombre</label>
                <input type="text" class="form-control" id='inNombre' name="nombre" autofocus value="<?=$row['ct_nombre']?>" placeholder="Nombre"/>
                <br/>
                <label for='inCalle'>Calle</label>
                <input type="text" class="form-control" id='inCalle' name="calle" value="<?=$row['ct_calle']?>"  placeholder="Calle"/>
                <br>
              </div>
              <div class="col-md-4">
                <label for='inAMaterno'>Apellido Materno</label>
                <input type="text" class="form-control" id='inAMaterno' name="amaterno" value="<?=$row['ct_amaterno']?>"  placeholder="AMaterno"/>
                <br/>
                <label for='inNum'>Número de domicilio</label>
                <input type="text" class="form-control" id='inNum' name="numero" value="<?=$row['ct_numero']?>"  placeholder="Numero"/>
                <br>
              </div>
              <div class="col-md-4">
                <label for='inAPaterno'>Apellido Paterno</label>
                <input type="text" class="form-control" id='inAPaterno' name="apaterno" value="<?=$row['ct_apaterno']?>" placeholder="APaterno"/>
                <br/>
                <label for='inCodigo'>Colonia</label>
                <select name='colonia' id='inColonia' class="form-control">
                <br>
                <?php
                    $codigo = $row['id_colonia'];
                    $result = mysql_query("SELECT cp.cp_cod_pos, cl.cl_nombre, cl.id_colonia, lc.lc_nombre FROM colonia cl RIGHT JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos INNER JOIN localidad lc ON cl.id_localidad = lc.id_localidad");
                    while($row2 = mysql_fetch_array($result)):
                      if($codigo == $row2['id_colonia']){$selected = 'selected';}else{$selected = '';}?> 
                      <option value='<?=$row2['id_colonia']?>' <?=$selected?>><?=$row2['cp_cod_pos']?> <?=$row2['cl_nombre']?> <?=$row2['lc_nombre']?></option>  
                <?php endwhile; ?>  
                </select>
                <br/>
              </div>
              <h3>Datos Fiscales</h3>
              <div class="col-md-6">
                <label for='arRFC'>RFC</label>
                <input type="text" class="form-control" id='arRFC' name="RFC" value="<?=$row3['df_rfc']?>"  placeholder="RFC"/>
                <br>
              </div>
              <div class="col-md-6">
                <label for='arRazonSocial'>Razón Social</label>
                <input type="text" class="form-control" id='arRazonSocial' name="RazonSocial" value="<?=$row3['df_razon_social']?>" placeholder="RazonSocial"/>
                <br>
              </div>
              <div class="col-md-4">
                <label for='arCalle'>Calle</label>
                <input type="text" class="form-control" id='arCalle' name="Calle" value="<?=$row3['df_calle']?>" placeholder="Calle"/>
                <br>
              </div>
              <div class="col-md-4">
                <label for='arNumero'>Número</label>
                <input type="text" class="form-control" id='arNumero' name="Numero" value="<?=$row3['df_numero']?>" placeholder="Numero"/>
                <br>
              </div>
               <div class="col-md-4">
                <label for='arCorreo'>Correo electrónico</label>
                <input type="text" class="form-control" id='arCorreo' name="Correo" value="<?=$row3['correo_electronico']?>" placeholder="Correo electrónico"/>
                <br>
              </div>
              <div class="col-md-4">
                <label for='arColonia'>Colonia</label>
                <select name='Colonia' id='arColonia' class="form-control">
                  <?php
                    $codigo = $row3['id_colonia'];
                    $result = mysql_query("SELECT cp.cp_cod_pos, cl.cl_nombre, cl.id_colonia, lc.lc_nombre FROM colonia cl RIGHT JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos INNER JOIN localidad lc ON cl.id_localidad = lc.id_localidad");
                    while ($row2 = mysql_fetch_array($result)):
                      if($codigo == $row2['id_colonia']){$selected = 'selected';}else{$selected = '';}?> 
                      <option value='<?=$row2['id_colonia']?>' <?=$selected?>><?=$row2['cp_cod_pos']?> <?=$row2['cl_nombre']?> <?=$row2['lc_nombre']?></option>  
                    <?php endwhile; ?>
                </select>
                <br>
              </div>
            </div>
            <div align='right'>
              <input class='btn btn-warning' type="submit" name="submit"  value="Guardar">
              <?php if($regresar_a == 'solicitud_desambiguar_cliente.php'){?>
                <button class="btn btn-negro" type='submit' value='Regresar' formaction="cliente_detalle.php"/>Regresar</button>
              <?php }else{?>
                <button class="btn btn-negro" type='submit' value='Regresar' formaction="cliente_general.php"/>Regresar</button>
              <?php }?>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(isset($_POST['submit'])){
      include ('cliente_editar.php');
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