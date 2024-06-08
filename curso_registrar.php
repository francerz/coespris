<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
	$querry11 = "select * from empleado";
   $result11 = mysql_query($querry11,$dbConn); 
   $title="Registrar curso";
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
		<fieldset>
		<legend><b>Curso</b></legend>
		<br>
		 <div id='content'>
           <div class='wrapper'>
			<form method="post" action="">
			<label><b>Nombre</b></label>
			<input type="text" name="nombre" placeholder="Ingresa el nombre"/>
			<br>
			<label><b>Duracion</b></label>
			<input type="text" name="duracion" placeholder="Ingresa la duración"/>
			<br>
			<legend><b>Empleado</b></legend>
				 		 <select name='empleado'>
			            <?php
			                 while ($row = mysql_fetch_array($result11)): ?> 
			                   <option value='<?=$row['id_empleado']?>'><?=$row['em_nombres']?>
			                   </option>  
			                 <?php endwhile; ?>  
			     		</select>  
			</div>
			<br>
			<input  type="submit" name="submit"  value="Registrar el Curso">
			
		</fieldset>
		</form>

<?php
if (isset($_POST['submit'])) {
	require("curso_insertar.php");
}
    include ("sec_piepagina.inc.php");
?>
</div>
</div>	
</body>
</html>