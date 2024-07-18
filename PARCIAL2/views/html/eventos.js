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

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response === 'success') {
                    $('#eventoModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error al guardar el evento');
                }
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
                $('#fecha').val(data.fecha);
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
                    if (response === 'success') {
                        location.reload();
                    } else {
                        alert('Error al eliminar el evento');
                    }
                }
            });
        }
    });
});