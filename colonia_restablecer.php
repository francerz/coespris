<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$colonia = $_POST['i'];
$title="Modificar Colonia";
$query = "SELECT * FROM localidad";
$result = mysql_query($query,$dbConn);
$query2 = "SELECT * FROM codigo_postal";
$result2 = mysql_query($query2,$dbConn);
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
              <h2>Modificar Colonia</h2>
            </div>
          </div>
          <div class="row">
          <?php
    if(isset($_POST['submit']))
    {
require("colonia_detalle.php");
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
          <form id='form_reset' method='POST' action='colonia_restablecer.php'>
            <input type="hidden" name="i" value="<?php echo "$colonia";  ?>"/>
            <div class="col-md-12">
              <h3>Datos de la Colonia</h3>
              <div class="col-md-4">
                <label for='inRol'>ID</label>
                <input type="text" class="form-control"  name="id" value="<?php echo "$colonia";  ?>" placeholder="Estado"/>
                <br/>
                <label for='inRol'>Nombre</label>
                <input type="text" class="form-control"  name="nombre" autofocus placeholder="Nombre"/>
                <br>
                </div>
              <div class="col-md-4">
                <label for='inRol'>Codigo Postal</label>
                <br/>
                <select name="cp" class="select">
                 <?php while ($row=mysql_fetch_array($result2)){
                  echo "<option value=\"".$row['id_cod_pos']."\">".$row['cp_cod_pos'];
                  }
                  ?>  
               </select>
                <br>
                <label for='inRol'>Localidad</label>
                <br/>
                <select name="lc" class="select">
                 <?php while ($row=mysql_fetch_array($result)){
                  echo "<option value=\"".$row['id_localidad']."\">".$row['lc_nombre'];
                  }
                  ?>  
               </select>
                <br>
              </div>
              <br><br><br><br><br><br><br><br><br><br><br><br>
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-default" type='submit' value='Regresar' formaction="colonia_general.php"/>Regresar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(isset($_POST['submit'])){
      include ('colonia_detalle.php');
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