		<script type="text/javascript">
$(function () {
        $('#column-PH').highcharts({
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
		<div aling="center">
<div id="column-PH" style="width: 500px; height: 300px; margin: 0 0"></div>
        </div>