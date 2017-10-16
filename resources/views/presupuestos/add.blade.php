@extends('layout_nosidebar')

@section('content')    

<h5>Asignar monto</h5>

<form role="form" method="post" action="{{ url('/montos/save') }}" name="basic_validate" id="basic_validate" novalidate="novalidate">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  
  <div class="form-group">
    <label for="exampleInputEmail1">Año</label>
    <input type="number" class="form-control" readonly name="year" id="required" value="{{ date('Y') }}" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Monto asignado</label>
    <input type="number" class="form-control" name="monto" id="required" value="" placeholder="">
  </div>

  <div class="form-group" id="select-linea">
    <label for="exampleInputEmail1">Linea</label>
    <select class="form-control" name="linea_id">
      @foreach($lineas as $linea)
      <option value="{{$linea->id}}">{{$linea->nombre}}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-success">Asignar</button>
  <a href="{{ url('/montos') }}" class="btn btn-md btn-info pull-right btn-actions">
      <i class="glyphicon glyphicon-add" style="vertical-align:middle"></i> Volver
  </a>
</form>

@stop
