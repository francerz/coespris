<?php
	require_once("conexion.php");
?>
<!DOCTYPE html>
<html lang='es'>
<head>
	<meta charset='utf-8'/>
	<meta http-equiv='X-UA-Compatible' content='IE=Edge'/>
	<meta name='viewport' content='width=device-width, initial-scale=1.0' />
	<title>Consultar cuentas</title>
</head>
<body>
	<header>
		<div class='wrapper'>
		</div>
	</header>
	<nav>
	</nav>
	<div id='content'>
		<div class='wrapper'>
			<a href='frmCuenta.htm'>Agregar cuenta</a>
			<?php 
				// CREAMOS Y EJECUTAMOS LA CONSULTA.
				$query = "SELECT * FROM cuenta";
				$result = mysql_query($query,$dbConn);
				// DESPLEGAMOS LOS DATOS.
			?>
			<table>
				<tr><th>ID</th>
					<th>Banco</th>
					<th>Cuentahabiente</th>
					<th>No. Cuenta</th>
					<th>CLABE</th>
				</tr>
				<?php while ($row = mysql_fetch_array($result)): ?>
				<tr><td><?=$row['id_cuenta']?></td>


			<?php   echo "<td>".$row['cn_razon_social_banco']."</td>"; 				?>
					<td><?=$row['cn_razon_social_banco']?></td>


			<?php 	echo "<option value='".$id."'>".$nombre."</option>"; 			?>
					<option value='<?=$id?>'><?=$nombre?></option>



					<td><?=$row['cn_cuentahabiente']?></td>
					<td><?=$row['cn_numero_cuenta']?></td>
					<td><?=$row['cn_clabe']?></td>
				</tr>
				<?php endwhile; ?>
			</table>
		</div>
	</div>
	<footer>
		<div class='wrapper'>
		</div>
	</footer>
</body>
</html>