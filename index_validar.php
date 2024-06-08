<?php
	session_start();
	require("conexion.php");

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT us.*, of.id_oficina, em.id_empleado, rl.rol_nombre 
	FROM usuario us JOIN rol rl ON us.id_rol = rl.id_rol 
	JOIN empleado em ON us.id_empleado = em.id_empleado 
	JOIN oficina of ON em.id_oficina = of.id_oficina
	WHERE us.usuario LIKE '$username'";
	$result = mysql_query($sql) or die(mysql_error());
	
	$count = mysql_fetch_array($result);
	if ($count['contrasenia'] == $password) {
		if($count['habilitado'] == 1){
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $count['usuario'];
			$_SESSION['start'] = time();
			$_SESSION['oficina'] = $count['id_oficina'];
			$_SESSION['empleado'] = $count['id_empleado'];
			$_SESSION['expire'] = $_SESSION['start'] + (5 * 60) ;
			$_SESSION['rol'] = $count['rol_nombre'];
			//var_dump($count);
			//die($sql);
			header("Location:./menu.php",302);
		}else{
			?><br>
					<div class="alert alert-danger" id="reg">
					  <strong>¡Error!</strong> Usuario no vigente.
					</div>
					<script type="text/javascript">
					  setTimeout(function(){
					$('#reg').fadeOut();
					  },2500);
					</script>
			<?php
		}
	}else{
		?>	<br>
					<div class="alert alert-danger" id="reg">
					  <strong>¡Error!</strong> Usuario o constraseña incorrecto/a.
					</div>
					<script type="text/javascript">
					  setTimeout(function(){
					$('#reg').fadeOut();
					  },2500);
					</script>
			<?php
	}
?>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/custom.js"></script>