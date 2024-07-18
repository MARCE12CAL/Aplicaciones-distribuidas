$(document).ready(function() {
    let paginaActual = 1;
    const porPagina = 10;

    function cargarInscripciones(pagina = 1, busqueda = '') {
        $.ajax({
            url: '../../controllers/inscripciones.controller.php',
            method: 'POST',
            data: {
                action: 'listar',
                pagina: pagina,
                porPagina: porPagina,
                busqueda: busqueda
            },
            dataType: 'json',
            success: function(response) {
                let html = '';
                response.inscripciones.forEach(inscripcion => {
                    html += `
                        <tr>
                            <td>${inscripcion.inscripcion_id}</td>
                            <td>${inscripcion.evento_nombre}</td>
                            <td>${inscripcion.participante_nombre} ${inscripcion.participante_apellido}</td>
                            <td>${inscripcion.fecha_inscripcion}</td>
                            <td>
                                <button class="btn btn-sm btn-primary editar-inscripcion" data-id="${inscripcion.inscripcion_id}">Editar</button>
                                <button class="btn btn-sm btn-danger eliminar-inscripcion" data-id="${inscripcion.inscripcion_id}">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#tablaInscripciones').html(html);

                // Generar paginación
                let paginacionHtml = '';
                for (let i = 1; i <= response.totalPaginas; i++) {
                    paginacionHtml += `<li class="page-item ${i === response.paginaActual ? 'active' : ''}">
                        <a class="page-link" href="#" data-pagina="${i}">${i}</a>
                    </li>`;
                }
                $('#paginacion').html(paginacionHtml);
            },
            error: function() {
                alert('Error al cargar las inscripciones');
            }
        });
    }

    function cargarEventos() {
        $.ajax({
            url: '../../controllers/eventos.controller.php',
            method: 'POST',
            data: { action: 'listar' },
            dataType: 'json',
            success: function(response) {
                let html = '<option value="">Seleccione un evento</option>';
                response.eventos.forEach(evento => {
                    html += `<option value="${evento.evento_id}">${evento.nombre}</option>`;
                });
                $('#evento').html(html);
            },
            error: function() {
                alert('Error al cargar los eventos');
            }
        });
    }

    function cargarParticipantes() {
        $.ajax({
            url: '../../controllers/participantes.controller.php',
            method: 'POST',
            data: { action: 'listar' },
            dataType: 'json',
            success: function(response) {
                let html = '<option value="">Seleccione un participante</option>';
                response.participantes.forEach(participante => {
                    html += `<option value="${participante.participante_id}">${participante.nombre} ${participante.apellido}</option>`;
                });
                $('#participante').html(html);
            },
            error: function() {
                alert('Error al cargar los participantes');
            }
        });
    }

    cargarInscripciones();
    cargarEventos();
    cargarParticipantes();

    $('#busqueda').on('keyup', function() {
        cargarInscripciones(1, $(this).val());
    });

    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        const pagina = $(this).data('pagina');
        cargarInscripciones(pagina, $('#busqueda').val());
    });

    $('#btnNuevaInscripcion').on('click', function() {
        $('#inscripcionModalLabel').text('Nueva Inscripción');
        $('#inscripcionForm')[0].reset();
        $('#inscripcionId').val('');
        $('#inscripcionModal').modal('show');
    });

    $(document).on('click', '.editar-inscripcion', function() {
        const id = $(this).data('id');
        $.ajax({
            url: '../../controllers/inscripciones.controller.php',
            method: 'POST',
            data: {
                action: 'obtener',
                id: id
            },
            dataType: 'json',
            success: function(inscripcion) {
                $('#inscripcionModalLabel').text('Editar Inscripción');
                $('#inscripcionId').val(inscripcion.inscripcion_id);
                $('#evento').val(inscripcion.evento_id);
                $('#participante').val(inscripcion.participante_id);
                $('#fechaInscripcion').val(inscripcion.fecha_inscripcion);
                $('#inscripcionModal').modal('show');
            },
            error: function() {
                alert('Error al cargar la inscripción');
            }
        });
    });

    $('#guardarInscripcion').on('click', function() {
        const id = $('#inscripcionId').val();
        const evento_id = $('#evento').val();
        const participante_id = $('#participante').val();
        const fecha_inscripcion = $('#fechaInscripcion').val();

        $.ajax({
            url: '../../controllers/inscripciones.controller.php',
            method: 'POST',
            data: {
                action: id ? 'actualizar' : 'crear',
                id: id,
                evento_id: evento_id,
                participante_id: participante_id,
                fecha_inscripcion: fecha_inscripcion
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#inscripcionModal').modal('hide');
                    cargarInscripciones(paginaActual, $('#busqueda').val());
                    alert(response.success);
                } else {
                    alert(response.error);
                }
            },
            error: function() {
                alert('Error al guardar la inscripción');
            }
        });
    });

    $(document).on('click', '.eliminar-inscripcion', function() {
        if (confirm('¿Está seguro de que desea eliminar esta inscripción?')) {
            const id = $(this).data('id');
            $.ajax({
                url: '../../controllers/inscripciones.controller.php',
                method: 'POST',
                data: {
                    action: 'eliminar',
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarInscripciones(paginaActual, $('#busqueda').val());
                        alert(response.success);
                    } else {
                        alert(response.error);
                    }
                },
                error: function() {
                    alert('Error al eliminar la inscripción');
                }
            });
        }
    });
});