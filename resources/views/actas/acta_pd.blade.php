<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h3>Acta</h3>
        <p>
            En la Ciudad de Buenos Aires, a {{ $fecha_actual['dia'] }} días del mes de {{ $fecha_actual['mes'] }}  de {{ $fecha_actual['year'] }}, y siendo las {{ $fecha_actual['hora'] }} hs, se reúne el Consejo de Promoción Cultural de la Ciudad Autónoma de Buenos Aires con la presencia de: @foreach($acta->users as $key=>$presente) {{ $presente->titulo }} {{ $presente->name }} {{ $presente->surename }}@if ($key < $jueces_total-2) , @endif @if ($key == $jueces_total-2) y @endif @endforeach. 
            @if ($jueces_ausentes_total>0)
                Se encontraban AUSENTES: 
                @foreach($jueces_ausentes as $key=>$ausente) {{ $ausente->titulo }} {{ $ausente->name }} {{ $ausente->surename }}
                @if ($key < $jueces_ausentes_total-2) , 
                @endif 
                @if ($key == $jueces_ausentes_total-2) y 
                @endif 
                @endforeach
            @endif 
            .
        </p>
        <p>
            <strong>1.- Proyectos Declarados de Interés Cultural:</strong>
            Habiéndose recibido los proyectos evaluados por los consejeros Alternos de la disciplina de 
            Patrimonio cultural y Publicaciones, Radio, tv y Sitios de Internet, los de Promoción Cultural 
            declara de interés cultural: 
              @foreach($acta->expedientes as $key=>$expediente) 
                @if ($expediente->pivot->estado == $expedientes_estado_aceptado) 
                  Proyecto N° {{ $expediente->numero }} /RPC/ {{ date('Y',strtotime($expediente->fecha_presentacion)) }}, “{{ $expediente->proyecto_nombre }}”, representante responsable {{ $expediente->responsable_nombre }}, DNI N° {{ $expediente->responsable_dni }}, CUIL N° {{ $expediente->responsable_cuil }}, se le concede la suma de {{ $expediente->monto_otorgado_letras() }} ( ${{ $expediente->monto_otorgado }}-)
                  @if($expediente->pivot->observaciones != '')
                    Observaciones: {{ $expediente->pivot->observaciones }};
                  @endif
                @endif 
              @endforeach
        </p>
        <p>
            <strong> 2. Proyectos No Declarados de Interés Cultural:</strong>
             los siguientes proyectos por los motivos que se consignan en las respectivas planillas de 
             evaluación, han sido rechazados por el Consejo de Promoción Cultural: 
             @foreach($acta->expedientes as $key=>$expediente) 
              @if ($expediente->pivot->estado == $expedientes_estado_rechazado) 
                Proyecto N° {{ $expediente->numero }} /RCP/ {{ date('Y',strtotime($expediente->fecha_presentacion)) }}, “{{ $expediente->proyecto_nombre }}” 
                @if($expediente->pivot->observaciones != '')
                  Observaciones: {{ $expediente->pivot->observaciones }};
                @endif
              @endif 
            @endforeach

        </p>
        
        @foreach($filas_jueces as $presente) 
          <p>&nbsp;</p> <p>&nbsp;</p>
          <p>
          {{ $presente['titulo'] }} {{ $presente['name'] }} {{ $presente['surename'] }}
          </p>
        @endforeach
    </body>
</html>
