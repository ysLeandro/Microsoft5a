<?php
class Database {
    private $host = "localhost";
    private $db_name = "microsoft5a";
    private $username = "microsoft5a";
    private $password = "microsoft5a";
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $exception) {
            error_log("Connection error: " . $exception->getMessage());
            throw new Exception("No se pudo conectar a la base de datos.");
        }
        return $this->conn;
    }
}
?>
