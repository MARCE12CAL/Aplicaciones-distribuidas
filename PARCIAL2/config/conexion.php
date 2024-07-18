<?php
class Clase_Conectar
{
    public $conexion;
    protected $db;
    private $server = "127.0.0.1";
    private $usu = "root";
    private $clave = "";
    private $base = "ssport";
    private $port = 3307;

    public function Procedimiento_Conectar()
    {
        $this->conexion = mysqli_connect($this->server, $this->usu, $this->clave, $this->base, $this->port);
        if (!$this->conexion) {
            die("Error al conectarse con MySQL: " . mysqli_connect_error());
        }
        if (!mysqli_set_charset($this->conexion, "utf8")) {
            die("Error al configurar el juego de caracteres UTF-8: " . mysqli_error($this->conexion));
        }
        $this->db = mysqli_select_db($this->conexion, $this->base);
        if (!$this->db) {
            die("Error al seleccionar la base de datos: " . mysqli_error($this->conexion));
        }
        return $this->conexion;
    }
}
?>