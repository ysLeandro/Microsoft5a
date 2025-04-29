<?php
require_once '../controllers/PersonaController.php';

$controller = new PersonaController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $estado_civil = $_POST['estado_civil'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];

    try {
        $controller->agregarPersona($nombre, $direccion, $estado_civil, $sexo, $telefono);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        echo "❌ Error al agregar: " . $e->getMessage();
    }
}
?>

<!-- HTML igual que antes -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Persona</title>
    <link rel="stylesheet" href="../css/crear.css">
</head>
<body>
    <div class="formulario-container">
        <h1>Crear Nueva Persona</h1>
        <form method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Dirección:</label>
            <input type="text" name="direccion" required>

            <label>Estado Civil:</label>
            <select name="estado_civil" required>
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
            </select>

            <label>Sexo:</label>
            <select name="sexo" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>

            <label>Teléfono:</label>
            <input type="text" name="telefono" required>

            <input type="submit" value="Guardar" class="btn-guardar">
        </form>
    </div>
</body>
</html>