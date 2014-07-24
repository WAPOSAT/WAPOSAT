<?php
require_once ("../require/monitoreo_class.php");

// Por ajax son enviados dos datos
/*
$id_equipo = $_GET["dato1"];
$id_sensor = $_GET["dato2"];
*/
$id_equipo =1;
$id_sensor =1;


$monitoreo = new monitoreo();

$monitoreo->mostrar_valores($id_sensor, $id_equipo,10);
?>
<table aling="center">
    <tr>
        <td>
            ID_SENSOR
        </td>
        <td>
            ID_EQUIPO
        </td>
        <td>
            FECHA
        </td>    
        <td>
            VALOR
        </td>
    </tr>
<?php 
while ($valores = $monitoreo->retornar_SELECT()){
?>   
    <tr>
        <td>
            <?php echo $valores["id_sensor"];?>
        </td>
        <td>
            <?php echo $valores["id_equipo"];?>
        </td>
        <td>
            <?php echo $valores["fecha"];?>
        </td>
        <td>
            <?php echo $valores["valor"];?>
        </td>
    </tr>    
    
<?php    
}    
?>

</table>
