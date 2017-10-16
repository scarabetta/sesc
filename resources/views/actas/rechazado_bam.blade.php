<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <p>Sr/a responsable del proyecto: {{ $expediente->proyecto_nombre }}</p>

        <p>Nos dirigimos a usted, a efectos de notificarle  lo resuelto por el Directorio 
        de este instituto BAMUSICA sobre el proyecto que ha presentado, el cual ha resultado denegado y 
        cuya fundamentación se transcribe a continuación:<br>
        {{ $acta_expediente->observaciones }}
        </p>

        <p>Sin más, lo saludamos atentamente.</p>
        <p>Administración <br> BAMUSICA</p>
   
    </body>
</html>


