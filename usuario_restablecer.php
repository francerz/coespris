<?php
  session_start();
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
  }
  require("conexion.php");
  $usuario = $_POST['i'];

$sql = mysql_query("SELECT * FROM usuario us INNER JOIN empleado em ON us.id_empleado = em.id_empleado WHERE id_usuario = '$usuario'");
$row = mysql_fetch_array($sql);
  $nombre = $row['usuario'];
  $nom = $row['em_nombres'];
  $ap1 = $row['em_amaterno'];
  $ap2 = $row['em_apaterno'];
  $nc = $nom . " " . $ap1 . " " . $ap2;
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
require("datos_secundarios_solicitud_detalle.php");
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
              <h2>Restablecer usuario
              </h2>
            </div>
          </div>
          <div class="row">
          <form id='form_reset' method='POST' action='usuario_detalle.php'>
            <div class="col-md-12">
              <h3>Datos del Usuario</h3>
                <div class="col-md-4">
                <label for='inNombre'>Nombre de usuario</label>
                <input readonly type="text" class="form-control"  name="usuario" tabindex="1" value="<?php echo "$nom"; ?>" required placeholder="Nombre"/>
                <br/>
                <label for='inEmpleado'>Nombre empleado</label>
                <input readonly type="text" class="form-control" name="emp" tabindex="2" value=" <?php echo $nc ?>" required placeholder="Nombre Empleado"/>
                <br>
              </div>
              <!-- 
              <div class="col-md-4">
                <label for='inRol'>Rol</label>
                <input readonly type="hidden" class="form-control"  name="rol" tabindex="3" value="<?=$row['rol_nombre']?>" required placeholder="Rol"/>
                <br/>
                <label for='inID'>ID</label>
                <input readonly type="hidden" class="form-control" name="idus" tabindex="4" value="<?=$row['id_usuario']?>" required placeholder="ID"/>
                <br>
              </div>
              -->
              <div class="col-md-4">
                <label for='inContrasenia'>Nueva contraseña</label>
                <input id='pass1' type="password" class="form-control"   name="contrasenia" tabindex="5" autofocus placeholder="Contraseña"/>
                <br/>
                <label for='inContrasenia2'>Repite la contraseña</label>
                <input id='pass2' type="password" class="form-control" name="contrasenia2" tabindex="6" placeholder="Repite tu Contraseña"/>
                <br>
              </div>
              <br><br><br><br><br><br><br><br><br><br><br><br>
              <div align="right">
              <input id='btn_submit' class='btn btn-warning' type="submit" name="submit" tabindex="7" value="Restablecer">
               <button class="btn btn-negro" type='submit' value='Regresar' tabindex="8" formaction="usuario_general.php"/>Regresar</button>
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
      include ('usuario_detalle.php');
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
        var formReset = document.getElementById('form_reset');
        var btnSubmit = document.getElementById('btn_submit');
        $('#dataTables-example').dataTable();
        formReset.addEventListener('submit',formReset_onsubmit);
        btnSubmit.addEventListener('click',btnSubmit_onclick);
    });
    function formReset_onsubmit(e) {
      var form = this;
      if (!form.checkValidity()){
        e.preventDefault();
        return false;
      }
    }
    function btnSubmit_onclick(e) {
      var passField1 = document.getElementById('pass1');
      var passField2 = document.getElementById('pass2');
      if (passField1.value == passField2.value) {
        passField1.setCustomValidity("");
      } else {
        passField1.setCustomValidity("Las contraseñas no coinciden");
      }
    }
  </script>
  <!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>