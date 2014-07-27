<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    
        //var chart;
        $('#container').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                margin: [70, 50, 60, 80], // margenes del cuadro de datos
                events: {
                    load: function() {
                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function() {
                            var x = (new Date()).getTime(), // current time
                                y = Math.random()*1+18;
                                //series = this.series[0];
    
                        // Add it
                                series.addPoint([x, y]);
                        }, 1000); // es la velocidad de creacion de un nuevo punto
                        
                    }
                }
            },
            title: {
                text: 'Sistema de Monitoreo en Tiempo Real'
            },
            subtitle: {
                text: 'Las graficas muestran los datos de temperatura que se estan midiendo en su punto deseado'
            },
            xAxis: {
                type: 'datetime',
                gridLineWidth: 1,
                minPadding: 0,  // controla la posicion de inicio 
                maxPadding: 0,  // controla la posicion de fin
                maxZoom: 60,
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Temperatura °C'
                },
                minPadding: 0.2,
                maxPadding: 0.2,
                maxZoom: 35,
                plotLines: [{
                    value: 0,
                    width: 5,
                    color: '#808080'
                }],
                min: 0,         // para establecer el valor minimo
                minorGridLineWidth: 0,
                gridLineWidth: 0,
                alternateGridColor: null, // para poder alternar el color en el eje Y
                plotBands: [
                    { // Moderate breeze
                    from: 5,
                    to: 12,
                    color: 'rgba(0, 0, 0, 0)',
                    label: {
                        text: 'Moderadamente frio',
                        style: {
                            color: '#606060'
                        }
                    }
                }, {
                    from: 12,
                    to: 25,
                    color: 'rgba(68, 170, 213, 0.2)',
                    label: {
                        text: 'Temperatura Normal',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Light breeze
                    from: 25,
                    to: 30,
                    color: 'rgba(200, 100, 0, 0.3)',
                    label: {
                        text: 'Zona de Precaucion',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Gentle breeze
                    from: 30,
                    to: 50,
                    color: 'rgba(180, 0, 0, 0.5)',
                    label: {
                        text: 'Zona de peligro',
                        style: {
                            color: '#606060'
                        }
                    }
                }]         
                           
            },
            legend: {
                enabled: true
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Temperatura',
                data: (function() {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;
    
                    for (i = -20; i <= 0; i++) {
                        data.push({
                            x: time + i * 1000,
                            y: Math.random()*1+18
                        });
                    }
                    return data;
                })()
            }        
                    ]
        });
    });
});    

		</script>
	</head>
	<body>
<script src="../../js/highcharts.js"></script>
<script src="../../js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; max-width: 700px; margin: 0 auto"></div>

	</body>
</html>
