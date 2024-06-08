<?php ob_start() or die(mysql_error());?>
<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$i=$_POST['i'];

	$dir="SELECT * FROM solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
	inner join colonia cl on c.id_colonia=cl.id_colonia 
	inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
	inner join datos_fiscales df on c.id_cliente=df.id_cliente
	where id_solicitud='$i'";
	$direc=mysql_query($dir,$dbConn) or die (mysql_error());
	$row=mysql_fetch_array($direc);

	//query municipio
    $mun="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
    inner join colonia cl on c.id_colonia=cl.id_colonia
    inner join localidad l on cl.id_localidad=l.id_localidad 
    inner join municipio mp on l.id_municipio=mp.id_municipio where id_solicitud='$i'";
    $municipio=mysql_query($mun,$dbConn) or die(mysql_error());
    $row2=mysql_fetch_array($municipio);
	
    //query domicilio
    $dom="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud='$i' and dss_clave='key_domicilio'";
    $domi=mysql_query($dom,$dbConn) or die(mysql_error());
    $row3=mysql_fetch_array($domi);

    //query calle
    $calle="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud='$i' and dss_clave='key_calle'";
    $calles=mysql_query($calle,$dbConn) or die(mysql_error());
    $row4=mysql_fetch_array($calles);

    //query clave scian
    $scian="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_scian'";
    $scianc=mysql_query($scian,$dbConn) or die(mysql_error());
    $row6=mysql_fetch_array($scianc);

    //query descripcion scian
    $descian="SELECT * from dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_des_scian'";
    $desi=mysql_query($descian,$dbConn)or die(mysql_error());
    $row7=mysql_fetch_array($desi);

    //query expediente
    $exp="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_expedien'";
    $expe=mysql_query($exp,$dbConn) or die(mysql_error());
    $row8=mysql_fetch_array($expe);

    //query radio
    $rad="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_estab_de'";
    $radio=mysql_query($rad,$dbConn) or die(mysql_error());
    $row9=mysql_fetch_array($radio);
    //lema
	$lem = "SELECT * FROM lema WHERE lema_estatus =1";
	$resulema = mysql_query($lem,$dbConn);
	$lema = mysql_fetch_array($resulema);

	//query datos fiscales
    $datosf="SELECT * from solicitud s inner join  datos_fiscales df on s.id_cliente=df.id_cliente 
	inner join colonia cl on df.id_colonia=cl.id_colonia
	inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
	where id_solicitud='$i'";
	$datosfi=mysql_query($datosf,$dbConn) or die(mysql_error());
	$row10=mysql_fetch_array($datosfi);

	//query municipio datos fiscales
	$mundafi="SELECT * from solicitud s inner join datos_fiscales df on s.id_cliente=df.id_cliente
	inner join colonia cl on df.id_colonia=cl.id_colonia
	inner join localidad l on cl.id_localidad=l.id_localidad
	inner join municipio mp on l.id_municipio=mp.id_municipio where id_solicitud='$i'";
	$mundafisca=mysql_query($mundafi,$dbConn)or die(mysql_error());
	$row11=mysql_fetch_array($mundafisca);



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
	<?php include("encabezado_solicitud.php");?>	
	<br><br>
	<div id="primer">
		<p><b>C. SECRETARIO DE SALUD Y BIENESTAR SOCIAL<br/>
			 DEL GOBIERNO DEL ESTADO DE COLIMA<br/>
			 P  R E S E  N T E
		</b></p>
	</div>
	<br>
	<div id="datos">
	De conformidad al Artículo 61 del Decreto No. 252, en el que se Reforman, Adicionan y 
	Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima y la 
	Tarifa para el Cobro de Productos, publicado el 25 de Diciembre del 2010 en el 
	Periódico Oficial del Estado de Colima, el suscrito solicita Reposición de Aviso de Apertura o Funcionamiento de: 
	</div>
	<br>
	<?php
	$prod="PRODUCTOS Y SERVICIOS";
	if(strcmp($row9['valor_capturado'],$prod)==0)
{
	?>
	<table class="if">
		<thead></thead>
		<tbody>
			<tr>
				<td style="border:inset 1pt">X</td>
				<td align="left" style="border:inset 0pt">Productos y Servicios</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Servicios de Salud</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Salud Ambiental</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Insumos para la Salud</td>
			</tr>
		</tbody>
	</table>
	<br>
<?php }?>
<?php
	$serv="SERVICIOS DE SALUD";
	if(strcmp($row9['valor_capturado'],$serv)==0)
{
	?>
	<table class="if">
		<thead></thead>
		<tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Productos y Servicios</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">X</td>
				<td align="left" style="border:inset 0pt">Servicios de Salud</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Salud Ambiental</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Insumos para la Salud</td>
			</tr>
		</tbody>
	</table>
	<br>
<?php }?>
<?php
	$sal="SALUD AMBIENTAL";
	if(strcmp($row9['valor_capturado'],$sal)==0)
{
	?>
	<table class="if">
		<thead></thead>
		<tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Productos y Servicios</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Servicios de Salud</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">X</td>
				<td align="left" style="border:inset 0pt">Salud Ambiental</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Insumos para la Salud</td>
			</tr>
		</tbody>
	</table>
	<br>
<?php }?>
<?php
	$ins="INSUMOS PARA LA SALUD";
	if(strcmp($row9['valor_capturado'],$ins)==0)
{
	?>
	<table class="if">
		<thead></thead>
		<tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Productos y Servicios</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Servicios de Salud</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Salud Ambiental</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">X</td>
				<td align="left" style="border:inset 0pt">Insumos para la Salud</td>
			</tr>
		</tbody>
	</table>
	<br>
<?php }?>
	<div align="left">Del  establecimiento con número de expediente: <u><?=$row8['valor_capturado']?></u></div>
	<br><br>
	<table style="width:100%" class="solicitudes">
		<thead></thead>
		<tbody>
			<tr>
				<td width="50%"><b>CLAVE(SCIAN) O (CMAP)</b></td>
				<td width="50%" colspan="2"><b>DESCRIPCION DE (SCIAN) O (CMAP)</b></td>
			</tr>
			<tr>
				<td><?=$row6['valor_capturado']?></td>
				<td colspan="2"><?=$row7['valor_capturado']?></td>
			</tr>
			<tr>
				<td><b>NOMBRE DEL PROPIETARIO:</b></td>
				<td colspan="2"><?=$row['ct_nombre']?>&nbsp;<?=$row['ct_apaterno']?>&nbsp;<?=$row['ct_amaterno']?></td>
			</tr>
			<tr>
				<td><b>CALLE Y NUMERO</b><br><?=$row['ct_calle']?>,#<?=$row['ct_numero']?></td>
				<td><b>COLONIA</b><br><?=$row['cl_nombre']?></td>
				<td><b>DELAGACION O MUNICIPIO</b><br> <?=$row2['mp_nombre']?></td>
			</tr>
			<tr>
				<td><b>RAZON SOCIAL O DENOMINACION <br> DEL ESTABELCIMIENTO:</b></td>
				<td colspan="2"><?=$row10['df_razon_social']?></td>
			</tr>
			<tr>
				<td><b>CALLE Y NUMERO</b><br><?=$row10['df_calle']?>,#<?=$row10['df_numero']?></td>
				<td><b>COLONIA </b><br><?=$row10['cl_nombre']?></td>
				<td><b>DELAGACION O MUNICIPIO</b><br><?=$row11['mp_nombre']?></td>
			</tr>

		</tbody>
	</table>
	<br><br><br>
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


	#primer,#datos,#fecha,#firma{
		font-size:9px;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
		font-weight: bold;
	}
	
	table.solicitudes, .solicitudes td, .solicitudes tr{
					padding: 5px;
					text-align: left;
				    border: 1px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 11px;
					font-family: 'Calibri', Helvetica, Arial, sans-serif;
				    

				}
				table.if, .if td, .if tr{
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
	$filename = "solicitud_reposicion_apertura".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>

