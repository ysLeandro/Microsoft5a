<?php
require_once '../controllers/PersonaController.php';
require_once '../controllers/DireccionController.php';
require_once '../controllers/TelefonoController.php';
require_once '../controllers/EstadoCivilController.php';
require_once '../controllers/SexoController.php';

$personaController = new PersonaController();
$direccionController = new DireccionController();
$telefonoController = new TelefonoController();
$estadoCivilController = new EstadoCivilController();
$sexoController = new SexoController();

// Inicializar variables para evitar warnings
$sexo = '';
$estado_civil = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $direcciones = $_POST['direccion'];
    $telefonos = $_POST['telefono'];
    $estado_civil = $_POST['estado_civil'];
    $sexo = $_POST['sexo'];

    try {
        // 1. Insertar persona
        $id_persona = $personaController->agregar($nombre);

        // 2. Insertar direcciones
        foreach ($direcciones as $dir) {
            if (!empty($dir)) {
                $direccionController->agregar($id_persona, $dir);
            }
        }

        // 3. Insertar teléfonos
        foreach ($telefonos as $tel) {
            if (!empty($tel)) {
                $telefonoController->agregar($id_persona, $tel);
            }
        }

        // 4. Insertar sexo y estado civil
        $sexoController->actualizar($id_persona, $sexo);
        $estadoCivilController->actualizar($id_persona, $estado_civil);

        // Redirigir a la lista
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        echo "❌ Error al agregar: " . $e->getMessage();
    }
}
?>

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
            <input type="text" name="nombre" required><br>

            <label>Dirección 1:</label>
            <input type="text" name="direccion[]"><br>

            <label>Dirección 2:</label>
            <input type="text" name="direccion[]"><br>

            <label>Teléfono 1:</label>
            <input type="text" name="telefono[]"><br>

            <label>Teléfono 2:</label>
            <input type="text" name="telefono[]"><br>

            <label>Estado Civil:</label>
            <input type="text" name="estado_civil" value="<?php echo htmlspecialchars($estado_civil); ?>" placeholder="Ej: Soltero, Unión Libre, etc." required><br>

            <label>Sexo:</label>
            <select name="sexo" required>
                <option value="Masculino" <?php echo ($sexo === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                <option value="Femenino" <?php echo ($sexo === 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
            </select><br>

            <input type="submit" value="Guardar" class="btn-guardar">
        </form>
    </div>
</body>
</html>