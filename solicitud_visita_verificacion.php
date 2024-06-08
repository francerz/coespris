<?php ob_start()or die(mysql_error());?>
<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$i=$_POST['i'];
$oficina= $_SESSION['oficina'];

$empl = "SELECT * FROM empleado INNER JOIN oficina using(id_oficina) WHERE id_oficina ='$oficina'";
$resu = mysql_query($empl,$dbConn);
$rown = mysql_fetch_array($resu);

//QUERY DE LOS CONSECUTIVOS

$n = "select * from oficina where id_oficina = '$oficina'";
$nn = mysql_query($n,$dbConn); 
$nom = mysql_fetch_array($nn);

//lema
		$lem = "SELECT * FROM lema WHERE lema_estatus =1";
		$resulema = mysql_query($lem,$dbConn);
		$lema = mysql_fetch_array($resulema);

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

//query datos cliente
$dir="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
inner join colonia cl on c.id_colonia=cl.id_colonia 
inner join codigo_postal cp on cl.id_cod_pos=cp.id_cod_pos 
inner join datos_fiscales df on c.id_cliente=df.id_cliente
where id_solicitud= '$i'";
$direc=mysql_query($dir,$dbConn) or die (mysql_error());
$row=mysql_fetch_array($direc);

//query clave scian
$scian="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_scian'";
$scianc=mysql_query($scian,$dbConn) or die(mysql_error());
$row6=mysql_fetch_array($scianc);

//query descripcion scian
$descian="SELECT * from dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_des_scian'";
$desi=mysql_query($descian,$dbConn)or die(mysql_error());
$row7=mysql_fetch_array($desi);


//query objeto de
$ob="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_objeto'";
$obje=mysql_query($ob,$dbConn)or die(mysql_error());
$row10=mysql_fetch_array($obje); 


//query radio
$rad="SELECT * FROM dss_solicitud inner join datos_secundarios_solicitud using(id_dat_sec_sol) where id_solicitud='$i' and dss_clave='key_estab_de'";
$radio=mysql_query($rad,$dbConn) or die(mysql_error());
$row9=mysql_fetch_array($radio);

