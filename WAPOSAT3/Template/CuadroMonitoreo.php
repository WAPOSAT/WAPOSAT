<?php  include_once("../include/head.default.php");?>

<!-- Especific JS -->
    <script src="monitoreo/CuadroMonitoreo.js"></script>

<div class="col-md-6">
    
    <!-- Cabecera de Parametros del Cuadro -->
    <div class="col-md-12 col-xs-12" id="HeaderCuadro" >
        <ul class="nav nav-tabs" role="tablist" id="MyTab">
            <li role="presentation" class="active" id="MPH">
                <a href="#PH" aria-controls="PH" role="tab" data-toggle="tab">DO</a>
            </li>
            <li role="presentation" id="MPH">
                <a href="#PH" aria-controls="PH" role="tab" data-toggle="tab">Temperatura</a>
            </li>
            <li role="presentation" id="MPH">
                <a href="#PH" aria-controls="PH" role="tab" data-toggle="tab">Nivel</a>
            </li>
        </ul>
    </div>
    <!-- Fin de Cabecera -->
    
    <!-- Tablero de Configuracion del Cuadro -->
    <div class="col-md-12 col-xs-12" id="ConfiguracionCuadro" >
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" >
                  <img src="../img/logos/Gota_Waposat_117x147.png" alt="Brand" height="100%">
              </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li>
                    <p class="navbar-text" id="fecha-text">
                        Dia: 31-Abr 18h
                    </p>
                </li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">1hora<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">1hora</a></li>
                    <li><a href="#">5horas</a></li>
                    <li><a href="#">12horas</a></li>
                    <li class="divider"></li>
                    <li><a href="#">1Dia</a></li>
                    <li><a href="#">2Dia</a></li>
                    <li><a href="#">5Dia</a></li>
                    <li class="divider"></li>
                    <li><a href="#">1Semana</a></li>
                    <li><a href="#">2Semana</a></li>
                    <li><a href="#">4Semana</a></li>
                    <li class="divider"></li>  
                    <li><a href="#">Todo</a></li>  
                  </ul>
                </li>
                <li>
                    <p class="navbar-text" id="limites-text">
                        Limites: 0-14
                    </p>
                </li>
                <li>
                  <a href="#" class="dropdown-toggle" data-toggle="modal" role="button" data-target="#myModal"><i class="fa fa-cog"></i></a>
                </li>  
              </ul>      
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        
        <!-- Ventana de Configuracion -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Configuración de los Limites</h4>
              </div>
              <div class="modal-body">
                  <!-- Contenido Ventana -->
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Limite Sup.</span>
                    <input type="text" class="form-control" placeholder="14" aria-describedby="basic-addon1">
                    <span class="input-group-addon" id="basic-addon2">g/ml</span>  
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Limite Inf. </span>
                    <input type="text" class="form-control" placeholder="0" aria-describedby="basic-addon1">
                    <span class="input-group-addon" id="basic-addon2">g/ml</span>
                  </div>
                  <!-- Fin del Contenido Ventana -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
              </div>
            </div>
          </div>
        </div> <!-- Fin de la Ventana de Configuracion -->
        
    </div>
    <!-- Fin del Tablero de Configuracion -->
    
    <!-- Zona de Avisos del Cuadro -->
    <div class="col-md-12 col-xs-12" id="AvisosCuadro">
        
    </div>
    <!-- Fin de la Zona de Avisos -->
    
    <!-- Tablero de Informacion -->
    <div class="col-md-12 col-xs-12" id="InformacionCuadro" >
        
    </div>
    <!-- Fin Tablero de Informacion -->
    
    
    
</div>