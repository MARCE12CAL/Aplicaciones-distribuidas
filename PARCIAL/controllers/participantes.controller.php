<?php
require_once __DIR__ . '/../models/participantes.model.php';

class ParticipantesController {
    private $model;

    public function __construct() {
        $this->model = new ParticipantesModel();
    }

    public function listarParticipantes($pagina = 1, $porPagina = 10, $busqueda = '') {
        $participantes = $this->model->obtenerParticipantes($pagina, $porPagina, $busqueda);
        $total = $this->model->contarParticipantes($busqueda);
        $totalPaginas = ceil($total / $porPagina);

        return json_encode([
            'participantes' => $participantes,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $pagina
        ]);
    }

    public function crearParticipante($nombre, $apellido, $email, $telefono) {
        if (empty($nombre) || empty($apellido) || empty($email)) {
            return json_encode(['error' => 'Los campos nombre, apellido y email son obligatorios']);
        }

        if ($this->model->crearParticipante($nombre, $apellido, $email, $telefono)) {
            return json_encode(['success' => 'Participante creado correctamente']);
        } else {
            return json_encode(['error' => 'Error al crear el participante']);
        }
    }

    public function obtenerParticipante($id) {
        $participante = $this->model->obtenerParticipante($id);
        if ($participante) {
            return json_encode($participante);
        } else {
            return json_encode(['error' => 'Participante no encontrado']);
        }
    }

    public function actualizarParticipante($id, $nombre, $apellido, $email, $telefono) {
        if (empty($nombre) || empty($apellido) || empty($email)) {
            return json_encode(['error' => 'Los campos nombre, apellido y email son obligatorios']);
        }

        if ($this->model->actualizarParticipante($id, $nombre, $apellido, $email, $telefono)) {
            return json_encode(['success' => 'Participante actualizado correctamente']);
        } else {
            return json_encode(['error' => 'Error al actualizar el participante']);
        }
    }

    public function eliminarParticipante($id) {
        if ($this->model->eliminarParticipante($id)) {
            return json_encode(['success' => 'Participante eliminado correctamente']);
        } else {
            return json_encode(['error' => 'Error al eliminar el participante']);
        }
    }
}

// Manejo de solicitudes AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ParticipantesController();
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'listar':
            $pagina = $_POST['pagina'] ?? 1;
            $porPagina = $_POST['porPagina'] ?? 10;
            $busqueda = $_POST['busqueda'] ?? '';
            echo $controller->listarParticipantes($pagina, $porPagina, $busqueda);
            break;
        case 'crear':
            echo $controller->crearParticipante($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['telefono']);
            break;
        case 'obtener':
            echo $controller->obtenerParticipante($_POST['id']);
            break;
        case 'actualizar':
            echo $controller->actualizarParticipante($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['telefono']);
            break;
        case 'eliminar':
            echo $controller->eliminarParticipante($_POST['id']);
            break;
        default:
            echo json_encode(['error' => 'Acción no válida']);
    }
}