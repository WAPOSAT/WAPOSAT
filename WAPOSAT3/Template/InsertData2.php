<?php
require_once ("../require/conexion_class.php");
require_once ("../require/monitoreo_class.php");

$id_sensor1  = htmlspecialchars($_GET["sensor1"],ENT_QUOTES);
$id_equipo = htmlspecialchars($_GET["equipo"],ENT_QUOTES);
$valor1 = htmlspecialchars($_GET["valor1"],ENT_QUOTES);
$id_sensor2  = htmlspecialchars($_GET["sensor2"],ENT_QUOTES);
$valor2 = htmlspecialchars($_GET["valor2"],ENT_QUOTES);
//$id_sensor3  = htmlspecialchars($_GET["sensor3"],ENT_QUOTES);
//$valor3 = htmlspecialchars($_GET["valor3"],ENT_QUOTES);

//echo "se han leido los valores";
$monitoreo = new monitoreo();
//echo "se ha creado el objeto";
$monitoreo->registrar_valor($id_sensor1, $id_equipo, $valor1);
$monitoreo->registrar_valor($id_sensor2, $id_equipo, $valor2);
//$monitoreo->registrar_valor($id_sensor3, $id_equipo, $valor3);
//echo "se ha finalizado correctamente";
?>