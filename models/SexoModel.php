<?php
require_once __DIR__ . '/../conexiondb/Conexion.php';

class SexoModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerSexoPorPersona($idPersona) {
        $sql = "SELECT sexo FROM sexo WHERE id_persona = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idPersona]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarSexo($idPersona, $sexo) {
    $sql = "UPDATE sexo SET sexo = ? WHERE id_persona = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$sexo, $idPersona]);

    if ($stmt->rowCount() === 0) {
        // No se actualizó nada, insertar nuevo registro
        $sqlInsert = "INSERT INTO sexo (id_persona, sexo) VALUES (?, ?)";
        $stmtInsert = $this->db->prepare($sqlInsert);
        $stmtInsert->execute([$idPersona, $sexo]);
    }
    }
}
?>