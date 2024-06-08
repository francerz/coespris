<?php ob_start();
session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
  
$i = (int)$_GET['i'];
$a =(int)$_GET['a'];

require_once("conexion.php");
$banco = "select * from cuenta";
$bancoz = mysql_query($banco,$dbConn); 
$row = mysql_fetch_array($bancoz);
$oficina= $_SESSION['oficina'];

$contenido = "SELECT * FROM solicitud sc INNER JOIN servicio sr ON sc.id_servicio = sr.id_servicio INNER JOIN 
formato fr ON sr.id_formato_autoriza = fr.id_formato where sc.id_solicitud = $i";
$conteni = mysql_query($contenido,$dbConn) or die("Error ".mysql_error());
$row6 = mysql_fetch_array($conteni);


$op = "select * from orden_pago where id_solicitud=$i";
$rep = mysql_query($op);
$op_total  = mysql_fetch_array($rep);

$asunto = "SELECT * FROM solicitud s INNER JOIN servicio sr using(id_servicio) WHERE id_solicitud = $i";
$ass = mysql_query($asunto,$dbConn);
$row4 = mysql_fetch_array($ass);


$da = "select * from datos_fiscales inner join colonia cl using(id_colonia) inner join codigo_postal using(id_cod_pos) inner join localidad lc on lc.id_localidad = cl.id_localidad
inner join municipio using(id_municipio) inner join estado using(id_estado) inner join solicitud using(id_cliente)
where id_solicitud = $i";
$daf = mysql_query($da,$dbConn); 
$row3 = mysql_fetch_array($daf);

$CL = "SELECT * FROM solicitud s INNER JOIN cliente cl using(id_cliente) INNER JOIN colonia col using(id_colonia)
INNER JOIN localidad loca using(id_localidad) WHERE id_solicitud = $i";
$cl2 = mysql_query($CL,$dbConn); 
$rok = mysql_fetch_array($cl2);

//query comisionado
$comi="SELECT * from autorizacion where id_autorizacion='$a'";
$comisionado=mysql_query($comi,$dbConn) or die(mysql_error());
$row7=mysql_fetch_array($comisionado);


//responsable
$loc = "SELECT * FROM dsa_autorizacion dsa INNER JOIN datos_secundarios_autorizacion dta ON
dsa.id_dat_sec_aut = dta.id_dat_sec_autorizacion WHERE dsa.id_autorizacion = '$a' AND dta.dsa_clave='key_resp_san'";
$vcp= mysql_query($loc,$dbConn); 
$sani = mysql_fetch_array($vcp);

//QUERY DEL EMPLEADO LOGEADO
$empl = "SELECT * FROM empleado INNER JOIN oficina using(id_oficina) WHERE id_empleado = {$_SESSION['empleado']}";
$resu = mysql_query($empl,$dbConn);
$rown = mysql_fetch_array($resu);

//lema
$lem = "SELECT * FROM lema WHERE lema_estatus =1";
$resulema = mysql_query($lem,$dbConn);
$lema = mysql_fetch_array($resulema);
?>

<head>
    <meta charset="utf-8">
    <title>Reporte</title>
</head>
<body>
<?php include("encabezado_pdf.php");?>
<div id="dato">
			<p align="left"  style='text-align:justify;'><b>NOMBRE O RAZON SOCIAL DEL ESTABLECIMIENTO:&nbsp;<?=$row3['df_razon_social']?><br>
			PROPIETARIO: SERVICIOS DE SALUD DEL ESTADO DE COLIMA<br>
			RESPONSABLE SANITARIO: <?=$sani['valor_capturado']?>.</b></p>
</div>
	<div id="con">
		<p align="center" style='text-align:justify;'>Los servicios de transfusión pueden omitir anotar los resultados de hemoglobina, hematocrito y de pruebas serológicas, así como el tipo de donación, excepto cuando se trate de actos de disposición con fines de transfusión autóloga por deposito previo realizado en el establecimiento.<br>
		<?=$row6['fr_contenido']?></p>
	</div>
<br>
				
		<div id="firmas">
			<h3 align="center">A T E N T A M E N T E</h3><br><br><br><br>
			<h3 align="center">________________________________________</h3>
			<h5 align="center" align="justify">I.B.Q.<?=$row7['au_comisionado']?><br>
			COMISIONADO ESTATAL PARA LA PROTECCI&Oacute;N<br>
			CONTRA RIESGOS SANITARIOS</h5>
		</div>
		<br>
		<div id="sec">
		<p align="left" id="elaborado">Elaborado por: <?=$rown['em_nombres']?><label> </label><?=$rown['em_apaterno']?><label> </label><?=$rown['em_amaterno']?></p>
		<br><br>
		<h5 align="center" id="pie"><?=$lema['lema_texto']?></h5>


</body>
<style type="text/css" media="screen">
	#sec{
		font-size: 12px;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
	}
	#elaborado{
		font-size: 9px;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
	}

			#firmas{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
			#pie{
				font-family: "Times New Roman", Times, serif;
				font-size: 12px;
				font-style: italic;
			}
			#dato{
				margin-top: 0.42em;
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
				font-style: bold;
			}
			#con{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
				font-style: bold;
			}
		</style>


<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "AutorizacionBancoSangre".time().'.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
unlink($filename);
?>