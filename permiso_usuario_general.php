<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
$query = "select * from permiso per join usuario us on per.id_permiso=us.id_usuario";

$result = mysql_query($query,$dbConn);
$title="Consulta permiso usuario";
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
           <th>Usuario</th>
          </tr>
            <?php while($row = mysql_fetch_array($result)):?>
               <tr>
               <td><?=$row['usuario']?></td>
               <td><?=$row['per_nombre']?></td>
               </tr>
              
              <?php endwhile; ?>
            </table>
        </div>
      </div>
     <?php include ("sec_piepagina.inc.php"); ?>
</body>

</html>