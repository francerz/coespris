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

    //query tipo de opinion tecnica
    $op="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_opinion'";
    $opinion=mysql_query($op,$dbConn) or die(mysql_error());
    $row5=mysql_fetch_array($opinion);

 		//lema
		$lem = "SELECT * FROM lema WHERE lema_estatus =1";
		$resulema = mysql_query($lem,$dbConn);
		$lema = mysql_fetch_array($resulema);

		$query4 = mysql_query("SELECT * FROM solicitud sl INNER JOIN cliente c ON sl.id_cliente = c.id_cliente INNER JOIN datos_fiscales df ON c.id_cliente = df.id_cliente INNER JOIN colonia col ON 
			df.id_colonia = col.id_colonia INNER JOIN localidad loc ON col.id_localidad = loc.id_localidad INNER JOIN municipio mp ON loc.id_municipio = mp.id_municipio
			WHERE sl.id_solicitud = '$i'");
		$row4 = mysql_fetch_array($query4);

	  //query datos fiscales
    $datosf="SELECT * from solicitud s inner join  datos_fiscales df on s.id_cliente=df.id_cliente 
	inner join colonia cl on df.id_colonia=cl.id_colonia
	inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
	where id_solicitud='$i'";
	$datosfi=mysql_query($datosf,$dbConn) or die(mysql_error());
	$row6=mysql_fetch_array($datosfi);

	//query municipio datos fiscales
	$mundafi="SELECT * from solicitud s inner join datos_fiscales df on s.id_cliente=df.id_cliente
	inner join colonia cl on df.id_colonia=cl.id_colonia
	inner join localidad l on cl.id_localidad=l.id_localidad
	inner join municipio mp on l.id_municipio=mp.id_municipio where id_solicitud='$i'";
	$mundafisca=mysql_query($mundafi,$dbConn)or die(mysql_error());
	$row7=mysql_fetch_array($mundafisca);	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>solicitud establecimientos</title>
	
</head>
<body>
<?php include("encabezado_solicitud.php"); ?>
<br>
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
		el suscrito solicita Opinión técnica para el funcionamiento de su establecimiento de: 
	</div>
    <br/>
   <div id="tip">TIPO OPINION</div>
    <?php
    $estab="ESTABLECIMIENTO";
    if (strcmp($row5['valor_capturado'],$estab)==0) 
    {
    ?>
    <table class="marca">
    	<thead></thead>
    	<tbody>
    		<tr>
    			<td style="border:inset 1pt">X</td>
    			<td style="border:inset 0pt">Establecimientos</td>
    		</tr>
    		<tr>
    			<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
    			<td style="border:inset 0pt">Etiquetado de Productos</td>
    		</tr>
    	</tbody>
    </table>
    <br>
    <?php }?>
    <?php
    $etique="ETIQUETADO";
    if (strcmp($row5['valor_capturado'],$etique)==0) 
    {
    ?>
    <table class="marca">
    	<thead></thead>
    	<tbody>
    		<tr>
    			<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
    			<td style="border:inset 0pt">Establecimientos</td>
    		</tr>
    		<tr>
    			<td style="border:inset 1pt">X</td>
    			<td style="border:inset 0pt">Etiquetado de Productos</td>
    		</tr>
    	</tbody>
    </table>
    <br>
    <?php }?>
    <?php
    if($row["id_servicio"]=='1')
    {
    ?>
	<table class="marca">
    	<thead></thead>
        <tbody>
			<tr>
				<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Alimentos</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Alimentos y Bebidas Alcoholicas</td> 
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
	 			<td align="left" style="border:inset 0pt">Publicidad</td>	
			</tr>
		</tbody>
	</table>			
	<br/>
	<?php } ?>
	<?php
    if($row["id_servicio"]=='2')
    {
    ?>
	<table class="marca">
    	<thead></thead>
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Alimentos</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">X</td>
				<td align="left" style="border:inset 0pt">Alimentos y Bebidas Alcoholicas</td> 
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
	 			<td align="left" style="border:inset 0pt">Publicidad</td>	
			</tr>
		</tbody>
	</table>			
	<br/>
	<?php } ?>
	<?php
    if($row["id_servicio"]=='3')
    {
    ?>
	<table class="marca">
    	<thead></thead>
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Alimentos</td>
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Alimentos y Bebidas Alcoholicas</td> 
			</tr>		    
			<tr>
				<td style="border:inset 1pt">X</td>
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
	 			<td align="left" style="border:inset 0pt">Publicidad</td>	
			</tr>
		</tbody>
	</table>			
	<br/>
	<?php } ?>
	<?php
    if($row["id_servicio"]=='4')
    {
    ?>
	<table class="marca">
    	<thead></thead>
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Alimentos</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">alimentos y Bebidas Alcoholicas</td> 
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
				<td style="border:inset 1pt">X</td>
			 	<td align="left" style="border:inset 0pt">Servicios de salud</td>
			</tr>
 			<tr>
	 			<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	 			<td align="left" style="border:inset 0pt">Salud ambiental</td>
			</tr>
 			
 			<tr>
	 			<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	 			<td align="left" style="border:inset 0pt">Publicidad</td>	
			</tr>
		</tbody>
	</table>			
	<br/>
	<?php } ?>
	<?php
    if($row["id_servicio"]=='5')
    {
    ?>
	<table class="marca">
    	<thead></thead>
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Alimentos</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Alimentos y Bebidas Alcoholicas</td> 
			</tr>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Bebidas Alcoholicas</td> 
			</tr>
			<tr>
	        	<td style="border:inset 1pt">X</td>
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
	 			<td align="left" style="border:inset 0pt">Publicidad</td>	
			</tr>
		</tbody>
	</table>			
	<br/>
	<?php } ?>
	<?php
    if($row["id_servicio"]=='6')
    {
    ?>
	<table class="marca">
    	<thead></thead>
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Alimentos</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Alimentos y Bebidas Alcoholicas</td> 
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
	 			<td style="border:inset 1pt">X</td>
	 			<td align="left" style="border:inset 0pt">Salud ambiental</td>
			</tr>
 			<tr>
	 			<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	 			<td align="left" style="border:inset 0pt">Publicidad</td>	
			</tr>
		</tbody>
	</table>			
	<br/>
	<?php } ?>
	<?php
    if($row["id_servicio"]=='27')
    {
    ?>
	<table class="marca">
    	<thead></thead>
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Alimentos</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">Alimentos y Bebidas Alcoholicas</td> 
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
	 			<td style="border:inset 1pt">X</td>
	 			<td align="left" style="border:inset 0pt">Publicidad</td>	
			</tr>
		</tbody>
	</table>			
	<br/>
	<?php } ?>
	<b>Del siguiente establecimiento:</b>
	<table id="tabla" style="width:100%" class="solicitudes">	
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
				<td><?=$row6['df_razon_social']?></td>
			</tr>
			<tr>
				<td>CALLE Y NUMERO</td>
				<td><?=$row6['df_calle']?>&nbsp;#<?=$row6['df_numero']?>.</td>
			</tr>
			<tr>
				<td>COLONIA</td>
				<td><?=$row6['cl_nombre']?>.</td>
			</tr>
			<tr>
				<td>DELEGACION O MUNICIPIO</td>
				<td><?=$row7['mp_nombre']?>.</td>
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

	#primer,#tip{
		font-size:9px;
		text-align: left;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
		font-style: bold;
	}
	#cab{
		font-size:9px;
		text-align: center;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
		font-style: bold;
	}

	#fecha,#firma{
		font-size:9px;
	}
	#dato{
font-size:12px;
text-align: left;
	}
	

	
	table.solicitudes, .solicitudes td, .solicitudes tr{
					padding: 5px;
					text-align: left;
				    border: 1px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 9px;
					font-family: 'Calibri', Helvetica, Arial, sans-serif;
				    

				}
				table.marca, .marca td, .marca tr{
					padding: 5px;
					text-align: left;
				    border: 0px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 8px;
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
	$filename = "solicitud_establecimientos".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>