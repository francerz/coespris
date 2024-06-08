<?php
session_start();
if (isset($_SESSION['username'])) {
      header("Location: index.php");
  }
if (isset($_POST['submit'])) {
  require("index_validar.php");
}
?> 
<!DOCTYPE html>
<html lang='es'>
    <?php include("sec_head.inc.php");?>
    <style type="text/css">
    #bg{
    position:fixed;
    top:0;
    left:0;
    z-index:-1;
}
    </style>
   </head>
<body>
<img id="bg" src="assets/img/bg.jpg"  alt="background" /> 
  <div class="container">
    <div class="row text-center ">
      <div class="col-md-12">
        <br><br>
        <h2>COESPRIS</h2>
        <h5>Sistema de Trámites y Servicios</h5>
        <br>
      </div>
    </div>
    <div class="row ">               
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>LOGIN</strong>  
          </div>
          <div class="panel-body">
            <form role="form" method="POST">
              <br>
              <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="username" placeholder="Usuario">
              </div>
              <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control"name="password" placeholder="Password">
              </div>
              <div class="form-group">
                <span class="pull-right">
                </span>
              </div>     
              <div style="text-align:center">                                
              <input type="submit" name="submit" class="btn btn-primary"  value="Entrar">
              </div>
            </form>
          </div>                   
        </div>
      </div>                    
    </div>
  </div>
<SCRIPT type="text/javascript">
window.onload = function() {
 
    function bgadj(){
             
        var element = document.getElementById("bg");
         
        var ratio =  element.width / element.height;   
         
        if ((window.innerWidth / window.innerHeight) < ratio){
         
            element.style.width = 'auto';
            element.style.height = '100%';
             
            <!-- si la imagen es mas ancha que la ventana la centro -->
            if (element.width > window.innerWidth){
             
                var ajuste = (window.innerWidth - element.width)/2;
                 
                element.style.left = ajuste+'px';
             
            }
         
        }
        else{  
         
            element.style.width = '100%';
            element.style.height = 'auto';
            element.style.left = '0';
 
        }
         
    }
<!-- llamo a la función bgadj() por primera vez al terminar de cargar la página -->
    bgadj();
    <!-- vuelvo a llamar a la función  bgadj() al redimensionar la ventana -->
    window.onresize = function() {
        bgadj();
 
    }
 
}
</SCRIPT>
  </body>
</html>