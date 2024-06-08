<?php ob_start(); ?>
<?php 
session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
require_once("conexion.php");
$i = (int)$_GET['i'];
$a = (int)$_GET['i'];

//OFICINA LOGEADA
$OfLog= $_SESSION['oficina'];

//QUERY DE LOS CONSECUTIVOS Y DEL ENCABEZADO.
$encab = "SELECT * FROM oficina where id_oficina = '$OfLog'";
$enca = mysql_query($encab,$dbConn);
$enrow = mysql_fetch_array($enca);

$empl = "SELECT * FROM empleado INNER JOIN oficina using(id_oficina) WHERE id_oficina ='$OfLog'";
$resu = mysql_query($empl,$dbConn);
$rown = mysql_fetch_array($resu);


$query = "SELECT es.es_nombre, es.id_estado, mp.mp_nombre, mp.id_municipio, df.df_razon_social, df.df_calle, df.df_numero, cl.cl_nombre, lc.lc_nombre, ct.ct_nombre, ct.ct_apaterno, ct.ct_amaterno FROM solicitud s INNER JOIN cliente ct ON s.id_cliente = ct.id_cliente INNER JOIN datos_fiscales df ON ct.id_cliente = df.id_cliente INNER JOIN colonia cl ON df.id_colonia = cl.id_colonia INNER JOIN localidad lc ON cl.id_localidad = lc.id_localidad INNER JOIN municipio mp ON lc.id_municipio = mp.id_municipio INNER JOIN estado es ON mp.id_estado = es.id_estado WHERE s.id_solicitud = '$i'";
    $result = mysql_query($query);
    $row2 = mysql_fetch_array($result);


    //licencia sanitaria
    $licencia = "SELECT * FROM dsa_autorizacion dsa INNER JOIN datos_secundarios_autorizacion dta ON
    dsa.id_dat_sec_aut = dta.id_dat_sec_autorizacion WHERE dsa.id_autorizacion = '$a' AND dta.dsa_clave='lic_sanitaria'";
    $licencianum= mysql_query($licencia,$dbConn); 
    $rowlicencia = mysql_fetch_array($licencianum);

    //datos fiscales del negocio

    $da = "select * from datos_fiscales inner join colonia cl using(id_colonia) inner join codigo_postal using(id_cod_pos) inner join localidad lc on lc.id_localidad = cl.id_localidad
    inner join municipio using(id_municipio) inner join estado using(id_estado) inner join solicitud using(id_cliente)
    where id_solicitud = $i";
    $daf = mysql_query($da,$dbConn); 
    $row3 = mysql_fetch_array($daf);
?>
<head>
    <meta charset="utf-8">
    <title>Reporte</title>
</head>
<body>
<table style="width:100%">
<tr>
<td><div id="im">
	<img class="peq" src="assets/img/asd.jpg"/ width="100%" height="40%">  </td>
</div>
	 <td>
	 	<div id="enc">
			<p  align="left">
				<b>Dependencia:</b> <u>SERVICIOS  DE   SALUD DEL ESTADO DE  COLIMA.
				JUAREZ # 235 CENTRO C.P. 28000 COLIMA, COL.</u>
				<br>
				<b>Secci&oacute;n:</b> <u>COMISI&Oacute;N ESTATAL PARA LA PROTECCI&Oacute;N
				CONTRA RIESGOS SANITARIOS.</u>
				<br>
				<b>Mesa:</b> <u>SUBCOMISI&Oacute;N DE COMUNICACI&Oacute;N DE RIESGOS, TR&Aacute;MITES Y AUTORIZACIONES</u>
				<br>
				<b>Gerencia:</b> <u>TR&Aacute;MITES Y AUTORIZACIONES</u>
				<br>
				NO. OFICIO: <font color="red"> <?=$enrow['of_nomenclatura']?><label>-</label><?php echo "$i";?><?php echo "/".substr(date('Y'),-2);?></font>
				
			</p>
		</div>
	</td>
