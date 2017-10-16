@extends('layout_nosidebar')

@section('content')

      
        <h3 class="text-center">{{ strtoupper(Auth::user()->fondo->nombre) }}</h2>
          <p class="text-center">Expedientes</p>
          <br>
          @if(Auth::user()->canGenerateMinute())
            @if($acta_abierta == -1)
            <button type="button" id="add-acta" class="btn btn-md btn-primary pull-right btn-actions">
                <i class="glyphicon glyphicon-add" style="vertical-align:middle"></i> Iniciar reunión
            </button>
            @else
            <a href="{{ url('/reunion/ver/'.$acta_abierta)}}" class="btn btn-md btn-primary pull-right btn-actions">
                <i class="glyphicon glyphicon-add" style="vertical-align:middle"></i> Continuar reunión
            </a>
            @endif
          @endif
          @if(Auth::user()->canViewBudget())
          <a href="{{ url('/montos') }}" class="btn btn-md btn-primary pull-right btn-actions">
              <i class="glyphicon glyphicon-add" style="vertical-align:middle"></i> Montos del fondo
          </a>
          <br>
          <br>
          @endif
        @include('expedientes.partials.tabs')
        <br>
        <br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed data-table">
                  <thead>
                    <tr>
                    @if(Auth::user()->canGenerateMinute())
                      <th> &nbsp; </th>
                    @endif
                      <th>Línea</th>
                      <th>Proyecto / Sala</th>
                      <th>Descripcion / Propuesta de programación</th>
                      <th>Fecha estimada de estreno</th>
                      @if(Auth::user()->canViewMontoSolicitado())
                      <th>Monto solicitado</th>
                      @endif
                      @if(Auth::user()->rol->nombre == 'coordinador')
                      <th>Evaluaciones</th>
                      @endif
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                @foreach($expedientes as $expediente)
                
                    @if($expediente->estadoActual() == App\Expediente::ESTADO_PENDIENTE ||
                    $expediente->estadoActual() == App\Expediente::ESTADO_RECHAZADO_CIUDADANO)
                        @if($expediente->estadoActual() == App\Expediente::ESTADO_RECHAZADO_CIUDADANO)
                        <tr style="color:red;">
                        @else
                        <tr>        
                        @endif             
                        @if(Auth::user()->canGenerateMinute())
                          <td><input class="select-exp" type="checkbox" value="{{ $expediente->id }}"></td>
                        @endif
                          <td class="col-md-1">{{ $expediente->linea->nombre }}</td>
                          <td class="col-md-2">{{ $expediente->proyecto_nombre }}</td>
                          <td>{{ substr($expediente->responsable_desc,0,100) }}...</td>
                          <td>{{ $expediente->fecha_presentacion }}</td>
                          @if(Auth::user()->canViewMontoSolicitado())
                            <td>${{ number_format($expediente->monto_solicitado, 2, ',', '') }}</td>
                          @endif
                          @if(Auth::user()->rol->nombre == 'coordinador')
                          <td>{{ $expediente->getResultadosEvaluacion() }}</td>
                          @endif
                          <td class="center">
                            <a href="{{ url('/expedientes/view/'.$expediente->id) }}" class="btn btn-warning btn-xs @if($expediente->enReunion()) disabled @endif"><span title="Ver expediente" class="glyphicon glyphicon-pencil"></span></a> &nbsp;
                            
                            <button class="btn btn-warning btn-xs" data-placement="left" data-title="Nota" data-toggle="popover" data-trigger="focus" data-content="{{$expediente->voto_comentario != '' ? $expediente->voto_comentario : "No hay comentarios" }}"><span title="Notas del expediente" class="glyphicon glyphicon-comment"></span></button>
                          </td>
                        </tr>
                    @endif
                @endforeach
                    
                  </tbody>
                </table>
              </div>

    <form id="form-exp" style="display:none" method="post" action="/reunion/crear">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dataTables.bootstrap.min.js') }}"></script>
    
    <script type="text/javascript" src="{{ URL::asset('js/matrix.tables.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/expedientes.list.js') }}"></script>
@stop
