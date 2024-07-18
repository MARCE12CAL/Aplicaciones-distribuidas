<?php
session_start();
require_once('../models/usuarios.model.php');

$usuario = new Clase_Usuarios();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar solicitud para obtener usuarios
    $usuariosDisponibles = $usuario->obtenerUsuarios();

    $response = [
        'status' => 'success',
        'data' => $usuariosDisponibles
    ];

    echo json_encode($response);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $correo_electronico = $_POST['correo_electronico'];
        $contrasena = $_POST['contrasena'];
        $resultado = $usuario->login($correo_electronico, $contrasena);
        if ($resultado) {
            $_SESSION['usuario'] = $resultado;
            header('Location: ../views/dashboard.php');
            exit();
        } else {
            header('Location: ../index.php?error=1');
            exit();
        }
    } elseif (isset($_POST['registrar'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo_electronico = $_POST['correo_electronico'];
        $contrasena = $_POST['contrasena'];
        $resultado = $usuario->registrar($nombre, $apellido, $correo_electronico, $contrasena);
        if ($resultado) {
            header('Location: ../index.php?registro=1');
            exit();
        } else {
            header('Location: ../index.php?error=2');
            exit();
        }
    }
}
?>
