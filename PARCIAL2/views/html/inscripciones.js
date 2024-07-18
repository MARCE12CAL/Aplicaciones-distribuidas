function editInscripcion(id) {
    $.ajax({
        url: '../../controllers/inscripciones.controller.php?action=obtener',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            var inscripcion = JSON.parse(response);
            $('#inscripcion_id').val(inscripcion.inscripcion_id);
            $('#participante_id').val(inscripcion.participante_id);
            $('#evento_id').val(inscripcion.evento_id);
            $('#inscripcionModal').modal('show');
        }
    });
}

function saveInscripcion() {
    var formData = $('#inscripcionForm').serialize();
    var action = $('#inscripcion_id').val() ? 'actualizar' : 'insertar';
    
    $.ajax({
        url: '../../controllers/inscripciones.controller.php?action=' + action,
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.trim() === 'success') {
                $('#inscripcionModal').modal('hide');
                location.reload();
            } else {
                alert('Error al guardar la inscripción');
            }
        }
    });
}

function deleteInscripcion(id) {
    if (confirm('¿Está seguro de que desea eliminar esta inscripción?')) {
        $.ajax({
            url: '../../controllers/inscripciones.controller.php?action=eliminar',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if (response.trim() === 'success') {
                    location.reload();
                } else {
                    alert('Error al eliminar la inscripción');
                }
            }
        });
    }
}

$(document).ready(function() {
    $('#createInscripcionModal').click(function() {
        $('#inscripcionForm')[0].reset();
        $('#inscripcion_id').val('');
        $('#inscripcionModal').modal('show');
    });
});