<?php
    $title="Registrar localidad";
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
<?php include ("sec_encabezado.inc.php"); ?>
  <div class='wrapper'>
    <div id="page-wrapper" >
      <div id="page-inner">
        <div class="row">
          <div class="col-md-12">
          <h2>Nueva Localidad</h2>
            <form method="post" role="form" action="">
              <div class = "form-group">
                <label>Nombre</label>
                <input class="form-control" type="text" name="localidad" autofocus placeholder="Colonia"/>
              </div>
              <div class="form-group">
                <label>Municipio</label>
                <select name = 'municipio' class="form-control">
                <?php
                require("conexion.php");
                $query = "SELECT * FROM municipio";
                $result = mysql_query($query, $dbConn);
                while ($row = mysql_fetch_array($result)): ?>
                  <option value='<?=$row['id_municipio']?>'><?=$row['mp_nombre']?></option>
                <?php endwhile; ?>
                </select>
              </div>
              
              <input class="btn btn-default" type="submit" name="submit"  value="Registrar Localidad">  
            </form>
          </div>
        </div>
        <form role="form">
          <div class = "form-group">
            <button class="btn btn-primary" type='submit' value='Regresar' formaction="catalogo_menu.php"/>Regresar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
if (isset($_POST['submit'])) {
  require("localidad_insertar.php");
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