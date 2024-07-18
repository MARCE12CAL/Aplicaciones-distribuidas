<?php
require_once __DIR__ . '/../config/conexion.php';

class UsuariosModel extends Clase_Conectar {
    public function __construct() {
        parent::Procedimiento_Conectar();
    }

    public function registrarUsuario($nombreUsuario, $contrasena, $email) {
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
        $query = "INSERT INTO Usuarios (nombre_usuario, contrasena, email) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sss", $nombreUsuario, $contrasenaHash, $email);
        return $stmt->execute();
    }

    public function verificarUsuario($nombreUsuario, $contrasena) {
        $query = "SELECT usuario_id, nombre_usuario, contrasena FROM Usuarios WHERE nombre_usuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($fila = $resultado->fetch_assoc()) {
            if (password_verify($contrasena, $fila['contrasena'])) {
                return $fila;
            }
        }
        return false;
    }
}