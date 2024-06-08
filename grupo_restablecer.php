<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$grupo = $_POST['i'];
$query = "SELECT * FROM grupo";
$result = mysql_query($query,$dbConn);
$title="Modificar Curso";
session_start();

$result = mysql_query("SELECT gr.* FROM grupo gr WHERE gr.id_grupo = '$grupo'");
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
              <h2>Modificar Grupo</h2>
            </div>
          </div>
          <div class="row">
             <?php
    if(isset($_POST['submit']))
    {
require("grupo_detalle.php");
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
          <form id='form_reset' method='POST' action='grupo_restablecer.php'>
          <input type="hidden" name="i" value="<?php echo "$grupo";  ?>"/>
            <div class="col-md-12">
              <h3>Datos del Grupo</h3>
                <div class="col-md-4">
                <label for='inID'>ID</label>
                <input readonly type="text" class="form-control"  name="id" value="<?php echo "$grupo";?>"/>
                <br/>
                <label for='inEmpleado'>Fecha Inicio</label>
                <input class="form-control" type="date" max='<?=date('Y-m-d')?>' name="in" autofocus value="<?=$row['det_fecha_inicio']?>" required placeholder="aaaa-mm-dd"/>
                <br>
              </div>
              <div class="col-md-4">
                <label for='inRol'>Sede</label>
                <input type="text" class="form-control"  name="sede" autofocus value="<?=$row['det_sede']?>" required placeholder="Sede"/>
                <br/>
                <label for='inEmpleado'>Fecha Fin</label>
                <input class="form-control" type="date"  name="fin" autofocus value="<?=$row['det_fecha_fin']?>" required placeholder="aaaa-mm-dd"/>
                <br>
              </div>
              <br><br><br><br><br><br><br><br><br><br><br><br>
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' formaction="grupo_general.php"/>Regresar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(isset($_POST['submit'])){
      include ('grupo_detalle.php');
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