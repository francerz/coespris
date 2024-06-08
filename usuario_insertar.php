<?php
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$emp = $_POST['emp'];
$rol = $_POST['rol'];


require("conexion.php");
mysql_query("INSERT INTO usuario VALUES ('', '$usuario','$contrasena','1','$emp','$rol')")or die(mysql_error());
echo '<script language="javascript">alert("Usuario registrado con exito");</script>';
mysql_close($dbConn);
header("Location: usuario_registrar.php");
echo "<script language=Javascript> location.href=\"catalogo_usuarios_permisos.php\"; </script>"; 
?>
