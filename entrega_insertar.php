<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require("conexion.php");
$solicitud = $_POST['solicitud'];
mysql_query("UPDATE solicitud SET s_estatus = 'ENTREGADO' WHERE id_solicitud = '$solicitud'");
mysql_close($dbConn);
header("Location: menu.php");
?>