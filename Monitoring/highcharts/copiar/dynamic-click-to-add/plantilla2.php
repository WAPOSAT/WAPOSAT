

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" lang="es-es" dir="ltr" >
<head>
	  <base href="http://waposat.tk/" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="DONNY" />
  <meta name="generator" content="Joomla! - Open Source Content Management" />
  <title>INICIO</title>
  <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
  
  
  

  
  
  <script src="/media/system/js/mootools-core.js" type="text/javascript"></script>
  <script src="/media/system/js/core.js" type="text/javascript"></script>
  <script src="/media/system/js/caption.js" type="text/javascript"></script>
  <script src="/modules/mod_imgscrawler/crawler.js" type="text/javascript"></script>
  
  
  
  
    
  
  
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://arduinobarato.com/WAPOSAT/Monitoring/highcharts/js/highcharts.js"></script>
        <script src="http://arduinobarato.com/WAPOSAT/Monitoring/highcharts/js/modules/exporting.js"></script> 		

		<script type="text/javascript">
$(function () {
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    
        //var chart;
        $('#contenedorTemperatura').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                margin: [45, 10, 60, 50], // margenes del cuadro de datos
                events: {
                    load: function() {
                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function() {
                            var x = (new Date()).getTime(), // current time
                                y = Math.random()*1+18;
                                series.addPoint([x, y],true,true);                                
                        }, 15000); // es la velocidad de creacion de un nuevo punto
                        
                    }
                }
            },
            title: {
                text: 'Temperatura en Tiempo Real'
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
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Temperatura (Celsius)'
                },
                minPadding: 0.2,
                maxPadding: 0.2,
                maxZoom: 30,
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
    
                    for (i = -300; i <= 0; i++) {
                        data.push({
                            x: time + i * 15000,
                            y: Math.random()*1+18
                        });
                    }
                    return data;
                })()
            }]
        });
    });
});    

		</script>
		
		
		
		
		
		
		
  
  
  
  <script type="text/javascript">
window.addEvent('load', function() {
				new JCaption('img.caption');
			});
window.addEvent('load', function() {
				new JCaption('img.caption');
			});

window.addEventListener('load', function () {
    marqueeInit({
        uniqueid: 'myimgscrawler-1',
        style: {
            'width':'100%','height':'100px'
        },
        inc: 1,
        mouse: 'pause',
        direction: 'left',
        moveatleast: 1,
        neutral: 50,
        savedirection: true
    });
},false);

function keepAlive() {	var myAjax = new Request({method: "get", url: "index.php"}).send();} window.addEvent("domready", function(){ keepAlive.periodical(3600000); });
  </script>

    <link rel="stylesheet" href="/templates/system/css/system.css" type="text/css" />
    <link rel="stylesheet" href="/templates/system/css/general.css" type="text/css" />
    			<link rel="stylesheet" href="/templates/donnylester/css/default.css" type="text/css" />
		<link rel="stylesheet" href="/templates/donnylester/css/template.css" type="text/css" />
		<link rel="stylesheet" href="/templates/donnylester/css/fonts/fonts.css" type="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="/templates/donnylester/css/mobile.css" type="text/css" />
	    <!--[if lte IE 8]>
  	<style type="text/css">
  	#nav > div.inner,#left > div.inner .module h3,#left > div.inner .moduletable h3,#left > div.inner .module_menu h3,#left > div.inner .moduletable_menu h3 { behavior: url(/templates/donnylester/pie.htc) }
  	</style>
  	<![endif]-->



</head>
<body>
<div id="wrapper">
	<div class="container-fluid inner">
	<div id="banner">
		<div class="inner clearfix">
			<div id="bannerlogo" class="logobloc">
				<div class="inner clearfix">
										<a href="/index.php">
											<img src="/templates/donnylester/images/waposat 534x210.png" width="454px" height="179px" alt="" />
										</a>
															<div class="bannerlogodesc">
						<div class="inner clearfix">Información oportuna para el cuidado de lo esencial, el agua</div>
					</div>
									</div>
			</div>
								</div>
	</div>
		<div id="nav">
		<div class="inner clearfix">
			
