<?php
require_once __DIR__ . '/../conexiondb/Conexion.php';

class PersonaModel {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function obtenerPersonas() {
        $sql = "SELECT * FROM persona";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPersonaPorId($id_persona) {
    $sql = "SELECT * FROM persona WHERE id_persona = :id_persona";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id_persona', $id_persona, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function agregarPersona($nombre) {
        $stmt = $this->conn->prepare("INSERT INTO persona (nombre) VALUES (:nombre)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        return $this->conn->lastInsertId(); // Importante para luego agregar direcciones y teléfonos
    }

    public function actualizarPersona($id_persona, $nombre) {
        $stmt = $this->conn->prepare("UPDATE persona SET nombre = :nombre WHERE id_persona = :id_persona");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id_persona', $id_persona);
        $stmt->execute();
    }

    public function eliminarPersona($id_persona) {
        $stmt = $this->conn->prepare("DELETE FROM persona WHERE id_persona = ?");
        $stmt->execute([$id_persona]);
    }
}
?>