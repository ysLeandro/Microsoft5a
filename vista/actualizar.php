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

if (!isset($_GET['id'])) {
    echo "ID no proporcionado.";
    exit;
}

$id = $_GET['id'];
$persona = $personaController->obtener($id);
$direcciones = $direccionController->obtenerPorPersona($id);
$telefonos = $telefonoController->obtenerPorPersona($id);
$estadoCivilData = $estadoCivilController->obtenerPorPersona($id);
$estado_civil = $estadoCivilData ? $estadoCivilData['estado_civil'] : '';
$sexoData = $sexoController->obtenerPorPersona($id);
$sexo = $sexoData ? $sexoData['sexo'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $nuevasDirecciones = $_POST['direccion'];
    $nuevosTelefonos = $_POST['telefono'];
    $estado_civil = $_POST['estado_civil'];
    $sexo = $_POST['sexo'];

    // ✅ Validar sexo
    if ($sexo !== 'Masculino' && $sexo !== 'Femenino') {
        die("❌ Valor de sexo no válido. Solo se permite 'Masculino' o 'Femenino'.");
    }

    // Actualizar nombre
    $personaController->actualizar($id, $nombre);

    // Eliminar direcciones y teléfonos anteriores
    foreach ($direcciones as $d) {
        $direccionController->eliminar($d['id_direccion']);
    }
    foreach ($telefonos as $t) {
        $telefonoController->eliminar($t['id_telefono']);
    }

    // Agregar nuevas direcciones
    foreach ($nuevasDirecciones as $dir) {
        if (!empty($dir)) {
            $direccionController->agregar($id, $dir);
        }
    }

    // Agregar nuevos teléfonos
    foreach ($nuevosTelefonos as $tel) {
        if (!empty($tel)) {
            $telefonoController->agregar($id, $tel);
        }
    }

    // Actualizar sexo y estado civil
    $sexoController->actualizar($id, $sexo);
    $estadoCivilController->actualizar($id, $estado_civil);

    header("Location: index.php");
    exit();
}
?>

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
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($persona['nombre']); ?>" required><br>

            <label>Direcciones:</label>
            <?php foreach ($direcciones as $dir): ?>
                <input type="text" name="direccion[]" value="<?php echo htmlspecialchars($dir['direccion']); ?>"><br>
            <?php endforeach; ?>
            <input type="text" name="direccion[]" placeholder="Nueva dirección"><br>

            <label>Estado Civil:</label>
            <input type="text" name="estado_civil" value="<?php echo htmlspecialchars($estado_civil); ?>" placeholder="Ej: Soltero, Unión Libre" required><br>

            <label>Sexo:</label>
            <select name="sexo" required>
                <option value="Masculino" <?php echo ($sexo == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                <option value="Femenino" <?php echo ($sexo == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
            </select><br>

            <label>Teléfonos:</label>
            <?php foreach ($telefonos as $tel): ?>
                <input type="text" name="telefono[]" value="<?php echo htmlspecialchars($tel['telefono']); ?>"><br>
            <?php endforeach; ?>
            <input type="text" name="telefono[]" placeholder="Nuevo teléfono"><br>

            <input type="submit" value="Actualizar" class="btn-guardar">
        </form>
    </div>
</body>
</html>