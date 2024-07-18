<?php
require_once(__DIR__ . '/../config/conexion.php');

class ParticipantesModel {
    private $conexion;

    public function __construct() {
        $conectar = new Clase_Conectar();
        $this->conexion = $conectar->Procedimiento_Conectar();
    }

    public function listar_participantes() {
        $sql = "SELECT * FROM Participantes";
        $resultado = mysqli_query($this->conexion, $sql);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    public function insertar_participante($nombre, $apellido, $email, $telefono) {
        $sql = "INSERT INTO Participantes (nombre, apellido, email, telefono) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido, $email, $telefono);
        return mysqli_stmt_execute($stmt);
    }

    public function obtener_participante($id) {
        $sql = "SELECT * FROM Participantes WHERE participante_id = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($resultado);
    }

    public function actualizar_participante($id, $nombre, $apellido, $email, $telefono) {
        $sql = "UPDATE Participantes SET nombre = ?, apellido = ?, email = ?, telefono = ? WHERE participante_id = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $email, $telefono, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function eliminar_participante($id) {
        $sql = "DELETE FROM Participantes WHERE participante_id = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}
?>