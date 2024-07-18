$(document).ready(function() {
    $('#registroForm').on('submit', function(e) {
        e.preventDefault();
        
        var nombreUsuario = $('#nombreUsuario').val();
        var email = $('#email').val();
        var contrasena = $('#contrasena').val();

        $.ajax({
            url: '../../controllers/usuarios.controller.php',
            method: 'POST',
            data: {
                action: 'registrar',
                nombreUsuario: nombreUsuario,
                email: email,
                contrasena: contrasena
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.success);
                    window.location.href = 'index.php';
                } else {
                    alert(response.error);
                }
            },
            error: function() {
                alert('Error en la solicitud');
            }
        });
    });
});