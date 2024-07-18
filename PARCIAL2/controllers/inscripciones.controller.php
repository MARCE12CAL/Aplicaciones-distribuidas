<?php
require_once(__DIR__ . '/../models/inscripciones.model.php');

class InscripcionesController {
    private $modelo;

    public function __construct() {
        $this->modelo = new InscripcionesModel();
    }

    public function listar() {
        return $this->modelo->listar_inscripciones();
    }

    public function insertar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $participante_id = $_POST['participante_id'];
            $evento_id = $_POST['evento_id'];
            $resultado = $this->modelo->insertar_inscripcion($participante_id, $evento_id);
            echo $resultado ? 'success' : 'error';
        }
    }

    public function obtener() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $inscripcion = $this->modelo->obtener_inscripcion($id);
            echo json_encode($inscripcion);
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['inscripcion_id'];
            $participante_id = $_POST['participante_id'];
            $evento_id = $_POST['evento_id'];
            $resultado = $this->modelo->actualizar_inscripcion($id, $participante_id, $evento_id);
            echo $resultado ? 'success' : 'error';
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $resultado = $this->modelo->eliminar_inscripcion($id);
            echo $resultado ? 'success' : 'error';
        }
    }
}

// Manejar las solicitudes
$controller = new InscripcionesController();
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'listar':
        echo json_encode($controller->listar());
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