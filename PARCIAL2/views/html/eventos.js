$(document).ready(function() {
    // Abrir modal para agregar evento
    $('#btnAgregarEvento').click(function() {
        $('#eventoModal').modal('show');
        $('#eventoForm')[0].reset();
        $('#eventoModalLabel').text('Agregar Evento');
        $('#evento_id').val('');
    });

    // Guardar evento (agregar o actualizar)
    $('#guardarEvento').click(function() {
        var formData = $('#eventoForm').serialize();
        var eventoId = $('#evento_id').val();
        var url = eventoId ? '../../controllers/eventos.controller.php?action=actualizar' : '../../controllers/eventos.controller.php?action=insertar';

        // Convertir fecha de DD/MM/YYYY a YYYY-MM-DD
        var fecha = $('#fecha').val().split('/');
        var fechaFormateada = fecha[2] + '-' + fecha[1] + '-' + fecha[0];
        formData = formData.replace('fecha=' + $('#fecha').val(), 'fecha=' + fechaFormateada);

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.trim() === 'success') {
                    $('#eventoModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error al guardar el evento');
                }
            },
            error: function() {
                alert('Error en la solicitud AJAX');
            }
        });
    });

    // Abrir modal para editar evento
    $('.editar-evento').click(function() {
        var eventoId = $(this).data('id');
        $.ajax({
            url: '../../controllers/eventos.controller.php?action=obtener',
            type: 'GET',
            data: { id: eventoId },
            dataType: 'json',
            success: function(data) {
                $('#evento_id').val(data.evento_id);
                $('#nombre').val(data.nombre);
                // Convertir fecha de YYYY-MM-DD a DD/MM/YYYY
                var fecha = new Date(data.fecha);
                var dia = ("0" + fecha.getDate()).slice(-2);
                var mes = ("0" + (fecha.getMonth() + 1)).slice(-2);
                $('#fecha').val(dia + '/' + mes + '/' + fecha.getFullYear());
                $('#ubicacion').val(data.ubicacion);
                $('#descripcion').val(data.descripcion);
                $('#eventoModalLabel').text('Editar Evento');
                $('#eventoModal').modal('show');
            }
        });
    });

    // Eliminar evento
    $('.eliminar-evento').click(function() {
        if (confirm('¿Está seguro de que desea eliminar este evento?')) {
            var eventoId = $(this).data('id');
            $.ajax({
                url: '../../controllers/eventos.controller.php?action=eliminar',
                type: 'POST',
                data: { id: eventoId },
                success: function(response) {
                    if (response.trim() === 'success') {
                        location.reload();
                    } else {
                        alert('Error al eliminar el evento');
                    }
                },
                error: function() {
                    alert('Error en la solicitud AJAX');
                }
            });
        }
    });

    // Validación de fecha
    $('#fecha').on('input', function() {
        var input = $(this).val();
        if(input.length === 2 || input.length === 5) {
            $(this).val(input + '/');
        }
    });
});