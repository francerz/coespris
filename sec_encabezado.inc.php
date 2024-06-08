<nav class="navbar navbar-default navbar-cls-top navbar-fixed-top" role="navigation" style="margin-top:0px" id="menu-contenedor">
    <div class="navbar-header" id="menu">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="menu.php"><h5>Sistema de Trámites y Servicios</h5></a> 
    </div>
<script>
function actualiza(){
  location.reload();
}
</script>
    <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
    Bienvenido: <?=$_SESSION['username']?> &nbsp; <a href="cerrar_sesion.php" class="btn btn-danger square-btn-adjust">Salir</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="actualiza();" class="btn btn-success square-btn-adjust"><i class="fa fa-refresh"></i></button> </div>
</nav>

<div id="stick">
<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation" id="sibar">
    <div class="sidebar-collapse" id="leftCol">
        <ul class="nav nav-stacked" id="sidebar">
            <li class="text-center">
               <a href="menu.php"><img src="assets/img/coespris.png" border="0" class="user-image img-responsive"/><?php include("reloj.php");?></a>
            </li>
            <?php if($_SESSION['rol']!='CONTADOR'){?>               
                <li>
                    <a href="solicitud_servicios.php"><i class="glyphicon glyphicon-plus fa-2x"></i> Solicitud</a>
                </li>
            <?php }?>
            <li>
                <a  href="solicitud_buscar.php"><i class="glyphicon glyphicon-search fa-2x"></i> Consultas</a>
            </li>
            <?php if($_SESSION['rol']!='CONTADOR'){?> 
              <li>
                <a  href="cursos_menu.php"><i class="glyphicon glyphicon-edit fa-2x"></i> Cursos</a>
              </li>
            <?php }
            if($_SESSION['rol']!='VENTANILLA'){?>
                <li>
                    <a href="ingresos_menu.php"><i class="fa fa-usd fa-2x"></i> Ingresos</a>
                </li>
                <?php if($_SESSION['rol']!='CONTADOR'){?>
                    <li >
                        <a  href="catalogo_menu.php"><i class="fa fa-list-alt fa-2x" ></i> Catálogos</a>
                    </li>
                    <li>
                        <a  href="catalogo_usuarios_permisos.php"><i class="fa fa-users fa-2x"></i> Usuarios y Permisos</a>
                    </li>
                <?php }?>
            <?php }?>
            <li>
                <a  href="cerrar_sesion.php"><i class="fa fa-times fa-2x"></i> Salir</a>
            </li>
        </ul>               
    </div>        
</nav>
</div>
<script type="text/javascript">
  /* activate sidebar */
$('#sidebar').affix({
  offset: {
    top: 235
  }
});

/* activate scrollspy menu */
var $body   = $(document.body);
var navHeight = $('.navbar').outerHeight(true) + 10;

$body.scrollspy({
  target: '#leftCol',
  offset: navHeight
});

/* smooth scrolling sections */
$('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 50
        }, 1000);
        return false;
      }
    }
});
</script>
<style type="text/css">
  /*
A Bootstrap 3.1 affix sidebar template
from http://bootply.com

This CSS code should follow the 'bootstrap.css'
in your HTML file.

license: MIT
author: bootply.com
*/

body {
 padding-top:50px;
}

#masthead { 
 min-height:250px;
}

#masthead h1 {
 font-size: 30px;
 line-height: 1;
 padding-top:20px;
}

#masthead .well {
 margin-top:8%;
}

@media screen and (min-width: 768px) {
  #masthead h1 {
    font-size: 50px;
  }
}

.navbar-bright {
 background-color:#111155;
 color:#fff;
}

.affix-top,.affix{
 position: static;
}

@media (min-width: 979px) {
  #sidebar.affix-top {
    position: static;
    margin-top:30px;
    width:228px;
  }
  
  #sidebar.affix {
    position: fixed;
    top:70px;
    width:228px;
  }
}

#sidebar li.active {
  border:0 #eee solid;
  border-right-width:5px;
}
</style>