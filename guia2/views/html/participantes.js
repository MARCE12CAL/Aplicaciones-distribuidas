$(document).ready(function() {
    let paginaActual = 1;
    const porPagina = 10;

    function cargarParticipantes(pagina = 1, busqueda = '') {
        $.ajax({
            url: '../../controllers/participantes.controller.php',
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
                response.participantes.forEach(participante => {
                    html += `
                        <tr>
                            <td>${participante.participante_id}</td>
                            <td>${participante.nombre}</td>
                            <td>${participante.apellido}</td>
                            <td>${participante.email}</td>
                            <td>${participante.telefono}</td>
                            <td>
                                <button class="btn btn-sm btn-primary editar-participante" data-id="${participante.participante_id}">Editar</button>
                                <button class="btn btn-sm btn-danger eliminar-participante" data-id="${participante.participante_id}">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#tablaParticipantes').html(html);

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
                alert('Error al cargar los participantes');
            }
        });
    }

    cargarParticipantes();

    $('#busqueda').on('keyup', function() {
        cargarParticipantes(1, $(this).val());
    });

    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        const pagina = $(this).data('pagina');
        cargarParticipantes(pagina, $('#busqueda').val());
    });

    $('#btnNuevoParticipante').on('click', function() {
        $('#participanteModalLabel').text('Nuevo Participante');
        $('#participanteForm')[0].reset();
        $('#participanteId').val('');
        $('#participanteModal').modal('show');
    });

    $(document).on('click', '.editar-participante', function() {
        const id = $(this).data('id');
        $.ajax({
            url: '../../controllers/participantes.controller.php',
            method: 'POST',
            data: {
                action: 'obtener',
                id: id
            },
            dataType: 'json',
            success: function(participante) {
                $('#participanteModalLabel').text('Editar Participante');
                $('#participanteId').val(participante.participante_id);
                $('#nombre').val(participante.nombre);
                $('#apellido').val(participante.apellido);
                $('#email').val(participante.email);
                $('#telefono').val(participante.telefono);
                $('#participanteModal').modal('show');
            },
            error: function() {
                alert('Error al cargar el participante');
            }
        });
    });

    $('#guardarParticipante').on('click', function() {
        const id = $('#participanteId').val();
        const nombre = $('#nombre').val();
        const apellido = $('#apellido').val();
        const email = $('#email').val();
        const telefono = $('#telefono').val();

        $.ajax({
            url: '../../controllers/participantes.controller.php',
            method: 'POST',
            data: {
                action: id ? 'actualizar' : 'crear',
                id: id,
                nombre: nombre,
                apellido: apellido,
                email: email,
                telefono: telefono
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#participanteModal').modal('hide');
                    cargarParticipantes(paginaActual, $('#busqueda').val());
                    alert(response.success);
                } else {
                    alert(response.error);
                }
            },
            error: function() {
                alert('Error al guardar el participante');
            }
        });
    });

    $(document).on('click', '.eliminar-participante', function() {
        if (confirm('¿Está seguro de que desea eliminar este participante?')) {
            const id = $(this).data('id');
            $.ajax({
                url: '../../controllers/participantes.controller.php',
                method: 'POST',
                data: {
                    action: 'eliminar',
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cargarParticipantes(paginaActual, $('#busqueda').val());
                        alert(response.success);
                    } else {
                        alert(response.error);
                    }
                },
                error: function() {
                    alert('Error al eliminar el participante');
                }
            });
        }
    });
});