<?php  ob_start() or die (mysql_error());?>
<?php  
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
		require_once("conexion.php");
		$i=$_POST['i'];
        $dir="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
        inner join colonia cl on c.id_colonia=cl.id_colonia 
        inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
		inner join datos_fiscales df on c.id_cliente=df.id_cliente
        where id_solicitud= '$i'";
        $direc=mysql_query($dir,$dbConn) or die (mysql_error());
        $row=mysql_fetch_array($direc);

        $datosf="SELECT * from solicitud s inner join  datos_fiscales df on s.id_cliente=df.id_cliente 
		inner join colonia cl on df.id_colonia=cl.id_colonia
		inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
		where id_solicitud='$i'";
		$datosfi=mysql_query($datosf,$dbConn) or die(mysql_error());
		$row14=mysql_fetch_array($datosfi);



        //query consiste en
        $con="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud = '$i' and dss_clave='key_consiste'";
        $consis=mysql_query($con,$dbConn) or die (mysql_error());
        $row2 = mysql_fetch_array($consis);
        //query domicilio
        $dom="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud = '$i' and dss_clave='key_domicilio'";
        $domi=mysql_query($dom,$dbConn) or die(mysql_error());
        $row3=mysql_fetch_array($domi);
        //query municipio
        $muni="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud = '$i' and dss_clave='key_municipio'";
        $munici=mysql_query($muni,$dbConn) or die(mysql_error());
        $row5=mysql_fetch_array($munici);
        //query total m2
        $total="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud = '$i' and dss_clave='key_superficie'";
        $totalm=mysql_query($total,$dbConn);
        $row4=mysql_fetch_array($totalm);
       //query planta baja
       $planta="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud = '$i' and dss_clave='key_pbaja'";
       $plantab=mysql_query($planta,$dbConn);
       $row7=mysql_fetch_array($plantab);
       //query planta 1
       $piso="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud = '$i' and dss_clave='key_piso1'";
       $piso1=mysql_query($piso,$dbConn);
       $row8=mysql_fetch_array($piso1);
       //query planta 2
	   $pisod="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud = '$i' and dss_clave='key_piso2'";
       $piso2=mysql_query($pisod,$dbConn);
       $row9=mysql_fetch_array($piso2);
       //query planta 3
       $pisot="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud = '$i' and dss_clave='key_piso3'";
       $piso3=mysql_query($pisot,$dbConn);
       $row10=mysql_fetch_array($piso3);
       //query perito
       $perito="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud = '$i' and dss_clave='key_perito'";
       $peri=mysql_query($perito,$dbConn);
       $row11=mysql_fetch_array($peri);

       //query tipo de servicio de construccion
       $tip="SELECT * FROM solicitud s INNER JOIN servicio se on s.id_servicio=se.id_servicio where id_solicitud='$i'";
       $tipos=mysql_query($tip,$dbConn) or die(mysql_error());
       $row12=mysql_fetch_array($tipos);
 		//lema
		$lem = "SELECT * FROM lema WHERE lema_estatus =1";
		$resulema = mysql_query($lem,$dbConn);
		$lema = mysql_fetch_array($resulema);

		$dompe="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud = '$i' and dss_clave='key_domperito'";
		$domperi=mysql_query($dompe,$dbConn) or die(mysql_error());
		$row13=mysql_fetch_array($domperi);


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>solicitud planos</title>
</head>
<body>
	<?php include("encabezado_solicitud.php"); ?>
	<br/>
    <div id="primer">
		<p>
		  <b>C. SECRETARIO DE SALUD Y BIENESTAR SOCIAL<br>
		DEL GOBIERNO DEL ESTADO DE COLIMA<br>
		P  R E S E  N T E</b>
		</p><br>
		CON FUNDAMENTO EN LOS ARTICULOS: 7°, 22 FRACCION I, 30, 31, 32, 93, 94, 95, 96 Y 99 DE LA LEY DE SALUD DEL ESTADO DE COLIMA, 
		TITULO SEGUNDO, CAPITULO I DEL REGLAMENTO DE LA LEY DE SALUD DEL ESTADO DE COLIMA, EN MATERIA DE SALUBRIDAD LOCAL; 
		EL  SUSCRITO SOLICITA LE SEAN CONCEDIDOS 365 DIAS A PARTIR DE LA FECHA DEL OTORGAMIENTO DEL PERMISO PARA REALIZAR UNA CONSTRUCCION EN EL PREDIO DE SU PROPIEDAD EN: 
	</div><br>
	<div id="datos">
			DOMICILIO:<u><b>___________<?=$row3['valor_capturado']?>, <?=$row5['valor_capturado']?>____________________________</u></b><br>
			CONSISTE EN LO SIGUIENTE:<u><b>___________<?=$row2['valor_capturado']?>___________________________</u></b><br>
			QUE CUENTA CON UNA SUPERFICIE TOTAL DE  <u><b>______<?=$row4['valor_capturado']?>________</u></b> M2	
	</div><br>	
	<div>