//query municipio
$mun="SELECT * from solicitud s inner join cliente c on s.id_cliente=c.id_cliente 
inner join colonia cl on c.id_colonia=cl.id_colonia
inner join localidad l on cl.id_localidad=l.id_localidad 
inner join municipio mp on l.id_municipio=mp.id_municipio where id_solicitud='$i'";
$municipio=mysql_query($mun,$dbConn) or die(mysql_error());
$row8=mysql_fetch_array($municipio);

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
	<title>solicitud vista verificacion</title>
	</head>
	<body>
     <?php include("encabezado_solicitud.php"); ?>
     <br>
       <div id="primer">
		<p><b>C. SECRETARIO DE SALUD Y BIENESTAR SOCIAL<br>
			DEL GOBIERNO DEL ESTADO DE COLIMA<br>
			P  R E S E  N T E
		</b></p>
	</div>
	<p style='text-align:justify;' id="con">De conformidad al Artículo 61 del Decreto No. 415, en el que se Reforman, Adicionan y Derogan diversos artículos del Código Fiscal, Ley de Hacienda del Estado de Colima, 
	publicado el sábado 26 de noviembre del año 2011, respectivamente,  publicados en el Periódico Oficial “El Estado de Colima”, 
	solicito Visita de Verificación Sanitaria al establecimiento de: </p>
	<?php
	$prod="PRODUCTOS Y SERVICIOS";
	if(strcmp($row9['valor_capturado'],$prod)==0)
	{
	?>
	<table id="table"  align="center" class="marca">
	     <tbody>
         	<tr>
         		<td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Productos y servicios</td>

	            <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Servicios de salud</td>
         	
         	     <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">salud Ambiental</td>
         	    
         	    <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Insumos para la salud</td>
         	
         	</tr>
         </tbody>
	</table>
	<?php } ?>
	
	<?php
	$serv="SERVICIOS DE SALUD";
	if(strcmp($row9['valor_capturado'],$serv)==0)
	{
	?>
	<table id="table"  align="center" class="marca">
	     <tbody>
         	<tr>
         		<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Productos y servicios</td>

	            <td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Servicios de salud</td>
         	
         	     <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">salud Ambiental</td>
         	    
         	    <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Insumos para la salud</td>
         	
         	</tr>
         </tbody>
	</table>
	<?php } ?>

	<?php
	$sal="SALUD AMBIENTAL";
	if(strcmp($row9['valor_capturado'],$sal)==0)
	{
	?>
	<table id="table"  align="center" class="marca">
	     <tbody>
         	<tr>
         		<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Productos y servicios</td>

	            <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Servicios de salud</td>
         	
         	     <td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">salud Ambiental</td>
         	    
         	    <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Insumos para la salud</td>
         	
         	</tr>
         </tbody>
	</table>
	<?php } ?>

	<?php
	$ins="INSUMOS PARA LA SALUD";
	if(strcmp($row9['valor_capturado'],$ins)==0)
	{
	?>
	<table id="table"  align="center" class="marca">
	     <tbody>
         	<tr>
         		<td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Productos y servicios</td>

	            <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Servicios de salud</td>
         	
         	     <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">salud Ambiental</td>
         	    
         	    <td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Insumos para la salud</td>
         	
         	</tr>
         </tbody>
	</table>
	<?php } ?>

	<div id="con">
   <p><b>Con el objeto de:</b></p>
      </div>
	
	<?php
	$ver="VERIFICACION PARA VALORAR EL LEVANTAMIENTO DE LA MEDIDA DE SEGURIDAD";
	if(strcmp($row10['valor_capturado'], $ver)==0)
	{
	?>
	<table id ="o" class="marca">
	<tbody>
      <tr>
      <td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Verificación  para Valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación por la toma de muestras para valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para liberación de producto asegurado </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación general del establecimiento </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para toma de muestra de producto</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios por baja definitiva.</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios,  para destrucción de  producto.</td>

      </tr>
	</tbody>
	</table>
	<br>
	<?php }?>

	<?php
	$verd="VERIFICACION POR LA TOMA DE MUESTRAS PARA VALORAR EL LEVANTAMIENTO DE LA MEDIDA DE SEGURIDAD";
	if(strcmp($row10['valor_capturado'], $verd)==0)
	{
	?>
	<table id ="o" class="marca">
	<tbody>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación  para Valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Verificación por la toma de muestras para valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para liberación de producto asegurado </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación general del establecimiento </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para toma de muestra de producto</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios por baja definitiva.</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios,  para destrucción de  producto.</td>

      </tr>
	</tbody>
	</table>
	<br>
	<?php }?>

	<?php
	$vert="VERIFICACION PARA LA LIBERACION DE PRODUCTO ASEGURADO";
	if(strcmp($row10['valor_capturado'], $vert)==0)
	{
	?>
	<table id ="o" class="marca">
	<tbody>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación  para Valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación por la toma de muestras para valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Verificación para liberación de producto asegurado </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación general del establecimiento </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para toma de muestra de producto</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios por baja definitiva.</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios,  para destrucción de  producto.</td>

      </tr>
	</tbody>
	</table>
	<br>
	<?php }?>

	<?php
	$verc="VERIFICACION GENERAL DEL ESTABLECIMIENTO";
	if(strcmp($row10['valor_capturado'], $verc)==0)
	{
	?>
	<table id ="o" class="marca">
	<tbody>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación  para Valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación por la toma de muestras para valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para liberación de producto asegurado </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Verificación general del establecimiento </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para toma de muestra de producto</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios por baja definitiva.</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios,  para destrucción de  producto.</td>

      </tr>
	</tbody>
	</table>
	<br>
	<?php }?>

	<?php
	$verci="VERIFICACION PARA LA TOMA DE MUESTRA DE PRODUCTO";
	if(strcmp($row10['valor_capturado'], $verci)==0)
	{
	?>
	<table id ="o" class="marca">
	<tbody>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación  para Valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación por la toma de muestras para valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para liberación de producto asegurado </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación general del establecimiento </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Verificación para toma de muestra de producto</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios por baja definitiva.</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios,  para destrucción de  producto.</td>

      </tr>
	</tbody>
	</table>
	<br>
	<?php }?>

	<?php
	$vers="VERIFICACION PARA RETIRO DE SELLOS DE SUSPENSION DE TRABAJOS Y SERVICIOS POR BAJA DEFINITIVA";
	if(strcmp($row10['valor_capturado'], $vers)==0)
	{
	?>
	<table id ="o" class="marca">
	<tbody>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación  para Valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación por la toma de muestras para valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para liberación de producto asegurado </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación general del establecimiento </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para toma de muestra de producto</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios por baja definitiva.</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios,  para destrucción de  producto.</td>

      </tr>
	</tbody>
	</table>
	<br>
	<?php }?>

	<?php
	$versi="VERIFICACION PARA RETIRO DE SELLOS DE SUSPENSION DE TRABAJOS Y SERVICIOS, PARA DESTRUCCION DE PRODUCTO";
	if(strcmp($row10['valor_capturado'], $versi)==0)
	{
	?>
	<table id ="o" class="marca">
	<tbody>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación  para Valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación por la toma de muestras para valorar el levantamiento de la medida de seguridad</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para liberación de producto asegurado </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación general del establecimiento </td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para toma de muestra de producto</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">&nbsp;&nbsp;&nbsp;</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios por baja definitiva.</td>

      </tr>
      <tr>
      <td style="border:inset 1pt">X</td>
	            <td align="left" style="border:inset 0pt">Verificación para retiro de sellos de suspensión de trabajos y servicios,  para destrucción de  producto.</td>

      </tr>
	</tbody>
	</table>
	<br>
	<?php }?>

	<div id="primer">
	 <p><b>
        	Del siguiente establecimiento:</b>
        </b> </p>
        </div>
        <table id="nom" border="0" style="width:100%" align="center" class="solicitudes" >
         <thead>
         </thead>
         <tbody>
         <tr>
         		<td style="border:1px solid;padding:3px 3px;"width="30%" >CLAVE  (SCIAN)</td>
         		<td style="border:1px solid;padding:3px 3px;" width="50%"  colspan="2" >DESCRIPCIÓN DE SCIAN</td>
         		
         	</tr>
         	<tr>
         	    <td style="border:1px solid;padding:3px 3px;"width="30%"><?=$row6['valor_capturado']?></td>
         	   <td  style="border:1px solid;padding:3px 3px;" width="50%" colspan="2"><?=$row7['valor_capturado']?></td>

         	</tr>
            <tr>
         		<td style="border:1px solid;padding:3px 3px;"width="40%" bgcolor="#A4A4A4">Nombre del propietario:</td>
         		<td style="border:1px solid;padding:3px 3px;"width="20%" colspan="2"><?=$row['ct_nombre']?>&nbsp;<?=$row['ct_apaterno']?>&nbsp;<?=$row['ct_amaterno']?></td>
         		
         	</tr>
         	 	<tr>
         		<td style="border:1px solid;padding:3px 3px;"width="30%" >Calle<br><?=$row['ct_calle']?></td>
         		<td style="border:1px solid;padding:3px 3px;"width="30%" >Colonia<br><?=$row['cl_nombre']?></td>
         		<td style="border:1px solid;padding:3px 3px;"width="30%" >Municipio<br><?=$row8['mp_nombre']?></td>
         	</tr>
         	<tr>
         		<td style="border:1px solid;padding:3px 3px;"width="30%" bgcolor="#A4A4A4">Razon social </td>
         		<td style="border:1px solid;padding:3px 3px;"width="40%" colspan="2"><?=$row10['df_razon_social']?></td>
         		
         	</tr>
         	<tr>
         		<td style="border:1px solid;padding:3px 3px;" width="30%" >Calle y numero<br><?=$row10['df_calle']?>,#<?=$row10['df_numero']?></td>
         		<td style="border:1px solid;padding:3px 3px;"width="30%" >Colonia<br><?=$row10['cl_nombre']?></td>
         		<td style="border:1px solid;padding:3px 3px;"width="30%" > Municipio<br><?=$row11['mp_nombre']?></td>
         	</tr>
         </tbody>
       </table>
        <table id="firma" align="center">
	<tbody>	
	<tr>
	     <td>
           <u><b></u></b><br><br>
					     
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

table.solicitudes, .solicitudes td, .solicitudes tr{
					padding: 5px;
					text-align: left;
				    border: 1px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 10px;
					font-family: 'Calibri', Helvetica, Arial, sans-serif;
				    

				}

</style>
?>
<?php
	require_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = "solicitud_visita_verificacion".time().'.pdf';
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
	unlink($filename);
?>