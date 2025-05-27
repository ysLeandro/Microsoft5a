<?php
require_once __DIR__ . '/../models/DireccionModel.php';

class DireccionController {
    private $model;

    public function __construct() {
        $this->model = new DireccionModel();
    }

    public function obtenerPorPersona($idPersona) {
        return $this->model->obtenerDireccionesPorPersona($idPersona);
    }

    public function agregar($idPersona, $direccion) {
        $this->model->agregarDireccion($idPersona, $direccion);
    }

    public function eliminar($idDireccion) {
        $this->model->eliminarDireccion($idDireccion);
    }
}
?>