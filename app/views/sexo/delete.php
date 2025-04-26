<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elininar Sexo</title>
</head>
<body>

<h1>Editar el Sexo</h1>
<form action="/sexo/public/sexo/delete" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($sexo['id']); ?>">
    
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($sexo['nombre']); ?>" required>
    
    <input type="submit" value="Eliminar">
</form>

<a href="index.php">Volver al listado</a>

</body>
</html>
