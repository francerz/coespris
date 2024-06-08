<?php
	require_once ('conexion.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<meta http-equiv='X-UA-Compatible' content='IE=Edge' />
	<meta name='viewport' content='width=device-width, initial-scale=1.0' />
	<title>Registrar cuenta</title>
</head>
<body>
	<header>
		<div class='wrapper'>

		</div>
	</header>
	<div id='content'>
		<div class='wrapper'>
			<form method='POST' action='insCuenta.php'>
				<label for='inpNombre'>Nombre del municipio:</label>
				<input id='inpNombre' type='text' name='nombre' maxlength='20' required /><br/>
				<?php
					$query = "SELECT id_estado, es_nombre FROM estado";
					$res_es = mysql_query($query,$dbConn);
				?>
				<label for='selEstado'>Entidad federativa:</label>
				<select id='selEstado' name='estado' required>
					<option value=''>[Seleccione un estado]<option>
				<?php while ($row_es = mysql_fetch_array($res_es)): ?>
				<?php echo "<option value='".$row_es['id_estado']."'>".$row_es['es_nombre']."</option>"; ?>
					<option value='<?=$row_es['id_estado']?>'><?=$row_es['es_nombre']?></option>
				<?php endwhile; ?>
				</select>
				<button type='submit'>Grabar</button>
			</form>
			</form>
		</div>
	</div>
	<footer>
		<div class='wrapper'>

		</div>
	</footer>
</body>
</html>