<?php
	/** INTROUCCIÓN A LAS SHORTTAGS
	  *	Las ShortTags son una forma de invocar un código de PHP sin
	  *	requerir mezclar mediante cadenas código de html.
	  * La forma más simple para incrustar corresponde a utilizar
	  * ShortTags que permiten recuperar valores de forma simple.
	  *	ESTRUCTURA:
	  *		<?=$variable?>
	  * ES EQUIVALENTE A:
	  *		<?php echo $variable; ?>
	  */
?>
<!-- SHORT TAGS REGULARES -->
<input type='text' name='nombre' value='<?=$nombre?>' />

<!-- SHORT TAGS DESDE UN ARREGLO -->
<input type='text' name='nombre' value='<?=$arreglo['nombre']?>' />

<!-- INCRUSTANDO PHP EN HTML -->
<!-- Ciclo para desplegar datos en una tabla -->
<table>
	<!-- DEFINIMOS EL ENCABEZADO -->
	<tr><th>Columna 1</th>
		<th>Columna 2</th>
		<th>Columna 3</th>
	</tr>
	<?php while($row = mysql_fetch_array($result)): ?>
	<tr><!-- Iniciamos la fila -->
		<td><?=$row['col1']?></td>
		<td><?=$row['col2']?></td>
		<td><?=$row['col3']?></td>
	</tr><!-- Cerramos la fila -->
	<?php endwhile; ?>
</table>

<!-- Ciclo para conformar una lista desplegable (ComboBox) -->
<select name='pais' required>
	<option value=''>[Seleccionar un pais]</option>
	<?php while($row = mysql_fetch_array($result_pais)): ?>
	<option value='<?=$row['id_pais']?>'><?=$row['nombre']?></option>
	<?php endwhile; ?>
</select>