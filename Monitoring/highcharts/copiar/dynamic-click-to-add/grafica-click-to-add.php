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
                                y = Math.random()*1+50;
                                //series = this.series[0];
                            series.addPoint([x, y],true,true);
                        }, 1000); // es la velocidad de creacion de un nuevo punto
                    }
                }
            },
            title: {
                text: 'Sistema de medidas'
            },
            subtitle: {
                text: 'Click the plot area to add a point. Click a point to remove it.'
            },
            xAxis: {
                type: 'datetime',
                gridLineWidth: 1,
                minPadding: 0,  // controla la posicion de inicio 
                maxPadding: 0,  // controla la posicion de fin
                maxZoom: 60,
                tickPixelInterval: 50
            },
            yAxis: {
                title: {
                    text: 'Valor'
                },
                minPadding: 0.2,
                maxPadding: 0.2,
                maxZoom: 60,
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            legend: {
                enabled: true
            },
            exporting: {
                enabled: false
            },
            plotOptions: {
                series: {
                    lineWidth: 1,
                    point: {
                        events: {
                            //'click': function() {
                            'click': function() {
                                if (this.series.data.length > 1) this.remove();
                            }
                        }
                    }
                }
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
                            y: Math.random()*1+50
                        });
                    }
                    return data;
                })()
            }]
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
