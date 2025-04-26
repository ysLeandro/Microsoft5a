<?php
//controlador sexo
class Sexo {
    private $conn;
    private $table_name = "sexo";

    public $id;
    public $nombre;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear un nuevo sexo
    public function create() {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nombre) VALUES (:nombre)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en create(): " . $e->getMessage());
            return false;
        }
    }


public function read() {
    try {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (PDOException $e) {
        error_log("Error en read(): " . $e->getMessage());
        return [];
    }
}



     // Leer un solo sexo por ID
    public function readOne() {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en readOne(): " . $e->getMessage());
            return null;
        }
    }

    // Actualizar un sexo
    public function update() {
        try {
            $query = "UPDATE " . $this->table_name . " SET nombre = :nombre WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en update(): " . $e->getMessage());
            return false;
        }
    }

    // Eliminar un sexo
    public function delete() {
        try {
            if (empty($this->id)) {
                return false;
            }
	            error_log("Intentando eliminar el ID: " . $this->id);




	  // Preparar la consulta
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
	
// Ejecutar la consulta
        if ($stmt->execute()) {
            error_log("Registro con ID " . $this->id . " eliminado correctamente.");
            return true;
        } else {
            error_log("Error en delete(): La consulta no se ejecutó correctamente.");
            return false;
        }



        } catch (PDOException $e) {
            error_log("Error en delete(): " . $e->getMessage());
            return false;
        }
    }
}
?>
