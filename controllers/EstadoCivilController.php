<?php
require_once __DIR__ . '/../models/EstadoCivilModel.php';

class EstadoCivilController {
    private $model;

    public function __construct() {
        $this->model = new EstadoCivilModel();
    }

    public function obtenerPorPersona($idPersona) {
        return $this->model->obtenerEstadoCivilPorPersona($idPersona);
    }

    public function actualizar($idPersona, $estadoCivil) {
        $this->model->actualizarEstadoCivil($idPersona, $estadoCivil);
    }
}
?>