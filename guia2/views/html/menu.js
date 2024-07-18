$(document).ready(function() {
    $('#logout').on('click', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '../../controllers/usuarios.controller.php',
            method: 'POST',
            data: {
                action: 'logout'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = '../index.php';
                } else {
                    alert('Error al cerrar sesión');
                }
            },
            error: function() {
                alert('Error en la solicitud');
            }
        });
    });
});