@extends('layout_nosidebar')

@section('content')

<div style="display:none;" id="save-gedo-inprogress" class="flash-message">
    <p class="alert alert-success">Procesando el pedido...</p>
</div>
<div id="reunion-save-success" class="flash-message">
    <p class="alert alert-success">La reunión han sido cerrada con éxito. Para terminar, genere el acta y guarde el número de gedo</p>
</div>
<div style="display:none;" id="reunion-save-success" class="flash-message">
    <p class="alert alert-success">El número de GEDO ha sido guardado con éxito.</p>
</div>
<br>
<div style="display:none;" id="reunion-save-error" class="flash-message">
    <p class="alert alert-error">Ocurrió un error al intentar guardar, porfavor intente nuevamente.</p>
</div>
<div class="col-md-6">
  
<form role="form" method="post" enctype="multipart/form-data" action="{{ url('/reunion/terminar') }}" name="basic_validate" id="form_terminar" novalidate="novalidate">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="acta_id" value="{{ $acta->id }}">
  <div class="form-group">
    <label for="nro_acta">Número de acta</label>
    <input type="text" class="form-control" name="nro_acta" id="nro_acta" value="{{ $acta->nro_acta }}" placeholder="" disabled>
  </div>
  <div class="form-group">
    <label for="nro_acta">Acta firmada</label>
    <input type="file" class="form-control" id="acta_firmada" name="acta_firmada">
  </div>
</form>
<button id="terminar-acta" class="btn btn-md btn-success pull-right btn-actions">
    <i class="glyphicon glyphicon-add"></i> Cerrar acta
</button>
<a href="{{ url('/reunion/print/'. $acta->id) }}" target="_blank" class="btn btn-md btn-info btn-actions">
    <i class="glyphicon glyphicon-add"></i> Generar Acta
</a>
</div>
<div class="col-md-6">
<h3>Notificaciones</h3>
<ul>
  @foreach($acta->expedientes as $expediente)
    @if($expediente->pivot->estado != 3)
      <li><a href="{{ url('/reunion/print_notif/'. $acta->id .'/'. $expediente->id) }}">{{ $expediente->proyecto_nombre }}</a></li>
    @endif
  @endforeach
</ul>
</div>
<script type="text/javascript" src="{{ URL::asset('js/reuniones.js') }}"></script>

@stop
