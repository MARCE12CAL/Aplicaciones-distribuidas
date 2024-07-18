<?php
require_once(__DIR__ . '/../models/eventos.model.php');

class EventosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new EventosModel();
    }

    public function listar() {
        return $this->modelo->listar_eventos();
    }

    public function insertar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $ubicacion = $_POST['ubicacion'];
            $descripcion = $_POST['descripcion'];
            $resultado = $this->modelo->insertar_evento($nombre, $fecha, $ubicacion, $descripcion);
            echo $resultado ? 'success' : 'error';
        }
    }

    public function obtener() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $evento = $this->modelo->obtener_evento($id);
            echo json_encode($evento);
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['evento_id'];
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $ubicacion = $_POST['ubicacion'];
            $descripcion = $_POST['descripcion'];
            $resultado = $this->modelo->actualizar_evento($id, $nombre, $fecha, $ubicacion, $descripcion);
            echo $resultado ? 'success' : 'error';
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $resultado = $this->modelo->eliminar_evento($id);
            echo $resultado ? 'success' : 'error';
        }
    }
}

// Manejar las solicitudes
$controller = new EventosController();
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'listar':
        $controller->listar();
        break;
    case 'insertar':
        $controller->insertar();
        break;
    case 'obtener':
        $controller->obtener();
        break;
    case 'actualizar':
        $controller->actualizar();
        break;
    case 'eliminar':
        $controller->eliminar();
        break;
}
?>