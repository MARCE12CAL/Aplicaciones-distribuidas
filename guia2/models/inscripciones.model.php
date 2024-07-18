<?php
require_once __DIR__ . '/../config/conexion.php';

class InscripcionesModel extends Clase_Conectar {
    public function __construct() {
        parent::Procedimiento_Conectar();
    }

    public function obtenerInscripciones($pagina = 1, $porPagina = 10, $busqueda = '') {
        $inicio = ($pagina - 1) * $porPagina;
        $busqueda = '%' . $busqueda . '%';
        
        $query = "SELECT i.inscripcion_id, e.nombre AS evento_nombre, p.nombre AS participante_nombre, p.apellido AS participante_apellido, i.fecha_inscripcion 
                  FROM Inscripciones i 
                  JOIN Eventos e ON i.evento_id = e.evento_id 
                  JOIN Participantes p ON i.participante_id = p.participante_id 
                  WHERE e.nombre LIKE ? OR p.nombre LIKE ? OR p.apellido LIKE ? 
                  LIMIT ?, ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sssii", $busqueda, $busqueda, $busqueda, $inicio, $porPagina);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function contarInscripciones($busqueda = '') {
        $busqueda = '%' . $busqueda . '%';
        
        $query = "SELECT COUNT(*) as total 
                  FROM Inscripciones i 
                  JOIN Eventos e ON i.evento_id = e.evento_id 
                  JOIN Participantes p ON i.participante_id = p.participante_id 
                  WHERE e.nombre LIKE ? OR p.nombre LIKE ? OR p.apellido LIKE ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sss", $busqueda, $busqueda, $busqueda);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    public function crearInscripcion($evento_id, $participante_id, $fecha_inscripcion) {
        $query = "INSERT INTO Inscripciones (evento_id, participante_id, fecha_inscripcion) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("iis", $evento_id, $participante_id, $fecha_inscripcion);
        return $stmt->execute();
    }

    public function obtenerInscripcion($id) {
        $query = "SELECT i.*, e.nombre AS evento_nombre, p.nombre AS participante_nombre, p.apellido AS participante_apellido 
                  FROM Inscripciones i 
                  JOIN Eventos e ON i.evento_id = e.evento_id 
                  JOIN Participantes p ON i.participante_id = p.participante_id 
                  WHERE i.inscripcion_id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarInscripcion($id, $evento_id, $participante_id, $fecha_inscripcion) {
        $query = "UPDATE Inscripciones SET evento_id = ?, participante_id = ?, fecha_inscripcion = ? WHERE inscripcion_id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("iisi", $evento_id, $participante_id, $fecha_inscripcion, $id);
        return $stmt->execute();
    }

    public function eliminarInscripcion($id) {
        $query = "DELETE FROM Inscripciones WHERE inscripcion_id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}