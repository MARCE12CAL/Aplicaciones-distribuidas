<?php
require_once(__DIR__ . '/../models/inscripciones.model.php');
require_once('../config/conexion.php');
class InscripcionesController {
    private $modelo;

    public function __construct() {
        $this->modelo = new InscripcionesModel();
    }

    public function listar() {
        return $this->modelo->listar_inscripciones();
    }

    public function insertar($participante_id, $evento_id) {
        return $this->modelo->insertar_inscripcion($participante_id, $evento_id);
    }

    public function obtener($id) {
        return $this->modelo->obtener_inscripcion($id);
    }

    public function actualizar($id, $participante_id, $evento_id) {
        return $this->modelo->actualizar_inscripcion($id, $participante_id, $evento_id);
    }

    public function eliminar($id) {
        return $this->modelo->eliminar_inscripcion($id);
    }
}
?>