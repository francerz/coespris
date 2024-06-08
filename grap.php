<?php
$title="Registrar Cuenta";
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
  $total =  $_POST['total'];
  $asd = $_POST['asd'];
  $qq = $_POST['qq'];
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
          <div class="col-md-8">
          <h2>Grafica</h2>
          <?php echo $total?><br>
          <?php echo $qq ?>
          <br> 
              <div class = "form-group">
                <img src="bar.php" alt="circle" border="0" class="img-responsive">
              </div>
         </div>
        </div>
      </div>
    </div>
  </div>

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
</body>
</html>