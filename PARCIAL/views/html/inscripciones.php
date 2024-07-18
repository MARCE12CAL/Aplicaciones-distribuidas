<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inscripciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../components/admin_navbar.php'; ?>

    <div class="container mt-4">
        <h2>Gestión de Inscripciones</h2>
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" id="busqueda" class="form-control" placeholder="Buscar inscripciones...">
            </div>
            <div class="col-md-6 text-end">
                <button id="btnNuevaInscripcion" class="btn btn-primary">Nueva Inscripción</button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Evento</th>
                    <th>Participante</th>
                    <th>Fecha de Inscripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaInscripciones">
                <!-- Aquí se cargarán las inscripciones dinámicamente -->
            </tbody>
        </table>
        <nav>
            <ul class="pagination" id="paginacion">
                <!-- Aquí se generará la paginación dinámicamente -->
            </ul>
        </nav>
    </div>

    <!-- Modal para crear/editar inscripciones -->
    <div class="modal fade" id="inscripcionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inscripcionModalLabel">Nueva Inscripción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="inscripcionForm">
                        <input type="hidden" id="inscripcionId">
                        <div class="mb-3">
                            <label for="evento" class="form-label">Evento</label>
                            <select id="evento" class="form-select" required>
                                <!-- Opciones de eventos se cargarán dinámicamente -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="participante" class="form-label">Participante</label>
                            <select id="participante" class="form-select" required>
                                <!-- Opciones de participantes se cargarán dinámicamente -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fechaInscripcion" class="form-label">Fecha de Inscripción</label>
                            <input type="date" class="form-control" id="fechaInscripcion" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="guardarInscripcion">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/inscripciones.js"></script>
</body>
</html>