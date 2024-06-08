<?php ob_start(); ?>
<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$i = $_POST['i'];
require_once("conexion.php");
$banco = "select * from cuenta";
$bancoz = mysql_query($banco,$dbConn); 
$row = mysql_fetch_array($bancoz);

$fr = "select * from formato inner join servicio on formato.id_formato = servicio.id_formato_solicitud 
inner join solicitud using(id_servicio) where id_solicitud = $i";
$result = mysql_query($fr,$dbConn); 
$row2 = mysql_fetch_array($result);

$asunto = "SELECT * FROM solicitud s INNER JOIN servicio sr using(id_servicio) WHERE id_solicitud = $i";
$ass = mysql_query($asunto,$dbConn);
$row4 = mysql_fetch_array($ass);


$da = "select * from datos_fiscales inner join colonia cl using(id_colonia) inner join codigo_postal using(id_cod_pos) inner join localidad lc on lc.id_localidad = cl.id_localidad
inner join municipio using(id_municipio) inner join estado using(id_estado) inner join solicitud using(id_cliente)
where id_solicitud = $i";
$daf = mysql_query($da,$dbConn); 
$row3 = mysql_fetch_array($daf);
?>

<head>
    <meta charset="utf-8">
    <title>Reporte</title>
</head>
<body>
<div id="im">
	<img class="pequeña" src="assets/img/logocolima.jpg"/ width="10%" height="10%">

		<div id="enc">
			<h4>
				SERVICIOS DE SALUD DEL ESTADO DE COLIMA	
				<br>
				AV. LICEO DE BARONES ESQ. DR. RUBÉN,
				<br>
			    COL. LA ESPERANZA COLIMA, COL. 
			    <br>
			    COMISIÓN ESTATAL PARA LA PROTECCIÓN 
			    <br>
			    CONTRA RIESGOS SANITARIOS.
			    <br>
			    AV. AYUNTAMIENTO ESQ. ARNOLDO VOGUEL CARRILLO
			    <br>
			    COL. BURÓCRATAS MUNICIPALES, COLIMA, COL.
			    <br><br>
				ASUNTO: <?=$row4['sr_nombre']?>
				<br>
				NO. OFICIO: GTA  5002- 147-CMN/12
				<br>
				Colima, Col. 
				<?php
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
				echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ; 
				?>

			</h4>
		</div>
</div>
	<style type="text/css" media="screen">
			img.pequeña{width: 100px; height: 100px; opacity: 0.5;
			position: absolute;
			}
			#enc{
				text-align: right;
				position: absolute;
				font-size: 10;
			}
	</style>
<br><br><br><br><br><br>
	<div id="dato">
			<h3>BANCO:<?=$row['cn_razon_social_banco']?><br>
			NOMBRE:SERVICIOS DE SALUD DEL ESTADO DE COLIMA<br>
			NO. CUENTA:<?=$row['cn_numero_cuenta']?><br>
			CLABE:<?=$row['cn_clabe']?></h3>
	</div>
		<style type="text/css" media="screen">
			#dato{
				margin-top: 0.42em;
				font-size: 10;
			}
		</style>
<br>
	<div>
		<h3 align="center" align="justify"><?=$row2['fr_contenido']?></h3>
	</div>
<br><br>
				<style>
					table, th, td {
					padding: 5px;
					text-align: left;
				    border: 1px solid black;
				    border-collapse: collapse;
				    font-weight: bold;
				    font-size: 11;
				    

				}
				div{
					font-size: 10;
				}

			</style>

	
			<table style="width:100%">
			 		<caption><?=$row3['df_razon_social']?></caption>
			  <tr>
			    	<td width="20%">Domicilio:</td>
			    	<td><?=$row3['df_calle']?></td>		
			  </tr>
			  <tr>
			    	<td>Localidad:</td>
			    	<td><?=$row3['lc_nombre']?></td>		
			    
			  </tr>
			  <!--<tr>
			   		<td>La cantidad de:</td>
			    	<td>$<?=$row2['op_total']?><label>  PESOS 00/100 M.N.</label></td>		
			    
			  </tr>-->
			</table>
			<table style="width:100%">
			 		<caption>DATOS FISCALES</caption>
			  <tr>
			    	<td width="20%">Nombre:</td>
			    	<td><?=$row3['df_razon_social']?></td>		
			  </tr>
			  <tr>
			    	<td>Domicilio:</td>
			    	<td><?=$row3['df_calle']?></td>		
			    
			  </tr>
			  <tr>
			   		<td>Entidad:</td>
			    	<td><?=$row3['es_nombre']?></td>		
			    
			  </tr>
			  <tr>
			   		<td>C.P:</td>
			    	<td><?=$row3['cp_cod_pos']?></td>		
			    
			  </tr>
			  <tr>
			   		<td>R.F.C:</td>
			    	<td><?=$row3['df_rfc']?></td>		
			    
			  </tr>
			</table>
	


<style type="text/css" media="screen">
		caption {
		   background: #E0E0E0;
		   margin: 0;
		   border: 1px solid #333333;
		   border-bottom: none;
		   padding: 6px 16px;
		   font-weight: bold;
		}	
</style>
<br><br>
		<div id="firmas">
			<h3 align="center">A T E N T A M E N T E</h3>
			<h4 align="center">____________________________________</h4>
			<h4 align="center" align="justify">I.B.Q. RICARDO JIMÉNEZ HERRERA<br>
			COMISIONADO ESTATAL PARA LA PROTECCIÓN<br>
			CONTRA RIESGOS SANITARIOS</h4>
		</div>
		<div id="sec">
		<h4 align="left">ACF/EEVM</h4>
		<h4 align="center">"2012, 50 Años de la Educación Especial en Colima".</h4>
		<style type="text/css" media="screen">
			#firmas{
				font-size: 10;
			}
		</style>
</body>
<style type="text/css" media="screen">
	#sec{
		font-size: 10;
	}
</style>
</div>


<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ejemplo".time().'.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>