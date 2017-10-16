<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <p align="center">Instituto PROTEATRO<br>
            Ministerio de Cultura<br>
            Gobierno de la Ciudad de Buenos Aires
        </p>

        <p><strong>Sr/a</strong> {{$expediente->responsable_nombre}}<br>
        <strong>Responsable del Proyecto: </strong> {{$expediente->proyecto_nombre }}
        </p>

        <p>Le informamos que el actual Directorio, haciendo uso de sus atribuciones y facultades como cuerpo colegiado qué dictamina cualquier tipo de erogación que realiza este Instituto, decidió en reunión y por simple mayoría, según consta en Actas, denegar su solicitud de subsidio.<br>
        {{ $acta_expediente->observaciones }}

        <p>Sin otro particular, lo/a saludamos atte.</p>

        <p>
            Administración <br> Instituto PROTEATRO
        </p>
   
    </body>
</html>