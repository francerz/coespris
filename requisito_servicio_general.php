<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$query = "select * from requisito_servicio;";

$result = mysql_query($query,$dbConn);
$title="Consulta requisito servicio";
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
        <table>
          <tr>
           <th>ID_requisito</th>
           <th>ID_servicio</th>
           <th>Cantidad</th>
          </tr>
            <?php while($row = mysql_fetch_array($result)):?>
               <tr>
               
               <td><?=$row['id_requisito']?></td>
               <td><?=$row['id_servicio']?></td>
               <td><?=$row['rsv_cantidad']?></td>
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