<?php
	if($row12['id_servicio']=='7')
			{?>
			<html>
				<body>
        			<table border='1' id='tabla'>
						<thead>
						</thead>
						<tbody>
							<tr>
								<td>
									<b>CASA HABITACIÓN, EDIFICIOS PARA 
									VIVIENDAS Y ESCUELAS.</b><br>
									PLANTA BAJA_<u><b><?=$row7['valor_capturado']?></b></u>_M<sup>2</sup><br>
									1.P1._<u><b><?=$row8['valor_capturado']?></b></u>_<br>
									2.P2._<u><b><?=$row9['valor_capturado']?></b></u>_<br>
									3.P3._<u><b><?=$row10['valor_capturado']?></b></u>_<br>
									TOTAL M2_<u><b><?=$row4['valor_capturado']?></b></u>_
								</td>
								<td>
									<b>FRACCIONAMIENTOS</b>
									CONSTRUCCION________M2<br><br><br><br><br><br>
									TOTAL M2______________
								</td>	
								<td>
									<b>ESTABLECIMIENTOS COMERCIALES, 
									INDUSTRIALES, DE SERVICIO Y SIMILARES</b>
									PLANTA BAJA___________M2<br>
									1. P. ________<br>
									2. P. ________<br>
									3. P. ________<br><br>
									TOTAL M2 _________________
								</td></tr>
						</tbody>
					</table>
			</body>
		</html>
	
<?php } ?>

			<?php 
			
			if($row12['id_servicio']=='9')
			{?>
	
	<html>
		<body>
        	<table border='1' id='tabla'>
				<thead>
				</thead>
					<tbody>
						<tr>
							<td>
								<b>CASA HABITACIÓN, EDIFICIOS PARA 
								VIVIENDAS Y ESCUELAS.</b><br>
								PLANTA BAJA_________M2<br>
								1.P_________<br>
								2.P_________<br>
								3.P_________<br><br>
								TOTAL M2 _________________
							</td>
							<td>
								<b>FRACCIONAMIENTOS</b>
								CONSTRUCCION_<u><b><?=$row7['valor_capturado']?></b></u>_M<sup>2</sup><br><br><br><br><br><br>
								TOTAL M2_<u><b><?=$row7['valor_capturado']?></b></u>_
								</td>	
								<td>
								<b>ESTABLECIMIENTOS COMERCIALES, 
								INDUSTRIALES, DE SERVICIO Y SIMILARES</b><br>
								PLANTA BAJA___________M2<br>
								1. P. ________<br>
								2. P. ________<br>
								3. P. ________<br><br>
								TOTAL M2 _________________
							</td>
						</tr>
				</tbody>
			</table>
		</body>
	</html>
	<?php } ?>
	<?php
		if($row12['id_servicio']=='8')
		{?>
	<html>
		<body>
        	<table border='1' id='tabla'>
				<thead>
				</thead>
				<tbody>
					<tr>
						<td>
							<b>CASA HABITACIÓN, EDIFICIOS PARA 
							VIVIENDAS Y ESCUELAS.</b><br>
							PLANTA BAJA___________M2<br>
							1. P. ________<br>
							2. P. ________<br>
							3. P. ________<br><br>
							TOTAL M2 _________________
						</td>
						<td>
							<b>FRACCIONAMIENTOS</b>
							CONSTRUCCION________M2<br><br><br><br><br><br>
							TOTAL M2______________
						</td>	
						<td>
							<b>ESTABLECIMIENTOS COMERCIALES, 
							INDUSTRIALES, DE SERVICIO Y SIMILARES</b><br>
							PLANTA BAJA_<u><b><?=$row7['valor_capturado']?></b></u>_M<sup>2</sup><br>
							1.P1._<u><b><?=$row8['valor_capturado']?></b></u>_<br>
							2.P2._<u><b><?=$row9['valor_capturado']?></b></u>_<br>
							3.P3._<u><b><?=$row10['valor_capturado']?></b></u>_<br>
							TOTAL M2_<u><b><?=$row4['valor_capturado']?></b></u>_
						</td>
					</tr>
				</tbody>
			</table>
		</body>
	</html>
<?php } ?>
	</div><br>
	<div id="dato">
		<p <style='text-align:justify;'>		
		MINIMO 2 COPIAS DE PLANOS QUE INCLUYEN PLANTAS, CORTES, FACHADAS, 
		CROQUIS DE LOCALIZACION, INSTALACIONES ELECTRICAS O HIDRAULICAS, ASI COMO 
		LAS DISPOSICIONES SANITARIAS QUE SE SEÑALAN EN LA TITULO SEGUNDO REFERENTE 
		A INGENIERIA SANITARIA RELATIVA A EDIFICIOS, DEL REGLAMENTO DE LA LEY DE SALUD 
		EN MATERIA DE SALUBRIDAD LOCAL. 
		</p>
		<p style='text-align:justify;'>
		EL PERITO RESPONSABLE DE LA OBRA, SE COMPROMETE FORMALMENTE A EJECUTARLA 
		CONFORME A LOS PLANOS APROBADOS. EN CASO DE HACERSE ALGUNA MODIFICACION, 
		SE PROCEDERA A RECABAR OPORTUNAMENTE LA AUTORIZACION CORRESPONDIENTE, 
		SEGÚN LO INDICADO POR LA LEY DE LSALUD DEL ESTADO DE COLIMA.
		</p>
		<div align="center">
		<?php
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");	
				?>
			COLIMA, COL. A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><?php echo $dias[date('w')]." ".date('d') ?>&nbsp;&nbsp;&nbsp;&nbsp;de&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $meses[date('n')-1]?>&nbsp;&nbsp;del&nbsp;&nbsp;<?php echo date('Y')?></u>	
		</div>
		<br>
	</div>
	<table id="firma" align="center" style="width:70%">
			<tbody>
				<tr>
					<td width="35%" align="center"><u><b>&nbsp;<?=$row11['valor_capturado']?>&nbsp;</b></u><br>
				       NOMBRE DEL PÉRITO          <br><br>
					______________________________<br>
					   NO.DE REGISTRO DE FIRMA    <br><br>
					<u><b>&nbsp;<?=$row13['valor_capturado']?></b></u><br>
					           DOMICILIO         <br><br>
			    	</td>
					<td width="35%" align="center">
				    <u><b>&nbsp;<?=$row['ct_nombre']?>&nbsp;<?=$row['ct_apaterno']?>&nbsp;<?=$row['ct_amaterno']?>&nbsp;</u></b><br>
					  NOMBRE DEL PROPIETARIO     <br><br>
					_____________________________<br>	
					             FIRMA          <br><br>
					<u><b>&nbsp;<?=$row['ct_calle']?>__#<?=$row['ct_numero']?>__COL.&nbsp;<?=$row['cl_nombre']?>_&nbsp;</b></u><br>
					     DOMICILIO PARTICULAR     <br><br>
			    	</td>
				</tr>
			</tbody>
	</table>
	<div id="dom">NOTA: EN CASO DE REQUERIR RECIBO FISCAL FAVOR DE LLENAR LA SIGUIENTE INFORMACION CON LOS DATOS FISCALES:<br>
		NOMBRE:<u><b>__<?=$row['ct_nombre']?>_<?=$row['ct_apaterno']?>_<?=$row['ct_amaterno']?></b></u>__RFC:<u><b> ___<?=$row['df_rfc']?>____</b></u><br>
		DOMICILIO:<u><b>____<?=$row14['df_calle']?>__#<?=$row14['df_numero']?>__<?=$row14['cl_nombre']?>_____________</u></b>,C.P.___<u><b><?=$row14['cp_cod_pos']?>___________</b></u><br><br> 
     <u>EL RESPONSABLE O PROPIETARIO DE LA CONSTRUCCION, DEBERA DAR AVISO DE LA SUSPENSION O TERMINACION DE LA OBRA.</u>
</div></p>
		    	<h5 align="center" id="pie"><?=$lema['lema_texto']?></h5>
</body>
</html>
<style type="text/css" media="screen"> 
#enc{
	text-align: right;
	position: absolute;
	font-size: 8;	
	opacity: 0.5;
	text:justify;
	}
#datos,#primer
	{
	text:justify;
	font-size:8;
	}
#firma,#dato,#dom,#tabla
	{
	font-size:8;
	}
img.pequeña
	{
	width:100px;
	height:100px;
	opacity:0.5;
	position:absolute;
	}
</style>
<?php
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "solicitud_planos".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>