<?php
$base_url = 'http://localhost:3000/PARCIAL2/';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Eventos Deportivos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #007BFF; /* Fondo azul */
            color: #000000; /* Letras negras */
            font-family: 'Open Sans', sans-serif;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .navbar {
            background-color: #333;
            padding: 10px;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }
        .nav-link {
            color: #fff;
            font-weight: bold; /* Letras en negrita */
            transition: color 0.2s ease;
            background-color: #444; /* Fondo de las opciones */
            padding: 10px 20px; /* Espaciado interno */
            border-radius: 5px; /* Bordes redondeados */
            margin: 5px; /* Espaciado entre las opciones */
        }
        .nav-link:hover {
            color: #ccc;
            background-color: #555; /* Cambio de fondo al pasar el cursor */
        }
        h1 {
            font-weight: bold;
            color: #000; /* Letras negras */
        }
        p {
            font-size: 18px;
            color: #000; /* Letras negras */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="<?php echo $base_url; ?>index.php">DEPORTIVO LIFE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>views/html/eventos.php">Eventos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>views/html/participantes.php">Participantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>views/html/inscripciones.php">Inscripciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>http://localhost:3000/PARCIAL2/index.php">Principal</a>
                </li>
            </ul>
        </div>            
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Bienvenido al Sistema de Gestión de Eventos Deportivos</h1>
        <p class="lead text-center">Utiliza el menú superior para navegar por las diferentes secciones del sistema.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
