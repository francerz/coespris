<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }

require_once("conexion.php");

$query = "select * from requisito";
$query2 ="select * from solicitud";
$result = mysql_query($query,$dbConn);
$result2= mysql_query($query2,$dbConn);
$title = "Registrar requisito de la solicitud";
?>

<!DOCTYPE HTML>
<HTML lang="es">
<head>
      <?php include ("sec_head.inc.php"); ?>
</head>
<body>              
    <?php include ("sec_encabezado.inc.php"); ?>
     <div id='content'>
        <div class='wrapper'>

          <form method='POST' action=''>
          <label for='inpCantidad'>Cantidad:</label>
          <input id='inpCantidad' type='text' name='cantidad' size='10' maxlength='20' required/>

      <select name='requisito'>
      <?php
                 while ($row = mysql_fetch_array($result)): ?> 
                   <option value='<?=$row['id_requisito']?>'><?=$row['rq_nombre']?>
                   </option>  
                 <?php endwhile; ?>  
      </select>
      <select name='solicitud'>
      <?php
                 while ($row = mysql_fetch_array($result2)): ?> 
                   <option value='<?=$row['id_solicitud']?>'><?=$row['s_fecha']?><?=$row['s_cantidad']?>
                   </option>  
                 <?php endwhile; ?>  
      </select>

     
          <input type='submit' value='guardar'/>   
          </form>
        <?php
         if (isset($_POST['submit'])) {require("requisito_solicitud_insertar.php");}
         include ("sec_piepagina.inc.php"); ?>
        </div>

      </div>
      <?php include ("sec_piepagina.inc.php"); ?>
</body>

</HTML>