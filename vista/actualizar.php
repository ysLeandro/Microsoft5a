<?php
require_once '../controllers/PersonaController.php';

$controller = new PersonaController();

if (!isset($_GET['id'])) {
    die("❌ Error: ID no especificado.");
}

$id_persona = $_GET['id'];
$persona = $controller->obtenerPersona($id_persona);

if (!$persona) {
    die("❌ Error: Persona no encontrada.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $estado_civil = $_POST['estado_civil'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];

    try {
        $controller->actualizarPersona($id_persona, $nombre, $direccion, $estado_civil, $sexo, $telefono);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        echo "❌ Error al actualizar: " . $e->getMessage();
    }
}
?>

<!-- HTML igual que antes -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Persona</title>
    <link rel="stylesheet" href="../css/estiloactualizar.css">
</head>
<body>
    <div class="formulario-container">
        <h1>Actualizar Datos de la Persona</h1>

        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($persona['nombre']); ?>" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($persona['direccion']); ?>" required>

            <label for="estado_civil">Estado Civil:</label>
            <select id="estado_civil" name="estado_civil" required>
                <option value="Soltero" <?php if($persona['estado_civil'] == 'Soltero') echo 'selected'; ?>>Soltero</option>
                <option value="Casado" <?php if($persona['estado_civil'] == 'Casado') echo 'selected'; ?>>Casado</option>
            </select>

            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="Masculino" <?php if($persona['sexo'] == 'Masculino') echo 'selected'; ?>>Masculino</option>
                <option value="Femenino" <?php if($persona['sexo'] == 'Femenino') echo 'selected'; ?>>Femenino</option>
            </select>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($persona['telefono']); ?>" required>

            <input type="submit" value="Actualizar" class="btn-guardar">
        </form>
    </div>
</body>
</html>