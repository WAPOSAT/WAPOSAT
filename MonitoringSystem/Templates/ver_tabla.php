<?php
require_once ("../require/monitoreo_class.php");

$id_equipo = 1;
$id_sensor = 1;

$monitoreo = new monitoreo();
$monitoreo->mostrar_valores($id_sensor, $id_equipo, 20);

?>

<html>
    <head>
        <title>..::TABLA DE DATOS::..</title>
<meta http-equiv="refresh" content="1">
        <script type="text/javascript" languaje="javascript" src="../JavaScript/ajax_refreshDivs_2.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Waposat</title>
	<link href="../Estilos/graficas.css" rel="stylesheet" type="text/css">
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
	<script language="javascript" type="text/javascript" src="../js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="../js/jquery.flot.js"></script>
        
        
        <script type="text/javascript" >
			window.onload = function startrefresh(){
                    //refreshDivs_2('tabla',1,'tabla.php','1', '1');
                    //refreshDivs_2('grafico',30,'grafico.php','1', '1');
			}
		</script>
    </head>
    <body>
        <div id="grafico" >
            <script type="text/javascript">

            $(function() {

                var data = [
                    <?php 
                    while ($valores = $monitoreo->retornar_SELECT()){
                    ?>   
                    [ <?php echo $valores["id_monitoreo"];?> , <?php echo $valores["valor"];?> ],
                    <?php    
                        }    
                    ?>
                        ];

                $.plot("#placeholder",[data]);

            });

            </script>
        </div>    
           
       
        
        <div id="content">
		<div class="demo-container">
			<div id="placeholder" class="demo-placeholder"></div>
		</div>
        </div>    
        <div id="tabla" >
        
        </div> 
        
        
    </body>
</html>