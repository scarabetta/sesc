@extends('layout')

@section('content')

<h5>Generar Acta</h5>

  <form role="form" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
    <div class="form-group">
      <label class="control-label">Fecha de reunión</label>
        <input type="text" class="form-control" name="required" id="required">
    </div>
    <div class="form-group">
      <label class="control-label">Expediente</label>
        <input type="text" class="form-control" name="required" id="required" disabled>
    </div>
    <div class="form-group">
      <label class="control-label">Descripción</label>
      <textarea class="form-control" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label class="control-label">Expediente</label>
        <input type="text" class="form-control" name="required" id="required" disabled>
    </div>
    <div class="form-group">
      <label class="control-label">Descripción</label>
      <textarea class="form-control" rows="3"></textarea>
    </div>
  </form>
  <button class="btn btn-info">Guardar</button>
  <button class="btn btn-info">Guardar e Imprimir</button>

<br>

@endsection