<ul class="menu">
<li class="item-101 current active"><a href="/" >INICIO</a></li><li class="item-102"><a href="/index.php/mision" >MISIÓN</a></li><li class="item-103"><a href="/index.php/vision" >VISIÓN</a></li><li class="item-104"><a href="/index.php/acerca-de-nosotros" >ACERCA DE NOSOTROS</a></li><li class="item-105"><a href="/index.php/producto" >PRODUCTO</a></li><li class="item-105"><a href="/index.php/muestra" >MUESTRA</a></li></ul>

		</div>
	</div>
	
	
	<div id="maincontent" class="maincontent noright">
		<div class="inner clearfix">
					<div id="left" class="column column1">
				<div class="inner clearfix">
							<div class="moduletable">
					<h3>AUTENTIFICACIÓN</h3>
					<form action="/index.php" method="post" id="login-form" >
		<fieldset class="userdata">
	<p id="form-login-username">
		<label for="modlgn-username">Usuario</label>
		<input id="modlgn-username" type="text" name="username" class="inputbox"  size="18" />
	</p>
	<p id="form-login-password">
		<label for="modlgn-passwd">Clave</label>
		<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18"  />
	</p>
		<p id="form-login-remember">
		<label for="modlgn-remember">Recuérdeme</label>
		<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
	</p>
		<input type="submit" name="Submit" class="button" value="Identificarse" />
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="aW5kZXgucGhwP0l0ZW1pZD0xMDE=" />
	<input type="hidden" name="90c86bf38457332018326db77ed00860" value="1" />	</fieldset>
	<ul>
		<li>
			<a href="/index.php/component/users/?view=reset">
			¿Recordar contraseña?</a>
		</li>
		<li>
			<a href="/index.php/component/users/?view=remind">
			¿Recordar usuario?</a>
		</li>
				<li>
			<a href="/index.php/component/users/?view=registration">
				Crear una cuenta</a>
		</li>
			</ul>
	</form>
		</div>
			<div class="moduletable">
					<h3>MENU</h3>
					
<ul class="menu">
<li class="item-101 current active"><a href="/" >INICIO</a></li><li class="item-102"><a href="/index.php/mision" >MISIÓN</a></li><li class="item-103"><a href="/index.php/vision" >VISIÓN</a></li><li class="item-104"><a href="/index.php/acerca-de-nosotros" >ACERCA DE NOSOTROS</a></li><li class="item-105"><a href="/index.php/producto" >PRODUCTO</a></li></ul>
		</div>
	
				</div>
			</div>
						<div id="main" class="column main row-fluid">
				<div class="inner clearfix">
							<div id="center" class="column center ">
								<div class="inner">
											
<div id="system-message-container">
</div>
											<div class="item-page">
	<h1>
	MUESTRAS	</h1>
	
<div id="cuadroTemperatura">
<?php
    include_once("Temperatura.php");
    include_once("column-Temperatura.php");
    ?>                 
</div>

<div id="cuadroPH">
<?php
    include_once("PH.php");
    include_once("column-PH.php");
    ?>                 
</div>

	
</div>

								</div>
							</div>
							
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
		<div id="modulesbottom">
		<div class="inner clearfix n1">
									<div id="modulesbottommod2" class="flexiblemodule ">
				<div class="inner clearfix">
							<div class="moduletable">
					
<div class="ic_marquee" id="myimgscrawler-1">
	<a href="http://www.essalud.gob.pe/" target="_blank"><img src="/images/logosempresas/1.png" alt="1.png" style="vertical-align:top;margin-right:3px" /></a><a href="http://www.indecopi.gob.pe/" target="_blank"><img src="/images/logosempresas/2.png" alt="2.png" style="vertical-align:top;margin-right:3px" /></a><a href="http://www.inei.gob.pe/" target="_blank"><img src="/images/logosempresas/3.png" alt="3.png" style="vertical-align:top;margin-right:3px" /></a><a href="http://www.senamhi.gob.pe/" target="_blank"><img src="/images/logosempresas/4.png" alt="4.png" style="vertical-align:top;margin-right:3px" /></a><a href="http://www.osinergmin.gob.pe/newweb/pages/Publico/1.htm?7863" target="_blank"><img src="/images/logosempresas/5.png" alt="5.png" style="vertical-align:top;margin-right:3px" /></a><a href="http://www.sunat.gob.pe/" target="_blank"><img src="/images/logosempresas/6.png" alt="6.png" style="vertical-align:top;margin-right:3px" /></a><img src="/images/logosempresas/7.png" alt="7.png" style="vertical-align:top;margin-right:3px" /></div>
		</div>
	
				</div>
			</div>
															<div class="clr"></div>
		</div>
	</div>
	
		<div id="footer">
		<div class="inner clearfix">
					<div class="moduletable">
					

<div class="custom"  >
	<h5 style="text-align: right; text-color: #ffffff;"><strong>© WEBSITE BASADA EN SOFTWARE LIBRE, </strong><strong style="line-height: 1.3em;">DISEÑADA POR DONNY LESTER PARA ™WAPOSAT</strong></h5></div>
		</div>
	
		</div>
	</div>
	

    </div>
</div>

</body>
</html>