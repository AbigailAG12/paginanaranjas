<?php
require 'db.php';

$titulo = $_POST['titulo'];
$imagen = $_FILES['imagen']['name'];
$redaccion = $_POST['redaccion'];
$target = "uploads/" . basename($imagen);

if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target)) {
    $sql = "INSERT INTO noticias (titulo, imagen, redaccion) VALUES ('$titulo', '$imagen', '$redaccion')";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva noticia agregada exitosamente.";
        header("Location: ../mod_admin/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Failed to upload image";
}

$conn->close();
?>
