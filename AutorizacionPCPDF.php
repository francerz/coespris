<?php ob_start(); ?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
require_once("conexion.php");

$i = $_GET['i'];
$ofic = $_SESSION['oficina'];
$da = "select * from dss_solicitud where id_solicitud=$i AND id_dat_sec_sol=5";
$muni = mysql_query($da,$dbConn); 
$row = mysql_fetch_array($muni);

$da2 = "select * from dss_solicitud where id_solicitud=$i AND id_dat_sec_sol=6";
$muni2 = mysql_query($da2,$dbConn); 
$row2 = mysql_fetch_array($muni2);

//consiste en 
$CONTENIDO = "SELECT * FROM dss_solicitud WHERE id_solicitud = '$i' AND id_dat_sec_sol = 4";
$RESULO = mysql_query($CONTENIDO,$dbConn); 
$ROKO = mysql_fetch_array($RESULO);

$da3 = "SELECT * FROM solicitud INNER JOIN cliente using(id_cliente) where id_solicitud = '$i'";
$cl = mysql_query($da3,$dbConn);
$row3 = mysql_fetch_array($cl);

$asunto = "SELECT * FROM solicitud s INNER JOIN servicio sr using(id_servicio) WHERE id_solicitud = $i";
$ass = mysql_query($asunto,$dbConn);
$row4 = mysql_fetch_array($ass);


//QUERY DEL EMPLEADO LOGEADO
$empl = "SELECT * FROM empleado INNER JOIN oficina using(id_oficina) WHERE id_oficina ='$ofic'";
$resu = mysql_query($empl,$dbConn);
$rown = mysql_fetch_array($resu);

//QUERY DE LOS CONSECUTIVOS

$n = "select * from oficina where id_oficina = '$ofic'";
$nn = mysql_query($n,$dbConn); 
$nom = mysql_fetch_array($nn);


//QUERY DEL ENCABEZADO.

$encab = "SELECT * FROM oficina where id_oficina = '$ofic'";
$enca = mysql_query($encab,$dbConn);
$enrow = mysql_fetch_array($enca);

//lema
$lem = "SELECT * FROM lema WHERE lema_estatus =1";
$resulema = mysql_query($lem,$dbConn);
$lema = mysql_fetch_array($resulema);

$contenido = "SELECT * FROM solicitud sc INNER JOIN servicio sr ON sc.id_servicio = sr.id_servicio INNER JOIN 
formato fr ON sr.id_formato_autoriza = fr.id_formato where sc.id_solicitud = $i";
$conteni = mysql_query($contenido,$dbConn) or die("Error ".mysql_error());
$row6 = mysql_fetch_array($conteni);
?>


<head>
    <meta charset="utf-8">
    <title>Reporte</title>
</head>
<body>
<?php include("encabezado_pdf.php"); ?>
	<p style="text-align:justify">C. <?=$row3['ct_nombre']?><label> </label><?=$row3['ct_apaterno']?><label> </label><?=$row3['ct_amaterno']?></p>
	<div>
	<P style='text-align:justify;'>
			Comunico a Usted,  que de conformidad a los artículos 32, 34, 93, 94, 95, 96, 98 y 99 la Ley de Salud
			del Estado de Colima; habiendo  sido  aprobados  sus  Planos  de Construcción por  esta
			Dependencia, quedando requisitado el tramite bajo la <b>Autorización de Construcción No. <u><?php echo "$i";?></u></b>, se  le
			fija  un  plazo  de	365	días  para  efectuar la construcción que consiste en <u><b><?=$ROKO['valor_capturado']?></u></b>
			(a) en  <u><b><?=$row2['valor_capturado']?></b></u> en el municipio de <b><?=$row['valor_capturado']?>, COL.</b>
		
	</p>	
	<p> <?=$row6['fr_contenido']?></p>
	</div>
	<div  id= "firmas">
	<br>
		<h3 align="center">A T E N T A M E N T E</h3>
		<br><br>
			<table alingn = "" cellpadding="" cellspacing="" WIDTH=540 HEIGHT=40>
				<tr>
					<td align="center" spacing="1px"><big><b>AUTORIZ&Oacute;<br>
					<br><br></b></big></td>
					<td align="center" spacing="1px"><big><b>REVIS&Oacute;<br>
					<br><br></b></big></td>
				</tr>
				<tr>
				  <td align="center"><u><b><big>ING. RICARDO JIMEN&Eacute;Z HERRERA</big></b></u></td>
				  <td align="center"><u><b><big>ARQ. HECTOR ESTRADA GUZMAN</big></b></u></td>
				</tr>
				<tr>
				  <td align="center"><b><big>COMISIONADO ESTATAL PARA LA PROTECCIPROTECCI&Oacute;N<br>CONTRA RIESGOS SANITARIOS</big></b></td>
				  <td align="center"><b><big>ENCARGADO DE INGENIERIA SANITARIA</big></b></td>
				</tr>
			</table>
			<br><br><br><br><br>
		<p align="left" id="elaborado">Elaborado por: <?=$rown['em_nombres']?><label> </label><?=$rown['em_apaterno']?><label> </label><?=$rown['em_amaterno']?></p>
		<br><br>
		<h5 align="center" id="pie"><?=$lema['lema_texto']?></h5>
		<style type="text/css" media="screen">
			
			table{
				font-size: 10px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
			#firmas{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
			#enc{
				font-size: 11px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
			.p{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
			#pie{
				font-family: "Times New Roman", Times, serif;
				font-size: 12px;
				font-style: italic;
			}
			#elaborado{
		font-size: 9px;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
	}
			
		</style>
	</div>
</body>

<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Autorizacion".time().'.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
unlink($filename);
?>