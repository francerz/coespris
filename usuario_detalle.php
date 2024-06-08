<?php
$contra = $_POST['contrasenia'];
$id = $_POST['idus'];
require("conexion.php");
mysql_query("UPDATE usuario SET contrasenia = '$contra'
	 where id_usuario = '$id'")or die(mysql_error());
mysql_close($dbConn);
header("Location: usuario_general.php");
echo "<script language=Javascript> location.href=\"usuario_general.php\"; </script>"; 

?>