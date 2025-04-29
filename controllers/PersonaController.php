<?php
require_once __DIR__ . '/../models/PersonaModel.php';

class PersonaController {
    private $model;

    public function __construct() {
        $this->model = new PersonaModel();
    }

    public function obtenerTodasLasPersonas() {
        return $this->model->obtenerPersonas();
    }

    public function obtenerPersona($id) {
        return $this->model->obtenerPersonaPorId($id);
    }

    public function agregarPersona($nombre, $direccion, $estado_civil, $sexo, $telefono) {
        $this->model->agregarPersona($nombre, $direccion, $estado_civil, $sexo, $telefono);
    }

    public function actualizarPersona($id, $nombre, $direccion, $estado_civil, $sexo, $telefono) {
        $this->model->actualizarPersona($id, $nombre, $direccion, $estado_civil, $sexo, $telefono);
    }

    public function eliminarPersona($id) {
        $this->model->eliminarPersona($id);
    }
}
?>