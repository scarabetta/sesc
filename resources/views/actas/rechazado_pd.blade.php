<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <p>Buenos Aires, {{ $fecha_actual['dia'] }} de {{ $fecha_actual['mes'] }} de {{ $fecha_actual['year'] }}</p>

        <p><strong>Directorio del Instituto para el Fomento de la Actividad de la Danza No Oficial de la Ciudad de Buenos Aires (PRODANZA) Ministerio de Cultura - GCBA</strong></p>

        <p>El/la que suscribe {{ $coordinador->name }} {{ $coordinador->surename }}, se dirige a usted con el objeto de
            informar que el proyecto presentado por {{ $expediente->responsable_nombre }} fue desestimado por el
            Instituto Prodanza.</p>

        <p>Sin otro particular, saludo a Uds. atentamente.</p>
   
    </body>
</html>