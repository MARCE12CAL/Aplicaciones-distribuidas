<?php
require_once __DIR__ . '/../config/conexion.php';

class ParticipantesModel extends Clase_Conectar {
    public function __construct() {
        parent::Procedimiento_Conectar();
    }

    public function obtenerParticipantes($pagina = 1, $porPagina = 10, $busqueda = '') {
        $inicio = ($pagina - 1) * $porPagina;
        $busqueda = '%' . $busqueda . '%';
        
        $query = "SELECT * FROM Participantes WHERE nombre LIKE ? OR apellido LIKE ? LIMIT ?, ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssii", $busqueda, $busqueda, $inicio, $porPagina);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function contarParticipantes($busqueda = '') {
        $busqueda = '%' . $busqueda . '%';
        
        $query = "SELECT COUNT(*) as total FROM Participantes WHERE nombre LIKE ? OR apellido LIKE ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ss", $busqueda, $busqueda);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    public function crearParticipante($nombre, $apellido, $email, $telefono) {
        $query = "INSERT INTO Participantes (nombre, apellido, email, telefono) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssss", $nombre, $apellido, $email, $telefono);
        return $stmt->execute();
    }

    public function obtenerParticipante($id) {
        $query = "SELECT * FROM Participantes WHERE participante_id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarParticipante($id, $nombre, $apellido, $email, $telefono) {
        $query = "UPDATE Participantes SET nombre = ?, apellido = ?, email = ?, telefono = ? WHERE participante_id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssssi", $nombre, $apellido, $email, $telefono, $id);
        return $stmt->execute();
    }

    public function eliminarParticipante($id) {
        $query = "DELETE FROM Participantes WHERE participante_id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}