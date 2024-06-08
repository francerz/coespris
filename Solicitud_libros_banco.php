<?php ob_start()or die(mysql_error());?>

<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$i=$_POST['i'];

	//query datos cliente
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

    //query radio
    $libro="SELECT * FROM dss_solicitud INNER JOIN datos_secundarios_solicitud using(id_dat_sec_sol) WHERE id_solicitud='$i' and dss_clave='key_libros_b'";
    $libros=mysql_query($libro,$dbConn);
    $row3=mysql_fetch_array($libros);

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
	<title>form pdf</title>
	<link rel="stylesheet" href="">
</head>
<body>
		<?php include("encabezado_solicitud.php"); ?>
		<br/>
		</br>

	<div id="primer">
		<p><b>C. SECRETARIO DE SALUD Y BIENESTAR SOCIAL<br/>
			 DEL GOBIERNO DEL ESTADO DE COLIMA<br/>
			 P  R E S E  N T E
		</b></p>
	</div>
			
	<div id="dato">
		De conformidad al Artículo 61 del Decreto No. 252, en el que se Reforman, Adicionan y 
		Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima y 
		la Tarifa Para el Cobro De Productos, publicado el 25 de Diciembre del 2010 en el Periódico Oficial del Estado de Colima, 
		el suscrito solicita Autorización de Libros de: 
	</div>
	</br><br><br>
	<?php
	$banco="BANCOS DE SANGRE";
	if(strcmp($row3['valor_capturado'], $banco)==0)
	{ ?>
	<table class="marca">
		<thead></thead>
		<tbody>
			<tr>
				<td style="border:inset 1pt">X</td>
				<td style="border:inset 0pt">Banco de sangre</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td style="border:inset 0pt">Servicios de transfusión</td>
			</tr>
		</tbody>
	</table>
	</br><br><br><br>
<?php }?>
<?php
	$serv="SERVICIOS DE TRANSFUSION";
	if(strcmp($row3['valor_capturado'], $serv)==0)
	{ ?>
	<table class="marca">
		<thead></thead>
		<tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td style="border:inset 0pt">Banco de sangre</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">X</td>
				<td style="border:inset 0pt">Servicios de transfusión</td>
			</tr>
		</tbody>
	</table>
	</br><br><br><br>
<?php }?>
	<b>Del siguiente establecimiento:</b>
	<table id="tabla" style="width:100%" class="solicitudes">	
		<thead></thead>
		<tbody>
			<tr>
				<td width="30%" bgcolor="#E0E0E0"><b>NOMBRE DEL PROPIETARIO:</b></td>
				<td width="70%"><?=$row['ct_nombre']?>&nbsp;<?=$row['ct_apaterno']?>&nbsp;<?=$row['ct_amaterno']?></td>
			</tr>
			<tr>
				<td>CALLE Y NUMERO</td>
				<td><?=$row['ct_calle']?>&nbsp;#<?=$row['ct_numero']?></td>
			</tr>
			<tr>
				<td>COLONIA</td>
				<td><?=$row['cl_nombre']?></td>
			</tr>
			<tr>
				<td>DELEGACION O MUNICIPIO</td>
				<td><?=$row2['mp_nombre']?></td>
			</tr>
			<tr>
				<td bgcolor="#E0E0E0"><b> RAZON SOCIAL O DENOMINACION 
					<br/>DEL ESTABLECIMIENTO</b>
				</td>
				<td><?=$row4['df_razon_social']?></td>
			</tr>
			<tr>
				<td>CALLE Y NUMERO</td>
				<td><?=$row4['df_calle']?>&nbsp;#<?=$row3['df_numero']?></td>
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
	            <U>COLIMA, COL. A&nbsp;&nbsp;&nbsp;<?php echo $dias[date('w')]." ".date('d')?>&nbsp;&nbsp;&nbsp;de&nbsp;&nbsp;&nbsp;<?php echo $meses[date('n')-1]?>&nbsp;&nbsp;&nbsp;<?php echo date('Y')?></u>
	</div>
	<br/><br><br><br>
	<div id="firma" align="center">
		        _______________________________________________________________<br/>
		        Nombre y firma del propietario, representante o apoderado Legal.
	</div>

</body>

</html>
	
<style type="text/css" media="screen">
	
		table.solicitudes, .solicitudes td, .solicitudes tr{
					padding: 5px;
					text-align: left;
				    border: 1px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 11px;
					font-family: 'Calibri', Helvetica, Arial, sans-serif;
				    

				}
				table.marca, .marca td, .marca tr{
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
			#con,#dato{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
				font-style: bold;
			}
			#cab{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
				font-style: bold;
				text-align: center;
			}
			
	
</style>
<?php
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "solicitud_banco_sangre".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>