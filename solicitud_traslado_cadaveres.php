<?php ob_start() or die (mysql_error());?>
<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$i=$_POST['i'];
require_once("conexion.php");
 //lema
		$lem = "SELECT * FROM lema WHERE lema_estatus =1";
		$resulema = mysql_query($lem,$dbConn);
		$lema = mysql_fetch_array($resulema);
$oficina= $_SESSION['oficina'];

$dir="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
inner join colonia cl on c.id_colonia=cl.id_colonia 
inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
inner join datos_fiscales df on c.id_cliente=df.id_cliente
where id_solicitud= '$i'";
$direc=mysql_query($dir,$dbConn) or die (mysql_error());
$row=mysql_fetch_array($direc);

$empl = "SELECT * FROM empleado INNER JOIN oficina using(id_oficina) WHERE id_oficina ='$oficina'";
$resu = mysql_query($empl,$dbConn);
$rown = mysql_fetch_array($resu);

//QUERY DE LOS CONSECUTIVOS

$n = "select * from oficina where id_oficina = '$oficina'";
$nn = mysql_query($n,$dbConn); 
$nom = mysql_fetch_array($nn);

//QUERY DEL ENCABEZADO.

$encab = "SELECT * FROM oficina where id_oficina = '$oficina'";
$enca = mysql_query($encab,$dbConn);
$enrow = mysql_fetch_array($enca);
$asunto = "SELECT * FROM solicitud s INNER JOIN servicio sr using(id_servicio) WHERE id_solicitud = $i";
$ass = mysql_query($asunto,$dbConn);
$row4 = mysql_fetch_array($ass);

$dom="SELECT * from dss_solicitud where id_solicitud= '$i' and id_dat_sec_sol=6";
$domi=mysql_query($dom,$dbConn) or die(mysql_error());
$row3=mysql_fetch_array($domi);

//query tipo servicio
$tip="SELECT * FROM solicitud s INNER JOIN servicio se on s.id_servicio=se.id_servicio where id_solicitud='$i'";
$tipos=mysql_query($tip,$dbConn) or die(mysql_error());
$row5=mysql_fetch_array($tipos);

$fin="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_finado'";
$finado=mysql_query($fin,$dbConn);
$row6=mysql_fetch_array($finado);

$apfin="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_apat_fin'";
$apfinado=mysql_query($apfin,$dbConn);
$row8=mysql_fetch_array($apfinado);

$amfin="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_amat_fin'";
$amfinado=mysql_query($amfin,$dbConn);
$row9=mysql_fetch_array($amfinado);

$inhu="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_inhumacion'";
$inhumacion=mysql_query($inhu,$dbConn);
$row7=mysql_fetch_array($inhumacion);


