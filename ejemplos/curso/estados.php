<?php
	require_once("conexion.php");

	$query = "SELECT * FROM estado";
	$result = mysql_query($query,$dbConn) or die(mysql_error());
?>
<!DOCTYPE html>
<html lang='es'>
<head>
	<meta charset='utf-8'/>
	<meta http-equiv='X-UA-Compatible' content='IE=Edge'/>
	<meta name='viewport' content='width=device-width, initial-scale=1.0' />
	<title>Consultar estados</title>
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
			<table>
			<?php 
				while ($row = mysql_fetch_array($result)):
					echo "<tr>";
					echo "<td>".$row['id_estado']."</td>";
					echo "<td>".$row['es_nombre']."</td>";
					echo "</tr>";
				endwhile;
			?>
			</table>
		</div>
	</div>
	<footer>
		<div class='wrapper'>
		</div>
	</footer>
</body>
</html>