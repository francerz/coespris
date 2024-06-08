<?php
$lema = $_POST['i'];
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$title="Modificar lema";

 $result = mysql_query("SELECT le.* FROM lema le WHERE le.id_lema = '$lema'");
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
              <h2>Modificar lema</h2>
            </div>
          </div>
          <div class="row">
          
          <form id='form_reset' method='POST' action='lema_detalle.php'>
            <input type="hidden" name="i" value="<?php echo "$lema";  ?>"/>
            <div class="col-md-12">
              <h4>Datos del lema</h4>
                <div class="col-md-6">
                <label for='inLema'>Lema</label>
                <input class="form-control" type="text" name="lema" autofocus value="<?=$row['lema_texto']?>" placeholder="Lema"/>
                <br/>
                <label for='inEmpleado'>Año de Vigencia</label>
                <input class="form-control" type="date" name="vigencia" autofocus value="<?=$row['anio_lema']?>" placeholder="aaaa-mm-dd"/>
                <br>
                <label>Estado de la vigencia</label>
                  <br>
                  <select name ='status' class="form-control">
                  <option value="1">Vigente</option>
                  <option value="0">No vigente</option>
                  </select>
              </div>
              <br><br><br><br><br><br><br><br><br><br><br><br>
              <div align="right">
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' formaction="lema_general.php"/>Regresar</button>
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
      include ('lema_detalle.php');
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