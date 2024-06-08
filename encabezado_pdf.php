<?php 
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
    require_once("conexion.php");
//OFICINA LOGEADA
$OfLog= $_SESSION['oficina'];

//QUERY DE LOS CONSECUTIVOS Y DEL ENCABEZADO.
$encab = "SELECT * FROM oficina where id_oficina = '$OfLog'";
$enca = mysql_query($encab,$dbConn);
$enrow = mysql_fetch_array($enca);

//Da nombre del servicio
$format= "select * from formato inner join servicio on formato.id_formato = servicio.id_formato_solicitud 
inner join solicitud using(id_servicio) where id_solicitud = $i";
$ReFormat = mysql_query($format,$dbConn); 
$FrServicio = mysql_fetch_array($ReFormat);
?>


<html>
<head>
</head>
<body>
<table style="width:100%">
<tr>
<td><div id="im">
	<img class="peq" src="assets/img/logocolima.jpg"/ width="20%" height="40%"> </td>
</div>
	 <td><div id="enc">
			<p  align="right">
				<b>SERVICIOS DE SALUD DEL ESTADO DE COLIMA</b>
				<br>
				AV. LICEO DE BARONES ESQ. DR. RUBÉN, COL. LA ESPERANZA COLIMA, COL. 
			    <br>
			    <b>COMISIÓN ESTATAL PARA LA PROTECCIÓN CONTRA RIESGOS SANITARIOS.</b>
			    <br>
			    AV. AYUNTAMIENTO ESQ. ARNOLDO VOGEL,<br>COL. BUROCRATAS MUNICIPALES, COLIMA COL.
			    <br>
			    <b><?=$enrow['of_nombre']?></b>
			    <br>
			    <?=$enrow['of_calle']?>,<?=$enrow['of_numero']?> <?=$enrow['of_dir_relativa']?>
			    <br><br>
				<b>ASUNTO: </b><?=$FrServicio['sr_nombre']?>
				<br>
				NO. OFICIO: <?=$enrow['of_nomenclatura']?><label>-</label><?php echo "$i";?><?php echo "/".substr(date('Y'),-2);?>
				<br>
				Colima, Col. 
				<?php
				$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
				echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ; 
				?>
			</p>
		</div></td>
</tr>
</table>
	<style type="text/css" media="screen">
			img.peq{width: 200px; height: 170px; opacity: 0.5;
			position: relative;
			bottom: 200px;
			}
			#enc{
				font-size: 10px;
				text-align: right;
				position: absolute;
				opacity: 0.5;				
			font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
			.p{
				font-size: 10px;
				font-family: 'Calibri', Helvetica, Arial, sans-serif;
			}
	</style>
</body>
</html>