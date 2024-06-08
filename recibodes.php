<?php ob_start(); 
session_start();
if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }
require_once("conexion.php");
$i = $_GET['i']; //id
$im = $_GET['im']; //total
$query = "SELECT * from solicitud inner join cliente using(id_cliente) inner join datos_fiscales df using(id_cliente)
inner join colonia cl ON df.id_colonia = cl.id_colonia inner join codigo_postal using(id_cod_pos) where id_solicitud = '$i'";
$resul = mysql_query($query,$dbConn); 
$row = mysql_fetch_array($resul);

$oficinaz = $_SESSION['oficina'];
$cons = "SELECT * FROM oficina of inner join colonia cl on of.id_colonia =
cl.id_colonia inner join codigo_postal cp on cl.id_cod_pos = cp.id_cod_pos inner join localidad loc on
cl.id_localidad = loc.id_localidad inner join municipio mp on loc.id_municipio = mp.id_municipio inner join 
estado es on mp.id_estado = es.id_estado  WHERE id_oficina = '$oficinaz'";
$resuc = mysql_query($cons,$dbConn);
$rowc = mysql_fetch_array($resuc);

$query2 = "select * from solicitud inner join oficina using(id_oficina)
inner join colonia using(id_colonia) inner join localidad using(id_localidad) where id_solicitud = '$i'";
$resul2 = mysql_query($query2,$dbConn); 
$row2 = mysql_fetch_array($resul2);

$query3 = "SELECT * from solicitud inner join servicio using(id_servicio) inner join formato ON id_formato_solicitud = id_formato where id_solicitud = '$i'";
$resul3 = mysql_query($query3,$dbConn);
$row3 = mysql_fetch_array($resul3);
$ventanilla=$_SESSION['username'];
$id_usu = $_SESSION['empleado'];

$query5 = "SELECT * FROM empleado WHERE id_empleado = '$id_usu'";
$result4 = mysql_query($query5,$dbConn);
$row4 = mysql_fetch_array($result4);
//autorizo.
$quert = "SELECT * FROM empleado em INNER JOIN puesto ps ON em.id_puesto = ps.id_puesto WHERE ps.pu_nombre='COMISIONADO'";
$rz = mysql_query($quert,$dbConn);
$roz = mysql_fetch_array($rz);

$query6 = "SELECT * FROM orden_pago pg INNER JOIN recibo_pago rg ON pg.id_folio_orden = rg.id_orden_pago WHERE pg.id_solicitud = '$i'";
$result8 = mysql_query($query6,$dbConn);
$row5 = mysql_fetch_array($result8);

//QUERY DEL ENCABEZADO.

$encab = "SELECT * FROM oficina where id_oficina = '$oficinaz'";
$enca = mysql_query($encab,$dbConn);
$enrow = mysql_fetch_array($enca);


##asd
$asunto = "SELECT * FROM solicitud s INNER JOIN servicio sr using(id_servicio) WHERE id_solicitud = $i";
$ass = mysql_query($asunto,$dbConn);
$row9 = mysql_fetch_array($ass);
/*

solicitud con cliente con datos fiscales con servicio
cliente localidad
cantidad esta en solicitud
importe ya lo calculo adrian
me lo manda
calculamos el total
datos fiscales

*/

