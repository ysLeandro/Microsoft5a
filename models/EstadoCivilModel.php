<?php
require_once __DIR__ . '/../conexiondb/Conexion.php';

class EstadoCivilModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerEstadoCivilPorPersona($idPersona) {
        $sql = "SELECT estado_civil FROM estadocivil WHERE id_persona = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idPersona]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarEstadoCivil($idPersona, $estadoCivil) {
    $sql = "UPDATE estadocivil SET estado_civil = ? WHERE id_persona = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$estadoCivil, $idPersona]);

    if ($stmt->rowCount() === 0) {
        // No se actualizó nada, insertar nuevo registro
        $sqlInsert = "INSERT INTO estadocivil (id_persona, estado_civil) VALUES (?, ?)";
        $stmtInsert = $this->db->prepare($sqlInsert);
        $stmtInsert->execute([$idPersona, $estadoCivil]);
    }
}
}
?>