function CargarCuadroGraficas () {
    $parametros = {
            'boton-llamar-cuadro-Graficas' : true,
        };
    $url = "monitoreo/cuadro.Graficas.php";
    $.ajax({
        type: "POST",
        url: $url,
        data: $parametros,
        success: function(data){
            $("#information").html(data);
        }
    });
}