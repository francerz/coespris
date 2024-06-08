<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
$title="Consulta permiso rol";

require_once("conexion.php");
$query = "select * from permiso per join rol rl on per.id_permiso=rl.id_rol";

$result = mysql_query($query,$dbConn);
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
           <th>Nombre del permiso</th>
           <th>Archivo</th> 
           <th>Rol </th>
          </tr>
            <?php while($row = mysql_fetch_array($result)):?>
               <tr>
               
               <td><?=$row['per_nombre']?></td>
               <td><?=$row['per_archivo']?></td>
               <td><?=$row['rol_nombre']?></td>
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