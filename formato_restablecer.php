<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$formato = $_POST['i'];
$title="Modificar formato";

 $result = mysql_query("SELECT fr.* FROM  formato fr WHERE fr.id_formato = '$formato'");
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
              <h2>Modificar formato</h2>
            </div>
          </div>
          <div class="row">
          <form id='form_reset' method='POST' action='formato_detalle.php'>
          <input type="hidden" name="i" value="<?php echo "$formato";  ?>"/>
            <div class="col-md-12">
              <h3>Datos del formato</h3>
                <div class="col-md-8">
               
                <label for='inEmpleado'>Nombre</label>
                <br/>
                <textarea  type="text" rows = "3" cols="60" name="nombre" autofocus value="<?=$row['fr_nombre']?>"><?=$row['fr_nombre']?></textarea>
                <br/><br>
                
                <label for='inID'>Contenido</label>
                <br/>
                <textarea  type="text" rows = "5" cols="80" name="area" autofocus value="<?=$row['fr_contenido']?>"><?=$row['fr_contenido']?></textarea>
                <br/><br><br>
              </div>
              <div class="col-md-4">
                <label for='inRol'>Tipo</label>
                <br/>
                <select name="tipo" class="select">
                  <option value="Autorizacion">Autorización</option>
                  <option value="Orden">Orden</option>
                  <option value="Recibo">Recibo</option>
                  <option value="Solicitud">Solicitud</option>
                </select>
                <br/><br>
                <label for='inID'>Estatus</label><br>
                <select name="estatus" class="select">
                  <option value="Habilitado">Habilitado</option>
                  <option value="Deshabilitado">Deshabilitado</option>
                </select>
                <br>
              </div>
              <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' formaction="formato_general.php"/>Regresar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(isset($_POST['submit'])){
      include ('formato_detalle.php');
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