<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");

$query = "select * from servicio";
$query2 = "select * from curso";
$result = mysql_query($query,$dbConn);
$result2 = mysql_query($query2,$dbConn);
$title= "Registrar grupo";
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php include ("sec_head.inc.php"); ?>
</head>
<body>
 <?php include ("sec_encabezado.inc.php"); ?>
 <div id='content'> 
  <div class='wrapper'>

     <form method="POST" action='grupo_insertar.php'>
     <label for='inpFechainicio'>Fecha de inicio:</label>
     <input id='inpFechainicio' type='date' name='fechaini' autofocus size='10' required />
     <label for='inpFechafin'>Fecha de fin:</label>
     <input id='inpFechafin' type='date' name='fechafin' size='10' required />
     <label for='inpSede'>Sede:</label>
     <input id='inpSede' type='text' name='sede' size='10' required />
    

      <select name='grupo'>
      <?php
                 while ($row = mysql_fetch_array($result)): ?> 
                   <option value='<?=$row['id_servicio']?>'><?=$row['sr_nombre']?>
                   </option>  
                 <?php endwhile; ?>  
      </select>

      <select name='curso'>
      <?php
                 while ($row = mysql_fetch_array($result2)): ?> 
                   <option value='<?=$row['id_curso']?>'><?=$row['c_nombre']?>
                   </option>  
                 <?php endwhile; ?>  
      </select>
       <input type='submit' value='Registrar' />
     </form>	
     <?php
    if (isset($_POST['submit'])) {require("grupo_insertar.php");}
    include ("sec_piepagina.inc.php"); ?>
     </div>
     </div>
</body>
</html>