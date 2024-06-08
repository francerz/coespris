<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
 
 $fechaini =$_POST['fechaini'];
 $fechafin =$_POST['fechafin'];
 $sede =strtoupper($_POST['sede']);
 $grupo =strtoupper($_POST['grupo']);
 $curso =strtoupper($_POST['curso']);
 	
 $query = ("INSERT INTO grupo VALUES ('', '$fechaini', '$fechafin', '$sede', '$grupo','$curso')") or die(mysql_error());
mysql_query($query,$dbConn);

header("Location: grupo_registrar.php");   
?>