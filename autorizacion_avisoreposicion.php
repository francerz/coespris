<?php ob_start(); ?>
<?php
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






//responsable legal
$loc = "SELECT * FROM dsa_autorizacion dsa INNER JOIN datos_secundarios_autorizacion dta ON
dsa.id_dat_sec_aut = dta.id_dat_sec_autorizacion WHERE dsa.id_autorizacion = '$a' AND dta.dsa_clave='nom_responsable'";
$vcp= mysql_query($loc,$dbConn); 
$responsable = mysql_fetch_array($vcp);
//nombre del lugar
$nombre = "SELECT * FROM dsa_autorizacion dsa INNER JOIN datos_secundarios_autorizacion dta ON
dsa.id_dat_sec_aut = dta.id_dat_sec_autorizacion WHERE dsa.id_autorizacion = '$a' AND dta.dsa_clave='key_nombrelugar'";
$vcp1= mysql_query($nombre,$dbConn); 
$nomb = mysql_fetch_array($vcp1);
//telefono
$tel = "SELECT * FROM dsa_autorizacion dsa INNER JOIN datos_secundarios_autorizacion dta ON
dsa.id_dat_sec_aut = dta.id_dat_sec_autorizacion WHERE dsa.id_autorizacion = '$a' AND dta.dsa_clave='key_telefono'";
$tel2= mysql_query($tel,$dbConn); 
$telefono = mysql_fetch_array($tel2);
//inicio de labores
$inlabores = "SELECT * FROM dsa_autorizacion dsa INNER JOIN datos_secundarios_autorizacion dta ON
dsa.id_dat_sec_aut = dta.id_dat_sec_autorizacion WHERE dsa.id_autorizacion = '$a' AND dta.dsa_clave='key_labores'";
$lab= mysql_query($inlabores,$dbConn); 
$laboresin = mysql_fetch_array($lab);
//giro
$gi = "SELECT * FROM dsa_autorizacion dsa INNER JOIN datos_secundarios_autorizacion dta ON
dsa.id_dat_sec_aut = dta.id_dat_sec_autorizacion WHERE dsa.id_autorizacion = '$a' AND dta.dsa_clave='giro_negocio'";
$ggg= mysql_query($gi,$dbConn); 
$Giro = mysql_fetch_array($ggg);
//QUERY DEL EMPLEADO LOGEADO
$empl = "SELECT * FROM empleado INNER JOIN oficina using(id_oficina) WHERE id_oficina ='$oficina'";
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
<p id="con" style='text-align:justify;'>DE CONFORMIDAD CON LOS ARTICULOS: 198, 200 BIS Y 202 DE LA LEY GENERAL DE SALUD CON ESTA FECHA; ESTA COMISION QUEDA ENTERADA DE LA APERTURA DE ESTABLECIMIENTO.</p>
<div id="dato">
			<table style="width:100%" class="autorizacion" border="0">
			  <tr>
			    	<td width="20%">PROPIETARIO:</td>
			    	<td><?=$rok['ct_nombre']?>&nbsp;<?=$rok['ct_apaterno']?>&nbsp;<?=$rok['ct_amaterno']?></td>
			  <tr>
			    	<td>R.F.C. PROP.:</td>
			    	<td><?=$row3['df_rfc']?></td>		
			    
			  </tr>
			  <tr>
			   		<td>NOMBRE:</td>
			    	<td><?=$nomb['valor_capturado']?></td>
			  </tr>
			  <tr>
			   		<td>R.F.C. EST.:</td>
			    	<td><?=$row3['df_rfc']?></td>
			  </tr>
			  <tr>
			   		<td>GIRO:</td>
			    	<td><?=$Giro['valor_capturado']?></td>
			  </tr>
			  <tr>
			   		<td>DOMICILIO:</td>
			    	<td><?=$row3['df_calle']?> No. <?=$row3['df_numero']?>, COL. <?=$row3['cl_nombre']?></td>
			  </tr>
			  <tr>
			   		<td>LOCALIDAD:</td>
			    	<td><?=$row3['lc_nombre']?></td>
			  </tr>
			  <tr>
			   		<td>MUNICIPIO:</td>
			    	<td><?=$row3['mp_nombre']?></td>
			  </tr>
			  <tr>
			   		<td>C.P.:</td>
			    	<td><?=$row3['cp_cod_pos']?></td>
			  </tr>
			  <tr>
			   		<td>TELEFONO:</td>
			    	<td><?=$telefono['valor_capturado']?></td>
			  </tr>

			  <tr>
			   		<td>REP. LEGAL:</td>
			    	<td><?=$responsable['valor_capturado']?></td>
			  </tr>

			  <tr>
			   		<td>INICIO DE LABORES:</td>
			    	<td><?=$laboresin['valor_capturado']?></td>
			  </tr>
			</table>
	</div>
</div>
<br>
	<div id="con">
		<p align="center" style='text-align:justify;'>
		<?=$row6['fr_contenido']?></p>
	</div>
<br>
				
		<div id="firmas">
			<h3 align="center">A T E N T A M E N T E</h3>
			<h5 align="center">____________________________________</h5>
			<h5 align="center" align="justify">I.B.Q. <?=$row7['valor_capturado']?><br>
			COMISIONADO ESTATAL PARA LA PROTECCI&Oacute;N<br>
			CONTRA RIESGOS SANITARIOS</h5>
		</div>
		<br>
		<div id="sec">
		<p align="left" id="elaborado">Elaborado por: <?=$rown['em_nombres']?><label> </label><?=$rown['em_apaterno']?><label> </label><?=$rown['em_amaterno']?></p>
		<br>
		<h5 align="center" id="pie"><?=$lema['lema_texto']?></h5>
</div>
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
				font-size: 10px;
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
$filename = "AutorizacionAvisoReposicion".time().'.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
unlink($filename);
?>