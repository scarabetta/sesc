@extends('layout')

@section('content')    
<h5>Editar Usuario</h5>

<form role="form" method="post" action="{{ url('/users/update/'.$usuario->id) }}" name="basic_validate" id="basic_validate" novalidate="novalidate">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" name="email" id="email" value="{{ $usuario->email }}" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="required" value="" placeholder="">
  </div>
  <div class="form-group" id="select-titulo">
    <label for="exampleInputTitulo">Cargo</label>
    <input type="text" class="form-control" name="titulo" value="{{ $usuario->titulo }}" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" class="form-control" name="name" id="required" value="{{ $usuario->name }}" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Apellido</label>
    <input type="text" class="form-control" name="surename" id="required" value="{{ $usuario->surename }}" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Perfil</label>
    <select class="form-control" name="rol_id" id="select-perfil">
      @foreach($roles as $rol)
      <option value="{{$rol->id}}" {{($rol->id == $usuario->rol_id) ? 'selected' : ''}}>{{$rol->nombre}}</option>
      @endforeach
    </select>
  </div>
  <div id="usuario_sade" class="form-group">
    <label for="">Usuario en SADE</label>
    <input type="text" class="form-control" name="usuario_sade" value="{{ $usuario->usuario_sade }}" placeholder="">
  </div>
  <div class="form-group" id="select-fondo" style="display:none;">
    <label for="exampleInputEmail1">Fondo</label>
    <select class="form-control" name="fondo_id">
      @foreach($fondos as $fondo)
      <option value="{{$fondo->id}}" {{($fondo->id == $usuario->fondo_id) ? 'selected' : ''}}>{{$fondo->nombre}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group" id="select-permisos" style="display:none;">
    <div class="checkbox">
      <label>
        <input type="checkbox" name="vota" value="1" <?php echo !empty($usuario->vota) ? 'checked' : '' ?>> Vota
      </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="comenta" value="1" <?php echo !empty($usuario->comenta) ? 'checked' : '' ?>> Comenta
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-success">Guardar</button>
</form>

<script type="text/javascript">
  $(document).ready(function(){

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
    });
    
  });
</script>
@stop
