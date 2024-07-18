<?php
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
</head>
<body>
    <?php include '../menu.php'; ?>

    <div class="container mt-4">
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