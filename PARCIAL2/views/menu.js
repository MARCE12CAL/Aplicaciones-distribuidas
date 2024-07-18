$(document).ready(function() {
    function loadContent(view) {
        $.ajax({
            url: '../html/' + view + '.php',
            method: 'GET',
            success: function(response) {
                $('#content').html(response);
            },
            error: function() {
                $('#content').html('<p>Error al cargar el contenido.</p>');
            }
        });
    }

    $('#eventosLink').click(function(e) {
        e.preventDefault();
        loadContent('eventos');
    });

    $('#participantesLink').click(function(e) {
        e.preventDefault();
        loadContent('participantes');
    });

    $('#inscripcionesLink').click(function(e) {
        e.preventDefault();
        loadContent('inscripciones');
    });

    // Cargar eventos por defecto
    loadContent('eventos');
});