<?php ob_start()or die(mysql_error());?>
<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$i=$_POST['i'];
	$lugar="SELECT * FROM solicitud s INNER JOIN servicio se 
	on s.id_servicio=se.id_servicio where id_solicitud='$i'";
	$lugares=mysql_query($lugar,$dbConn) or die(mysql_error());
	$row=mysql_fetch_array($lugares);

	//query datos cliente
	$dir="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
    inner join colonia cl on c.id_colonia=cl.id_colonia 
    inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
	inner join datos_fiscales df on c.id_cliente=df.id_cliente
    where id_solicitud= '$i'";
    $direc=mysql_query($dir,$dbConn) or die (mysql_error());
    $row2=mysql_fetch_array($direc);

    //query municipio
    $mun="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
    inner join colonia cl on c.id_colonia=cl.id_colonia
    inner join localidad l on cl.id_localidad=l.id_localidad 
    inner join municipio mp on l.id_municipio=mp.id_municipio where id_solicitud='$i'";
    $municipio=mysql_query($mun,$dbConn) or die(mysql_error());
    $row3=mysql_fetch_array($municipio);

      //query datos fiscales
    $datosf="SELECT * from solicitud s inner join  datos_fiscales df on s.id_cliente=df.id_cliente 
	inner join colonia cl on df.id_colonia=cl.id_colonia
	inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
	where id_solicitud='$i'";
	$datosfi=mysql_query($datosf,$dbConn) or die(mysql_error());
	$row4=mysql_fetch_array($datosfi);

	//query municipio datos fiscales
	$mundafi="SELECT * from solicitud s inner join datos_fiscales df on s.id_cliente=df.id_cliente
	inner join colonia cl on df.id_colonia=cl.id_colonia
	inner join localidad l on cl.id_localidad=l.id_localidad
	inner join municipio mp on l.id_municipio=mp.id_municipio where id_solicitud='$i'";
	$mundafisca=mysql_query($mundafi,$dbConn)or die(mysql_error());
	$row5=mysql_fetch_array($mundafisca);

	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>solicitud establecimientos</title>
	
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

	<div id="dato">
		De conformidad al Artículo 61 del Decreto No. 415, por el que se Reforman, Adicionan y 
		Derogan, diversas disposiciones de la Ley de Hacienda del Estado de Colima, publicado 
		el sábado 26 de noviembre del año 2011, en el Periódico Oficial “El Estado de Colima”, 
		el suscrito solicita Opinión técnica para el etiquetado de productos de: 
	</div>
    <br/>
	<table>
    	<thead></thead>
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Alimentos</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Bebidas Alcoholicas</td> 
			</tr>
			<tr>
	        	<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	        	<td align="left" style="border:inset 0pt">Insumos para la salud</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
			 	<td align="left" style="border:inset 0pt">Servicios de salud</td>
			</tr>
 			<tr>
	 			<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	 			<td align="left" style="border:inset 0pt">Salud ambiental</td>
			</tr>
 			<tr>
	 			<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	 			<td align="left"  style="border:inset 0pt">Bebidas no alcoholicas</td>
 			</tr>
 		
 			<tr>
	 			<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	 			<td align="left" style="border:inset 0pt">Productos de belleza</td>	
 			</tr>
		</tbody>
	</table>			
	<br/>
	<b>Del siguiente establecimiento:</b>
	<table id="tabla" style="width:100%">	
		<thead></thead>
		<tbody>
			<tr>
				<td width="30%" bgcolor="#E0E0E0"><b>NOMBRE DEL PROPIETARIO:</b></td>
				<td width="70%"><?=$row2['ct_nombre']?>&nbsp;<?=$row2['ct_apaterno']?>&nbsp;<?=$row2['ct_amaterno']?></td>
			</tr>
			<tr>
				<td>CALLE Y NUMERO</td>
				<td><?=$row2['ct_calle']?>&nbsp;#<?=$row2['ct_numero']?></td>
			</tr>
			<tr>
				<td>COLONIA</td>
				<td><?=$row2['cl_nombre']?></td>
			</tr>
			<tr>
				<td>DELEGACION O MUNICIPIO</td>
				<td><?=$row3['mp_nombre']?></td>
			</tr>
			<tr>
				<td bgcolor="#E0E0E0"><b> RAZON SOCIAL O DENOMINACION 
					<br/>DEL ESTABLECIMIENTO</b>
				</td>
				<td><?=$row4['df_razon_social']?></td>
			</tr>
			<tr>
				<td>CALLE Y NUMERO</td>
				<td><?=$row4['df_calle']?>&nbsp;#<?=$row4['df_numero']?></td>
			</tr>
			<tr>
				<td>COLONIA</td>
				<td><?=$row4['cl_nombre']?></td>
			</tr>
			<tr>
				<td>DELEGACION O MUNICIPIO</td>
				<td><?=$row5['mp_nombre']?></td>
			</tr>		
		</tbody>		
	</table>
	<br/>
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
	img.pequeña{
		width: 100px; 
		height: 100px; 
		opacity: 0.5;
	    position: absolute;
	    }

	#enc{
		text-align: right;
		position: absolute;
		font-size: 10;
		opacity: 0.5;
	   }

	#cab{
		font-size:10;
		text-align: center;
	}

	#primer,#dato,#fecha,#firma{
		font-size:10;
	}
	
	#tabla,th,td{
		font-size:10;
		border: 1px solid black;
		text-align:left;
		border-collapse:collapse;

	}
	
	
</style>
<?php
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "solicitud_establecimientos".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>