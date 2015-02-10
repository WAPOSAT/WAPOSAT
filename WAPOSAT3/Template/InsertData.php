<?php
require_once ("../require/conexion_class.php");
require_once ("../require/monitoreo_class.php");

$id_sensor  = htmlspecialchars($_GET["sensor"],ENT_QUOTES);
$id_equipo = htmlspecialchars($_GET["equipo"],ENT_QUOTES);
$valor = htmlspecialchars($_GET["valor"],ENT_QUOTES);

//echo "se han leido los valores";
$monitoreo = new monitoreo();
//echo "se ha creado el objeto";
$monitoreo->registrar_valor($id_sensor, $id_equipo, $valor);
//echo "se ha finalizado correctamente";
?>