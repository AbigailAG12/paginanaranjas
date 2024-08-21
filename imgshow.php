<?php
include 'db.php';

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "SELECT image FROM carrusel WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = "./uploads/" . $row['image'];

        if (is_file($image_path)) {
            if (unlink($image_path)) {
                echo "Imagen eliminada exitosamente";
            } else {
                echo "Error al eliminar la imagen.";
            }
        } else {
            echo "La imagen no existe.";
        }

        $sql = "DELETE FROM carrusel WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Registro eliminado exitosamente";
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }
    } else {
        echo "Registro no encontrado.";
    }
}

$sql = "SELECT id, title, image, url FROM carrusel ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ofrecer educación superior">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow">
    <link rel="stylesheet" href="./css/style.css">
    <title>Mostrar imágenes</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Imágenes del Carrusel</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>URL</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td><img src='uploads/" . $row['image'] . "' width='100'></td>";
                        echo "<td><a href='" . $row['url'] . "' target='_blank'>enlace</a></td>";
                        echo "<td>";
                        echo "<a href='imgshow.php?delete_id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta imagen?\");'>Eliminar</a>";
                        echo "<a href='imgedit.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No existen imágenes en el carrusel.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
                <a href="index.php" class="btn btn-primary">Inicio</a>
    </div>

    <!-- Enlace a jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Enlace a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include 'db.php';

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $sql = "SELECT imagen FROM noticias WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = "uploads/" . $row['image'];

        if (file_exists($image_path)) {
            if (!unlink($image_path)) {
                error_log("Error al eliminar el archivo: " . $image_path);
            }
        }

        $sql = "DELETE FROM noticias WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            header("Location: imgshow.php");
            exit();
        } else {
            echo "Error al eliminar la noticia: " . $conn->error;
        }
    } else {
        echo "Noticia no encontrada";
    }

    header("Location: imgshow.php");
    exit();
}

$sql = "SELECT id, titulo, imagen, redaccion FROM noticias ORDER BY id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Mostrar noticias">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Mostrar Noticias</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
        <h2>Noticias</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>redaccion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
                        echo "<td><img src='uploads/" . htmlspecialchars($row['imagen']) . "' width='100'></td>";
                        echo "<td>" . nl2br(htmlspecialchars(substr($row['redaccion'], 0, 100))) . "...</td>";
                        echo "<td>";
                        echo "<a href='imgshow.php?delete_id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta noticia?\");'>Eliminar</a>";
                        echo "<a href='newadd.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No existen noticias.</td></tr>";
                }
            ?>
            </tbody>
        </table>

        <!-- Enlace a jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <!-- Enlace a Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    </div>
    </body>
</html>

<?php
$conn->close();
?>