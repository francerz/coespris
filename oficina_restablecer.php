<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$oficina = $_POST['i'];
$title="Modificar Empleado";
$result3 = mysql_query("SELECT * FROM oficina of WHERE of.id_oficina = '$oficina'");
$row = mysql_fetch_array($result3);


$query = "SELECT * FROM colonia";
$result = mysql_query($query,$dbConn);
$query2 = "SELECT * FROM cuenta";
$result2 = mysql_query($query2,$dbConn);
/*
$query = "SELECT * FROM oficina AS of INNER JOIN colonia AS cl ON of.id_colonia = cl.id_colonia WHERE of.id_oficina = '$oficina' ";
$result = mysql_query($query,$dbConn);
$query2 = "SELECT * FROM oficina AS of INNER JOIN cuenta AS ct ON of.id_cuenta = ct.id_cuenta WHERE of.id_oficina = '$oficina'";
$result2 = mysql_query($query2,$dbConn); */
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
              <h2>Modificar Oficina</h2>
            </div>
          </div>
          <div class="row">
          
          <form id='form_reset' method='POST' action='oficina_detalle.php'>
          <input type="hidden" name="id" value="<?php echo "$oficina";  ?>"/>
            <div class="col-md-12">
              <h3>Datos de la oficina</h3>
          
            <div class="col-md-4">
              <label for='inRol'>Nombre de la oficina</label>
                </br>
                <textarea class="form-control" type="text" rows = "5" cols="40" name="nombre" autofocus value="<?=$row['of_nombre']?>"><?=$row['of_nombre']?></textarea>
                </br><br>

                <label for='inRol'>Calle</label>
                <input type="text" class="form-control"  name="calle" autofocus value="<?=$row['of_calle']?>" placeholder="Calle"/>
                <br>
                <label for='inRol'>Número</label>
                <input type="text" class="form-control"  name="numero" autofocus value="<?=$row['of_numero']?>" placeholder="Número"/>
                <br>
                <label for='inRol'>Nomenclatura</label>
                <input type="text" class="form-control"  name="nomenclatura" autofocus value="<?=$row['of_nomenclatura']?>" placeholder="Nomenclatura"/>
                <br>

            </div>    
              <div class="col-md-6">

                
                <label for='inRol'>Dirección relativa</label>
                <input type="text" class="form-control"  name="direccion" autofocus value="<?=$row['of_dir_relativa']?>" placeholder="dirección relativa"/>
                <br>
                <label for='inRol'>RFC</label>
                <input type="text" class="form-control"  name="rfc" autofocus value="<?=$row['of_rfc']?>" placeholder="RFC"/>
                <br>

                <label for='inRol'>Colonia</label>
                <br/>
                <select name="colonia" class="select">
              
                 <?php while ($row=mysql_fetch_array($result)){
                  echo "<option value=\"".$row['id_colonia']."\">".$row['cl_nombre'];
                  }
                  ?>  
               </select>
                <br/>
                <label for='inRol'>Cuenta</label>
                <br/>
                <select name="cuenta" class="select">
                 <?php while ($row=mysql_fetch_array($result2)){
                  echo "<option value=\"".$row['id_cuenta']."\">".$row['cn_numero_cuenta'];
                  }
                  ?>  
               </select>
                <br>           
              </div>
              </div>

              <br><br><br><br><br><br><br><br><br><br><br><br>
             <div align="right">
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit"  value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' formaction="oficina_general.php"/>Regresar</button>
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
      include ('oficina_detalle.php');
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