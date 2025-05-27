<?php
require_once __DIR__ . '/../models/SexoModel.php';

class SexoController {
    private $model;

    public function __construct() {
        $this->model = new SexoModel();
    }

    public function obtenerPorPersona($idPersona) {
        return $this->model->obtenerSexoPorPersona($idPersona);
    }

    public function actualizar($idPersona, $sexo) {
        $this->model->actualizarSexo($idPersona, $sexo);
    }
}
?>