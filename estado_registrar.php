<?php
$title="Registrar Estado";
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
?>
<!DOCTYPE HTML>
<HTML lang="es">
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
          <h2>Nuevo Estado</h2>
            <form method="post" role="form" action="">
              <div class = "form-group">
                <label>Nombre</label>
                <input class="form-control" type="text" name="estado" autofocus placeholder="Estado"/>
              </div>
              <input class="btn btn-default" type="submit" name="submit"  value="Registrar Estado">  
            </form>
          </div>
        </div>
        <form role="form" align = right>
          <div class = "form-group">
            <button class="btn btn-primary" type='submit' value='Regresar' formaction="catalogo_menu.php"/>Regresar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


<?php
if (isset($_POST['submit'])) {
	require("estado_insertar.php");
}
include ("sec_piepagina.inc.php");
?>
</div>
</div>
</body>
</html>