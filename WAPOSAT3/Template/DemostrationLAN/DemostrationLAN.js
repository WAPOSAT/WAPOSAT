function CargarCuadroGraficas () {
    $parametros = {
            'boton-llamar-cuadro-Graficas' : true,
        };
    $url = "DemostrationLAN/cuadro.Graficas.php";
    $.ajax({
        type: "POST",
        url: $url,
        data: $parametros,
        success: function(data){
            $("#information").html(data);
        }
    });
}