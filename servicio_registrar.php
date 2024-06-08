<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
require_once("conexion.php");
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<?php include ("sec_head.inc.php"); ?>
	</head>
<body>
	<?php include ("sec_encabezado.inc.php"); ?>
	<div class='wrapper'>
		<div id="page-wrapper" >
      		<div id="page-inner">
        		<div class="row">
            		<form method='POST' enctype="multipart/form-data" action='servicio_insertar.php'>
	          			<div class="col-md-12">
	          				<div class="panel-body">
								<h2>Nuevo Servicio</h2>
	          				</div>
	          			</div>
	          			<div class="col-md-6">
	          				<div class="panel-body">
						        <label for='inNombre'>Nombre</label>
		                    	<input type="text" class="form-control" name="nombre" autofocus required placeholder="Nombre Servicio"/>
		          			</div>
	       				</div>
	       				<div class="col-md-3">
	       					<div class="panel-body">
			                    <label for='incontrasenia'>Cantidad de Salario Minimo</label>
			                    <input type="number" class="form-control" name="cantidad" required placeholder="Cantidad de Salario Minimo"/>
	       					</div>
	       				</div>
	       				<div class="col-md-3">
	       					<div class="panel-body">
			                    <label for='incontrasenia'>Tipo</label>
			                    <select name='tipo' required class="form-control">
			                    	<option value='asesoria' onclick = 'deshabilita()'>Asesoria</option>
			                    	<option value='autorizacion' onclick = 'habilita()'>Autorizacion</option>
			                    	<option value='constancia'onclick = 'deshabilita()'>Constancia</option>
			                    	<option value='curso' onclick = 'deshabilita()'>Curso</option>
			                    	<option value='emision' onclick = 'deshabilita()'>Emision</option>
			                    	<option value='opinion' onclick = 'deshabilita()'>Opinion</option>
			                    	<option value='visita' onclick = 'deshabilita()'>Visita</option>
			                    </select>
	       					</div>
	       				</div>
	       				<div class="col-md-12">
	       					<div class="panel-body">
		       				<div class='panel panel-default'>
		       					<div class='panel-heading'>
		       						<label>Imagen del Servicio</label>
		       					</div>
		       					<div class='panel-body'>
		       						<div style="height: 200px; overflow-y: scroll;" align='center'>
								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-asterisk'/>
								          <span class="fa-2x glyphicon glyphicon-asterisk" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-plus'/>
								          <span class="fa-2x glyphicon glyphicon-plus" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-minus" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-cloud" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-envelope" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-pencil" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-glass" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-music" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-search" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-star" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-star-empty" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-user" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-film" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-th-large" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-th" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-th-list" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-ok" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-remove" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-signal" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-cog" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-trash" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-home" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-file" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-time" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-road" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-download-alt" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-download" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-upload" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-inbox" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-play-circle" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-repeat" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-refresh" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-list-alt" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-lock" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-flag" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-headphones" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-qrcode" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-barcode" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-tag" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-tags" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-book" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-bookmark" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-print" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-camera" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-list" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-facetime-video" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-picture" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-map-marker" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-adjust" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-tint" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-edit" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-share" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-check" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-move" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-question-sign" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-info-sign" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-screenshot" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-gift" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-leaf" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-fire" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-eye-open" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-plane" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-calendar" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-retweet" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-folder-close" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-folder-open" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-hdd" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-bell" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-certificate" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-globe" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-wrench" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-briefcase" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-paperclip" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-phone" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-pushpin" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-usd" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-flash" aria-hidden="true"></span>
								        </div>

								        <div class="col-md-1">
								        	<input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
								          <span class="fa-2x glyphicon glyphicon-record" aria-hidden="true"></span>
								        </div>
		       						</div>
		       					</div>
		       				</div>
		       				</div>
	       				</div>
	       				<div class="col-md-12">
	       					<div class="col-md-12">
	       					<?php $result = mysql_query("SELECT id_formato, fr_nombre FROM formato WHERE fr_tipo='Solicitud' AND estatus='Habilitado'");?>
			       				<div class="col-md-2">
		       						<h3>Solicitud</h3>
		       					</div>
		       					<div class="col-md-10">
		       						<div class="panel-body">
		       							<select name='solicitud' required class="form-control">
		       								<option value='0' onclick = 'abrirSol()'>Nueva</option>
		       								<?php while ($row=mysql_fetch_array($result)):?>
		       									<option value='<?=$row['id_formato']?>' onclick = 'cerrarSol()'><?=$row['fr_nombre']?></option>
		       								<?php endwhile;?>
		       							</select>
		       						</div>
		       					</div>
		       				</div>
		       				<div id="solicitud">
			       				<div class="col-md-3">
			       					<div class="panel-body">
			       						<label>Nombre</label>
			       						<input type="text" class="form-control" id='sol2' name='sol-nombre' required>
			       					</div>
			       				</div>
			       				<div class="col-md-5">
			       					<div class="panel-body">
			       						<label>Contenido</label>
			       						<textarea class="form-control" required id='sol3' name='sol-contenido' style="max-width: 100%;"></textarea>
			       					</div>
			       				</div>
			       				<div class="col-md-4">
			       					<div class="panel-body">
			       						<label>Archivo</label>
			       						<div class='fileUpload btn btn-negro'>
				       						<span>Subir</span>
				       						<input id="solarchivofile" placeholder="Choose File" disabled="disabled" />
				       						<input name="sol-archivo" id='solarchivobtn' required type="file" class="upload"/>
				       					</div>
			       						<label>PDF</label>
			       						<div class='fileUpload btn btn-primary'>
				       						<span>Subir</span>
				       						<input id="solpdffile" placeholder="Choose File" disabled="disabled" />
				       						<input name="sol-pdf" id="solpdfbtn" required type="file" class="upload"/>
										</div>
			       					</div>
			       				</div>
		       				</div>
	       				</div>
	       				<div class="col-md-12">
	       					<div class="col-md-12">
	       					<?php $result = mysql_query("SELECT id_formato, fr_nombre FROM formato WHERE fr_tipo='Orden' AND estatus='Habilitado'");?>
			       				<div class="col-md-3">
		       						<h3>Orden de Pago</h3>
		       					</div>
		       					<div class="col-md-9">
		       						<div class="panel-body">
		       							<select name='orden' required class="form-control">
		       								<option value='0' onclick = 'abrirOrd()'>Nueva</option>
		       								<?php while ($row=mysql_fetch_array($result)):?>
		       									<option value='<?=$row['id_formato']?>' onclick = 'cerrarOrd()'><?=$row['fr_nombre']?></option>
		       								<?php endwhile;?>
		       							</select>
		       						</div>
		       					</div>
		       				</div>
		       				<div id="orden">
			       				<div class="col-md-3">
			       					<div class="panel-body">
			       						<label>Nombre</label>
			       						<input type="text" class="form-control" id='ord2' name='ord-nombre' required>
			       					</div>
			       				</div>
			       				<div class="col-md-5">
			       					<div class="panel-body">
			       						<label>Contenido</label>
			       						<textarea class="form-control" required id='ord3' name='ord-contenido' style="max-width: 100%;"></textarea>
			       					</div>
			       				</div>
			       				<div class="col-md-4">
			       					<div class="panel-body">
			       						<label>Archivo</label>
			       						<div class='fileUpload btn btn-negro'>
				       						<span>Subir</span>
				       						<input id="ordarchivofile" placeholder="Choose File" disabled="disabled" />
				       						<input name="ord-archivo" id='ordarchivobtn' required type="file" class="upload"/>
				       					</div>
			       						<label>PDF</label>
			       						<div class='fileUpload btn btn-primary'>
				       						<span>Subir</span>
				       						<input id="ordpdffile" placeholder="Choose File" disabled="disabled" />
				       						<input name="ord-pdf" id="ordpdfbtn" required type="file" class="upload"/>
										</div>
			       					</div>
			       				</div>
		       				</div>
	       				</div>
	       				<div class="col-md-12">
	       					<div class="col-md-12">
	       					<?php $result = mysql_query("SELECT id_formato, fr_nombre FROM formato WHERE fr_tipo='Recibo' AND estatus='Habilitado'");?>
			       				<div class="col-md-3">
		       						<h3>Recibo de Pago</h3>
		       					</div>
		       					<div class="col-md-9">
		       						<div class="panel-body">
		       							<select name='recibo' required class="form-control">
		       								<option value='0' onclick = 'abrirRec()'>Nueva</option>
		       								<?php while ($row=mysql_fetch_array($result)):?>
		       									<option value='<?=$row['id_formato']?>' onclick = 'cerrarRec()'><?=$row['fr_nombre']?></option>
		       								<?php endwhile;?>
		       							</select>
		       						</div>
		       					</div>
		       				</div>
		       				<div id="recibo">
			       				<div class="col-md-3">
			       					<div class="panel-body">
			       						<label>Nombre</label>
			       						<input type="text" class="form-control" id='rec2' name='rec-nombre' required>
			       					</div>
			       				</div>
			       				<div class="col-md-5">
			       					<div class="panel-body">
			       						<label>Contenido</label>
			       						<textarea class="form-control" required id='rec3' name='rec-contenido' style="max-width: 100%;"></textarea>
			       					</div>
			       				</div>
			       				<div class="col-md-4">
			       					<div class="panel-body">
			       						<label>Archivo</label>
			       						<div class='fileUpload btn btn-negro'>
				       						<span>Subir</span>
				       						<input id="recarchivofile" placeholder="Choose File" disabled="disabled" />
				       						<input name="rec-archivo" id='recarchivobtn' type="file" required class="upload"/>
				       					</div>
			       						<label>PDF</label>
			       						<div class='fileUpload btn btn-primary'>
				       						<span>Subir</span>
				       						<input id="recpdffile" placeholder="Choose File" disabled="disabled" />
				       						<input name="rec-pdf" id="recpdfbtn" type="file" required class="upload"/>
										</div>
			       					</div>
			       				</div>
		       				</div>
	       				</div>
	       				<div class="col-md-12" id='autorizacion' style="display: none;">
	       					<div class="col-md-12">
	       					<?php $result = mysql_query("SELECT id_formato, fr_nombre FROM formato WHERE fr_tipo='Autorizacion' AND estatus='Habilitado'");?>
			       				<div class="col-md-2">
		       						<h3>Autorización</h3>
		       					</div>
		       					<div class="col-md-10">
		       						<div class="panel-body">
		       							<select name='autorizacion' id='autoriza1' required disabled="disabled" class="form-control">
		       								<option value='0' onclick = 'abrirAut()'>Nueva</option>
		       								<?php while ($row=mysql_fetch_array($result)):?>
		       									<option value='<?=$row['id_formato']?>' onclick = 'cerrarAut()'><?=$row['fr_nombre']?></option>
		       								<?php endwhile;?>
		       							</select>
		       						</div>
		       					</div>
		       				</div>
		       				<div id="auto">
			       				<div class="col-md-3">
			       					<div class="panel-body">
			       						<label>Nombre</label>
			       						<input type="text" id='autoriza2' disabled="disabled" class="form-control" name='aut-nombre' required>
			       					</div>
			       				</div>
			       				<div class="col-md-5">
			       					<div class="panel-body">
			       						<label>Contenido</label>
			       						<textarea class="form-control" id='autoriza3' disabled="disabled" required name='aut-contenido' style="max-width: 100%;"></textarea>
			       					</div>
			       				</div>
			       				<div class="col-md-4">
			       					<div class="panel-body">
			       						<label>Archivo</label>
			       						<div class='fileUpload btn btn-negro'>
				       						<span>Subir</span>
				       						<input id="autarchivofile" placeholder="Choose File" disabled="disabled" />
				       						<input name="aut-archivo" id='autarchivobtn' disabled="disabled" type="file" required class="upload"/>
				       					</div>
			       						<label>PDF</label>
			       						<div class='fileUpload btn btn-primary'>
				       						<span>Subir</span>
				       						<input id="autpdffile" placeholder="Choose File" disabled="disabled" />
				       						<input name="aut-pdf" id="autpdfbtn" type="file" disabled="disabled" required class="upload"/>
										</div>
			       					</div>
			       				</div>
		       				</div>
	       				</div>
	       				<style type="text/css">
	       					    .fileUpload {
								    position: relative;
								    overflow: hidden;
								    margin: 10px;
								}
								#recarchivofile,#recpdffile,#ordarchivofile,#ordpdffile,#solarchivofile,#solpdffile,#autarchivofile,#autpdffile{
								    color: rgb(0,0,0);
								}
								.fileUpload input.upload {
								    position: absolute;
								    top: 0;
								    right: 0;
								    margin: 0;
								    padding: 0;
								    font-size: 20px;
								    cursor: pointer;
								    opacity: 0;
								    filter: alpha(opacity=0);
								}
	       				</style>
	       				<script language="JavaScript">
	       					document.getElementById("solarchivobtn").onchange = function () {
							    document.getElementById("solarchivofile").value = this.value;
							};
							document.getElementById("solpdfbtn").onchange = function () {
							    document.getElementById("solpdffile").value = this.value;
							};
							document.getElementById("ordarchivobtn").onchange = function () {
							    document.getElementById("ordarchivofile").value = this.value;
							};
							document.getElementById("ordpdfbtn").onchange = function () {
							    document.getElementById("ordpdffile").value = this.value;
							};
							document.getElementById("recarchivobtn").onchange = function () {
							    document.getElementById("recarchivofile").value = this.value;
							};
							document.getElementById("recpdfbtn").onchange = function () {
							    document.getElementById("recpdffile").value = this.value;
							};
							document.getElementById("autarchivobtn").onchange = function () {
							    document.getElementById("autarchivofile").value = this.value;
							};
							document.getElementById("autpdfbtn").onchange = function () {
							    document.getElementById("autpdffile").value = this.value;
							};
							function habilita(){
								$('#autorizacion').show();
								document.getElementById('autoriza1').disabled = false;
								document.getElementById('autoriza2').disabled = false;
								document.getElementById('autoriza3').disabled = false;
								document.getElementById('autarchivobtn').disabled = false;
								document.getElementById('autpdfbtn').disabled = false;
							}
		 					function deshabilita(){
		 						$('#autorizacion').hide();
								document.getElementById('autoriza1').disabled = true;
								document.getElementById('autoriza2').disabled = true;
								document.getElementById('autoriza3').disabled = true;
								document.getElementById('autarchivobtn').disabled = true;
								document.getElementById('autpdfbtn').disabled = true;
							}
							function abrirSol(){
								$('#solicitud').show();
								document.getElementById('sol2').disabled = false;
								document.getElementById('sol3').disabled = false;
								document.getElementById('solarchivobtn').disabled = false;
								document.getElementById('solpdfbtn').disabled = false;
							}
		 					function cerrarSol(){
		 						$('#solicitud').hide();
								document.getElementById('sol2').disabled = true;
								document.getElementById('sol3').disabled = true;
								document.getElementById('solarchivobtn').disabled = true;
								document.getElementById('solpdfbtn').disabled = true;
							}
							function abrirOrd(){
								$('#orden').show();
								document.getElementById('ord2').disabled = false;
								document.getElementById('ord3').disabled = false;
								document.getElementById('ordarchivobtn').disabled = false;
								document.getElementById('ordpdfbtn').disabled = false;
							}
		 					function cerrarOrd(){
		 						$('#orden').hide();
								document.getElementById('ord2').disabled = true;
								document.getElementById('ord3').disabled = true;
								document.getElementById('ordarchivobtn').disabled = true;
								document.getElementById('ordpdfbtn').disabled = true;
							}
							function abrirRec(){
								$('#recibo').show();
								document.getElementById('rec2').disabled = false;
								document.getElementById('rec3').disabled = false;
								document.getElementById('recarchivobtn').disabled = false;
								document.getElementById('recpdfbtn').disabled = false;
							}
		 					function cerrarRec(){
		 						$('#recibo').hide();
								document.getElementById('rec2').disabled = true;
								document.getElementById('rec3').disabled = true;
								document.getElementById('recarchivobtn').disabled = true;
								document.getElementById('recpdfbtn').disabled = true;
							}
							function abrirAut(){
								$('#auto').show();
								document.getElementById('autoriza2').disabled = false;
								document.getElementById('autoriza3').disabled = false;
								document.getElementById('autarchivobtn').disabled = false;
								document.getElementById('autpdfbtn').disabled = false;
							}
		 					function cerrarAut(){
		 						$('#auto').hide();
								document.getElementById('autoriza2').disabled = true;
								document.getElementById('autoriza3').disabled = true;
								document.getElementById('autarchivobtn').disabled = true;
								document.getElementById('autpdfbtn').disabled = true;
							}
						</script>
	       				<div class="col-md-6" align='right'>
	       					<div class="panel-body">
	       						<input class="btn btn-success" type="submit" value="Guardar">
	       					</div>
	       				</div>
	      			</form>
	      			<div class="col-md-6">
	      				<div class="panel-body">
	      					<form>
	        					<button class="btn btn-negro" type='submit' value='Regresar' formaction="servicio_general.php"/>Regresar</button>
	      					</form>
	      				</div>
	      			</div>
      			</div>
    		</div>
  		</div>
	</div>
	<?php mysql_close($dbConn);?>
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