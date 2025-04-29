<?php
require_once __DIR__ . '/../conexiondb/Conexion.php';

class PersonaModel {

    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function obtenerPersonas() {
        $sql = "SELECT p.id_persona, p.nombre, d.direccion, e.estado_civil, s.sexo, t.telefono
                FROM persona p
                INNER JOIN direccion d ON p.id_persona = d.id_persona
                INNER JOIN estadocivil e ON p.id_persona = e.id_persona
                INNER JOIN sexo s ON p.id_persona = s.id_persona
                INNER JOIN telefono t ON p.id_persona = t.id_persona";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarPersona($nombre, $direccion, $estado_civil, $sexo, $telefono) {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("INSERT INTO persona (nombre) VALUES (:nombre)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();

            $id_persona = $this->conn->lastInsertId();

            $stmt = $this->conn->prepare("INSERT INTO direccion (direccion, id_persona) VALUES (:direccion, :id_persona)");
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("INSERT INTO estadocivil (estado_civil, id_persona) VALUES (:estado_civil, :id_persona)");
            $stmt->bindParam(':estado_civil', $estado_civil);
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("INSERT INTO sexo (sexo, id_persona) VALUES (:sexo, :id_persona)");
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("INSERT INTO telefono (telefono, id_persona) VALUES (:telefono, :id_persona)");
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function obtenerPersonaPorId($id_persona) {
        $sql = "SELECT p.nombre, d.direccion, e.estado_civil, s.sexo, t.telefono
                FROM persona p
                INNER JOIN direccion d ON p.id_persona = d.id_persona
                INNER JOIN estadocivil e ON p.id_persona = e.id_persona
                INNER JOIN sexo s ON p.id_persona = s.id_persona
                INNER JOIN telefono t ON p.id_persona = t.id_persona
                WHERE p.id_persona = :id_persona";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_persona', $id_persona, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPersona($id_persona, $nombre, $direccion, $estado_civil, $sexo, $telefono) {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("UPDATE persona SET nombre = :nombre WHERE id_persona = :id_persona");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("UPDATE direccion SET direccion = :direccion WHERE id_persona = :id_persona");
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("UPDATE estadocivil SET estado_civil = :estado_civil WHERE id_persona = :id_persona");
            $stmt->bindParam(':estado_civil', $estado_civil);
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("UPDATE sexo SET sexo = :sexo WHERE id_persona = :id_persona");
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("UPDATE telefono SET telefono = :telefono WHERE id_persona = :id_persona");
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function eliminarPersona($id_persona) {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("DELETE FROM direccion WHERE id_persona = :id_persona");
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("DELETE FROM estadocivil WHERE id_persona = :id_persona");
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("DELETE FROM sexo WHERE id_persona = :id_persona");
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("DELETE FROM telefono WHERE id_persona = :id_persona");
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $stmt = $this->conn->prepare("DELETE FROM persona WHERE id_persona = :id_persona");
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->execute();

            $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }
}
?>