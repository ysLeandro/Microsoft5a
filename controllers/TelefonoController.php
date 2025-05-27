<?php
require_once __DIR__ . '/../models/TelefonoModel.php';

class TelefonoController {
    private $model;

    public function __construct() {
        $this->model = new TelefonoModel();
    }

    public function obtenerPorPersona($idPersona) {
        return $this->model->obtenerTelefonosPorPersona($idPersona);
    }

    public function agregar($idPersona, $telefono) {
        $this->model->agregarTelefono($idPersona, $telefono);
    }

    public function eliminar($idTelefono) {
        $this->model->eliminarTelefono($idTelefono);
    }
}
?>