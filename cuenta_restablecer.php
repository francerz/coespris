<?php

session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$cuenta = $_POST['i'];

require_once("conexion.php");
$title="Modificar Cuenta";
 $result = mysql_query("SELECT cn.* FROM cuenta cn WHERE cn.id_cuenta = '$cuenta'");
 $row = mysql_fetch_array($result);
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
              <h2>Modificar cuenta</h2>
            </div>
          </div>
          <div class="row">
         
          <form id='form_reset' method='POST' action='cuenta_detalle.php'>
          <input type="hidden" name="i" value="<?php echo "$cuenta";  ?>"/>
            <div class="col-md-12">
              <h3>Datos de la cuenta</h3>
              <br>
                <div class="col-md-4">
                
                <label for='inEmpleado'>Razón social</label>
                <input type="text" class="form-control" name="razon" autofocus value="<?=$row['cn_razon_social_banco']?>"  placeholder="Razón social"/>
                <br/>
                <label for='inEmpleado'>Clabe</label>
                <input type="text" class="form-control" name="clabe" autofocus value="<?=$row['cn_clabe']?>" placeholder="Clabe"/>
                <br>
              </div>
              <div class="col-md-5">
                <label for='inEmpleado'>Cuenta habiente</label>
                <input type="text" class="form-control" name="cuentaha" autofocus value="<?=$row['cn_cuentahabiente']?>" placeholder="Cuenta habiente"/>
                <br/>
                <label for='inEmpleado'>Número cuenta</label>
                <input type="text" class="form-control" name="nucuenta" autofocus value="<?=$row['cn_numero_cuenta']?>" placeholder="Número cuenta"/>
                <br>
              </div>

              <br><br><br><br><br><br><br><br><br><br><br><br>
              <div align="right">
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' formaction="cuenta_general.php"/>Regresar</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(isset($_POST['submit'])){
      include ('cuenta_detalle.php');
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
  <!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>