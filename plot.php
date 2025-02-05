<?php
require_once ('src/jpgraph.php');
require_once ('src/jpgraph_line.php');
require_once("conexion.php");
$datay1 = array(20,15,23,15,80,20,45,10,5,45,60);
$datay2 = array(12,9,12,8,41,15,30,8,48,36,14,25);
$datay3 = array(5,17,32,24,4,2,36,2,9,24,21,23);

// Setup the graph
$graph = new Graph(900,350);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Evolución de pedidos');
$graph->SetBox(false);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels(array('Ene','Feb','Mar','Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Nov', 'Oct', 'Dic'));
$graph->xgrid->SetColor('#E3E3E3');

//Creamos la primera linea
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Tienda 1');

// Creamos la segunda linea
$p2 = new LinePlot($datay2);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend('Tienda 2');

//Creamos la tercera linea
//Elegimos el tipo de grafica y agregamos el array
$p3 = new LinePlot($datay3);
$graph->Add($p3);
//le asignamos un color
$p3->SetColor("#FF1493");
//le ponemos un nombre
$p3->SetLegend('Tienda 3');
//tamaño
$graph->legend->SetFrameWeight(1);

// Generamos el grafico
$graph->Stroke();
?>
