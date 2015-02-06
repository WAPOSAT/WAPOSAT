<?php
$id_equipo = 1;
$id_parametro = 
?>

<script>
var EstPH = 0,
    EstTemp = 0;

var ArrayDataTime = [[]],
    labelDataTime = [],
    DatasetDataTime = [],
    longDataTime = 0;

var ArrayNewDataTime = [[]],
    NewData = 0;

function GetDataTime (id_equipo, id_parametro){
    $parametros = {
            'boton-obtener-data-tiempo' : true,
            'id_equipo' : id_equipo,
            'id_parametro' : id_parametro,
        };
    $url = "monitoreo/chart.DataTime.php";
    $.ajax({
        type: "POST",
        url: $url,
        data: $parametros,
        success: function(data){
            ArrayDataTime = data;
            labelDataTime = ArrayDataTime[0];
            DatasetDataTime = ArrayDataTime[1];
            longDataTime = labelDataTime.length;
        }
    });
}
    
function GetNewDataTime (id_equipo, id_parametro){
    $parametros = {
        'boton-obtener-new-data-time' : true,
        'id_equipo' : id_equipo,
        'id_parametros' : id_parametro;
    };
    $url = "monitoreo/chart.NewDataTime.php";
    $.ajax({
        type: "POST",
        url: $url,
        success: function(data){
            ArrayNewDataTime = data;
            NewData =1;
        }
    });
}

function CargarData (id_equipo, id_parametro, superior, inferior, tiempoAntes, Periodo) {
    var Lim_sup = superior,
        Lim_inf = inferior,
        TimeBefore = tiempoAntes,     //horas
        Tmuestreo = Periodo,   //segundos
        PuntoMedio = MPoint;
    GetNewDataTime (id_equipo, id_parametro);
    var data = {
        labels: labelDataTime,
        datasets: [
            {
                label: "Parametro",
                fillColor : "rgba(220,220,0,0)",       //Fondo
                strokeColor : "rgba(220,220,0,1)",     //Linea
                pointColor : "rgba(220,220,0,1)",      //Punto
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(220,220,220,1)",
                data: DatasetDataTime
            },
            {
                label: "Limite Superior",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,0)",
                pointColor: "rgba(151,187,205,0)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: (function() {
                        // generate an array of random data
                        var data = [],
                            i;
                        for (i = 0; i < longDataTime; i++) {
                            data.push(
                                Lim_sup
                            );
                        }
                        return data;
                    })()
            },
            {
                label: "Limite Inferior",
                fillColor: "rgba(151,187,205,0)",
                strokeColor: "rgba(151,187,205,0)",
                pointColor: "rgba(151,187,205,0)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: (function() {
                        // generate an array of random data
                        var data = [],
                            i;
                        for (i = 0; i < longDataTime; i++) {
                            data.push(
                                Lim_inf
                            );
                        }
                        return data;
                    })()
            }
        ]
    };
    
    ArrayDataTime = [[]];
    labelDataTime = [];
    DatasetDataTime = [];
    longDataTime = 0;
    
    return data;
}


function animar_grafica (Linea, id_equipo, id_parametro, Lim_sup, Lim_inf, frecuencia ,parametro){
    if (parametro == 1 && EstPH == 0 ){
        EstPH = 1;
        EstTemp = 0;
        nuevo_dato (Linea, id_equipo, id_parametro, Lim_sup, Lim_inf, frecuencia ,parametro);
    }
    
    if (parametro == 2 && EstTemp == 0){
        EstPH = 0;
        EstTemp = 1;
        nuevo_dato (Linea, id_equipo, id_parametro, Lim_sup, Lim_inf, frecuencia ,parametro);
    }
}


function nuevo_dato (Linea, id_equipo, id_parametro, Lim_sup, Lim_inf, frecuencia ,parametro){

    if (parametro == 1){
        if (EstPH == 0) {bucle = 0;}
    }
    
    if (parametro == 2){
        if (EstTemp == 0) {bucle = 0;}
    }
    if (bucle == 1){
        Linea.addData([ y, Lim_sup, Lim_inf] ,time);
        Linea.removeData();
        setTimeout(function(){
            nuevo_dato (Linea, MPoint, Lim_sup, Lim_inf, frecuencia ,parametro);
        }, frecuencia);
    }
}    
</script>