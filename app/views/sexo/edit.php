<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sexo</title>
</head>
<body>

<h1>Editar </h1>
<form action="/sexo/public/sexo/update" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($sexo['id']); ?>">
    
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($sexo['nombre']); ?>" required>
    
    <input type="submit" value="Actualizar">
</form>

<a href="index.php">Volver al listado</a>

</body>
</html>
