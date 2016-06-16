<?php
require_once ("../require/conexion_class.php");
require_once ("../require/monitoreo_class.php");

$id_equipo = htmlspecialchars($_GET["equipo"],ENT_QUOTES);

$id_sensor1  = htmlspecialchars($_GET["sensor1"],ENT_QUOTES);
//$valor1 = htmlspecialchars($_GET["valor1"],ENT_QUOTES);
$id_sensor2  = htmlspecialchars($_GET["sensor2"],ENT_QUOTES);
//$valor2 = htmlspecialchars($_GET["valor2"],ENT_QUOTES);
$id_sensor3  = htmlspecialchars($_GET["sensor3"],ENT_QUOTES);
//$valor3 = htmlspecialchars($_GET["valor3"],ENT_QUOTES);


//echo "se han leido los valores";
$monitoreo = new monitoreo();
//echo "se ha creado el objeto";

//Inicio del Programa de creacion de datos en el tiempo

$hora = date('H');
$hora = $hora - 1;

$aleatorioPH = rand(0,100)/100;
$aleatorio2PH = rand(0,100)/100;
$PI = 3.14159;
$PH = $aleatorioPH*$aleatorio2PH*0.3+(-1*cos(($hora)*$PI/12)*0.35)+7.3;
$PH = round($PH,2);

$aleatorioT = rand(0,100)/100;
$aleatorio2T = rand(0,100)/100;
$Temp = $aleatorioT*$aleatorio2T*0.3+(-1*cos(($hora)*$PI/12)*1.2)+23.01;
$Temp = round($Temp,2);    

$aleatorioDO = rand(0,100)/100;
$aleatorio2DO = rand(0,100)/100;
$DO = $aleatorioDO*$aleatorio2DO*0.3+(-1*cos(($hora)*$PI/12)*1.2)+7.01;
$DO = round($DO,2);


$valor1 = $PH;
$valor2 = $Temp;
$valor3 = $DO;

$monitoreo->registrar_valor($id_sensor1, $id_equipo, $valor1);
$monitoreo->registrar_valor($id_sensor2, $id_equipo, $valor2);
$monitoreo->registrar_valor($id_sensor3, $id_equipo, $valor3);
//$monitoreo->registrar_valor($id_sensor3, $id_equipo, $valor3);
echo "hola mundo ;)";
?>