?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>solicitud traslado de cadaveres</title>
</head>
<body>
<?php include("encabezado_solicitud.php"); ?>
	<br/>


       <div id="primer">
	<p><b>C. SECRETARIO DE SALUD Y BIENESTAR SOCIAL<br>
		DEL GOBIERNO DEL ESTADO DE COLIMA<br>
		P  R E S E  N T E
	</b></p><br>

     De conformidad al Artículo 61 del Decreto No. 415, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima, publicado el sábado 26 de noviembre del año 2011 en el Periódico Oficial “El Estado de Colima”, solicito el: 
	</div></div>
	<br>
         <?php
         if($row5['id_servicio']=='10')
         {
         ?>
         <table id="a">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Traslado</td>
         	</tr>
         </tbody>
         </table>
         <br>
	<table id="b">
        <tbody>
			<tr>
				<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">A otra entidad federativa</td> 
			</tr>
			<tr>
	        	<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	        	<td align="left" style="border:inset 0pt">A otro país
			</tr>
			
		</tbody>
	</table>
	<br>		
	 <table id="c">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Exhumación</td>
         	</tr>
         </tbody>
         </table>
         <br>
        <table id="d">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">En el mismo panteón De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">En otros municipios del estado</td> 
			</tr>			
		</tbody>
	</table>
	<br>	
<table id="e">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Cremación</td>
			</tr>		    		
		</tbody>
	</table>
	<?php } ?>

	         <?php
         if($row5['id_servicio']=='11')
         {
         ?>
         <table id="a">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Traslado</td>
         	</tr>
         </tbody>
         </table>
         <br>
	<table id="b">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">X</td>
				<td align="left" style="border:inset 0pt">A otra entidad federativa</td> 
			</tr>
			<tr>
	        	<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	        	<td align="left" style="border:inset 0pt">A otro país
			</tr>
			
		</tbody>
	</table>
	<br>		
	 <table id="c">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Exhumación</td>
         	</tr>
         </tbody>
         </table>
         <br>
        <table id="d">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">En el mismo panteón De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">En otros municipios del estado</td> 
			</tr>			
		</tbody>
	</table>
	<br>	
<table id="e">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Cremación</td>
			</tr>		    		
		</tbody>
	</table>
	<?php } ?>

	         <?php
         if($row5['id_servicio']=='12')
         {
         ?>
         <table id="a">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Traslado</td>
         	</tr>
         </tbody>
         </table>
         <br>
	<table id="b">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">A otra entidad federativa</td> 
			</tr>
			<tr>
	        	<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	        	<td align="left" style="border:inset 0pt">A otro país
			</tr>
			
		</tbody>
	</table>
	<br>		
	 <table id="c">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Exhumación</td>
         	</tr>
         </tbody>
         </table>
         <br>
        <table id="d">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">En el mismo panteón De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">En otros municipios del estado</td> 
			</tr>			
		</tbody>
	</table>
	<br>	
<table id="e">
        <tbody>
			<tr>
				<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Cremación</td>
			</tr>		    		
		</tbody>
	</table>
	<?php } ?>

	         <?php
         if($row5['id_servicio']=='13')
         {
         ?>
         <table id="a">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Traslado</td>
         	</tr>
         </tbody>
         </table>
         <br>
	<table id="b">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">A otra entidad federativa</td> 
			</tr>
			<tr>
	        	<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	        	<td align="left" style="border:inset 0pt">A otro país
			</tr>
			
		</tbody>
	</table>
	<br>		
	 <table id="c">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Exhumación</td>
         	</tr>
         </tbody>
         </table>
         <br>
        <table id="d">
        <tbody>
			<tr>
				<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">En el mismo panteón De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">En otros municipios del estado</td> 
			</tr>			
		</tbody>
	</table>
	<br>	
<table id="e">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Cremación</td>
			</tr>		    		
		</tbody>
	</table>
	<?php } ?>
	         <?php
         if($row5['id_servicio']=='14')
         {
         ?>
         <table id="a">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Traslado</td>
         	</tr>
         </tbody>
         </table>
         <br>
	<table id="b">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">A otra entidad federativa</td> 
			</tr>
			<tr>
	        	<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	        	<td align="left" style="border:inset 0pt">A otro país
			</tr>
			
		</tbody>
	</table>
	<br>		
	 <table id="c">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Exhumación</td>
         	</tr>
         </tbody>
         </table>
         <br>
        <table id="d">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">En el mismo panteón De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">X</td>
				<td align="left" style="border:inset 0pt">En otros municipios del estado</td> 
			</tr>			
		</tbody>
	</table>
	<br>	
<table id="e">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Cremación</td>
			</tr>		    		
		</tbody>
	</table>
	<?php } ?>

	         <?php
         if($row5['id_servicio']=='23')
         {
         ?>
         <table id="a">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Traslado</td>
         	</tr>
         </tbody>
         </table>
         <br>
	<table id="b">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">A otra entidad federativa</td> 
			</tr>
			<tr>
	        	<td style="border:inset 1pt">X</td>
	        	<td align="left" style="border:inset 0pt">A otro país
			</tr>
			
		</tbody>
	</table>
	<br>		
	 <table id="c">
         <tbody>
         	<tr>
         		<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Exhumación</td>
         	</tr>
         </tbody>
         </table>
         <br>
        <table id="d">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">En el mismo panteón De un municipio a otro municipio del estado.</td>
			</tr>		    
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
				<td align="left" style="border:inset 0pt">En otros municipios del estado</td> 
			</tr>			
		</tbody>
	</table>
	<br>	
<table id="e">
        <tbody>
			<tr>
				<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Cremación</td>
			</tr>		    		
		</tbody>
	</table>
	<?php } ?>	

      <div id="primer">
	 <p><b>
        	Datos del finado:</b>
        </b> </p>
        </div>
       <table id="nom" border="0" style="width:70%" align="center">
         <thead>

         	<tr>
         		<td style="border:1px solid;padding:3px 3px;"width="60%" bgcolor="#A4A4A4">Nombre </td>
         		<td style="border:1px solid;padding:3px 3px;"width="40%" bgcolor="#A4A4A4">Fecha</td>
         	</tr>

         </thead>
         <tbody>
         	<tr>
         		<td style="border:1px solid;padding:3px 3px;"><?=$row6['valor_capturado']?>&nbsp;<?=$row8['valor_capturado']?>&nbsp;<?=$row9['valor_capturado']?></td>
         		<td style="border:1px solid;padding:3px 3px;"><?=$row7['valor_capturado']?></td>
         	</tr>
         </tbody>
       </table>
       <br>
        <div id="primer">
	 <p><b>
        	Datos del solicitante:</b>
      </p>
        </div>
        <table id="dom" border="0" style="width:70%" align="center">
        	<thead>
        <tbody>		
         	<tr>
         		<td style="border:1px solid;padding:3px 3px;" width="30%" bgcolor="#A4A4A4">Nombre </td>
         		<td style="border:1px solid;padding:3px 3px;" width="70%" ><?=$row['ct_nombre']?>&nbsp;<?=$row['ct_apaterno']?>&nbsp;<?=$row['ct_amaterno']?></td>
         	</tr>
         </thead>
         </tbody>
        </table>
        <div align="center" id="fecha">
        <br>
		<?php
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
				
				?>
			COLIMA, COL.A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><?php echo $dias[date('w')]." ".date('d') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $meses[date('n')-1]?>&nbsp;&nbsp;del&nbsp;&nbsp;<?php echo date('Y')?></u>	
		</div>
	<table id="firma" align="center">
	<tbody>	
	<tr>
	     <td><br><br><br><br>
					_________________________________________________<br><br>	
					Nombre y Firma del propietario Representante
					             O Apodero Legal          <br><br>
	     </td>
	</tr>        
