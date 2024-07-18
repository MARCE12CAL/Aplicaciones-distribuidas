$(document).ready(function() {
    // Abrir modal para agregar participante
    $('#btnAgregarParticipante').click(function() {
        $('#participanteModal').modal('show');
        $('#participanteForm')[0].reset();
        $('#participanteModalLabel').text('Agregar Participante');
        $('#participante_id').val('');
    });

    // Guardar participante (agregar o actualizar)
    $('#guardarParticipante').click(function() {
        var formData = $('#participanteForm').serialize();
        var participanteId = $('#participante_id').val();
        var url = participanteId ? '../../controllers/participantes.controller.php?action=actualizar' : '../../controllers/participantes.controller.php?action=insertar';

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.trim() === 'success') {
                    $('#participanteModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error al guardar el participante');
                }
            },
            error: function() {
                alert('Error en la solicitud AJAX');
            }
        });
    });

    // Abrir modal para editar participante
    $('.editar-participante').click(function() {
        var participanteId = $(this).data('id');
        $.ajax({
            url: '../../controllers/participantes.controller.php?action=obtener',
            type: 'GET',
            data: { id: participanteId },
            dataType: 'json',
            success: function(data) {
                $('#participante_id').val(data.participante_id);
                $('#nombre').val(data.nombre);
                $('#apellido').val(data.apellido);
                $('#email').val(data.email);
                $('#telefono').val(data.telefono);
                $('#participanteModalLabel').text('Editar Participante');
                $('#participanteModal').modal('show');
            },
            error: function() {
                alert('Error al obtener los datos del participante');
            }
        });
    });

    // Eliminar participante
    $('.eliminar-participante').click(function() {
        if (confirm('¿Está seguro de que desea eliminar este participante?')) {
            var participanteId = $(this).data('id');
            $.ajax({
                url: '../../controllers/participantes.controller.php?action=eliminar',
                type: 'POST',
                data: { id: participanteId },
                success: function(response) {
                    if (response.trim() === 'success') {
                        location.reload();
                    } else {
                        alert('Error al eliminar el participante');
                    }
                },
                error: function() {
                    alert('Error en la solicitud AJAX');
                }
            });
        }
    });
});