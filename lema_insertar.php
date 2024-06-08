<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
mysql_query("UPDATE lema lm SET lm.lema_estatus =0")or die(mysql_error());
$fecha =$_POST['fecha'];
$lema =$_POST['lema'];
 
mysql_query("INSERT INTO lema VALUES ('','$fecha','$lema', '1')")or die(mysql_error());
mysql_close($dbConn);
 echo "<script language=Javascript> location.href=\"lema_general.php\"; </script>"; 


?>