</tbody>
</table>
</body>
</html>
<style type="text/css" media="screen"> 

#enc{
	font-size:7;
	text-align:right;
	position:absolute;
 	font-family: 'Calibri', Helvetica, Arial, sans-serif;
	opacity: 0.5;	
	
}

#cab{
	font-size:9;
	text-align:center;
	font-family: 'Calibri', Helvetica, Arial, sans-serif;
}
#datos,#primer{
	font-size:9;
	font-family: 'Calibri', Helvetica, Arial, sans-serif;
}

#firma,#dato,#dom,#tabla{
	font-size:9;
}
#nom{
	font-size:9;
	font-family: 'Calibri', Helvetica, Arial, sans-serif;
		border: 1px solid black;
		border-collapse:collapse;
		text-align:center;
}
#fecha{
	font-size:9;
	font-family: 'Calibri', Helvetica, Arial, sans-serif;
    
		text-align:center;
}
#dom{
	font-size:9;
	font-family: 'Calibri', Helvetica, Arial, sans-serif;
		border: 1px solid black;
		border-collapse:collapse;
		text-align:center;
}

#a,#b,#c,#d,#e{
	font-size:9;
	text-align:center;
	font-family: 'Calibri', Helvetica, Arial, sans-serif;
}

</style>

<?php

	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "solicitud_traslado_de_cadaveres".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);

?>