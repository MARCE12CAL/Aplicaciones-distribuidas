<?php
$base_url = 'http://localhost:3000/PARCIAL2/';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="<?php echo $base_url; ?>index.php">DEPORTIVO LIFE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" id="eventosLink" href="<?php echo $base_url; ?>views/html/eventos.php">Eventos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="participantesLink" href="<?php echo $base_url; ?>views/html/participantes.php">Participantes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inscripcionesLink" href="<?php echo $base_url; ?>views/html/inscripciones.php">Inscripciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_url; ?>index.php">Principal</a>
            </li>
        </ul>
    </div>
</nav>