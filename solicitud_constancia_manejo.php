<?php ob_start() or die(mysql_error());?>
<?php 
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$i=$_POST['i'];
	//lema
	$lem = "SELECT * FROM lema WHERE lema_estatus =1";
	$resulema = mysql_query($lem,$dbConn);
	$lema = mysql_fetch_array($resulema);

	//query radio
$rad="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_constancial'";
$radio=mysql_query($rad,$dbConn) or die(mysql_error());
$row9=mysql_fetch_array($radio);
//cantidad actas
$jj="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_solicitudes'";
$gg=mysql_query($jj,$dbConn) or die(mysql_error());
$row1=mysql_fetch_array($gg);


//query datos cliente
		$dir="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
	    inner join colonia cl on c.id_colonia=cl.id_colonia 
	    inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
		inner join datos_fiscales df on c.id_cliente=df.id_cliente
	    where id_solicitud= '$i'";
	    $direc=mysql_query($dir,$dbConn) or die (mysql_error());
	    $row6=mysql_fetch_array($direc);

	    //query municipio
	    $mun="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
	    inner join colonia cl on c.id_colonia=cl.id_colonia
	    inner join localidad l on cl.id_localidad=l.id_localidad 
	    inner join municipio mp on l.id_municipio=mp.id_municipio 
	    INNER JOIN estado es on mp.id_estado = es.id_estado where id_solicitud='$i'";
	    $municipio=mysql_query($mun,$dbConn) or die(mysql_error());
	    $row7=mysql_fetch_array($municipio);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php include("encabezado_solicitud.php");?><br>
<br/>

	<div id="primer">
		<p ><b>C. SECRETARIO DE SALUD Y BIENESTAR SOCIAL<br/>
			 DEL GOBIERNO DEL ESTADO DE COLIMA<br/>
			 P  R E S E  N T E
		</b></p>
	</div>
	<br>
	<div><p style='text-align:justify;' id="con">
		De conformidad al Artículo 61 del Decreto No. 252 y No. 415, en el que se Reforman, 
		Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de 
		Colima, publicado el 25 de Diciembre del 2010 en el Periódico Oficial del Estado de 
		Colima y el sábado 26 de noviembre del año 2011, respectivamente,  publicados en el 
		Periódico Oficial “El Estado de Colima”, el C. <u><b><?=$row6['ct_nombre']?></b></u>, 
		con domicilio en <u><b><?=$row6['ct_calle']?></b></u>, colonia 
		<u><b><?=$row7['cl_nombre']?></b></u>, municipio <u><b><?=$row7['mp_nombre']?></b></u>, en el estado de
		 <u><b><?=$row7['es_nombre']?></b></u>; solicita <u><b><?=$row1['valor_capturado']?></b></u> constancia (s) de:
	</p></div>
	<br>


	<?php
	$var1="EXPEDICION DE CONSTANCIA POR PERSONA DEL CURSO DE MANEJO Y DISPENSACION  DE MEDICAMENTOS A PROPIETARIOS Y/O EMPLEADOS DE FARMACIAS, DROGUERIAS Y BOTICAS CON VENTA DE MEDICAMENTOS EN GENERAL, IMPARTIDA POR INSTRUCTOR AUTORIZADO QUE CUENTE CON CLAVE ALFANUM";
	if(strcmp($row9['valor_capturado'],$var1)==0)
	{
	?>
	<table id="table"  align="center" class="marca">
	     <tbody>
         	<tr>
         		<td class="check-cell"><div class="check-area">&nbsp;&nbsp;&nbsp;<div></td>
	            <td align="left" style="border:inset 0pt">CONSTANCIA DEL CURSO DE CAPACITACION DE BUENAS PRACTICAS DE HIGIENE Y/O MANEJO HIGIENICO DE ALIMENTOS</td>

	            <td class="check-cell"><div class="check-area">X</div></td>
	            <td align="left" style="border:inset 0pt">EXPEDICION DE CONSTANCIA POR PERSONA DEL CURSO DE MANEJO Y DISPENSACION  DE MEDICAMENTOS A PROPIETARIOS Y/O EMPLEADOS DE FARMACIAS, DROGUERIAS Y BOTICAS CON VENTA DE MEDICAMENTOS EN GENERAL, IMPARTIDA POR INSTRUCTOR AUTORIZADO QUE CUENTE CON CLAVE ALFANUMERICA</td>

         	    

         	</tr>
         </tbody>
	</table>
	<?php } ?>

	<?php
	$var2="CONSTANCIA DEL CURSO DE CAPACITACION DE BUENAS PRACTICAS DE HIGIENE Y/O MANEJO HIGIENICO DE ALIMENTOS";
	if(strcmp($row9['valor_capturado'],$var2)==0)
	{
	?>
	<table id="table"  align="center" class="marca">
	     <tbody>
         	<tr>
         		<td class="check-cell"><div class="check-area">X</div></td>
	            <td align="left" style="border:inset 0pt">CONSTANCIA DEL CURSO DE CAPACITACION DE BUENAS PRACTICAS DE HIGIENE Y/O MANEJO HIGIENICO DE ALIMENTOS</td>

	            <td class="check-cell"><div class="check-area">&nbsp;&nbsp;&nbsp;<div></td>
	            <td align="left" style="border:inset 0pt">EXPEDICION DE CONSTANCIA POR PERSONA DEL CURSO DE MANEJO Y DISPENSACION  DE MEDICAMENTOS A PROPIETARIOS Y/O EMPLEADOS DE FARMACIAS, DROGUERIAS Y BOTICAS CON VENTA DE MEDICAMENTOS EN GENERAL, IMPARTIDA POR INSTRUCTOR AUTORIZADO QUE CUENTE CON CLAVE ALFANUMERICA</td>

         	    

         	</tr>
         </tbody>
	</table>
	<?php } ?>
	
	<br><br><br>
	<div>En la que asisistio(asistieron) el dia_____ de ______del __________.</div>
	<br><br><br><br><br>
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
	<br><br><br><br>
	<div><b>Nota: En caso de solicitar constancias demás personas, escribir sus nombres al 
	<br>reverso de esta hoja </b></div>

</body>

</html>
	
<style type="text/css" media="screen"> 

table.marca, .marca td, .marca tr{
					padding: 5px;
					text-align: left;
				    border: 0px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 9px;
					font-family: 'Calibri', Helvetica, Arial, sans-serif;
				    

				}
				#pie{
				font-family: "Times New Roman", Times, serif;
				font-size: 9px;
				font-style: italic;
			}
	
#primer{
	text-align: left;
	font-size: 9px;
	font-weight: bold;
	font-family: 'Calibri', Helvetica, Arial, sans-serif;
}
#con{
	font-size: 10px;
	font-weight: bold;
	font-family: 'Calibri', Helvetica, Arial, sans-serif;
}
td.check-cell {
		width: 1.5em;
		vertical-align: top;
	}
div.check-area {
		width: 0.50cm;
		height: 0.50cm;
		border: inset 1px solid #000;
		vertical-align: middle;
		text-align: center;
	}	



</style>
	
</style>
<?php
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "solicitud_constancia_manejo".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>

