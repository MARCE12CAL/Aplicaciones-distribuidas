<?php
require_once __DIR__ . '/../config/conexion.php';

class EventosModel extends Clase_Conectar {
    public function __construct() {
        parent::Procedimiento_Conectar();
    }

    public function obtenerEventos($pagina = 1, $porPagina = 10, $busqueda = '') {
        $inicio = ($pagina - 1) * $porPagina;
        $busqueda = '%' . $busqueda . '%';
        
        $query = "SELECT * FROM Eventos WHERE nombre LIKE ? OR ubicacion LIKE ? LIMIT ?, ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssii", $busqueda, $busqueda, $inicio, $porPagina);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function contarEventos($busqueda = '') {
        $busqueda = '%' . $busqueda . '%';
        
        $query = "SELECT COUNT(*) as total FROM Eventos WHERE nombre LIKE ? OR ubicacion LIKE ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ss", $busqueda, $busqueda);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    public function crearEvento($nombre, $fecha, $ubicacion, $descripcion) {
        $query = "INSERT INTO Eventos (nombre, fecha, ubicacion, descripcion) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssss", $nombre, $fecha, $ubicacion, $descripcion);
        return $stmt->execute();
    }

    public function obtenerEvento($id) {
        $query = "SELECT * FROM Eventos WHERE evento_id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarEvento($id, $nombre, $fecha, $ubicacion, $descripcion) {
        $query = "UPDATE Eventos SET nombre = ?, fecha = ?, ubicacion = ?, descripcion = ? WHERE evento_id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssssi", $nombre, $fecha, $ubicacion, $descripcion, $id);
        return $stmt->execute();
    }

    public function eliminarEvento($id) {
        $query = "DELETE FROM Eventos WHERE evento_id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}