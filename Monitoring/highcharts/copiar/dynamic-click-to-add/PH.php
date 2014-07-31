
		<script type="text/javascript">
$(function () {
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    
        //var chart;
        $('#contenedorPH').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                margin: [45, 10, 60, 80], // margenes del cuadro de datos
                events: {
                    load: function() {
                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function() {
                            var x = (new Date()).getTime(), // current time
                                hora1 = (new Date()).getHours(),
                                pi1 = 3.14159,
                                y = Math.random()*0.25+(-Math.cos((hora1)*pi1/12)*0.4)+7;
                                //y = Math.random()*0.5+7;
                                series.addPoint([x, y],true,true);                                
                        }, 300000); // es la velocidad de creacion de un nuevo punto
                        
                    }
                }
            },
            title: {
                text: 'PH en tiempo real'
            },
            /*subtitle: {
                text: 'Las graficas muestran los datos de temperatura que se estan midiendo en su punto deseado'
            },*/
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
                    text: 'PH'
                },
                minPadding: 0.2,
                maxPadding: 0.2,
                maxZoom: 2,
                /*plotLines: [{
                    value: 0,
                    width: 5,
                    color: '#808080'
                }],
                min: 0,         // para establecer el valor minimo
                max: 14,*/
                minorGridLineWidth: 0,
                gridLineWidth: 0,
                alternateGridColor: null, // para poder alternar el color en el eje Y
                plotBands: [
                    { // Moderate breeze
                    from: 0,
                    to: 3,
                    color: 'rgba(180, 0, 0, 0.5)',
                    label: {
                        text: 'Solucion basica',
                        style: {
                            color: '#606060'
                        }
                    }
                }, {
                    from: 3,
                    to: 6,
                    color: 'rgba(68, 170, 213, 0.2)',
                    label: {
                        text: 'Moderadamente basica',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Light breeze
                    from: 6,
                    to: 8,
                    color: 'rgba(255, 0, 0, 0)',
                    label: {
                        text: 'Solucion neutral',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Gentle breeze
                    from: 8,
                    to: 11,
                    color: 'rgba(68, 170, 213, 0.2)',
                    label: {
                        text: 'Moderadamente acida',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Gentle breeze
                    from: 11,
                    to: 14,
                    color: 'rgba(180, 0, 0, 0.5)',
                    label: {
                        text: 'Solucion acida',
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
                name: 'Ph',
                data: (function() {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        hora = (new Date()).getHours(),
                        pi = 3.14159,
                        i;
    
                    for (i = -144; i <= 0; i++) {    //para que paresca muestra de un dia, utilizar i= -288
                        data.push({
                            x: time + i * 300000,
                            y: Math.random()*0.25+(-Math.cos((hora+(i*24/288))*pi/12)*0.4)+7
                            //y: -Math.cos((hora+(i*24/288))*pi/12)*2
                        });
                    }
                    return data;
                })()
            }]
        });
    });
});    

		</script>

<div align="center" >
<div id="contenedorPH" style="height: 300px; width: 700px "></div>
</div>
