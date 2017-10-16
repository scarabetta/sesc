@extends('layout_nosidebar')

@section('content')

      
        <h3 class="text-center">{{ strtoupper(Auth::user()->fondo->nombre) }}</h2>
          <p class="text-center">Expedientes</p>
          <br>

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
                    <!-- TODO: si es suplente poner check que permita resetear estado -->
                      <th>Línea</th>
                      <th>Proyecto</th>
                      <th>Descripcion</th>
                      @if(Auth::user()->fondo->codigo != 'PRD')
                      <th>Fecha Estimada de Presentación</th>
                      @endif
                      <th>Monto asignado</th>
                      <th>Estado</th>
                      <th>Datos</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                @foreach($expedientes as $expediente)
                  @if($expediente->estadoActual() != App\Expediente::ESTADO_RECHAZADO_CIUDADANO)
                    <tr>
                      <td class="col-md-1">{{ $expediente->linea->nombre }}</td>
                      <td class="col-md-2">{{ $expediente->proyecto_nombre }}</td>
                      <td>{{ substr($expediente->responsable_desc,0,100) }}...</td>
                      @if(Auth::user()->fondo->codigo != 'PRD')
                      <td>{{ $expediente->fecha_presentacion }}</td>
                      @endif
                      <td>${{ number_format($expediente->monto_otorgado, 2, ',', '') }}</td>
                      <td>{{ $expediente->getEstadoActa($expediente->estadoActual()) }}</td>
                      <td class="col-md-2 center">
                        <strong>N° acta</strong>: {{$expediente->getUltimoTratamientoReunion()->nro_acta}}<br>
                        <strong>N° GEDO</strong>: {{$expediente->getUltimoTratamientoReunion()->nro_gedo}}<br>
                        <a href="{{ url('/reunion/print/'. $expediente->getUltimoTratamientoReunion()->acta_id) }}" target="_blank" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-print"></span></a>
                        <a href="{{ url('/expedientes/archivado/'.$expediente->id) }}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a> &nbsp;
                        
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
