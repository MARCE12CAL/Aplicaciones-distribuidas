<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: html/menu.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Eventos Deportivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm">
            <div class="mb-3">
                <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="nombreUsuario" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        <p class="mt-3">¿No tienes una cuenta? <a href="html/registro.php">Regístrate</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="index.js"></script>
</body>
</html>