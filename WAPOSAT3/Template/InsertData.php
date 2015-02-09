<?php
// www.internetdelascosas.cl
//
// Script para recolectar datos enviados por arduinos conectados a la red
//
// contacto@internetdelascosas.cl
//

// Parametros de base de datos
echo "inicio";
$mysql_servidor = "localhost";
$mysql_base = "DB_waposat";
$mysql_usuario = "root";
$mysql_clave = "jibf123";
echo "variables bien";
$id_sensor  = htmlspecialchars($_GET["sensor"],ENT_QUOTES);
$id_equipo = htmlspecialchars($_GET["equipo"],ENT_QUOTES);
$valor = htmlspecialchars($_GET["valor"],ENT_QUOTES);
echo "datos bien";
// Valida que esten presente todos los parametros
	mysql_connect($mysql_servidor,$mysql_usuario,$mysql_clave) or die("Imposible conectarse al servidor.");
echo "conect bien";
	mysql_select_db($mysql_base) or die("Imposible abrir Base de datos");
echo "select bien";
	$sql = "insert into monitoreo (id_monitoreo,id_sensor, id_equipo, fecha, valor) values (NULL, '".$id_sensor."','".$id_equipo."', NOW(), '".$valor."')";
echo $sql;
	mysql_query($sql);
?>
