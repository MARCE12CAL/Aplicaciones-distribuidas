<?php
require_once(__DIR__ . '/../models/eventos.model.php');
require_once('../config/conexion.php');

class EventosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new EventosModel();
    }

    public function listar() {
        return $this->modelo->listar_eventos();
    }

    public function insertar($nombre, $fecha, $ubicacion, $descripcion) {
        return $this->modelo->insertar_evento($nombre, $fecha, $ubicacion, $descripcion);
    }

    public function obtener($id) {
        return $this->modelo->obtener_evento($id);
    }

    public function actualizar($id, $nombre, $fecha, $ubicacion, $descripcion) {
        return $this->modelo->actualizar_evento($id, $nombre, $fecha, $ubicacion, $descripcion);
    }

    public function eliminar($id) {
        return $this->modelo->eliminar_evento($id);
    }
}
?>