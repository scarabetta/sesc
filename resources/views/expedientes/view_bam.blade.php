@extends('layout_nosidebar')

@section('content')

<div class="col-md-6">    
    <h3>Ficha</h3>

    @include('expedientes.partials.rechazado')
    
      <form role="form" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
        <div class="form-group">
          <label class="control-label">Número de Expediente</label>
            <input type="text" value="{{ $expediente->numero }}" class="form-control" name="required" id="required" disabled>
        </div>
        <div class="form-group">
          <label class="control-label">Nombre del proyecto</label>
            <input type="text" value="{{ $expediente->proyecto_nombre }}" class="form-control" name="required" id="required" disabled>
        </div>
        <div class="form-group">
          <label class="control-label">Línea</label>
            <input type="text" value="{{ $expediente->linea->nombre }}" class="form-control" name="required" id="required" disabled>
        </div>
        <div class="form-group">
          <label class="control-label">Nombre del Músico / Grupo / Club de Música</label>
            <input type="text" value="{{ $expediente->nombre_grupo }}" class="form-control" name="required" id="required" disabled>
        </div>
        <div class="form-group">
          <label class="control-label">Descripción</label>
            <textarea class="form-control" name="required" id="required" disabled>{{ $expediente->responsable_desc }}</textarea>
        </div>
        @if(Auth::user()->fondo->codigo != 'PRD')
        <div class="form-group">
          <label class="control-label">Fecha Estimada de Presentación</label>
            <input type="text" value="{{ $expediente->fecha_presentacion }}" class="form-control" name="number" id="number" disabled>
        </div>
        @endif
        <div class="form-group">
          <label class="control-label">Monto solicitado</label>
            <input type="text" value="${{ $expediente->monto_solicitado }}" class="form-control" name="number" id="number" disabled>
        </div>
        @if(Auth::user()->canViewFinalBudget())
        <div class="form-group">
          <label class="control-label">Monto final</label>
            <input type="text" value="${{ $expediente->monto_otorgado }}" class="form-control" name="number" id="number" disabled>
        </div>
        @endif
        <div class="form-group">
          <label class="control-label">Voto promedio</label>
            <input type="text" value="{{ $expediente->getResultadosEvaluacion() }}" class="form-control" name="number" id="number" disabled>
        </div>
      </form>
      @if(!isset($archivo))
        <br><br>
        @include('expedientes.partials.documentos')
      @endif
</div>

<div class="col-md-6">  
  <a href="{{ url('/expedientes') }}" class="btn btn-md btn-info pull-right btn-actions">
      <i class="glyphicon glyphicon-add"></i> Volver
  </a>
  @if(!isset($archivo))
    @include('expedientes.partials.votacion')
  @else
    <a href="{{ url('/reunion/votos_excel/'. $expediente->getUltimaReunion() ) }}" id="exportar-votos" class="btn btn-md btn-info pull-right btn-actions">
        <span class="glyphicon glyphicon-add"></span> Votos de la reunión
    </a>
    @include('expedientes.partials.documentos')

  @endif
  <br><br>
</div>
<script type="text/javascript" src="{{ URL::asset('js/votacion.js') }}"></script>
@stop
