<?php
class Conexion {
    private static $host = "localhost";
    private static $dbname = "personas_db"; // NUEVO nombre de la base de datos
    private static $username = "microsoft5a2";
    private static $password = "microsoft5a2";
    private static $conn = null;

    public static function conectar() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8",
                    self::$username,
                    self::$password
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("❌ Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>




