<?php
require_once __DIR__ . '/../conexiondb/Conexion.php';

class DireccionModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerDireccionesPorPersona($idPersona) {
        $sql = "SELECT * FROM direccion WHERE id_persona = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idPersona]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarDireccion($idPersona, $direccion) {
        $sql = "INSERT INTO direccion (id_persona, direccion) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idPersona, $direccion]);
    }

    public function eliminarDireccion($idDireccion) {
        $sql = "DELETE FROM direccion WHERE id_direccion = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idDireccion]);
    }
}
?>