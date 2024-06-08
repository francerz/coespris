<?php ob_start();
session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
require_once("conexion.php");
$i = $_GET['i'];
$a = $_GET['a'];
$title = "autorizacion";
//autorizacion
$query = "SELECT au.au_fecha, au.au_comisionado FROM autorizacion au WHERE au.id_autorizacion = '$a'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
//solicitud
$query = "SELECT es.es_nombre, es.id_estado, mp.mp_nombre, mp.id_municipio, df.df_razon_social, df.df_calle, df.df_numero, cl.cl_nombre, lc.lc_nombre, ct.ct_nombre, ct.ct_apaterno, ct.ct_amaterno FROM solicitud s INNER JOIN cliente ct ON s.id_cliente = ct.id_cliente INNER JOIN datos_fiscales df ON ct.id_cliente = df.id_cliente INNER JOIN colonia cl ON df.id_colonia = cl.id_colonia INNER JOIN localidad lc ON cl.id_localidad = lc.id_localidad INNER JOIN municipio mp ON lc.id_municipio = mp.id_municipio INNER JOIN estado es ON mp.id_estado = es.id_estado WHERE s.id_solicitud = '$i'";
$result = mysql_query($query);
$row2 = mysql_fetch_array($result);
//datos secundarios
$query = "SELECT dsa.valor_capturado FROM dsa_autorizacion dsa WHERE dsa.id_autorizacion = '$a'";
$result = mysql_query($query);


//query comisionado
$comi="SELECT * from autorizacion where id_autorizacion='$a'";
$comisionado=mysql_query($comi,$dbConn) or die(mysql_error());
$row4=mysql_fetch_array($comisionado);

?>
<!DOCTYPE html>

<head>
</head>
<body>
<div id='encabezado'>
<?php include("encabezado_pdf.php");?>
</div>
<div id='wrapper'>
<img id="bg" src="formatos/autorizacion.png"/>
<style type="text/css">
  #bg{
  left: 0px; 
  top: 0px; 
  position: absolute;
  z-index:-1;
}
#wrapper {
  position: absolute;
  overflow: hidden;
  margin: 0px;
  width: 8.5in;
  height: 5.5in;
  background-image: url('../formatos/autorizacion.png');
  background-size: 100% 100%;
  background-repeat: no-repeat;
  background-position: 0px 0px;
}
</style>
<div id='cliente'><h3><?=$row2['ct_nombre']?> <?=$row2['ct_apaterno']?> <?=$row2['ct_amaterno']?><br>
<?=$row2['df_razon_social']?><br>
<?=$row2['df_calle']?> <?=$row2['df_numero']?><br>
<?=$row2['cl_nombre']?> <?=$row2['lc_nombre']?><br>
<?=$row2['mp_nombre']?><br>
<?=$row2['es_nombre']?></h3></div>
<div id='a'><h3><?=$row2['id_estado']?> 0<?php if($row2['id_municipio']<9){echo "0".$row2['id_municipio'];}else{$row2['id_municipio'];}?> <?php
  $row3 = mysql_fetch_array($result);
  switch ($row3['valor_capturado']) {
    case 'FARMACIA':
      echo "09";
      $tipo = '09 Farmacia';
      break;
    case 'BOTICA':
      echo "10";
      $tipo = '10 Botica';
      break;
    case 'DROGERIA':
      echo "11";
      $tipo = '11 Drogeria';
      break;    
    default:
      break;
  }
?> <?php $row3 = mysql_fetch_array($result); echo "{$row3['valor_capturado']}"?></h3></div>
<div id='dsa1'><h3><?php 
$row3 = mysql_fetch_array($result);
if ($row3['valor_capturado']==464111) {
  echo "464111 Farmacias sin minisúper (Con venta de medicamentos controlados, biologicos y hemoderivados)";
}else{
  echo "464112 Farmacias con minisúper (Con venta de medicamentos controlados, biologicos y/o hemoderivados)";
}
?><br><br><?=$tipo?></h3></div>
<div id='dsa2'><h3><?php
while($row3 = mysql_fetch_array($result)){
  echo "{$row3['valor_capturado']}<br><br>";
}?></h3></div>
<div id='fecha'><h3><?=substr($row['au_fecha'],0,10)?></h3></div>
<div id='comisionado'><h3><?=$row4['au_comisionado']?></h3></div>
<style type="text/css">
#encabezado {
    position:absolute;
    top: 0px;
    left: 0px;
    right: 0px;
  }
#cliente {
  position:absolute;
  top: 118px;
  color: red;
  margin-left: 260px;
  font-size: 11px;
}
#a {
    position:absolute;
    text-align: center;
    margin-left: -70px;
    bottom: 560px;
    color: red;
    font-size: 50px;
  }
#dsa1{
    position:absolute;
    margin-left: 20px;
    bottom: 480px;
    color: red;
    font-size: 10px;
  }
#dsa2{
    position:absolute;
    margin-left: 20px;
    bottom: 180px;
    color: red;
    font-size: 10px;
  }
#fecha {
    position:absolute;
    margin-left: 110px;
    bottom: 85px;
    color: red;
  }
#comisionado {
    position:absolute;
    bottom: 40px;
    margin-left: 420px;
    font-family: 'Times New Roman', Helvetica, Arial, sans-serif;
    font-size: 12px;
  }
</style>
</div>
</body>

<?php 
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "autorizacion".time().'.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
unlink($filename);
?>