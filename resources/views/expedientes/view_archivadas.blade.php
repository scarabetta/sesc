@extends('layout_nosidebar')

@section('content')

<div class="col-md-6">    
    <h3>{{ $expediente->proyecto_nombre }}</h3>
    
      <form role="form" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
        <div class="form-group">
          <label class="control-label">Línea</label>
            <input type="text" value="{{ $expediente->linea->nombre }}" class="form-control" name="required" id="required" disabled>
        </div>
        <div class="form-group">
          <label class="control-label">Número EE</label>
            <input type="text" value="{{ $expediente->numero }}" class="form-control" name="required" id="required" disabled>
        </div>
        <div class="form-group">
          <label class="control-label">Nombre del Responsable</label>
            <input type="text" value="{{ $expediente->responsable_nombre }}" class="form-control" name="required" id="required" disabled>
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
        @if(Auth::user()->canViewFinalBudget())
        <div class="form-group">
          <label class="control-label">Estado</label>
            <input type="text" value="Votación" class="form-control" name="number" id="number" disabled>
        </div>
        @endif
        <div class="form-group">
          <label class="control-label">Evaluacion</label>
            <input type="text" value="{{ $expediente->getResultadosEvaluacion() }}" class="form-control" name="number" id="number" disabled>
        </div>
      </form>

      
    
    <br>
</div>

<div class="col-md-6">  

  @include('expedientes.partials.documentos')
  
  <a href="{{ URL::previous() }}" class="btn btn-md btn-info pull-right btn-actions">
      <i class="glyphicon glyphicon-add"></i> Volver
  </a>
</div>
<script type="text/javascript" src="{{ URL::asset('js/votacion.js') }}"></script>
@stop
