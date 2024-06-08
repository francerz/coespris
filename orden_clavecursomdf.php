<?php ob_start(); ?>
<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$i = (int)$_GET['i'];

require_once("conexion.php");
$banco = "select * from cuenta";
$bancoz = mysql_query($banco,$dbConn); 
$row = mysql_fetch_array($bancoz);
$oficina= $_SESSION['oficina'];

$contenido = "SELECT * FROM orden_pago INNER JOIN formato using(id_formato) WHERE id_solicitud = $i";
$conteni = mysql_query($contenido,$dbConn) or die("Error ".mysql_error());
$row6 = mysql_fetch_array($conteni);

$op = "select * from orden_pago where id_solicitud=$i";
$rep = mysql_query($op);
$op_total  = mysql_fetch_array($rep);

$asunto = "SELECT * FROM solicitud s INNER JOIN servicio sr using(id_servicio) WHERE id_solicitud = $i";
$ass = mysql_query($asunto,$dbConn);
$row4 = mysql_fetch_array($ass);


$da = "select * from datos_fiscales inner join colonia cl using(id_colonia) inner join codigo_postal using(id_cod_pos) inner join localidad lc on lc.id_localidad = cl.id_localidad
inner join municipio using(id_municipio) inner join estado using(id_estado) inner join solicitud using(id_cliente)
where id_solicitud = $i";
$daf = mysql_query($da,$dbConn); 
$row3 = mysql_fetch_array($daf);

$CL = "SELECT * FROM solicitud s INNER JOIN cliente cl using(id_cliente) INNER JOIN colonia col using(id_colonia)
INNER JOIN localidad loca using(id_localidad) WHERE id_solicitud = $i";
$cl2 = mysql_query($CL,$dbConn); 
$rok = mysql_fetch_array($cl2);


//autorizo
$quert = "SELECT * FROM empleado em INNER JOIN puesto ps ON em.id_puesto = ps.id_puesto WHERE ps.pu_nombre='COMISIONADO'";
$rz = mysql_query($quert,$dbConn);
$roz = mysql_fetch_array($rz);


$id_usu = $_SESSION['empleado'];
//QUERY DEL EMPLEADO LOGEADO
$empl = "SELECT * FROM empleado WHERE id_empleado = '$id_usu'";
$resu = mysql_query($empl,$dbConn);
$rown = mysql_fetch_array($resu);


//lema
$lem = "SELECT * FROM lema WHERE lema_estatus =1";
$resulema = mysql_query($lem,$dbConn);
$lema = mysql_fetch_array($resulema);

?>

<head>
    <meta charset="utf-8">
    <title>Reporte</title>
</head>
<body>
<?php include("encabezado_pdf.php");?>
	<div id="dato">
			<p align="left"  style='text-align:justify;'><b>BANCO:<?=$row['cn_razon_social_banco']?><br>
			NOMBRE:SERVICIOS DE SALUD DEL ESTADO DE COLIMA<br>
			NO. CUENTA:<?=$row['cn_numero_cuenta']?><br>
			CLABE:<?=$row['cn_clabe']?><br>
			</p>
	</div>
		<style type="text/css" media="screen">
			#dato{
				margin-top: 0.42em;
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
				font-style: bold;
			}
			#con{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
				font-style: bold;
			}
		</style>
	<div id="con">
		<p align="center" style='text-align:justify;'>   <?=$row6['fr_contenido']?>&nbsp;<u><b><?=$row4['sr_nombre']?></b></u>,sirvase cobrar al:</p>
	</div>
<br>
				<style>
					table.ordenes, .ordenes td, .ordenes tr{
					padding: 5px;
					text-align: left;
				    border: 0px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 12px;
					font-family: 'Calibri', Helvetica, Arial, sans-serif;
				    

				}
				div{
					font-size: 10;
				}


			</style>

<h5 align="left" id="nom"><u>C. <?=$rok['ct_nombre']?>&nbsp;<?=$rok['ct_apaterno']?>&nbsp;<?=$rok['ct_amaterno']?>.</u></h5>

			<table style="width:100%" class="ordenes">
			  <tr>
			    	<td width="20%">Con domicilio en:</td>
					<td><u><?=$rok['ct_calle']?>&nbsp;No.<?=$rok['ct_numero']?>. COL. <?=$rok['cl_nombre']?>.</u></td>
			  <tr>
			    	<td>De la localidad de:</td>
			    	<td><u><?=$rok['lc_nombre']?>,<?=$row3['es_nombre']?>.</u></td>		
			    
			  </tr>
			  <tr>
			   		<td>La cantidad de:</td>
			    	<td><u>$
			    	<?php 
			    	$im = $op_total['op_total'];
					  require_once("letras.php");
					  $resultado = num2letras($im);
					  echo "$im". " " ."($resultado)";
					  ?></u></td>		
			    
			  </tr>
			</table>
</div>
<br><br>
<br>
		<div id="firmas">
			<h3 align="center">A T E N T A M E N T E</h3>
			<h5 align="center">____________________________________</h5>
			<h5 align="center" align="justify">I.B.Q. <?=$roz['em_nombres']?> <?=$roz['em_apaterno']?> <?=$roz['em_amaterno']?><br>
			COMISIONADO ESTATAL PARA LA PROTECCI&Oacute;N<br>
			CONTRA RIESGOS SANITARIOS</h5>
		</div>
		<br>
		<div id="sec">
		<p align="left" id="elaborado">Elaborado por: <?=$rown['em_nombres']?><label> </label><?=$rown['em_apaterno']?><label> </label><?=$rown['em_amaterno']?></p>
		<br><br>
		<h5 align="center" id="pie"><?=$lema['lema_texto']?></h5>
</div>
</body>
<style type="text/css" media="screen">
	#sec{
		font-size: 12px;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
	}
	#elaborado{
		font-size: 9px;
		font-family: 'Calibri', Helvetica, Arial, sans-serif;
	}

			#firmas{
				font-size: 12px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
			#pie{
				font-family: "Times New Roman", Times, serif;
				font-size: 12px;
				font-style: italic;
			}
	</style>


<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Orden_clavecurso".time().'.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
unlink($filename);
?>