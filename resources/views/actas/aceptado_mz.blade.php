<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <p>Buenos Aires, {{ $fecha_actual['dia'] }} de {{ $fecha_actual['mes'] }} de {{ $fecha_actual['year'] }}</p>

        <p><strong>Subgerencia Operativa de Regímenes de Promoción Cultural <br>
            Ministerio de Cultura - GCBA</strong></p>

        <p>El/la que suscribe {{ $coordinador->name }} {{ $coordinador->surename }}, se dirige a usted con el objeto de
            informar que el proyecto N° {{ $expediente->numero }}/RCP/{{ $fecha_actual['year'] }}, 
            correspondiente a la disciplina {{ $expediente->linea->nombre }}, denominado 
            {{ $expediente->proyecto_nombre }} ha sido declarado de interés cultural.</p>

        <p>Sin otro particular, saludo a Uds. atentamente.</p>
   
    </body>
</html>