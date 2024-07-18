<?php
require_once('../config/conexion.php');

class InscripcionesModel {
    private $conexion;

    public function __construct() {
        $conectar = new Clase_Conectar();
        $this->conexion = $conectar->Procedimiento_Conectar();
    }

    public function listar_inscripciones() {
        $sql = "SELECT i.*, p.nombre AS nombre_participante, e.nombre AS nombre_evento 
                FROM Inscripciones i 
                JOIN Participantes p ON i.participante_id = p.participante_id 
                JOIN Eventos e ON i.evento_id = e.evento_id";
        $resultado = mysqli_query($this->conexion, $sql);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    public function insertar_inscripcion($participante_id, $evento_id) {
        $sql = "INSERT INTO Inscripciones (participante_id, evento_id) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $participante_id, $evento_id);
        return mysqli_stmt_execute($stmt);
    }

    public function obtener_inscripcion($id) {
        $sql = "SELECT * FROM Inscripciones WHERE inscripcion_id = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($resultado);
    }

    public function actualizar_inscripcion($id, $participante_id, $evento_id) {
        $sql = "UPDATE Inscripciones SET participante_id = ?, evento_id = ? WHERE inscripcion_id = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "iii", $participante_id, $evento_id, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function eliminar_inscripcion($id) {
        $sql = "DELETE FROM Inscripciones WHERE inscripcion_id = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}
?>