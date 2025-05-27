<?php
require_once __DIR__ . '/../models/PersonaModel.php';

class PersonaController {
    private $model;

    public function __construct() {
        $this->model = new PersonaModel();
    }

    public function obtenerTodas() {
        return $this->model->obtenerPersonas();
    }

    public function obtener($id) {
        return $this->model->obtenerPersonaPorId($id);
    }

    public function agregar($nombre) {
        return $this->model->agregarPersona($nombre); // devuelve id_persona
    }

    public function actualizar($id, $nombre) {
        $this->model->actualizarPersona($id, $nombre);
    }

    public function eliminar($id) {
        $this->model->eliminarPersona($id);
    }
}
?>