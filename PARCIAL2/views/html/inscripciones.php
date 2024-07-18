<?php
$base_url = 'http://localhost:3000/PARCIAL2/';
require_once("../../controllers/inscripciones.controller.php");
require_once("../../controllers/eventos.controller.php");
require_once("../../controllers/participantes.controller.php");

$inscripcionesController = new InscripcionesController();
$eventosController = new EventosController();
$participantesController = new ParticipantesController();

$inscripciones = $inscripcionesController->listar();
$eventos = $eventosController->listar();
$participantes = $participantesController->listar();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inscripciones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestión de Inscripciones</h1>
        <button id="createInscripcionModal" class="btn btn-primary mb-3">Nueva Inscripción</button>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Participante</th>
                    <th>Evento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscripciones as $inscripcion): ?>
                <tr>
                    <td><?php echo $inscripcion['inscripcion_id']; ?></td>
                    <td><?php echo $inscripcion['nombre_participante']; ?></td>
                    <td><?php echo $inscripcion['nombre_evento']; ?></td>
                    <td>
                        <button onclick="editInscripcion(<?php echo $inscripcion['inscripcion_id']; ?>)" class="btn btn-sm btn-warning">Editar</button>
                        <button onclick="deleteInscripcion(<?php echo $inscripcion['inscripcion_id']; ?>)" class="btn btn-sm btn-danger">Eliminar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<!-- Botón para regresar al index -->
</div>   <a href="http://localhost:3000/index.php" class="btn btn-secondary mt-3">Regresar al Inicio</a>
</div>
    <!-- Modal para crear/editar inscripción -->
    <div class="modal fade" id="inscripcionModal" tabindex="-1" role="dialog" aria-labelledby="inscripcionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inscripcionModalLabel">Inscripción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="inscripcionForm">
                        <input type="hidden" id="inscripcion_id" name="inscripcion_id">
                        <div class="form-group">
                            <label for="participante_id">Participante</label>
                            <select class="form-control" id="participante_id" name="participante_id" required>
                                <?php foreach ($participantes as $participante): ?>
                                    <option value="<?php echo $participante['participante_id']; ?>"><?php echo $participante['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="evento_id">Evento</label>
                            <select class="form-control" id="evento_id" name="evento_id" required>
                                <?php foreach ($eventos as $evento): ?>
                                    <option value="<?php echo $evento['evento_id']; ?>"><?php echo $evento['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="saveInscripcion()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function editInscripcion(id) {
            $.ajax({
                url: '../controllers/inscripciones.controller.php',
                type: 'GET',
                data: { action: 'show', id: id },
                success: function(response) {
                    var inscripcion = JSON.parse(response);
                    $('#inscripcion_id').val(inscripcion.inscripcion_id);
                    $('#participante_id').val(inscripcion.participante_id);
                    $('#evento_id').val(inscripcion.evento_id);
                    $('#inscripcionModal').modal('show');
                }
            });
        }

        function saveInscripcion() {
            var formData = $('#inscripcionForm').serialize();
            var action = $('#inscripcion_id').val() ? 'update' : 'store';
            
            $.ajax({
                url: '../controllers/inscripciones.controller.php',
                type: 'POST',
                data: formData + '&action=' + action,
                success: function(response) {
                    $('#inscripcionModal').modal('hide');
                    location.reload();
                }
            });
        }

        function deleteInscripcion(id) {
            if (confirm('¿Está seguro de que desea eliminar esta inscripción?')) {
                $.ajax({
                    url: '../controllers/inscripciones.controller.php',
                    type: 'POST',
                    data: { action: 'destroy', id: id },
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        }

        $(document).ready(function() {
            $('#createInscripcionModal').click(function() {
                $('#inscripcionForm')[0].reset();
                $('#inscripcion_id').val('');
                $('#inscripcionModal').modal('show');
            });
        });
    </script>
    <!-- Justo antes del cierre del body -->
<script src="inscripciones.js"></script>

</body>
</html>