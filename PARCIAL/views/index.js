$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        
        var nombreUsuario = $('#nombreUsuario').val();
        var contrasena = $('#contrasena').val();

        $.ajax({
            url: '../controllers/usuarios.controller.php',
            method: 'POST',
            data: {
                action: 'login',
                nombreUsuario: nombreUsuario,
                contrasena: contrasena
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = 'html/menu.php';
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