<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id, title, image, url FROM carrusel WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $url = $_POST['url'];

    // Manejar la subida de una nueva imagen si se proporciona
    if ($_FILES['image']['name']) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . $image_name;
        move_uploaded_file($image_tmp_name, $image_path);

        // Eliminar la imagen anterior
        $sql = "SELECT image FROM carrusel WHERE id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $old_image_path = "uploads/" . $row['image'];
        if (file_exists($old_image_path)) {
            unlink($old_image_path);
        }

        $sql = "UPDATE carrusel SET title = '$title', image = '$image_name', url = '$url' WHERE id = $id";
    } else {
        $sql = "UPDATE carrusel SET title = '$title', url = '$url' WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: imgshow.php");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
} else {
    echo "ID no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Editar imagen del carrusel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Editar Imagen</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Imagen</h2>
        <form action="imgedit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="url">URL:</label>
                <input type="text" class="form-control" id="url" name="url" value="<?php echo $row['url']; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Imagen (deja en blanco para mantener la actual):</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <!-- Enlace a jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Enlace a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
