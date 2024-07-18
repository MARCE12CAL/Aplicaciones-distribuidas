$(document).ready(function() {
    function cargarEstadisticas() {
        $.ajax({
            url: '../../controllers/dashboard.controller.php',
            method: 'POST',
            data: { action: 'obtenerEstadisticas' },
            dataType: 'json',
            success: function(response) {
                $('#totalEventos').text(response.totalEventos);
                $('#totalParticipantes').text(response.totalParticipantes);
                $('#totalInscripciones').text(response.totalInscripciones);

                crearGraficoEventos(response.eventosRecientes);
                crearGraficoInscripciones(response.inscripcionesPorEvento);
            },
            error: function() {
                alert('Error al cargar las estadísticas');
            }
        });
    }

    function crearGraficoEventos(eventosRecientes) {
        const ctx = document.getElementById('eventosChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: eventosRecientes.map(evento => evento.nombre),
                datasets: [{
                    label: 'Eventos Recientes',
                    data: eventosRecientes.map(evento => evento.capacidad),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Capacidad de Eventos Recientes'
                    }
                }
            }
        });
    }

    function crearGraficoInscripciones(inscripcionesPorEvento) {
        const ctx = document.getElementById('inscripcionesChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: inscripcionesPorEvento.map(item => item.evento_nombre),
                datasets: [{
                    data: inscripcionesPorEvento.map(item => item.total_inscripciones),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Inscripciones por Evento'
                    }
                }
            }
        });
    }

    cargarEstadisticas();
});