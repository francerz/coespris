<?php
require_once("conexion.php");
session_start();
//$grupo = $_GET['g'];
$grupo = 1;
//autorizacion
$query = "SELECT em.em_nombres, em.em_apaterno, em.em_amaterno FROM grupo AS det
INNER JOIN empleado AS em ON det.id_empleado = em.id_empleado WHERE det.id_grupo = '$grupo'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <title>Prueba de Impresión</title>
 <link href="pantalla.css" rel="stylesheet" type="text/css" media="all" />
 <link href="impresora.css" rel="stylesheet" type="text/css" media="print" />
</head>
<body>
<style type="text/css">
body { background-color: #fff; color: #000 }
.clase2 { page-break-after: always; }
</style>
<div class="clase2">
	<div id='wrapper'>
	<div id='empleado'><h3><?=$row['em_nombres']?> <?=$row['em_apaterno']?> <?=$row['em_amaterno']?></div>
      <style type="text/css">
      #empleado {
        position:absolute;
        top: 118px;
        color: black;
        font-style: bold;
        margin-left: 260px;
        margin-top: 299px;
        font-size: 50px;
        font-family: "Homer Simpson", cursive; 
        transform: rotate(90deg);
      }
    </style>
     <img id="bg" src="formatos/reconocimiento.jpg"/ height="700px;" width="950px;">
	       <style type="text/css">
	          #reconocimiento
	          {
	            right: 0px;
	            left: 100%; 
	            top: 0px; 
	            position: absolute;
	            z-index:-1;
	    	    -ms-transform: rotate(9deg); /* IE 9 */
    			-webkit-transform: rotate(7deg); /* Chrome, Safari, Opera */
  				transform: rotate(90deg);
	          }
	         
	         
	       </style>
	</div>
</div>
<div class="clase2">
	<div id='wrapper'>
     <img id="bg" src="formatos/constancia.jpg"/ height="700px;" width="950px;">
	       <style type="text/css">
	          #bg
	          {
	            right: 0px;
	            left: 100%; 
	            top: 0px; 
	            position: absolute;
	            z-index:-1;
	    	    -ms-transform: rotate(9deg); /* IE 9 */
    			-webkit-transform: rotate(7deg); /* Chrome, Safari, Opera */
  				transform: rotate(90deg);
	          }
	         
	         
	       </style>
	</div>
</div>
</body>
</html>
<?php
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "PDF".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>
