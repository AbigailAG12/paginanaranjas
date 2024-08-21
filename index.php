<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ofrecer educación superior">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/style11.css">
    <title>Las naranjas</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="header_container">
        <img src="./img/OIP.png" alt="Logo" class="header_image">
        <h1 class="titulo">Las naranjas</h1>
        <nav>
            <ul class="header_nav">
                <li class="header_nav_item"><a href="#">Inicio</a></li>
                <li class="header_nav_item"><a href="./historia.html">Historia</a></li>
                <li class="header_nav_item"><a href="./formulario1.html">Formulario</a></li>
                <li class="header_nav_item"><a href="./Productos.html">Productos</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="carousel" aria-label="Carrusel de imágenes">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner">
                    <?php
                    include 'db.php';
                    $sql = "SELECT title, image, url FROM carrusel ORDER BY id DESC LIMIT 3";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $first = true;
                        while ($row = $result->fetch_assoc()) {
                            $activeClass = $first ? 'active' : '';
                            echo '<div class="carousel-item ' . $activeClass . '">';
                            echo '<img src="uploads/' . $row['image'] . '" class="d-block w-100" alt="' . $row['title'] . '">';
                            echo '<div class="carousel-caption d-none d-md-block">';
                            echo '<a href="' . $row['url'] . '" class="read-more btn btn-primary">Leer más</a>';
                            echo '</div></div>';
                            $first = false;
                        }
                    } else {
                        echo '<div class="carousel-item active">';
                        echo '<img src="./img/default.jpg" class="d-block w-100" alt="Sin imágenes">';
                        echo '<div class="carousel-caption d-none d-md-block">';
                        echo '<p>No hay imágenes en el carrusel.</p>';
                        echo '</div></div>';
                    }
                    $conn->close();
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        </section>

        <!-- Botón para ir a admin.php -->
        <div class="text-center mt-4">
            <a href="imgadd.php" class="btn btn-primary">Agregar Imagen</a>
        </div>
        <div class="text-center mt-4">
            <a href="imgshow.php" class="btn btn-primary">Editar Imagenes</a>
        </div>
        <br>
    <body>
        <section class="post-list">
            <div class="content">
                <article class="post">
                    <div class="post-header">
                        <div class="post-img-1"></div>
                    </div>
                    <div class="post-body">
                        <span>5 Febrero, 2023 | Las naranjas</span>
                        <h2>Propiedades</h2>
                        <p>La naranja es una de las frutas mas populares, es un alimento muy rico en vitaminas, sales, minerales y azucares con propiedades beneficiosas para la salud aportando un valioso enriquecimiento a la dieta humana. </p>
                        <a href="#" class="post-link">Leer Más...</a>
                    </div>
                </article>
                <article class="post">
                    <div class="post-header">
                        <div class="post-img-2"></div>
                    </div>
                    <div class="post-body">
                        <span>10 Noviembre, 2023 | Las naranjas</span>
                        <h2>Beneficios</h2>
                        <p>Las naranjas son cítricos con un aporte interesante en nutrientes, entre los que destacan no solo vitaminas y minerales, sino también flavonoides y ácidos orgánicos que ayudan a completar sus destacadas propiedades para nuestra salud.</p>
                        <a href="#" class="post-link">Leer Más...</a>
                    </div>
                </article>
                <article class="post">
                    <div class="post-header">
                        <div class="post-img-3"></div>
                    </div>
                    <div class="post-body">
                        <span>5 Abril, 2024 | Las naranjas</span>
                        <h2>Variedadess</h2>
                        <p>Existe una gran cantidad de variedades de naranja que se diferencian principalmente por el sabor y la calidad del fruto. Las variedades o tipos de naranjas dulces se distribuyen en cuatro grupos.</p>
                        <a href="#" class="post-link">Leer Más...</a>
                    </div>
                </article>
            </div>
        </section>
    </body>

            
    </main>

    <footer>
       <!-- <p>Pie de página</p> -->
    </footer>
    
    <!-- Enlace a jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Enlace a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
