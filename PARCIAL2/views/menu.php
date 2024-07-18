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
            background-color: #f0f0f0;
        }
        .navbar {
            background-color: #2196f3; /* Blue color */
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #03a9f4; /* Electric blue color */
            text-shadow: 0 0 10px #03a9f4;
        }
        .navbar-brand span {
            color: #03a9f4; /* Electric blue color */
            text-shadow: 0 0 10px #03a9f4;
        }
        .nav-link {
            color: #03a9f4; /* Electric blue color */
            text-shadow: 0 0 10px #03a9f4;
            transition: color 0.2s ease;
            padding: 10px 20px;
            border-radius: 10px;
        }
        .nav-link:hover {
            color: #fff;
            background-color: #03a9f4; /* Electric blue color */
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .nav-box {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .nav-box span {
            font-size: 18px;
            font-weight: bold;
            color: #03a9f4; /* Electric blue color */
            text-shadow: 0 0 10px #03a9f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-top: 20px;
        }
        h1 {
            font-weight: bold;
            color: #333;
        }
        p {
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="<?php echo $base_url; ?>index.php">
            <span>DEPORTIVO</span>
            <span>LIFE</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" id="eventosLink" href="<?php echo $base_url; ?>views/html/eventos.php">
                        <div class="nav-box">
                            <span>Eventos</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="participantesLink" href="<?php echo $base_url; ?>views/html/participantes.php">
                        <div class="nav-box">
                            <span>Participantes</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inscripcionesLink" href="<?php echo $base_url; ?>views/html/inscripciones.php">
                        <span>Inscripciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>index.php">
                        <div class="nav-box">
                            <span>Principal</span>
                        </div>
                    </a>
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
