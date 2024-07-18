<?php
require_once '../config/conexion.php';

class Dashboard {
    private $conexion;

    public function __construct() {
        $conectar = new Clase_Conectar();
        $this->conexion = $conectar->Procedimiento_Conectar();
    }

    public function obtenerTotalEventos() {
        $query = "SELECT COUNT(*) as total FROM eventos";
        $resultado = mysqli_query($this->conexion, $query);
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['total'];
    }

    public function obtenerTotalParticipantes() {
        $query = "SELECT COUNT(*) as total FROM participantes";
        $resultado = mysqli_query($this->conexion, $query);
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['total'];
    }

    public function obtenerTotalInscripciones() {
        $query = "SELECT COUNT(*) as total FROM inscripciones";
        $resultado = mysqli_query($this->conexion, $query);
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['total'];
    }

    public function obtenerEventosRecientes($limite = 5) {
        $query = "SELECT * FROM eventos ORDER BY fecha DESC LIMIT $limite";
        $resultado = mysqli_query($this->conexion, $query);
        $eventos = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $eventos[] = $fila;
        }
        return $eventos;
    }

    public function obtenerInscripcionesPorEvento() {
        $query = "SELECT e.nombre as evento, COUNT(i.id) as total_inscripciones 
                  FROM eventos e 
                  LEFT JOIN inscripciones i ON e.id = i.evento_id 
                  GROUP BY e.id 
                  ORDER BY total_inscripciones DESC";
        $resultado = mysqli_query($this->conexion, $query);
        $inscripciones = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $inscripciones[] = $fila;
        }
        return $inscripciones;
    }
}