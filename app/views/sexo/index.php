<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Sexos</title>
    <link rel="stylesheet" href="/eysphp/public/css/style.css">
</head>
<body>

<div class="container">
    <h1>Listar  Sexos</h1>
    <a href="/eysphp/app/views/sexo/create.php"><button>Agregar</button></a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sexos) && is_array($sexos)): ?>
                <?php foreach ($sexos as $sexo): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sexo['id']); ?></td>
                        <td><?php echo htmlspecialchars($sexo['nombre']); ?></td>
                        <td>
    <a href="/eysphp/public/sexo/edit?id=<?php echo htmlspecialchars($sexo['id']); ?>">
        <button>Editar</button>
    </a>
    <a href="/eysphp/public/sexo/eliminar?id=<?php echo htmlspecialchars($sexo['id']); ?>" 
       onclick="return confirm('¿Estás seguro de eliminar este registro?');">
        <button>Eliminar</button>
    </a>
</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay registros disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="/eysphp/public/js/script.js"></script>
</body>
</html>
