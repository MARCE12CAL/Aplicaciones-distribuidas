<?php
require_once __DIR__ . '/../models/inscripciones.model.php';

class InscripcionesController {
    private $model;

    public function __construct() {
        $this->model = new InscripcionesModel();
    }

    public function listarInscripciones($pagina = 1, $porPagina = 10, $busqueda = '') {
        $inscripciones = $this->model->obtenerInscripciones($pagina, $porPagina, $busqueda);
        $total = $this->model->contarInscripciones($busqueda);
        $totalPaginas = ceil($total / $porPagina);

        return json_encode([
            'inscripciones' => $inscripciones,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $pagina
        ]);
    }

    public function crearInscripcion($evento_id, $participante_id, $fecha_inscripcion) {
        if (empty($evento_id) || empty($participante_id) || empty($fecha_inscripcion)) {
            return json_encode(['error' => 'Todos los campos son obligatorios']);
        }

        if ($this->model->crearInscripcion($evento_id, $participante_id, $fecha_inscripcion)) {
            return json_encode(['success' => 'Inscripción creada correctamente']);
        } else {
            return json_encode(['error' => 'Error al crear la inscripción']);
        }
    }

    public function obtenerInscripcion($id) {
        $inscripcion = $this->model->obtenerInscripcion($id);
        if ($inscripcion) {
            return json_encode($inscripcion);
        } else {
            return json_encode(['error' => 'Inscripción no encontrada']);
        }
    }

    public function actualizarInscripcion($id, $evento_id, $participante_id, $fecha_inscripcion) {
        if (empty($evento_id) || empty($participante_id) || empty($fecha_inscripcion)) {
            return json_encode(['error' => 'Todos los campos son obligatorios']);
        }

        if ($this->model->actualizarInscripcion($id, $evento_id, $participante_id, $fecha_inscripcion)) {
            return json_encode(['success' => 'Inscripción actualizada correctamente']);
        } else {
            return json_encode(['error' => 'Error al actualizar la inscripción']);
        }
    }

    public function eliminarInscripcion($id) {
        if ($this->model->eliminarInscripcion($id)) {
            return json_encode(['success' => 'Inscripción eliminada correctamente']);
        } else {
            return json_encode(['error' => 'Error al eliminar la inscripción']);
        }
    }
}

// Manejo de solicitudes AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new InscripcionesController();
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'listar':
            $pagina = $_POST['pagina'] ?? 1;
            $porPagina = $_POST['porPagina'] ?? 10;
            $busqueda = $_POST['busqueda'] ?? '';
            echo $controller->listarInscripciones($pagina, $porPagina, $busqueda);
            break;
        case 'crear':
            echo $controller->crearInscripcion($_POST['evento_id'], $_POST['participante_id'], $_POST['fecha_inscripcion']);
            break;
        case 'obtener':
            echo $controller->obtenerInscripcion($_POST['id']);
            break;
        case 'actualizar':
            echo $controller->actualizarInscripcion($_POST['id'], $_POST['evento_id'], $_POST['participante_id'], $_POST['fecha_inscripcion']);
            break;
        case 'eliminar':
            echo $controller->eliminarInscripcion($_POST['id']);
            break;
        default:
            echo json_encode(['error' => 'Acción no válida']);
    }
}