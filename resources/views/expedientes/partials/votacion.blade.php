@if(Auth::user()->comenta || Auth::user()->vota)

    <h3>Evaluación del Proyecto</h3> 

    @if(Auth::user()->canViewMontoDisponible())
    <br>
    <div class="alert alert-success" role="alert">Monto disponible en la línea: ${{ $monto_disponible }}</div>
    <br>
    @endif
      
      <form role="form" method="post" action="{{ url('/expedientes/votar/' . $expediente->id) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="expediente_id" value="{{ $expediente->id }}">
    @if(Auth::user()->vota)
      @foreach($votacion_opciones as $opcion)
            <div class="form-group">
              <label class="control-label">{{ $opcion->pregunta }}</label>
              @if($opcion->tipo_rta != 'number' and $opcion->tipo_rta != 'monto')
                <select class="form-control" name="opcion[{{ $opcion->id }}]">
                    <option value="">Seleccione una opción</option>
                @foreach($opcion->opcionesRta() as $key=>$rta)
                  <option value="{{$key}}" {{ ((isset($respuestas[$opcion->id]) and $respuestas[$opcion->id]['respuesta'] == $key) ? 'selected' : '') }}>{{ ucfirst($rta) }} </option>
                @endforeach
                </select>
              @elseif($opcion->tipo_rta == 'number')
                <input type="number" min="1" max="10" value="{{ $respuestas[$opcion->id]['respuesta'] or 0 }}" class="form-control num-vote" id="required" name="opcion[{{ $opcion->id }}]">
              @else
                <div class="form-group">
                  <input type="text" class="form-control" name="monto" id="monto" value="{{ $voto_usuario->monto or '' }}" />
                </div>
              @endif
            </div>
        @endforeach
    @endif
    @if(Auth::user()->comenta)
        <div class="form-group">
          <label class="control-label">Comentario</label>
          <textarea class="form-control" name="comentario" rows="5">{{ $voto_usuario->comentario or '' }}</textarea>
        </div>
    @endif
        
        @foreach($otros_votos as $voto)
        <div class="form-group">
          <label class="control-label">{{ $voto->usuario->titulo }} {{ $voto->usuario->name }} {{ $voto->usuario->surename }} comentó:</label>
          {{ $voto->comentario }}
        </div>
        @endforeach
        
        @if(isset($opcion) && $opcion->tipo_rta == 'number')
        <div class="well well-sm text-right"><strong>Total:</strong> <span id="total-vote"></span></div>
        @endif
        
        @if(Auth::user()->vota)
        <button type="submit" class="btn btn-md btn-success pull-right btn-actions">
            <i class="glyphicon glyphicon-add" style="vertical-align:middle"></i> Votar
        </button> 
        @endif
      </form>
@endif
