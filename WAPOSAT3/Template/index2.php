<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de monitoreo en tiempo real">
    <meta name="author" content="WAPOSAT">

    <title>WAPOSAT</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    
    <!-- Navigation -->
    <?php include("navigation.php"); ?>

    <!-- Header -->
    <header id="top" class="header page-header">
        <div class="text-vertical-center">
            <h1>WAPOSAT</h1>
            <h3>Innovaci&oacute;n para el cambio.</h3>
            <br>
            <a href="#about" class="btn btn-dark btn-lg">Descubre m&aacute;s</a>
        </div>
    </header>

    <!-- About -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Informaci&oacute;n oportuna para una mejor toma de decisiones</h2>
                    <p class="lead">Revisa nuestra plataforma de prueba <a target="_blank" href="mapas.php">Estacion CITRAR-UNI</a>.</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Services -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-cogs fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>La tecnolog&iacute;a en tus manos</strong>
                                </h4>
                                <p></p>
                                
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-bar-chart fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Informaci&oacute;n en tiempo real</strong>
                                </h4>
                                <p></p>
                                
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-newspaper-o fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Informes de acuerdo a tus necesidades</strong>
                                </h4>
                                <p></p>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Callout -->
    <aside class="callout">
        <div class="text-vertical-center">
            <h1>Nuestro sistema autom&aacute;tico</h1>
        </div>
    </aside>

    <!-- Mision y Vision -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Misi&oacute;n</h2>
                    <p class="lead">Innovar, desarrollar y brindar productos y servicios tecnologicos de informacion en tiempo real de las condiciones reales del agua.</p>
                    <h2>Visi&oacute;n</h2>
                    <p class="lead">Ser una empresa tecnol&oacute;gica lider en el control y la mitigaci&oacute;n de la contaminaci&oacute;n del agua.</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    
    <!-- Acerca de Nosotros -->
    <section id="AcercaDe" class="about bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Acerca de Nosotros</h2>
                    <p class="lead">Waposat es una empresa que innova y desarrolla productos tecnol&oacute;gicos para el monitoreo del agua.<br>Mediante los productos y servicios que brindamos tenemos como objetivo de que todas las instituciones, empresas y personas puedan acceder, de manera sencilla, al uso de la tecnolog&iacute;a para que puedan tener un mejor control y uso del agua en todas las actividades que realizan.</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    
    <!-- Footer -->
    <?php include("footer.php") ?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

</body>

</html>
