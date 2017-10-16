<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <p style="text-align:center">
        <b>Instituto PROTEATRO</b> <br>
        <b>Ministerio de Cultura</b> <br>
        <b>Gobierno de la Ciudad de Buenos Aires</b> <br>
        </p>
        
        
        <b>Sr/a/Srta. {{ $expediente->responsable_nombre }} {{ $expediente->responsable_apellido }}</b><br>
        <b>Responsable del Proyecto: {{ $expediente->proyecto_nombre }}</b> <br>
        <b>Nº de EE: {{ $expediente->numero }}</b> <br>
        
        <p>
        Le informamos que el actual Directorio de ésta entidad decidió tras evaluarlo y por simple
        mayoría, otorgar un subsidio de pesos {{ $expediente->monto_otorgado_letras() }} ( ${{ $expediente->monto_otorgado }}-)
        al proyecto que usted presentó y representa.
        </p>
        
        <p>
        Al recibir esta notificación, deberá ingresar al sistema TAD (Tramitación a Distancia) en la
        solapa MIS TAREAS y completar en su totalidad el formulario, así como indicar si lo
        acepta o no, y los motivos en el supuesto caso de rechazarlo.
        </p>
        
        <p>
        De aceptarlo, deberá ingresar al siguiente link para sacar un turno que le otorgará la
        fecha para acercarse a firmar el contrato de concertación respectivo, en nuestra oficina de
        atención al público, en los días y horarios dedicados a tal fin.
        <a href="http://www.buenosaires.gob.ar/pedir-nuevo-turno?idPrestacion=1426">http://www.buenosaires.gob.ar/pedir-nuevo-turno?idPrestacion=1426</a>
        </p>
        <p>
        <b>En caso de tratarse de un grupo eventual y/o estable, debe hacerlo junto a un
        integrante de la Cooperativa avalada por la entidad Asociación Argentina de
        Actores, ambos con sus respectivos documentos de identidad, y teniendo en
        cuenta que deberá cargar en TAD (Trámite a distancia) la siguiente documentación
        de la <u>obra estrenada:</u></b>
        </p>
        
        <p>
        - Contrato con la sala o espacio teatral independiente, visado por la Asociación Argentina
        de Actores.<br>
        - Autorización o Registro de la obra emitido por Argentores. En este último caso cuando el
        autor es integrante de la cooperativa, <b>(NO el recibo de pago por inicio del trámite)</b>.<br>
        - Programa de mano con logo y leyenda de PROTEATRO incluido en la impresión del
        mismo, más recibo de ARGENTORES <b>(entregado a la Sala o Espacio teatral)</b> donde
        figure el período liquidado de la función de estreno. <b>(NO el que otorga la Sala o Espacio
        teatral)</b>.<br>
        - Copia de la habilitación o autorización para funcionar de la sala y/o espacio teatral donde
        se estrenó, expedida por la Dirección General de Habilitaciones y Permisos. <b>(SOLO en
        casos de salas o espacios teatrales NO registrados en este Instituto)</b>.<br>
        </p>
        
        <p>
        <b><u>IMPORTANTE:</u></b> Se le recuerda que al momento de suscribir el contrato de concertación y
        a partir de esa fecha, deberá efectuar la apertura / certificación de una caja de ahorros en
        el Banco de la Ciudad de Buenos Aires dentro de un plazo no mayor a cinco (5) días
        hábiles, tal como lo indica la cláusula quinta de dicho contrato.
        </p>
        
        <p>
        <b><u>ACLARACIÓN FINAL:</u></b> En el caso que usted no pueda cumplimentar con los requisitos
        citados anteriormente, lamentablemente, se procederá a dar de baja dicho subsidio.
        </b>
        </p>
        
        Lo/la saludamos atentamente.<br>
        Administración Instituto PROTEATRO<br>
   
    </body>
</html>
