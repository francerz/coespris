<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
mysql_query("UPDATE salario_minimo sm SET sm.vigente =0")or die(mysql_error());
 $importe =$_POST['importe'];
 $aniovigencia =$_POST['aniovigencia'];
 $query = ("INSERT INTO salario_minimo values ('','$importe','$aniovigencia','1')") or die(mysql_error());
 mysql_query($query,$dbConn);
 mysql_close($dbConn);
 echo "<script language=Javascript> location.href=\"salario_minimo_general.php\"; </script>"; 

?>