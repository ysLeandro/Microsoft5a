<?php
require_once __DIR__ . '/../conexiondb/Conexion.php';

class TelefonoModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerTelefonosPorPersona($idPersona) {
        $sql = "SELECT * FROM telefono WHERE id_persona = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idPersona]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarTelefono($idPersona, $telefono) {
        $sql = "INSERT INTO telefono (id_persona, telefono) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idPersona, $telefono]);
    }

    public function eliminarTelefono($idTelefono) {
        $sql = "DELETE FROM telefono WHERE id_telefono = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idTelefono]);
    }
}
?>