<!-- Este archivo es sólo de referencia -->

<!-- 	ETIQUETA FORM	-->
<!-- 	Permite elaborar formularios para capturar datos del usuario y enviarlos al servidor HTTP.
		ATRIBUTOS:
		- name:		Especifica un nombre para el formulario.
		- method:	Especifica el método de envío de datos.
		- action:	Especifica el archivo a ser invocado para enviar los datos al servidor.
		- enctype:	Se especifica 'multipart/form-data' cuando se quiere enviar un archivo.
-->
<form method='POST' action='estado_insertar.php' enctype='multipart/form-data'>
	<!--	ETIQUETA LABEL		-->
	<!--	Permite establecer una etiqueta para un control de entrada de datos.
			ATRIBUTOS:
			- for:		Se especifica el [id] del elemento que se desea asignar.
	-->
	<label for='inp_nombre'>Nombre completo:</label>
	<!--	ETIQUETA INPUT		-->
	<!--	Permite capturar datos del usuario mediante un control.
			ATRIBUTOS:
			- id:			Especifica un identificador único para el elemento.
			- type:			Especifica el tipo de entrada que se prefiere utilizar.
			- name:			Especifica un nombre de variable del formulario, se recibe en $_GET o $_POST según el method del formulario.
			- value:		Establece un valor predeterminado para el campo en el formulario.
			- size:			Especifica el tamaño del campo de texto.
			- maxlength:	Especifica la longitud máxima de caracteres aceptables.
			- readonly:		Deshabilita la edición del campo (los values sí se envían con submit).
			- disabled:		Deshabilita la edición del campo (los values no se envían con submit).
			- accept:		(sólo [type='file']) Especifica el tipo MIME de archivo aceptado en el dialogo.
			- placeholder:	Coloca un texto de pista para el usuario.
			- required:		Especifica que un campo es requerido para enviar el formulario.
			- pattern:		Utiliza una expresión regular (RegEx) para validar los datos introducidos.
	-->
	<!--	ETIQUETA INPUT[type='text']		-->
	<input id='inp_nombre' type='text' name='nombre' maxlength='80' pattern='^[A-Za-z]{1}[A-Za-z\s]*' />
	
	<!--	ETIQUETA INPUT[type='password']	-->
	<label for='inp_password'>Contraseña:</label>
	<input id='inp_password' type='password' name='contrasenia' size='20' required />
	
	<!--	ETIQUETA INPUT[type='date']		-->
	<label for='inp_fecha'>Fecha:</label>
	<input id='inp_fecha' type='date' name='fecha' placeholder='aaaa-mm-dd' />
	
	<!--	ETIQUETA INPUT[type='time']		-->
	<label for='inp_hora'>Hora:</label>
	<input id='inp_hora' type='time' name='hora' placeholder='hh:mm:ss' />
	
	<!--	ETIQUETA INPUT[type='number'] 	-->
	<label for='inp_cantidad'>Cantidad:</label>
	<input id='inp_cantidad' type='number' name='cantidad' value='1' min='1' max='10' />

	<!--	ETIQUETA INPUT[type='file'] -->
	<label for='inp_foto'>Foto:</label>
	<input id='inp_foto' type='file' name='foto' accept='image/*' />
	
	<!--	ETIQUETA INPUT[type='radio']	-->
	<label>Selecciona una fruta:</label>
	<label><input type='radio' name='fruta' value='1' />Manzana</label>
	<label><input type='radio' name='fruta' value='2' checked />Naranja</label>
	<label><input type='radio' name='fruta' value='3' />Durazno</label>
	
	<!--	ETIQUETA INPUT[type='checkbox']	-->
	<label>Tareas pendientes:</label>
	<label><input type='checkbox' name='tarea1' checked />Comprar despensa</label>
	<label><input type='checkbox' name='tarea2' />Pasear al perro</label>
	<label><input type='checkbox' name='tarea3' />Llamar a Martha</label>
	<label><input type='checkbox' name='tarea4' checked />Pagar la luz</label>
	
	<!--	ETIQUETA SELECT
			Permite al usuario seleccionar un elemento desde una lista desplegable (ComboBox).
			ATRIBUTOS:
			- id:		Especifica un identificador único para el elemento.
			- name:		Especifica un nombre de variable del formulario, se recibe en $_GET o $_POST según el method del formulario.
			- size:		Especifica el tamaño de la lista (predeterminado = 1).
			- required:	Especifica que un campo es requerido para enviar el formulario.
			
			ETIQUETA OPTION
			Se utiliza en conjunto con SELECT y representa un elemento de la lista.
			ATRIBUTOS:
			- value:	Especifica el valor corresponiente.
			- selected:	Especifica si el elemento está seleccionado.
	-->
	<label for='sel_color'>Color favorito:</label>
	<select id='sel_color' name='color' required>
		<option value='1'>Azul</option>
		<option value='2'>Amarillo</option>
		<option value='3' selected>Rojo</option>
		<option value='4'>Verde</option>
	</select>
	<!--	ETIQUETA TEXTAREA	-->
	<!--	Permite al usuario capturar texto extenso en el formulario.
			ATRIBUTOS:
			- id:		Especifica un identificador único para elemento.
			- name:		Especifica un nombre de variable del formulario, se recibe en $_GET o $_POST según el method del formulario.
			- rows:		Especifica la cantidad de renglones que puede mostrar.
			- cols:		Especifica la cantidad de columnas de caracteres puede mostrar.
			- required:	Especifica que un campo es requerido para enviar el formulario.
	-->
	<label for='txt_comentario'>Comentarios:</label>
	<textarea id='txt_comentario' name='comentario' rows='5' cols='30' required>
		El texto contenido se pone aquí y no en value.
	</textarea>
	<!--	ETIQUETA BUTTON		-->
	<!--	Permite capturar una acción del usuario al realizar click sobre el botón.
			ATRIBUTOS:
			- id:		Especifica un identificador único para el elemento.
			- type:		Especifica el tipo de acción que se desea realizar.
			- name:		Especifica un nombre de variable del formulario, se recibe en $_GET o $_POST según el method del formulario.
			- value:	Establece el valor para la variable en el formulario.
	-->
	<button type='submit'>Enviar</button>
</form>