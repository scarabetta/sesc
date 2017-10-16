@extends('layout')

@section('content')    

<h5>Crear Usuario</h5>

<form role="form" method="post" action="{{ url('/users/save') }}" name="basic_validate" id="basic_validate" novalidate="novalidate">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" name="email" id="email" value="" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="required" value="" placeholder="">
  </div>
  <div class="form-group" id="select-titulo">
    <label for="exampleInputTitulo">Cargo</label>
    <input type="text" class="form-control" name="titulo" value="" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" class="form-control" name="name" id="required" value="" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Apellido</label>
    <input type="text" class="form-control" name="surename" id="required" value="" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Perfil</label>
    <select class="form-control" name="rol_id" id="select-perfil">
      @foreach($roles as $rol)
      <option value="{{$rol->id}}">{{$rol->nombre}}</option>
      @endforeach
    </select>
  </div>
  <div id="usuario_sade" style="display:none;" class="form-group">
    <label for="">Usuario en SADE</label>
    <input type="text" class="form-control" name="usuario_sade" value="" placeholder="">
  </div>
  <div class="form-group" id="select-fondo" style="display:none;">
    <label for="fondo_id">Fondo</label>
    <select id="select-fondo" class="form-control" name="fondo_id">
      @foreach($fondos as $fondo)
      <option value="{{$fondo->id}}">{{$fondo->nombre}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group" id="select-permisos" style="display:none;">
    <div class="checkbox">
      <label>
        <input type="checkbox" name="vota" value="1"> Vota
      </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="comenta" value="1"> Comenta
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-success">Guardar</button>
</form>
<script type="text/javascript">
  $(document).ready(function(){
    
    $('#select-perfil').change(function(){
      if($( "#select-perfil option:selected" ).text() !== 'administrador'){
        $('#select-fondo').show();
        $('#select-permisos').show();
        
        if($( "#select-perfil option:selected" ).text() == 'coordinador'){
            $('#usuario_sade').show();
        }
        
        if($( "#select-perfil option:selected" ).text() == 'juez'){
            $('#usuario_sade').hide();
        }
      
      }else{
        $('#select-fondo').hide();
        $('#select-permisos').hide();
        $('#usuario_sade').hide();
      }
    })
    
  });
</script>
@stop
