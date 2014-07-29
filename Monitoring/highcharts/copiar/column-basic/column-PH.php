		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="../../js/highcharts.js"></script>
        <script src="../../js/modules/exporting.js"></script>

		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Media del PH Mensual'
            },
            /*subtitle: {
                text: 'Source: WorldClimate.com'
            },*/
            xAxis: {
                categories: [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago'
                ]
            },
            yAxis: {
                min: 0,
                max: 14,
                title: {
                    text: 'Valor del PH'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'PH',
                data: [7.3, 7.5, 7.9, 7.9, 7.5, 7.6, 7.1, 7.3]
    
            }]
        });
    });
    

		</script>
<div id="container" style="width: 500px; height: 300px; margin: 0 auto"></div>
