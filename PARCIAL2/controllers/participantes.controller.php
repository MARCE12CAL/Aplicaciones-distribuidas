<?php
require_once(__DIR__ . '/../models/participantes.model.php');

class ParticipantesController {
    private $modelo;

    public function __construct() {
        $this->modelo = new ParticipantesModel();
    }

    public function listar() {
        return $this->modelo->listar_participantes();
    }

    public function insertar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $resultado = $this->modelo->insertar_participante($nombre, $apellido, $email, $telefono);
            echo $resultado ? 'success' : 'error';
        }
    }

    public function obtener() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $participante = $this->modelo->obtener_participante($id);
            echo json_encode($participante);
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['participante_id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $resultado = $this->modelo->actualizar_participante($id, $nombre, $apellido, $email, $telefono);
            echo $resultado ? 'success' : 'error';
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $resultado = $this->modelo->eliminar_participante($id);
            echo $resultado ? 'success' : 'error';
        }
    }
}

// Manejar las solicitudes
$controller = new ParticipantesController();
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