function agregar() {
    var ponderacion = document.getElementById("ponderacion").value;

    if (ponderacion < 100) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La suma de los indicadores es menor al 100%',
        })
    } else if (ponderacion > 100) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La suma de los indicadores es mayor al 100%',
        })
    } else if (ponderacion == 100) {
        var id_empleado = document.getElementById("id_empleado").value;
        var anio = document.getElementById("anio").value;

        $.ajax({
            type: 'post',
            url: 'indicator/guardar',
            data: { 'id_empleado': id_empleado, 'anio': anio },

            success: function(data) {
                Swal.fire("Enviado", "Los indicadores se enviaron con exito", "success");
                $('#crear').attr('disabled', true);
                $('#enviar').attr('disabled', true);

            },
        });
    }
}

function calificar() {

    var id_empleado = document.getElementById("id_empleado").value;
    var anio = document.getElementById("anio").value;

    $.ajax({
        type: 'post',
        url: 'indicator/calificar',
        data: { 'id_empleado': id_empleado, 'anio': anio },

        success: function(data) {
            Swal.fire("Enviado", "Los indicadores se enviaron con exito", "success");
            $('#crear').attr('disabled', true);
            $('#enviar').attr('disabled', true);
            $('#calificar').attr('disabled', true);

        },
    });
}