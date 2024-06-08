<?php
ob_start(); 
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$grupo = $_GET['g'];
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
</head>
<body>
<style type="text/css">
body { background-color: #fff; color: #000 }
.clase2 { page-break-after: always; }
</style>
<div class="clase2">
	<div id='wrapper'>
		<div id='cliente'><h3><?=$row['em_nombres']?> <?=$row['em_apaterno']?> <?=$row['em_amaterno']?></div>
    	<img id="reconocimiento" src="formatos/reconocimiento.jpg"/ height="700px;" width="950px;">
	</div>
</div>
<style type="text/css">
	#cliente{
    	position:absolute;
    	color: black;
    	font-style: bold;
    	margin-left: 50%;
    	margin-top: 300px;
    	font: oblique 160% sans-serif bold;
    	text-align: center;
    	-ms-transform: rotate(9deg); /* IE 9 */
		-webkit-transform: rotate(7deg); /* Chrome, Safari, Opera */
		transform: rotate(90deg);
	}
    #reconocimiento{
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
<?php 
$query = "SELECT asi.as_nombre FROM grupo AS det INNER JOIN asistentes AS asi ON det.id_grupo = asi.id_grupo
WHERE det.id_grupo = '$grupo' AND asi.estatus LIKE 'ACTIVO'";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)): ?>
	<div class="clase2">
		<div id='wrapper'>
			<div id='cliente'><h3><?=$row['as_nombre']?></div>
	     	<img id="reconocimiento" src="formatos/constancia.jpg"/ height="700px;" width="950px;">
		</div>
	</div>
<?php endwhile; ?>
</body>
</html>
<?php
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "Reconocimientos".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>