<?php
     session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	require_once("conexion.php");
	$result = mysql_query("SELECT cl.cl_nombre, cl.id_colonia, cp.cp_cod_pos, lc.lc_nombre FROM colonia cl INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos INNER JOIN localidad lc ON cl.id_localidad = lc.id_localidad");
	$result2 = mysql_query("SELECT cl.cl_nombre, cl.id_colonia, cp.cp_cod_pos, lc.lc_nombre FROM colonia cl INNER JOIN codigo_postal cp ON cl.id_cod_pos = cp.id_cod_pos INNER JOIN localidad lc ON cl.id_localidad = lc.id_localidad");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include ("sec_head.inc.php"); ?>
	</head>
<body>
    <?php include ("sec_encabezado.inc.php"); ?>
	<div class='wrapper'>
    	<div id="page-wrapper" >
      		<div id="page-inner">
      			<div class="panel-body">
	        		<div class="row">
	          			<div class="col-md-12">
	          				<form method='POST' action='cliente_insertar.php'>
								<input type='hidden' name='s' value='<?=$_POST['s']?>'/>
		          				<h2>Nuevo Cliente</h2>
								<h3>Datos del Cliente</h3>
								<div class="col-md-4">
									<label for='inNombre'>Nombre</label>
									<input type="text" class="form-control" id='inNombre' name="nombre" autofocus required placeholder="Nombre" autofocus tabindex="1" />
									<br/>
									<label for='inCalle'>Calle</label>
									<input type="text" class="form-control" id='inCalle' name="calle" required placeholder="Calle" tabindex="4" />
									<br/>
									
								</div>
								<div class="col-md-4">
									<label for='inAPaterno'>Apellido Paterno</label>
									<input type="text" class="form-control" id='inAPaterno' name="apaterno" placeholder="Apellido paterno" tabindex="2" />
									<br/>
									<label for='inNum'>Número de domicilio</label>
									<input type="text" class="form-control" id='inNum' name="numero" required placeholder="Número" tabindex="5" />
									<br/>
								</div>
								<div class="col-md-4">
									<label for='inAMaterno'>Apellido Materno</label>
									<input type="text" class="form-control" id='inAMaterno' name="amaterno" placeholder="Apellido materno" tabindex="3" />
									<br/>
									<label for='inColonia'>Colonia</label>
									<select name='colonia' id='inColonia' class="form-control" tabindex="6">
				                    <?php
				                        while ($row = mysql_fetch_array($result)): ?> 
				                        <option value='<?=$row['id_colonia']?>'><?=$row['cp_cod_pos']?> <?=$row['cl_nombre']?> <?=$row['lc_nombre']?></option>  
				                    <?php endwhile; ?>  
				                    </select>
				                    <br/>
				    
							    </div>		
							
							 

							    <h3>Datos Fiscales</h3>
								<div class="col-md-4">
									<label for='arRFC'>RFC</label>
									<input type="text" class="form-control" id='arRFC' min="13" name="RFC"  required placeholder="RFC" tabindex="7" />
									<br/>
								</div>
								<div class="col-md-4">
									<label for='arRazonSocial'>Razón Social</label>
									<input type="text" class="form-control" id='arRazonSocial' name="RazonSocial" required placeholder="Razón social" tabindex="8" />
									<br/>
								</div>
								<div class="col-md-4">
									<label for='arNumero'>Correo electrónico</label>
									<input type="text" class="form-control" id='arNumero' name="Correo" placeholder="Ejemplo@email.com" tabindex="9" />
									<br/>
								</div>
								<div class="col-md-4">
									<label for='arCalle'>Calle</label>
									<input type="text" class="form-control" id='arCalle' name="Calle" required placeholder="Calle" tabindex="10" />
									<br/>
								</div>
								<div class="col-md-4">
									<label for='arNumero'>Número</label>
									<input type="text" class="form-control" id='arNumero' name="Numero" required placeholder="Número" tabindex="11" />
									<br/>
								</div>
								
								<div class="col-md-4">
									<label for='arColonia'>Colonia</label>
									<select name='Colonia' id='arColonia' class="form-control" tabindex="12">
									<?php
				                        while ($row2 = mysql_fetch_array($result2)): ?> 
				                        <option value='<?=$row2['id_colonia']?>'><?=$row2['cp_cod_pos']?> <?=$row2['cl_nombre']?> <?=$row2['lc_nombre']?></option>  
				                    <?php endwhile; ?>
				                	</select>
				                    <br/>
				                </div>	

				                	<div class='col-md-6' align="right">
								        <input class="btn btn-primary" type="submit" name="submit"  value="Registrar" tabindex="13">
						            </div>			                
							</form>	
						

							
						            <div class='col-md-6' align='right'>
								<form method='POST' action='solicitud_desambiguar_cliente.php'>
									<input type='hidden' name='servicio' value='<?=$_POST['s']?>'/>
						        	<button class="btn btn-negro" type='submit' value='Regresar' tabindex="14" />Regresar</button>
						        </form>
						    </div>
						   </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<!-- JQUERY SCRIPTS -->
	<script src="assets/js/jquery-1.10.2.js"></script>
	<!-- BOOTSTRAP SCRIPTS -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- METISMENU SCRIPTS -->
	<script src="assets/js/jquery.metisMenu.js"></script>
	<!-- MORRIS CHART SCRIPTS -->
	<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
	<script src="assets/js/morris/morris.js"></script>
	<!-- DATA TABLE SCRIPTS -->
	<script src="assets/js/dataTables/jquery.dataTables.js"></script>
	<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
	<script>
	  $(document).ready(function () {
	      $('#dataTables-example').dataTable();
	  });
	</script>
	<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>