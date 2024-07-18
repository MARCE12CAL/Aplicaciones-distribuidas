$(document).ready(function() {
    let paginaActual = 1;
    const porPagina = 10;

    function cargarEventos(pagina = 1, busqueda = '') {
        $.ajax({
            url: '../../controllers/eventos.controller.php',
            method: 'POST',
            data: {
                action: 'listar',
                pagina: pagina,
                porPagina: porPagina,
                busqueda: busqueda
            },
            dataType: 'json',
            success: function(response) {
                const eventos = response.eventos;
                let html = '';
                eventos.forEach(evento => {
                    html += `
                        <tr>
                            <td>${evento.evento_id}</td>
                            <td>${evento.nombre}</td>
                            <td>${evento.fecha}</td>
                            <td>${evento.ubicacion}</td>
                            <td>
                                <button class="btn btn-sm btn-info editar-evento" data-id="${evento.evento_id}">Editar</button>
                                <button class="btn btn-sm btn-danger eliminar-evento" data-id="${evento.evento_id}">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#tablaEventos').html(html);

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
              alert('Error al cargar los eventos');
          }
      });
  }

  cargarEventos();

  $('#busqueda').on('keyup', function() {
      cargarEventos(1, $(this).val());
  });

  $(document).on('click', '.page-link', function(e) {
      e.preventDefault();
      const pagina = $(this).data('pagina');
      cargarEventos(pagina, $('#busqueda').val());
  });

  $('#btnNuevoEvento').on('click', function() {
      $('#eventoModalLabel').text('Nuevo Evento');
      $('#eventoForm')[0].reset();
      $('#eventoId').val('');
      $('#eventoModal').modal('show');
  });

  $(document).on('click', '.editar-evento', function() {
      const id = $(this).data('id');
      $.ajax({
          url: '../../controllers/eventos.controller.php',
          method: 'POST',
          data: {
              action: 'obtener',
              id: id
          },
          dataType: 'json',
          success: function(evento) {
              $('#eventoModalLabel').text('Editar Evento');
              $('#eventoId').val(evento.evento_id);
              $('#nombre').val(evento.nombre);
              $('#fecha').val(evento.fecha);
              $('#ubicacion').val(evento.ubicacion);
              $('#descripcion').val(evento.descripcion);
              $('#eventoModal').modal('show');
          },
          error: function() {
              alert('Error al cargar el evento');
          }
      });
  });

  $('#guardarEvento').on('click', function() {
      const id = $('#eventoId').val();
      const nombre = $('#nombre').val();
      const fecha = $('#fecha').val();
      const ubicacion = $('#ubicacion').val();
      const descripcion = $('#descripcion').val();

      $.ajax({
          url: '../../controllers/eventos.controller.php',
          method: 'POST',
          data: {
              action: id ? 'actualizar' : 'crear',
              id: id,
              nombre: nombre,
              fecha: fecha,
              ubicacion: ubicacion,
              descripcion: descripcion
          },
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  $('#eventoModal').modal('hide');
                  cargarEventos(paginaActual, $('#busqueda').val());
                  alert(response.success);
              } else {
                  alert(response.error);
              }
          },
          error: function() {
              alert('Error al guardar el evento');
          }
      });
  });

  $(document).on('click', '.eliminar-evento', function() {
      if (confirm('¿Está seguro de que desea eliminar este evento?')) {
          const id = $(this).data('id');
          $.ajax({
              url: '../../controllers/eventos.controller.php',
              method: 'POST',
              data: {
                  action: 'eliminar',
                  id: id
              },
              dataType: 'json',
              success: function(response) {
                  if (response.success) {
                      cargarEventos(paginaActual, $('#busqueda').val());
                      alert(response.success);
                  } else {
                      alert(response.error);
                  }
              },
              error: function() {
                  alert('Error al eliminar el evento');
              }
          });
      }
  });
});