<?php
require_once('../config/conexion.php');

class EventosModel {
    private $conexion;

    public function __construct() {
        $conectar = new Clase_Conectar();
        $this->conexion = $conectar->Procedimiento_Conectar();
    }

    public function listar_eventos() {
        $sql = "SELECT * FROM Eventos";
        $resultado = mysqli_query($this->conexion, $sql);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    public function insertar_evento($nombre, $fecha, $ubicacion, $descripcion) {
        $sql = "INSERT INTO Eventos (nombre, fecha, ubicacion, descripcion) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $nombre, $fecha, $ubicacion, $descripcion);
        return mysqli_stmt_execute($stmt);
    }

    public function obtener_evento($id) {
        $sql = "SELECT * FROM Eventos WHERE evento_id = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($resultado);
    }

    public function actualizar_evento($id, $nombre, $fecha, $ubicacion, $descripcion) {
        $sql = "UPDATE Eventos SET nombre = ?, fecha = ?, ubicacion = ?, descripcion = ? WHERE evento_id = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $fecha, $ubicacion, $descripcion, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function eliminar_evento($id) {
        $sql = "DELETE FROM Eventos WHERE evento_id = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}
?>