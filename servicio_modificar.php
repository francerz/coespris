<?php
 session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
  require("conexion.php");
  $id = $_POST['id'];
  $row = mysql_fetch_array(mysql_query("SELECT sr_nombre, sr_cant_sal_min, sr_imagen, sr_tipo FROM servicio WHERE id_servicio = '$id'"));
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
        <div class="row">
          <form action='servicio_editar.php' method='POST'>
            <input type='hidden' value='<?=$id?>' name='id'>
            <div class="col-md-12">
              <div class="panel-body">
                <h2>Modificar Servicio</h2>
              </div>
            </div>
            <div class="col-md-6">
              <div class="panel-body">
                <label for='inNombre'>Nombre</label>
                <input type="text" class="form-control" name="nombre" autofocus required value='<?=$row['sr_nombre']?>' placeholder="Nombre Servicio"/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="panel-body">
                <label for='incontrasenia'>Cantidad de Salario Minimo</label>
                <input type="number" class="form-control" name="cantidad" required value='<?=$row['sr_cant_sal_min']?>' placeholder="Cantidad de Salario Minimo"/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="panel-body">
                <label for='incontrasenia'>Tipo</label>
                <select name='tipo' required class="form-control">
                  <?php if($row['sr_tipo']=='asesoria'){?><option selected value='asesoria'>Asesoria</option><?php }else{?><option value='asesoria'>Asesoria</option><?php }?>
                  <?php if($row['sr_tipo']=='autorizacion'){?><option selected value='autorizacion'>Autorizacion</option><?php }else{?><option value='autorizacion'>Autorizacion</option><?php }?>
                  <?php if($row['sr_tipo']=='constancia'){?><option selected value='constancia'>Constancia</option><?php }else{?><option value='constancia'>Constancia</option><?php }?>
                  <?php if($row['sr_tipo']=='curso'){?><option selected value='curso'>Curso</option><?php }else{?><option value='curso'>Curso</option><?php }?>
                  <?php if($row['sr_tipo']=='emision'){?><option selected value='emision'>Emision</option><?php }else{?><option value='emision'>Emision</option><?php }?>
                  <?php if($row['sr_tipo']=='opinion'){?><option selected value='opinion'>Opinion</option><?php }else{?><option value='opinion'>Opinion</option><?php }?>
                  <?php if($row['sr_tipo']=='visita'){?><option selected value='visita'>Visita</option><?php }else{?><option value='visita'>Visita</option><?php }?>
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
                        <?php if($row['sr_imagen']=='glyphicon glyphicon-asterisk'){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-asterisk'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-asterisk'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']=='glyphicon glyphicon-plus'){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-plus'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-plus'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-plus" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']=='glyphicon glyphicon-minus'){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-minus'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-minus'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-minus" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']=='glyphicon glyphicon-cloud'){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-cloud'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-cloud'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-cloud" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-envelope" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-glass" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-music" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-search" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-star" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-user" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-film" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-th-large" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-th" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-th-list" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-ok" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-remove" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-signal" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-cog" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-trash" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-home" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-file" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-time" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-road" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-download" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-upload" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-inbox" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-play-circle" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-repeat" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-refresh" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-lock" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-flag" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-headphones" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-qrcode" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-barcode" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-tag" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-tags" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-book" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-bookmark" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-print" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-camera" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-list" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-facetime-video" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-picture" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-adjust" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-tint" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-edit" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-share" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-check" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-move" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-screenshot" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-gift" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-leaf" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-fire" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-plane" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-calendar" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-retweet" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-folder-close" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-hdd" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-bell" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-certificate" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-globe" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-wrench" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-paperclip" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-phone" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-pushpin" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-usd" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-flash" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-1">
                        <?php if($row['sr_imagen']==''){ ?>
                          <input type='radio' checked required name='imagen' value='glyphicon glyphicon-'/>
                        <?php }else{?>
                          <input type='radio' required name='imagen' value='glyphicon glyphicon-'/>
                        <?php } ?>
                        <span class="fa-2x glyphicon glyphicon-record" aria-hidden="true"></span>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6" align='right'>
              <input class="btn btn-success" type="submit" value="Guardar">
            </div>
          </form>
          <div class='col-md-6'>
            <form method='POST' action='servicio_general.php'>
              <input type='hidden' value='<?=$id?>' name='id'>
              <button class="btn btn-negro" type='submit' value='Regresar'/>Regresar</button>
            </form>
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