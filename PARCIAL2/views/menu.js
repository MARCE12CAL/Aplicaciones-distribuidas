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

    $('.nav-link').click(function(e) {
        e.preventDefault();
        var view = $(this).data('view');
        if (view) {
            loadContent(view);
        }
    });

    // Cargar eventos por defecto
    loadContent('eventos');
});