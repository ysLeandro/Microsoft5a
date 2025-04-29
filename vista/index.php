<?php
require_once '../controllers/PersonaController.php';

$controller = new PersonaController();

try {
    $personas = $controller->obtenerTodasLasPersonas();
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
                <th>Dirección</th>
                <th>Estado Civil</th>
                <th>Sexo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($personas as $fila) { ?>
            <tr>
                <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                <td><?php echo htmlspecialchars($fila['direccion']); ?></td>
                <td><?php echo htmlspecialchars($fila['estado_civil']); ?></td>
                <td><?php echo htmlspecialchars($fila['sexo']); ?></td>
                <td><?php echo htmlspecialchars($fila['telefono']); ?></td>
                <td>
                    <a href="actualizar.php?id=<?php echo $fila['id_persona']; ?>">Editar</a> |
                    <a href="eliminar.php?id=<?php echo $fila['id_persona']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta persona?');">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>