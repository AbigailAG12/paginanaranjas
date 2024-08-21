<?php
require 'db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Imagen al Carrusel</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2>Add News</h2>
    <form action="newinsert.php" method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" required><br>
        <label for="imagen">Imagen:</label><br>
        <input type="file" id="imagen" name="imagen" required><br>
        <label for="redaccion">Redacción:</label><br>
        <textarea id="redaccion" name="redaccion" rows="10" cols="30" required></textarea><br><br>
        <input type="submit" value="editar">
    </form>
</body>
</html>
