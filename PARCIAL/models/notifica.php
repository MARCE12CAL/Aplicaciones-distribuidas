<?php
class Notificacion {
    public static function enviarConfirmacionInscripcion($email, $nombreParticipante, $nombreEvento, $fechaEvento) {
        $para = $email;
        $asunto = "Confirmación de Inscripción - $nombreEvento";
        $mensaje = "
        <html>
        <head>
            <title>Confirmación de Inscripción</title>
        </head>
        <body>
            <h2>¡Gracias por inscribirte, $nombreParticipante!</h2>
            <p>Tu inscripción para el evento '$nombreEvento' ha sido confirmada.</p>
            <p>Fecha del evento: $fechaEvento</p>
            <p>Esperamos verte pronto.</p>
        </body>
        </html>
        ";

        $cabeceras = "MIME-Version: 1.0" . "\r\n";
        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $cabeceras .= 'From: noreply@tudominio.com' . "\r\n";

        return mail($para, $asunto, $mensaje, $cabeceras);
    }

    public static function enviarRecordatorioEvento($email, $nombreParticipante, $nombreEvento, $fechaEvento) {
        $para = $email;
        $asunto = "Recordatorio de Evento - $nombreEvento";
        $mensaje = "
        <html>
        <head>
            <title>Recordatorio de Evento</title>
        </head>
        <body>
            <h2>Hola $nombreParticipante,</h2>
            <p>Te recordamos que el evento '$nombreEvento' se llevará a cabo pronto.</p>
            <p>Fecha del evento: $fechaEvento</p>
            <p>¡No te lo pierdas!</p>
        </body>
        </html>
        ";

        $cabeceras = "MIME-Version: 1.0" . "\r\n";
        $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $cabeceras .= 'From: noreply@tudominio.com' . "\r\n";

        return mail($para, $asunto, $mensaje, $cabeceras);
    }
}