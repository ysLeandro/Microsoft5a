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

try {
    $personas = $personaController->obtenerTodas();
} catch (Exception $e) {
    echo "❌ Error al cargar personas: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Personas</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h1>Listado de Personas</h1>

    <a href="crear.php">Registrar Nueva Persona</a>
    <br><br>

    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Direcciones</th>
                <th>Estado Civil</th>
                <th>Sexo</th>
                <th>Teléfonos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personas as $p): 
                $id = $p['id_persona'];
                $direcciones = $direccionController->obtenerPorPersona($id);
                $telefonos = $telefonoController->obtenerPorPersona($id);
                $estado_civil_data = $estadoCivilController->obtenerPorPersona($id);
                $estado_civil = $estado_civil_data ? $estado_civil_data['estado_civil'] : 'N/A';
                $sexo_data = $sexoController->obtenerPorPersona($id);
                $sexo = $sexo_data ? $sexo_data['sexo'] : 'N/A';
            ?>
            <tr>
                <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                <td>
                    <?php foreach ($direcciones as $d): ?>
                        <?php echo htmlspecialchars($d['direccion']); ?><br>
                    <?php endforeach; ?>
                </td>
                <td><?php echo htmlspecialchars($estado_civil); ?></td>
                <td><?php echo htmlspecialchars($sexo); ?></td>
                <td>
                    <?php foreach ($telefonos as $t): ?>
                        <?php echo htmlspecialchars($t['telefono']); ?><br>
                    <?php endforeach; ?>
                </td>
                <td>
                    <a href="actualizar.php?id=<?php echo $id; ?>">Editar</a> |
                    <a href="eliminar.php?id=<?php echo $id; ?>" onclick="return confirm('¿Estás seguro de eliminar esta persona?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>