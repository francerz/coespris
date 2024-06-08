<?php ob_start()or die(mysql_error());?>
<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
		require_once("conexion.php");
		$i=$_POST['i'];

		$dom="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_curso_dom'";
		$domi=mysql_query($dom,$dbConn) or die(mysql_error());
		$row=mysql_fetch_array($domi);

		$hor="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_hor_cur'";
		$hora=mysql_query($hor,$dbConn) or die(mysql_error());
		$row2=mysql_fetch_array($hora);

		$persona="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_per_cur'";
		$personas=mysql_query($persona,$dbConn) or die(mysql_error());
		$row3=mysql_fetch_array($personas);

		$instru="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_nomb_ins'";
		$instructor=mysql_query($instru,$dbConn) or die(mysql_error());
		$row4=mysql_fetch_array($instructor);

		 //lema
		$lem = "SELECT * FROM lema WHERE lema_estatus =1";
		$resulema = mysql_query($lem,$dbConn);
		$lema = mysql_fetch_array($resulema);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AUTORIZACIÓN DE CLAVE PARA LA IMPARTICIÓN DEL CURSO DE MANEJO Y DISPENSACIÓN DE MEDICAMENTOS POR INSTRUCTOR AUTORIZADO</title>
	<link rel="stylesheet" href="">
</head>
<body>
<?php include("encabezado_solicitud.php"); ?>
<br>
	<div id="primer">
	<p><b>C. SECRETARIO DE SALUD Y BIENESTAR SOCIAL<br/>
			 DEL GOBIERNO DEL ESTADO DE COLIMA<br/>
			 P  R E S E  N T E
		</b></p>
	</div>
	<br><br>
	<div id="dato">De conformidad al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”, el suscrito solicita la Autorización de Clave para que será impartido en: </div>
	<table style="width:100%" class="solicitudes">
	<br><br>
		<thead></thead>
		<tbody>
			<tr>
				<td style="width:30%">Domicilio:</td>
				<td style="width:70%">_____<u><?=$row['valor_capturado']?></u>______</td>
			</tr>
			<tr>
				<td>Horario:</td>
				<td>______<u><?=$row2['valor_capturado']?></u>______</td>
			</tr>
			<tr>
				<td>No. de Personas</td>
				<td>_____<u><?=$row3['valor_capturado']?></u>______</td>
			</tr>
			<tr>
				<td>Nombre del instructor Autorizado</td>
				<td>______<u><?=$row4['valor_capturado']?></u>_______</td>
			</tr>
		</tbody>
	</table>
	<br><br><br><br>
<?php
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
	?>
	<div id="fecha" align="center">
	            <U>COLIMA,COL.A&nbsp;&nbsp;&nbsp;<?php echo $dias[date('w')]." ".date('d')?>&nbsp;&nbsp;&nbsp;de&nbsp;&nbsp;&nbsp;<?php echo $meses[date('n')-1]?>&nbsp;&nbsp;&nbsp;<?php echo date('Y')?></u>
	</div>
	<br/>
	<div id="firma" align="center">
		        _______________________________________________________________<br/>
		        Nombre y firma del propietario, representante o apoderado Legal.
	</div>

</body>

</html>
	
<style type="text/css" media="screen">

	#primer,#tip{
		font-size:9px;
		text-align: left;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
		font-style: bold;
	}
	#cab{
		font-size:9px;
		text-align: center;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
		font-style: bold;
	}

	#fecha,#firma{
		font-size:9px;
	}
	#dato{
font-size:12px;
text-align: left;
	}
	

	
	table.solicitudes, .solicitudes td, .solicitudes tr{
					padding: 5px;
					text-align: left;
				    border: 1px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 9px;
					font-family: 'Calibri', Helvetica, Arial, sans-serif;
				    

				}
				table.marca, .marca td, .marca tr{
					padding: 5px;
					text-align: left;
				    border: 0px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 8px;
					font-family: 'Calibri', Helvetica, Arial, sans-serif;
				    

				}
				#pie{
				font-family: "Times New Roman", Times, serif;
				font-size: 9px;
				font-style: italic;
			}
</style>
<?php
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "solicitud_imparticion_clave".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>
