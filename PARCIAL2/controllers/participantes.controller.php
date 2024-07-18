<?php
require_once(__DIR__ . '/../models/participantes.model.php');
require_once('../config/conexion.php');
class ParticipantesController {
    private $modelo;

    public function __construct() {
        $this->modelo = new ParticipantesModel();
    }

    public function listar() {
        return $this->modelo->listar_participantes();
    }

    public function insertar($nombre, $apellido, $email, $telefono) {
        return $this->modelo->insertar_participante($nombre, $apellido, $email, $telefono);
    }

    public function obtener($id) {
        return $this->modelo->obtener_participante($id);
    }

    public function actualizar($id, $nombre, $apellido, $email, $telefono) {
        return $this->modelo->actualizar_participante($id, $nombre, $apellido, $email, $telefono);
    }

    public function eliminar($id) {
        return $this->modelo->eliminar_participante($id);
    }
}
?>