//ciudad del cliente
$ciudcl = mysql_query("SELECT * FROM solicitud sl INNER JOIN cliente cl ON sl.id_cliente = cl.id_cliente INNER JOIN colonia col ON cl.id_colonia = col.id_colonia
  INNER JOIN localidad lc ON col.id_localidad = lc.id_localidad WHERE sl.id_solicitud = '$i'");
$result13 = mysql_fetch_array($ciudcl);
$title = "Recibo";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Recibo</title>
  </head>
  <body>
    <div id="wrapper">
      <img id="bg" src="./images/recibo.jpg"/>
      <img class="peq" src="assets/img/logocolima.jpg"/>
      <style type="text/css">
        #bg{
          left: 0px; 
          top: 0px; 
          position: absolute;
          z-index:-1;
          width: 100%;
          height: 100%;
        }
        .peq{
          width: 100px;
          left: 10px;
          position: absolute;
        }
      </style>
      <div id="nombre">
        <h6><?=$row['ct_nombre']?> <?=$row['ct_apaterno']?> <?=$row['ct_amaterno']?></h6>
      </div>
      <div id="Calle">
        <h6>
      <?php  $di = strtoupper($row['ct_calle'] . " #" . $row['ct_numero'].", COL. ".$row['cl_nombre']).".";
      echo "$di";
      ?>
        </h6>
      </div>
      <div id="cp">
        <h6><?=$row['cp_cod_pos']?></h6>
      </div>
      <div id="ciudad">
        <h6>
          <?php 
          $var2 = strtoupper($result13['lc_nombre']);
          echo "$var2";
          ?>

        </h6>
      </div>
      <div id="rfc">
        <h6><?=$row['df_rfc']?></h6>
      </div>
      <div id="cantidad">
        <h6><b>1</b></h6>
      </div>
      <div id="descripcion">
       <p style='text:justify;'><?=$row9['sr_nombre']?>.</p>
      </div>
      <div id="rfc2">
        <h6><?=$rowc['of_rfc']?></h6>
      </div>
      <div id="dir">
        <h6>
        <?php   $dy = strtoupper($rowc['of_calle']." #".$rowc['of_numero']." ".$rowc['cl_nombre']." ".$rowc['cp_cod_pos']." ".$rowc['es_nombre'].".");
          echo "$dy";
          ?>
        </h6>
      </div>
      <div id="importe">
        <h6>$<?=round($im)?>.00</h6>
      </div>
      <div id="total">
        <h6>$<?=round($im)?>.00</h6>
      </div>
      <div id="recibo">
        <h6> 
          <?=$enrow['of_nomenclatura']?>-<?=$row5['id_folio']?>
          <label><?php echo "/".substr(date('Y'),-2);?></label>
        </h6>
      </div>
      <div id="ventanilla">
        <h6>
          <?=$row4['em_nombres']?> <?=$row4['em_apaterno']?> <?=$row4['em_amaterno']?>  
        </h6>
      </div>
      <div id="autorizo">
        <h6>
          <?=$roz['em_nombres']?> <?=$roz['em_apaterno']?> <?=$roz['em_amaterno']?>  
        </h6>
      </div>
      <div id='letra'>
        <h6>
          <?php 
          require_once("letras.php");
          $resultado = num2letras($im);
          echo "$resultado";
          ?>
        </h6>
      </div>
      <div id='fecha'>
        <h6>
          <?php
          $ofi = strtoupper($row2['lc_nombre']);
          $ofi = $ofi . ", COL.";
          $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
          $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
          echo  strtoupper($ofi . " " .$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y'));     
          ?>
        </h6>
      </div>
      <style type="text/css">
        #descripcion{
          font-size: 10px;
          width: 200px;
          height: -30px;
          position:absolute;
          text-align: center;
          bottom: 250px;
          margin-left: 200px;
        }
        #fecha {
            position:absolute;
            margin-left: 200px;
            bottom: 300px;
          }
        #rfc2 {
            position:absolute;
            margin-left: 325px;
            bottom:365px;
          }
        #dir {
            position:absolute;
            margin-left: 200px;
            bottom:350px;
          }
        #letra {
            position:absolute;
            text-align: center;
            bottom: 95px;
            margin-right: 300px;
          }
        #recibo {
            position:absolute;
            text-align: center;
            bottom: 300px;
            margin-left: 550px;
          }
        #total {
            position:absolute;
            text-align: center;
            bottom: 95px;
            margin-left: 550px;
          }
        #importe {
            position:absolute;
            text-align: center;
            bottom: 150px;
            margin-left: 550px;
          }
        #ventanilla {
            position:absolute;
            text-align: center;
            bottom: 30px;
            margin-right: 15px;
          }
        #autorizo {
            position:absolute;
            text-align: center;
            bottom: 30px;
            margin-right:-450px;
          }
        #cantidad {
            position:absolute;
            text-align: center;
            bottom: 150px;
            margin-right: 630px;
          }
        #nombre {
            position:absolute;
            margin-left: 75px;
            bottom: 250px;
          }
        #Calle {
            position:absolute;
            bottom: 230px;
           margin-left: 65px;
          }
        #cp {
            position:absolute;
            text-align: center;
            bottom: 230px;
            margin-left: 60px;
          }
        #ciudad {
            position:absolute;
            text-align: center;
            bottom: 230px;
            margin-left: 375px;
          }
        #rfc {
            position:absolute;
            text-align: center;
            bottom: 250px;
            margin-left: 325px;
          }
      </style>
    </div>
  </body>
  <?php
    require_once("dompdf/dompdf_config.inc.php");
    $dompdf = new DOMPDF();
    $dompdf->set_paper("A5", $orientation = "landscape");
    $dompdf->load_html(ob_get_clean());
    $dompdf->render();
    $pdf = $dompdf->output();
    $filename = "Recibo_pago".time().'.pdf';
    file_put_contents($filename, $pdf);
    $dompdf->stream($filename);
    unlink($filename);
  ?>
</html>