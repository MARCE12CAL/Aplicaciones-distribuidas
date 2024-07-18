function editInscripcion(id) {
    $.ajax({
        url: '../../controllers/inscripciones.controller.php',
        type: 'GET',
        data: { action: 'show', id: id },
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
    var action = $('#inscripcion_id').val() ? 'update' : 'store';
    
    $.ajax({
        url: '../../controllers/inscripciones.controller.php',
        type: 'POST',
        data: formData + '&action=' + action,
        success: function(response) {
            $('#inscripcionModal').modal('hide');
            location.reload();
        }
    });
}

function deleteInscripcion(id) {
    if (confirm('¿Está seguro de que desea eliminar esta inscripción?')) {
        $.ajax({
            url: '../../controllers/inscripciones.controller.php',
            type: 'POST',
            data: { action: 'destroy', id: id },
            success: function(response) {
                location.reload();
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