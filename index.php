<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <!-- Barra de navegación fija -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Librería</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php/registrarse.php">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php/iniciarSesion.php">Iniciar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content text-center">
            <h1 class="hero-title">Librería el tesoro del saber</h1>
            <p class="hero-p">"Descubre un mundo de conocimiento en *El Tesoro del Saber*. Tu portal hacia libros fascinantes, bestsellers, y recursos educativos. ¡Explora nuestras colecciones y encuentra tu próxima gran lectura!"</p>
            <div class="d-flex justify-content-center">
                <a href="php/registrarse.php" class="btn btn-primary me-2 custom-btn">Registrarse</a>
                <a href="php/iniciarSesion.php" class="btn btn-secondary custom-btn">Iniciar Sesión</a>
            </div>
        </div>
    </section>

    <div class="wall"></div>

    <!-- Carrusel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/fachadaLibreria.jpg" alt="First slide" data-bs-toggle="modal" data-bs-target="#modal1">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/anaqueles.jpg" alt="Second slide" data-bs-toggle="modal" data-bs-target="#modal2">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/salasLectura.jpg" alt="Third slide" data-bs-toggle="modal" data-bs-target="#modal3">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/secciones.jpg" alt="Fourth slide" data-bs-toggle="modal" data-bs-target="#modal4">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/biblioteca.jpg" alt="Five slide" data-bs-toggle="modal" data-bs-target="#modal5">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Modales -->
    <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body text-white" style="background-image: url('images/fachadaLibreria.jpg'); background-size: cover;">
                    <h1>Librería el tesoro del saber</h1>
                    <p>Fachada de la librería, el lugar donde comienza tu viaje de conocimiento.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body text-white" style="background-image: url('images/anaqueles.jpg'); background-size: cover;">
                    <h1>Anaqueles llenos de conocimiento</h1>
                    <p>Descubre nuestras estanterías repletas de joyas literarias.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body text-white" style="background-image: url('images/salasLectura.jpg'); background-size: cover;">
                    <h1>Salas de lectura</h1>
                    <p>Un espacio dedicado para disfrutar de una buena lectura.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body text-white" style="background-image: url('images/secciones.jpg'); background-size: cover;">
                    <h1>Secciones especializadas</h1>
                    <p>Encuentra libros especializados en diferentes áreas del conocimiento.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body text-white" style="background-image: url('images/biblioteca.jpg'); background-size: cover;">
                    <h1>Biblioteca</h1>
                    <p>Un lugar para aprender, investigar y crecer.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Primera Sección -->
    <div class="container mt-5">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3>Ciencia Ficción</h3>
                <img src="images/ficcion.jpg" alt="Género 1" class="img-fluid">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3>Libros de Historia</h3>
                <img src="images/historia.jpg" alt="Género 2" class="img-fluid">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3>Novelas Románticas</h3>
                <img src="images/novelas.jpg" alt="Género 3" class="img-fluid">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3>Miembros</h3>
                <p>Costo de membresía para adquirir libros a precios especiales.</p>
                <p>$100 anual</p>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3>Socios Platino</h3>
                <p>Beneficios exclusivos para socios platino.</p>
                <p>$250 anual</p>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3>Acceso Premium</h3>
                <p>Acceso ilimitado a todas las colecciones.</p>
                <p>$500 anual</p>
            </div>
        </div>
    </div>

    <!-- Segunda Sección -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3>Comentarios destacados</h3>
                <p>"Gran variedad de libros y excelente servicio al cliente!"</p>
                <p>— María López</p>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3>Opiniones de usuarios</h3>
                <p>"Un lugar perfecto para perderse entre libros y aprender."</p>
                <p>— Juan Pérez</p>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h3>Lo que dicen nuestros clientes</h3>
                <p>"Las membresías valen cada centavo. ¡Muy recomendadas!"</p>
                <p>— Ana García</p>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
