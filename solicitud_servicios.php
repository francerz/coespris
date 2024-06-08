<?php
session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: index.php");
    }
	$_SESSION['usuario'] = 'Usuario';
	require_once ("conexion.php");

?>
<?php
	$query = "SELECT id_servicio, sr_nombre, sr_imagen FROM servicio WHERE sr_tipo = 'opinion'" ;
    $result = mysql_query($query, $dbConn); 

    $query2 = "SELECT id_servicio, sr_nombre, sr_imagen FROM servicio WHERE sr_tipo = 'autorizacion'" ;
    $result2 = mysql_query($query2, $dbConn); 

    $query3 = "SELECT id_servicio, sr_nombre, sr_imagen FROM servicio WHERE sr_tipo = 'asesoria' || sr_tipo = 'constancia' || sr_tipo = 'curso' || sr_tipo = 'visita'" ;
    $result3 = mysql_query($query3, $dbConn); 
    $contador=1;
    $contador2=1;
    $cont2=2;
    $cont3=1;
    ?>

<!DOCTYPE html>
<html lang='es'>
<head>
    	<?php  include ("sec_head.inc.php");?>
</head>
<body>
<?php include("sec_encabezado.inc.php");?>
	<div id="page-wrapper" >
        <div id="page-inner-hola">
            <div class="row">
                <div class="col-md-12">
					<h2 class="title" aline='center'>Menú de servicios</h2>
			    </div>
            </div>              
            <!-- /. ROW  -->
              <hr/>   
	           
	           <style type="text/css">
                button{
                         border-width: 0px;
                         background-color: transparent;
                      }
               </style>

<!-- ******************************************************************************************************************************************************************-->                    
<form role="form" method='POST' action='solicitud_desambiguar_cliente.php'>

<div id="tab-box">
 
        <div id="tab-1" class="tab">
          <span class="hola"><a href="#tab-1">Opiniones</a></span>
            <span class="hola">
             <?php while ($row = mysql_fetch_array($result)):
             $rest = substr($row['sr_nombre'], 0, 36);?>

               <?php   if ($contador % 4 === 0): ?>
              <div class="row">
              <?php endif; ?>

                <div class="col-md-3 col-sm-6 col-xs-6">                        
                           <div class="view view-first" >
                                 <button class="mask" type="submit" name="servicio" value="<?=$row['id_servicio']?>">
                                     <h2>TRÁMITE</h2>
                                     <p><?=utf8_decode($row['sr_nombre'])?></p>
                                 </button>
                           </div>
                         <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                             <i class="<?=$row['sr_imagen']?>"></i>
                            </span>
                               <div class="text-box" >
                             <br><br><br><br><br>
                               <p class="text-muted"><?=utf8_decode($rest);echo("...") ?> </p>                    
                               </div>   
                         </div>   
                        <br><br>
                </div>
              
          <?php if ($contador % 4 === 0): ?>
         
           </div>
          <?php endif; ?> 
          <?php endwhile;?>  
            </span>
       </div>
    <!-- *********************************************************************************************************************-->
         <?php while ($row = mysql_fetch_array($result2)):
          $rest2 = substr($row['sr_nombre'], 0, 36);?>
      
      <?php if($contador === 1) : ?>
       <div id="tab-<?=$cont2?>" class="tab">
          <span class="hola"><a href="#tab-<?=$cont2?>">Autorizaciones <?php echo "$cont3"; ?></a></span>
            <span class="hola">
      <?php endif;?>
        
               <?php   if ($contador % 4 === 0): ?>
              <div class="row">
              <?php endif; ?>

                <div class="col-md-3 col-sm-6 col-xs-6">                        
                           <div class="view view-first" >
                                 <button class="mask" type="submit" name="servicio" value="<?=$row['id_servicio']?>">
                                     <h2>TRÁMITE</h2>
                                     <p><?=utf8_decode($row['sr_nombre'])?></p>
                                 </button>
                           </div>
                         <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                             <i class="<?=$row['sr_imagen']?>"></i>
                            </span>
                               <div class="text-box" >
                             <br><br><br><br><br>
                               <p class="text-muted"><?=utf8_decode($rest2);echo("...") ?> </p>                    
                               </div>   
                         </div>   
                        <br><br>
                </div>
              
          <?php if ($contador % 4 === 0): ?>
         
           </div>
          <?php endif; ?> 

     <?php if ($contador === 12) { ?>
           </span>
      </div>
      <?php $contador=1; $cont3++; $cont2++; } 
      else 
        { 
          $contador++; 
        }
      ?>
<?php endwhile;?> 
<?php if($cont3===2) { ?>
      </div>
   <?php } ?>

    <!-- *********************************************************************************************************************-->
       <div id="tab-4" class="tab">
          <span class="hola"><a href="#tab-4">Otros</a></span>
            <span class="hola">
             <?php while ($row = mysql_fetch_array($result3)):
             $rest3 = substr($row['sr_nombre'], 0, 36);?>

               <?php   if ($contador % 4 === 0): ?>
              <div class="row">
              <?php endif; ?>
                <div class="col-md-4 col-sm-6 col-xs-6">                        
                           <div class="view view-first" >
                                 <button class="mask" type="submit" name="servicio" value="<?=$row['id_servicio']?>">
                                     <h2>TRÁMITE</h2>
                                     <p><?=utf8_decode($row['sr_nombre'])?></p>
                                 </button>
                           </div>
                         <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                             <i class="<?=$row['sr_imagen']?>"></i>
                            </span>
                               <div class="text-box" >
                             <br><br><br><br><br>
                               <p class="text-muted"><?=utf8_decode($rest3);echo("...") ?></p>                    
                               </div>   
                         </div>   
                        <br><br>
                </div>             
          <?php if ($contador % 4 === 0): ?>
           </div>
          <?php endif; ?> 
          <?php endwhile;?>  
            </span>
       </div>  

</div>
<script type="text/javascript">
      window.location.hash = '#tab-1'
</script>
</form>

<!-- ******************************************************************************************************************************************************************-->
<!-- 		 </form>   -->
        <!-- /. PAGE INNER  -->
        </div> 
    <!-- /. PAGE WRAPPER  -->
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