<?php
    require_once("conexion.php");
 session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
?>
<!DOCTYPE HTML>
<html lang="es">
  <head>
    <?php include ("sec_head.inc.php"); ?>
  </head>
<body>
<script>
function volver(){
   window.location.assign("catalogo_menu.php")
}
</script>

<?php include ("sec_encabezado.inc.php"); ?>
  <div class='wrapper'>
    <div id="page-wrapper" >
      <div id="page-inner">
        <div class="row">
            <form method="post" role="form" action="">
            <div class="col-md-12"> 
            <h2>Nueva Oficina</h2>
            <br>
              <div class = "form-group">
                <label>Nombre de oficina</label>
                <input class="form-control" type="text" name="nombre" autofocus required placeholder="Nombre"/>
              </div>
              <div class = "form-group">
                <label>Calle</label>
                <input class="form-control" type="text" name="calle" required placeholder="Calle"/>
              </div>
              <div class = "form-group">
                <label>Número</label>
                <input class="form-control" type="text" name="numero"  required placeholder="Numero"/>
              </div>
               <div class = "form-group">
                <label>Nomenclatura</label>
                <input class="form-control" type="text" name="nomenclatura" required placeholder="Nomenclatura"/>
              </div>
               <div class = "form-group">
                <label>Dirección relativa </label>
                <input class="form-control" type="text" name="direccion" required placeholder="Dirección relativa"/>
              </div>
               <div class = "form-group">
                <label>RFC</label>
                <input class="form-control" type="text" name="rfc" required placeholder="RFC"/>
              </div>
              <div class="form-group">
                <label>Colonia</label>
                <select name = 'colonia' class="form-control">
                <?php
                $query = "SELECT * FROM colonia";
                $result = mysql_query($query, $dbConn);
                while ($row = mysql_fetch_array($result)): ?>
                  <option value='<?=$row['id_colonia']?>'><?=$row['cl_nombre']?></option>
                <?php endwhile; ?>
                </select>
              </div>

               <div class="form-group">
                <label>Cuenta</label>
                <select name = 'cuenta' class="form-control">
                <?php
                require("conexion.php");
                $query = "SELECT * FROM cuenta";
                $result = mysql_query($query, $dbConn);
                while ($row = mysql_fetch_array($result)): ?>
                  <option value='<?=$row['id_cuenta']?>'><?=$row['cn_numero_cuenta']?></option>
                <?php endwhile; ?>
                </select>
              </div>
             <div align="right">  
               <input id='btn_submit' class='btn btn-default' type="submit" name="submit" style="display:inline" value="Registrar">
               <input type="button" class="btn btn-negro" id="filter" onclick="volver();"  style="display:inline" name="filter" value="Regresar" />
               <br><br>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
if (isset($_POST['submit'])) {
  require("oficina_insertar.php");
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

</div>
</div>
</script>
</body>
</html>