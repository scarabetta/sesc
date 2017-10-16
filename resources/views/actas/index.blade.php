@extends('layout_nosidebar')

@section('content')

{{ Session::get('error_monto') }}
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            @if(Auth::user()->fondo->codigo == 'PRT' || Auth::user()->fondo->codigo == 'BAM')
                Directorio
            @else
                Jueces
            @endif
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        <!-- Tabla jueces -->
        <input type="hidden" class="doClose" name="close" value="0">
        <table class="table table-striped">
          <thead>
              <th> &nbsp; </th>
              <th> Nombre </th>
              <th> Cargo </th>
              <th> Usuario</th>
          </thead>
          <tbody>
            @foreach($jueces as $juez)
              <tr>
                  <td><input {{ ($juez->id == $coordinador->id) ? "disabled" : "" }} {{ in_array($juez->id,$jueces_seleccionados) || ($juez->id == $coordinador->id) ? "checked='true'" : "" }} type="checkbox" name="jueces[{{ $juez->juez_id }}]" value="{{ $juez->juez_id }}"></td>
                  <td>{{ $juez->surename }}, {{ $juez->name }} </td>
                  <td>{{ $juez->titulo }}</td>
                  <td>{{ $juez->email }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Votación
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body" id="expedientes">
        <!-- Tabla expedientes -->
        <table class="table table-striped">
          <thead>
            <tr>
                <th> &nbsp; </th>
              <th>Línea</th>
              <th>Proyecto</th>
              <!--th>Descripcion</th-->
              @if(Auth::user()->fondo->codigo != 'PRD')
              <th>Fecha Estimada de Presentación</th>
              @endif
              <th>Monto solicitado</th>
              <th>Promedio</th>
              @if(Auth::user()->fondo->codigo == 'PRD')
                <th>N° de registro</th>
              @endif  
              <th> Resolución </th>
              <th>Observaciones</th>
            </tr>
          </thead>
          <tbody>
              
        @foreach($expedientes as $expediente)
            @if($expediente->estadoActual() == App\Expediente::ESTADO_RECHAZADO_CIUDADANO)
            <tr style="color:red;">
            @else
            <tr>        
            @endif
              <td class="center">
                <a href="{{ url('/expedientes/archivado/'.$expediente->id) }}" target="_blank" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a> &nbsp;
              </td>
              <td class="col-md-1">{{ $expediente->linea->nombre }}</td>
              <td class="col-md-2">{{ $expediente->proyecto_nombre }}</td>
              <!--td>{{ $expediente->responsable_desc }}</td-->
              @if(Auth::user()->fondo->codigo != 'PRD')
              <td>{{ $expediente->fecha_presentacion }}</td>
              @endif
              <td>${{ number_format($expediente->monto_solicitado, 2, ',', '') }}</td>
              <td>{{ $expediente->getResultadosEvaluacion() }}</td>
              @if(Auth::user()->fondo->codigo == 'PRD')
                <th><input type="text" size="7" value="{{ $expediente->pivot->nroregistro }}" name="expedientes_nroregistro[{{ $expediente->id }}]"\></th>
              @endif
              <td class="col-md-2">
                <select class="form-control input-sm select-state expedientes_estados" data-expediente-id="{{ $expediente->id }}" data-linea-id="{{ $expediente->linea->id }}" name="expedientes_estados[{{ $expediente->id }}]">
                    @if($expediente->cantidadDeRechazosCiudadano() > 1)
                        <option selected value="2" data-exp="{{ $expediente->id }}">Rechazado por ciudadano</option>
                    @else
                        <option {{ $expediente->pivot->estado == 3 ? "selected" : "" }} value="3" data-exp="{{ $expediente->id }}">Pendiente</option>
                        <option {{ $expediente->pivot->estado == 1 ? "selected" : "" }} value="1" data-exp="{{ $expediente->id }}">Aceptado</option>
                        <option {{ $expediente->pivot->estado == 2 ? "selected" : "" }} value="2" data-exp="{{ $expediente->id }}">Rechazado</option>
                      @if(Auth::user()->fondo->acceptsSubstitute())
                        <option {{ $expediente->pivot->estado == 4 ? "selected" : "" }} value="4" data-exp="{{ $expediente->id }}">Suplente</option>
                      @endif
                  @endif
                </select>
                <input class="form-control input-sm" type="text" name="expedientes_montos[{{ $expediente->linea->id }}][{{ $expediente->id }}]" placeholder="monto" value="{{ $expediente->monto_otorgado }}" {{ $expediente->pivot->estado != 1 ? 'disabled' : ''}}>
              @if($expediente->linea->acceptsPlus())
              <select class="form-control input-sm select-state" name="expedientes_plus[{{ $expediente->id }}]">
                @foreach($expediente->linea->extraOptions() as $key=>$opcion)
                  <option {{ $expediente->pivot->plus == $key ? "selected" : "" }}  value="{{$key}}" data-exp="{{ $expediente->id }}">{{ $key }}%</option>
                @endforeach
              </select>
              @endif
              </td>
              <td>
                <textarea name="expedientes_observaciones[{{ $expediente->id }}]">{{ $expediente->pivot->observaciones }}</textarea>
              </td>
            </tr>
        @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
  
</div>

<a id="print_acta" class="btn btn-md btn-info btn-actions">
    <i class="glyphicon glyphicon-add"></i> Previsualizar acta
</a>
<a href="{{ url('/reunion/votos_excel/'. $acta_id) }}" id="exportar-votos" class="btn btn-md btn-info btn-actions">
    <span class="glyphicon glyphicon-add"></span> Exportar votos
</a>
<a href="{{ url('/expedientes') }}" class="btn btn-md btn-info btn-actions">
    <i class="glyphicon glyphicon-add"></i> Volver
</a>

<a href="{{ url('/reunion/cancelar/'. $acta_id) }}" id="cancelar-reunion" class="btn btn-md btn-danger btn-actions">
    <span class="glyphicon glyphicon-add"></span> Cancelar Reunión
</a>
<button id="close-acta" class="btn btn-md btn-success pull-right btn-actions">
    <i class="glyphicon glyphicon-add"></i> Cerrar Reunión
</button>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" id="acta_id" name="acta_id" value="{{ $acta_id }}">
<input type="hidden" id="url_root" value="{{ URL::to('/') }}">

<button id="save-acta" class="btn btn-md btn-success pull-right btn-actions">
    <i class="glyphicon glyphicon-add"></i> Guardar
</button>


<script type="text/javascript" src="{{ URL::asset('js/reuniones.js') }}"></script>

@stop
