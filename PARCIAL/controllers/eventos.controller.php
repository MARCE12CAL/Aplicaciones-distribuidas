<?php
require_once __DIR__ . '/../models/eventos.model.php';

class EventosController {
    private $model;

    public function __construct() {
        $this->model = new EventosModel();
    }

    public function listarEventos($pagina = 1, $porPagina = 10, $busqueda = '') {
        $eventos = $this->model->obtenerEventos($pagina, $porPagina, $busqueda);
        $total = $this->model->contarEventos($busqueda);
        $totalPaginas = ceil($total / $porPagina);

        return json_encode([
            'eventos' => $eventos,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $pagina
        ]);
    }

    public function crearEvento($nombre, $fecha, $ubicacion, $descripcion) {
        if (empty($nombre) || empty($fecha) || empty($ubicacion)) {
            return json_encode(['error' => 'Los campos nombre, fecha y ubicación son obligatorios']);
        }

        if ($this->model->crearEvento($nombre, $fecha, $ubicacion, $descripcion)) {
            return json_encode(['success' => 'Evento creado correctamente']);
        } else {
            return json_encode(['error' => 'Error al crear el evento']);
        }
    }

    public function obtenerEvento($id) {
        $evento = $this->model->obtenerEvento($id);
        if ($evento) {
            return json_encode($evento);
        } else {
            return json_encode(['error' => 'Evento no encontrado']);
        }
    }

    public function actualizarEvento($id, $nombre, $fecha, $ubicacion, $descripcion) {
        if (empty($nombre) || empty($fecha) || empty($ubicacion)) {
            return json_encode(['error' => 'Los campos nombre, fecha y ubicación son obligatorios']);
        }

        if ($this->model->actualizarEvento($id, $nombre, $fecha, $ubicacion, $descripcion)) {
            return json_encode(['success' => 'Evento actualizado correctamente']);
        } else {
            return json_encode(['error' => 'Error al actualizar el evento']);
        }
    }

    public function eliminarEvento($id) {
        if ($this->model->eliminarEvento($id)) {
            return json_encode(['success' => 'Evento eliminado correctamente']);
        } else {
            return json_encode(['error' => 'Error al eliminar el evento']);
        }
    }
}

// Manejo de solicitudes AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EventosController();
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'listar':
            $pagina = $_POST['pagina'] ?? 1;
            $porPagina = $_POST['porPagina'] ?? 10;
            $busqueda = $_POST['busqueda'] ?? '';
            echo $controller->listarEventos($pagina, $porPagina, $busqueda);
            break;
        case 'crear':
            echo $controller->crearEvento($_POST['nombre'], $_POST['fecha'], $_POST['ubicacion'], $_POST['descripcion']);
            break;
        case 'obtener':
            echo $controller->obtenerEvento($_POST['id']);
            break;
        case 'actualizar':
            echo $controller->actualizarEvento($_POST['id'], $_POST['nombre'], $_POST['fecha'], $_POST['ubicacion'], $_POST['descripcion']);
            break;
        case 'eliminar':
            echo $controller->eliminarEvento($_POST['id']);
            break;
        default:
            echo json_encode(['error' => 'Acción no válida']);
    }
}