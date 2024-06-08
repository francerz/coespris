<?php
$rol = $_POST['i'];
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$query = "SELECT * FROM rol order by rol_nombre asc";
$result = mysql_query($query,$dbConn);
$title="Modificar Rol";

$result = mysql_query("SELECT rl.* FROM rol rl WHERE rl.id_rol = '$rol'");
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
           <?php
    if(isset($_POST['submit']))
    {
require("rol_detalle.php");
      ?>

      <div class="alert alert-success alert-dismissable" id="reg">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Bien Hecho!</strong> La modificación se ha hecho con éxito.
</div>

<script type="text/javascript">
  setTimeout(function(){
$('#reg').fadeOut();
  },4000);
</script>

   <?php }
  ?>
            <div class="col-md-12">
              <h2>Modificar rol</h2>
            </div>
          </div>
          <div class="row">
          <form id='form_reset' method='POST' action=''>
            <div class="col-md-12">
              <h3>Datos del rol</h3>
                <div class="col-md-4">
                <label for='inEmpleado'>Nombre</label>
                <input  autofocus type="text" class="form-control" name="r_nombre" autofocus value="<?=$row['rol_nombre']?>" placeholder="Nombre rol"/>
                <br>
              </div>
              <br><br><br><br><br><br><br><br><br><br><br><br>
             <div align="right">
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' formaction="rol_general.php"/>Regresar</button>
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
      include ('rol_detalle.php');
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
<style>
  .select
  {
  border: 1px solid #DBE1EB;
  font-size: 14px;
  font-family: Arial, Verdana;
  padding-left: 7px;
  padding-right: 7px;
  padding-top: 10px;
  padding-bottom: 10px;
  border-radius: 4px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  -o-border-radius: 4px;
  background: #FFFFFF;
  background: linear-gradient(left, #FFFFFF, #F7F9FA);
  background: -moz-linear-gradient(left, #FFFFFF, #F7F9FA);
  background: -webkit-linear-gradient(left, #FFFFFF, #F7F9FA);
  background: -o-linear-gradient(left, #FFFFFF, #F7F9FA);
  color: #2E3133;
  }
  .select:hover
  {
  border-color: #FBFFAD;
  }
  .select option
  {
  border: 1px solid #DBE1EB;
  border-radius: 4px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  -o-border-radius: 4px;
  }
    .select option:hover
    {
    background: #FC4F06;
    background: linear-gradient(left, #FC4F06, #D85F2B);
    background: -moz-linear-gradient(left, #FC4F06, #D85F2B);
    background: -webkit-linear-gradient(left, #FC4F06, #D85F2B);
    background: -o-linear-gradient(left, #FC4F06, #D85F2B);
    font-style: italic;
    color: #FFFFFF;
    }
 </style>

</body>
</html>