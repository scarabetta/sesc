@extends('layout')

@section('content')
      
        <h3 class="text-center">Administración de Usuarios</h2>
          <br>
            <a href="{{ url('users/add') }}" class="btn btn-md btn-primary pull-right" type="button">
              Nuevo usuario
              <span class="glyphicon glyphicon-add"></span>
            </a>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered data-table">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Cargo</th>
                      <th>Email</th>
                      <th>Fondo</th>
                      <th>Perfil</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($usuarios as $usuario)
                      <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->surename }}</td>
                        <td>{{ $usuario->titulo }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->rol->nombre != 'administrador' ? $usuario->fondo->nombre : '-' }}</td>
                        <td>{{ ucfirst($usuario->rol->nombre) }}</td>
                        <td>
                          <a href="{{ url('users/edit/'.$usuario->id) }}" class="btn btn-primary btn-rounded btn-xs btn-editar">Editar</a>
                          <a href="{{ url('users/delete/'.$usuario->id) }}" class="btn btn-danger btn-rounded btn-xs btn-eliminar">Eliminar</a>
                        </td>
                      </tr>
                    @endforeach
                    
                    
                  </tbody>
                </table>
              </div>

    <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/matrix.tables.js') }}"></script>
@endsection
