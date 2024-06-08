<?php ob_start() or die(mysql_error());?>
<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$i=$_POST['i'];

	$curso="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_curso_de'";
	$cursos=mysql_query($curso) or die(mysql_error());
	$row=mysql_fetch_array($cursos);

	$per="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' AND id_dat_sec_sol=27";
	$perso=mysql_query($per,$dbConn);
	$row2=mysql_fetch_array($perso);

	$nomb="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_nombre_cur'";
	$nombre=mysql_query($nomb,$dbConn);
	$row3=mysql_fetch_array($nombre);

	$dir="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
    inner join colonia cl on c.id_colonia=cl.id_colonia 
    inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
	inner join datos_fiscales df on c.id_cliente=df.id_cliente
    where id_solicitud= '$i'";
    $direc=mysql_query($dir,$dbConn) or die (mysql_error());
    $row4=mysql_fetch_array($direc);
    //lema
	$lem = "SELECT * FROM lema WHERE lema_estatus =1";
	$resulema = mysql_query($lem,$dbConn);
	$lema = mysql_fetch_array($resulema);
    //query municipio
    $mun="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
    inner join colonia cl on c.id_colonia=cl.id_colonia
    inner join localidad l on cl.id_localidad=l.id_localidad 
    inner join municipio mp on l.id_municipio=mp.id_municipio where id_solicitud='$i'";
    $municipio=mysql_query($mun,$dbConn) or die(mysql_error());
    $row5=mysql_fetch_array($municipio);

	$da = "select * from datos_fiscales inner join colonia cl using(id_colonia) inner join codigo_postal using(id_cod_pos) inner join localidad lc on lc.id_localidad = cl.id_localidad
	inner join municipio using(id_municipio) inner join estado using(id_estado) inner join solicitud using(id_cliente)
	where id_solicitud = $i";
	$daf = mysql_query($da,$dbConn); 
	$ro3 = mysql_fetch_array($daf);
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
<br>
	<?php include("encabezado_solicitud.php");?>
	<br>
	<br/>

	<div id="primer">
		<p><b>C. SECRETARIO DE SALUD Y BIENESTAR SOCIAL<br/>
			 DEL GOBIERNO DEL ESTADO DE COLIMA<br/>
			 P  R E S E  N T E
		</b></p>
	</div>
	<br>
	<div>
	De conformidad al Artículo 61 del Decreto No. 252 y No. 415, en el que se Reforman, 
	Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de 
	Colima, publicado el 25 de Diciembre del 2010 en el Periódico Oficial del Estado de 
	Colima y el sábado 26 de noviembre del año 2011, respectivamente,  publicados en el 
	Periódico Oficial “El Estado de Colima”, el  C. <u><?=$row4['ct_nombre']?>&nbsp;<?=$row4['ct_apaterno']?>&nbsp;<?=$row4['ct_amaterno']?></u>, 
	con domicilio en <u><?=$row4['ct_calle']?>,<?=$row4['ct_numero']?></u>, colonia <u><?=$row4['cl_nombre']?></u>, municipio <u><?=$row5['mp_nombre']?></u>, 
	en el estado de <u><?=$ro3['es_nombre']?></u>; solicito curso de capacitación de
	</div>
	<br><br><br>

<?php
	$manejo="MANEJO Y DISPENSACION DE MEDICAMENTOS A PROPIETARIOS Y/O EMPLEADOS DE FARMACIAS, DROGUERIAS Y BOTICAS CON VENTA DE MEDICAMENTOS EN GENERAL";
	if(strcmp($row['valor_capturado'],$manejo)==0)
{
	?>
	<table class="solicitudes">
		<thead></thead>
		<tbody>
			<tr>
				<td style="border:inset 1pt">X</td>
				<td align="left" style="border:inset 0pt">
				Manejo y dispensación de medicamentos a propietarios y/o empleados de farmacias,
				 droguerías y boticas con venta de medicamentos en general</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Nombre del curso:_____________________________________________  </td>
			</tr>
		</tbody>
	</table>
	<br><br><br>
<?php } ?>

<?php
	$otro="OTROS";
	if(strcmp($row['valor_capturado'],$otro)==0)
{
	?>
	<table class="solicitudes">
		<thead></thead>
		<tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">
				Manejo y dispensación de medicamentos a propietarios y/o empleados de farmacias,
				 droguerías y boticas con venta de medicamentos en general</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">X</td>
				<td align="left" style="border:inset 0pt">Nombre del curso: <u><?=$row2['valor_capturado']?></u></td>
			</tr>
		</tbody>
	</table>
	<br><br><br>
<?php } ?>

	<div>En el que asistira(n) <u><?=$row2['valor_capturado']?></u> persona(s).</div>
	<br><br>
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
	<br>

</body>

</html>
	<style type="text/css" media="screen">
	#cab{
		font-size:10;
		text-align: center;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
		font-style: bold;
	}
	}

	#dato,#fecha,#firma{
		font-size:10;
	}
	#con,#primer{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
				font-style: bold;
	}

	
	table.solicitudes, .solicitudes td, .solicitudes tr{
					padding: 5px;
					text-align: left;
				    border: 0px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 11px;
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
	$filename = "solicitud_curso_capacitacion".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>


