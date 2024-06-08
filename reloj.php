<?php
    require_once("conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="acciones.js"></script>
<link rel="stylesheet" type="text/css" rel="nofollow" href="estilos.css"/>
</head>

<body onload="Reloj()">
<div id="txt">
</div>
<style type="text/css">
	#txt{
    font-family:sans-serif;
    font-size: 11px;
    color:white;

}
</style>
<script language="JavaScript" type="text/JavaScript">
    var Hoy = new Date("<?php echo date("d M Y G:i:s"); ?>");
function Reloj(){ 
var esteMomento = new Date();
var hora = esteMomento.getHours();
var mt = "AM";
if (hora > 12) {
mt = "PM";
hora = hora - 12;
}

if (hora == 0) hora = 12;
var minuto = esteMomento.getMinutes();
if(minuto < 10) minuto = '0' + minuto;
var segundo = esteMomento.getSeconds();
if(segundo < 10) segundo = '0' + segundo;

    var Dia = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"); 
    var Mes = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
    var Anio = Hoy.getFullYear(); 
    var Fecha = Dia[Hoy.getDay()] + ", " + Hoy.getDate() + " de " + Mes[Hoy.getMonth()] + " de " + Anio + ", a las "; 
    var Inicio, Script, Final, Total 
    Inicio = "<font size=2 color=white>" 
    HoraCompleta= hora + ":" + minuto +" "+mt;
    Script = Fecha + "<br>" + HoraCompleta
    Final = "</font>" 
    Total = Inicio + Script + Final 
    document.getElementById('txt').innerHTML = Total 
    Hoy.setSeconds(Hoy.getSeconds() +1)
    setTimeout("Reloj()",1000) 
} 
</script>
</body>
</html>