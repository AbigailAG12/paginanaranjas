<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $image = $_POST['current_image'];

    // Manejar la carga de la nueva imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen real
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Verificar si el archivo ya existe
            if (!file_exists($target_file)) {
                // Verificar el tamaño del archivo
                if ($_FILES["image"]["size"] <= 5000000) {
                    // Permitir ciertos formatos de archivo
                    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
                        // Intentar mover el archivo cargado a la carpeta de destino
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            // Eliminar la imagen antigua
                            if (file_exists("uploads/" . $image) && $image != basename($_FILES["image"]["name"])) {
                                unlink("uploads/" . $image);
                            }
                            $image = basename($_FILES["image"]["name"]);
                        } else {
                            echo "Error al subir la imagen.";
                        }
                    } else {
                        echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
                    }
                } else {
                    echo "El archivo es demasiado grande.";
                }
            } else {
                echo "El archivo ya existe.";
            }
        } else {
            echo "El archivo no es una imagen.";
        }
    }

    // Actualizar los datos en la base de datos
    $sql = "UPDATE carrusel SET title='$title', url='$url', image='$image' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Imagen actualizada correctamente');</script>";
        echo "<script>window.location.href='imgshow.php';</script>";
    } else {
        echo "Error al actualizar la imagen: " . $conn->error;
    }
} else {
    echo "<script>window.location.href='imgshow.php';</script>";
}

$conn->close();
?>
