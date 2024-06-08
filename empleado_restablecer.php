<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$empleado = $_POST['i'];
$query = "SELECT * FROM puesto";
$result = mysql_query($query,$dbConn);
$query2 = "SELECT * FROM oficina";
$result2 = mysql_query($query2,$dbConn);
$title="Modificar empleado";

$result3 = mysql_query("SELECT em.* FROM empleado em WHERE em.id_empleado = '$empleado'");
 $row3 = mysql_fetch_array($result3);


$query4 = mysql_query("SELECT * FROM oficina");

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
require("empleado_detalle.php");
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
              <h2>Modificar empleado</h2>
            </div>
          </div>
          <div class="row">
          <form id='form_reset' method='POST' action=''>
            <div class="col-md-12">
              <h3>Datos del empleado</h3>
                <div class="col-md-4">
                <input readonly type="hidden" class="form-control"  name="i"  value="<?php echo "$empleado";?>"/>
                <label for='inEmpleado'>Nombre</label>
                <input type="text" class="form-control" name="nombres"  tabindex="1" autofocus value="<?=$row3['em_nombres']?>" placeholder="Nombre del empleado"/>
                <br>
                <label for='inRol'>Apellido paterno</label>
                <input type="text" class="form-control"  name="apaterno" tabindex="2" autofocus value="<?=$row3['em_apaterno']?>" placeholder="Apellido Paterno"/>
                <br/>
                <label for='inRol'>Apellido materno</label>
                <input type="text" class="form-control"  name="amaterno" tabindex="3" autofocus value="<?=$row3['em_amaterno']?>" placeholder="Apellido Materno"/>
                <br>
                 <label for='inID'>Oficina</label>
                <br/>
                <select name="oficina" tabindex="6" class="select">
                 <?php while ($row=mysql_fetch_array($result2)){
                  echo "<option value=\"".$row['id_oficina']."\">".$row['of_nombre'];
                  }
                  ?>  
               </select>
              </div>
              <div class="col-md-4">
                <label for='inRol'>Tipo empleado</label>
                <br/>
                <select name="tipo" tabindex="4" class="select">
                  <option value="INTERNO">Interno</option>
                  <option value="EXTERNO">Externo</option>
                </select>
                <br/><br>
                <label for='inID'>Puesto</label>
                <br/>
                <select name="puesto" tabindex="5" class="select">
                 <?php while ($row=mysql_fetch_array($result)){
                  echo "<option value=\"".$row['id_puesto']."\">".$row['pu_nombre'];
                  }
                  ?>  
               </select>
     
              </div>
            </div>
            <br><br><br><br><br>
               <div align="right">
                <input id='btn_submit' class='btn btn-warning' type="submit" name="submit" tabindex="7" value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' tabindex="8" formaction="empleado_general.php"/>Regresar</button>
               </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if(isset($_POST['submit'])){
      include ('empleado_detalle.php');
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