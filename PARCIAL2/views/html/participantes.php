<?php
$base_url = 'http://localhost:3000/PARCIAL2/';
require_once("../../controllers/participantes.controller.php");
$controller = new ParticipantesController();
$participantes = $controller->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Participantes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #4567b7; /* Blue background */
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .btn {
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            background-color: #2196f3; /* Blue color */
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #03a9f4; /* Electric blue color */
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .table {
            border-collapse: collapse;
            width: 100%;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f0f0f0;
        }
        .modal-content {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .modal-header {
            background-color: #2196f3; /* Blue color */
            color: #ffffff;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .modal-footer {
            background-color: #f0f0f0;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
        .return-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #2196f3; /* Blue color */
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="<?php echo $base_url;?>index.php">DEPORTIVO LIFE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" id="eventosLink" href="<?php echo $base_url;?>views/html/eventos.php">Eventos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="participantesLink" href="<?php echo $base_url;?>views/html/participantes.php">Participantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inscripcionesLink" href="<?php echo $base_url;?>views/html/inscripciones.php">Inscripciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url;?>index.php">Principal</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Gestión de Participantes</h2>
        <button class="btn btn-primary mb-3" id="btnAgregarParticipante">Agregar Participante</button>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaParticipantes">
                <?php foreach ($participantes as $participante): ?>
                <tr>
                    <td><?php echo $participante['participante_id']; ?></td>
                    <td><?php echo $participante['nombre']; ?></td>
                    <td><?php echo $participante['apellido']; ?></td>
                    <td><?php echo $participante['email']; ?></td>
                    <td><?php echo $participante['telefono']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-info editar-participante" data-id="<?php echo $participante['participante_id']; ?>">Editar</button>
                        <button class="btn btn-sm btn-danger eliminar-participante" data-id="<?php echo $participante['participante_id']; ?>">Eliminar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Botón para regresar al index -->
        <a href="http://localhost:3000/index.php" class="btn btn-secondary mt-3">Regresar al Inicio</a>
    </div>
    
    <!-- Modal para agregar/editar participante -->
    <div class="modal fade" id="participanteModal" tabindex="-1" role="dialog" aria-labelledby="participanteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="participanteModalLabel">Agregar Participante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="participanteForm">
                        <input type="hidden" id="participante_id" name="participante_id">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="guardarParticipante">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="participantes.js"></script>
</body>
</html>
