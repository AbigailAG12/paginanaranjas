<?php
include 'db.php';

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    // Obtener el nombre del archivo de la imagen
    $sql = "SELECT image FROM carrusel WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $image = $row['image'];

    // Eliminar el registro de la base de datos
    $sql = "DELETE FROM carrusel WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // Eliminar el archivo de imagen del servidor
        if (file_exists("uploads/" . $image)) {
            unlink("uploads/" . $image);
        }
        echo "<script>alert('Imagen eliminada correctamente');</script>";
        echo "<script>window.location.href='imgshow.php';</script>";
    } else {
        echo "Error al eliminar la imagen: " . $conn->error;
    }
} else {
    echo "<script>window.location.href='imgshow.php';</script>";
}

$conn->close();
?>
