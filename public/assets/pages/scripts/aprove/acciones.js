function aprobar(id_user) {
    var nombre = "comentarios";
    nombre = nombre.concat(id_user);
    var comentarios = document.getElementById(nombre).value;
    var anio = 2021;
    var icomentario = "#comentarios"
    var iapro = "#apro";
    var irecha = "#recha";
    icomentario = icomentario.concat(id_user);
    iapro = iapro.concat(id_user);
    irecha = irecha.concat(id_user);

    $.ajax({
        type: 'post',
        url: 'aprove',
        data: { 'id_empleado': id_user, 'anio': anio, 'comentario': comentarios },

        success: function(data) {
            Swal.fire("Aprobado", "Los indicadores se aprobaron", "success");
            $(icomentario).attr('disabled', true);
            $(iapro).attr('disabled', true);
            $(irecha).attr('disabled', true);

        },
    });
}

function rechazar(id_user) {
    var nombre = "comentarios";
    nombre = nombre.concat(id_user);
    var comentarios = document.getElementById(nombre).value;
    var anio = 2021;

    $.ajax({
        type: 'post',
        url: 'refuse',
        data: { 'id_empleado': id_user, 'anio': anio, 'comentario': comentarios },

        success: function(data) {
            Swal.fire("Rechazado", "Los indicadores se rechazaron", "success");
            $(icomentario).attr('disabled', true);
            $(iapro).attr('disabled', true);
            $(irecha).attr('disabled', true);


        },
    });
}