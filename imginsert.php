<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $url = $_POST['url'];
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    if ($_FILES['image']['error'] != 0) {
        echo "Error al subir el archivo: " . $_FILES['image']['error'];
    } else {
        if ($_FILES['image']['size'] > 2000000) {
            echo "El archivo es demasiado grande.";
        } else {
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'png', 'jpeg', 'gif'];

            if (!in_array($imageFileType, $allowed_types)) {
                echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            } else {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $sql = "INSERT INTO carrusel (title, image, url) VALUES ('$title', '$image', '$url')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Nueva imagen agregada exitosamente.";
                        header("Location: ../mod_admin/index.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Hubo un error subiendo el archivo.";
                }
            }
        }
    }
}

$conn->close();
?>
