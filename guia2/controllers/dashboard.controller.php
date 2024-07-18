<?php
require_once '../models/Dashboard.php';

class DashboardController {
    private $dashboardModel;

    public function __construct() {
        $this->dashboardModel = new Dashboard();
    }

    public function obtenerEstadisticas() {
        $totalEventos = $this->dashboardModel->obtenerTotalEventos();
        $totalParticipantes = $this->dashboardModel->obtenerTotalParticipantes();
        $totalInscripciones = $this->dashboardModel->obtenerTotalInscripciones();
        $eventosRecientes = $this->dashboardModel->obtenerEventosRecientes(5);
        $inscripcionesPorEvento = $this->dashboardModel->obtenerInscripcionesPorEvento();

        return [
            'totalEventos' => $totalEventos,
            'totalParticipantes' => $totalParticipantes,
            'totalInscripciones' => $totalInscripciones,
            'eventosRecientes' => $eventosRecientes,
            'inscripcionesPorEvento' => $inscripcionesPorEvento
        ];
    }
}

// Manejo de solicitudes AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $controller = new DashboardController();
    
    if ($_POST['action'] === 'obtenerEstadisticas') {
        $estadisticas = $controller->obtenerEstadisticas();
        echo json_encode($estadisticas);
    }
}