</tr>
</table>
<br>
<br>
<div><p style='text-align:justify;'>
   <u> <b>ACTA DE ENTREGA RECEPCI&Oacute;N, LICENCIA SANITARIA <font color="red"> No.<?=$rowlicencia['valor_capturado']?></font></b></u><br> 
   Siendo las <b>10:00 horas con 20 minutos del d&iacute;a 24 (veinticuatro) de julio de 2012 (dos mil doce)</b>, se 
   present&oacute; en las oficinas de esta Comisi&oacute;n Estatal para la Protecci&oacute;n Contra Riesgos Sanitarios, la 
   C.<b> <?=$row2['ct_nombre']?> <?=$row2['ct_apaterno']?> <?=$row2['ct_amaterno']?></b>, quien se identific&oacute; mostrando Credencial de Elector con Fotograf&iacute;a  
   No. Folio.- <b>0146125866887</b> expedida por el Instituto Federal Electoral, en su car&aacute;cter de 
   Propietaria de la empresa denominada <b><?=$row3['df_razon_social']?></b>, con domicilio en <b><?=$row3['df_calle']?> No. <?=$row3['df_numero']?>, COL. <?=$row3['cl_nombre']?>, <?=$row3['lc_nombre']?>, <?=$row3['es_nombre']?></b>; con la finalidad de que se le haga la 
   entrega de la Licencia Sanitaria solicitada por la Modificaci&oacute;n a la Licencia No. 02-06 A024; se 
   procede a entregar con fundamento en los Art&iacute;culos 132, 198 fracciones II y III, 368, 369, 370, 371
   y 373 de la Ley General de Salud: 61, 64, 71, 132, 133, 139 fracción I, y 142, 143 del Reglamento 
   de la Ley General de Salud en Materia de Control Sanitario de Actividades, Establecimientos,
   Productos y Servicios, 1,2 apartado C fracción X, 36, 37, 38 del Reglamento Interior de la 
   Secretaria de Salud; 1, 2, 3 del Reglamento de la Comisi&oacute;n Federal para la Protecci&oacute;n Contra 
   Riesgos Sanitarios; Acuerdo Especifico de Coordinaci&oacute;n para el ejercicio de facultades en materia 
   de control y fomento sanitarios, que celebran la Secretaria de Salud, con la participaci&oacute;n de la 
   Comisi&oacute;n Federal para Protecci&oacute;n contra Riesgos Sanitarios y el Estado de Colima, publicado en 
   el Diario Oficial de la Federaci&oacute;n el 04 de Febrero de 2005, Acuerdo Nacional para la 
   Descentralizaci&oacute;n de los Servicios de Salud, Cl&aacute;usula Octava del Acuerdo de Coordinaci&oacute;n para 
   la Descentralizaci&oacute;n Integral de los Servicios de Salud de Colima; 93, 96 y 97 de la Ley Estatal de 
   Salud, la LICENCIA SANITARIA No.<b> <font color="red"><?=$rowlicencia['valor_capturado']?></font> </b>CLAVE (SCIAN) 561710 Modalidad “A” 
   autorizada para prestar SERVICIOS URBANOS DE FUMIGACI&Oacute;N, DESINFECCI&Oacute;N Y 
   CONTROL DE PLAGAS.<br>
   La C.<font color="red"><b> <?=$row2['ct_nombre']?> <?=$row2['ct_apaterno']?> <?=$row2['ct_amaterno']?></b></font>, se responsabiliza del buen uso de esta Autorización, 
   haci&eacute;ndosele saber que en caso de incumplimiento de las condiciones y requisitos sanitarios 
   exigidos, se proceder&aacute; a su revocaci&oacute;n conforme a lo establecido en el Titulo Decimosexto, 
   Capitulo II de la Ley General de Salud, sin perjuicio de las sanciones que correspondan.<br> 
   En conformidad por quienes intervinieron, la presente Acta de Entrega-Recepci&oacute;n se firma en 
   original y copia al margen y al calce para constancia de hechos.
<br>
<br>
   </p></div>
		<table WIDTH=500 HEIGHT=40>
				<tr>
					<td align="center" spacing="1px" id="no"><b>I.B.Q. RICARDO JIM&Eacute;NEZ HERRERA
					</b></td>
					<td align="center" id="no" spacing="1px"><font color="red"><b>C. JUANA LEMUS SAMANO</b></font></td>
				</tr>
				<tr>
				  <td align="center" id="no"><u><b>POR LA COMISIÓN ESTATAL PARA <br>FUMIGACIONES LEMUS LA PROTECCIÓN CONTRA RIESGOS<br> SANITARIOS</b></u></td>
					<td align="center" id="no"><u><b><font color="red">FUMIGACIONES LEMUS</font></b></u></td>
				</tr>
			</table>

			<br><br>
		<div id="sec">
		<p align="left" id="elaborado">Elaborado por: <?=$rown['em_nombres']?><label> </label><?=$rown['em_apaterno']?><label> </label><?=$rown['em_amaterno']?></p>
		<style type="text/css" media="screen">
			#firmas{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
			#pie{
				font-family: "Times New Roman", Times, serif;
				font-size: 9px;
				font-style: italic;
			}
			#no{
				font-size: 12px;
			}
			
</body>
<style type="text/css" media="screen">
	#sec{
		font-size: 10px;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
	}
	#elaborado{
		font-size: 9px;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
	}

			img.peq{width: 300px; height: 170px;
			position: relative;
			bottom: 200px;
			border-
			}

			.p{
				font-size: 10px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
			#firmas{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
			#enc{
				font-size: 12px;
				
			}

</style>
<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Orden_verificacionmuestra".time().'.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
unlink($filename);
?>