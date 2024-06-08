<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$query = "select * from requisito_solicitud";

$result = mysql_query($query,$dbConn);
$title="Consulta requisito solicitud";
?>

<!DOCTYPE HTML>
<html lang='es'> 
<head>
     <?php include ("sec_head.inc.php"); ?>
</head>

<body>             
   <?php include ("sec_encabezado.inc.php"); ?>
      <div id='content'>
        <div class='wrapper'>
        <table border='1'>
          <tr>
           <th>ID_requisito</th>
           <th>ID_solicitud</th>
           <th>Cantidad</th>
          </tr>
            <?php while($row = mysql_fetch_array($result)):?>
               <tr>
               
               <td><?=$row['id_requisito']?></td>
               <td><?=$row['id_solicitud']?></td>
               <td><?=$row['rso_cantidad']?></td>
               </tr>
              
              <?php endwhile; ?>
            </table>
        </div>
      </div>
      <form>
        <button type='submit' value='Regresar' formaction="catalogo_menu.php"/>Regresar</button>
      </form>
     <?php include ("sec_piepagina.inc.php"); ?>
</body>

</html>