<?php
require_once '../controllers/PersonaController.php';

$controller = new PersonaController();

if (!isset($_GET['id'])) {
    die("❌ Error: ID no especificado.");
}

$id_persona = $_GET['id'];

try {
    $controller->eliminarPersona($id_persona);
    header("Location: index.php");
    exit();
} catch (Exception $e) {
    echo "❌ Error al eliminar: " . $e->getMessage();
}
?>