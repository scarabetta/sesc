@extends('layout_nosidebar')

@section('content')
      
        <h3 class="text-center">{{ strtoupper(Auth::user()->fondo->nombre) }}</h2>
          <p class="text-center">Montos asignados</p>

          <a href="{{ url('/') }}" class="btn btn-md btn-info pull-right btn-actions">
              <i class="glyphicon glyphicon-add" style="vertical-align:middle"></i> Volver
          </a>
          
          @if(Auth::user()->canEditBudget())
          <a href="{{ url('/montos/add') }}" class="btn btn-md btn-primary pull-right btn-actions">
              <i class="glyphicon glyphicon-add" style="vertical-align:middle"></i> Asignar monto
          </a>
          @endif
          <br>
          <br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed data-table">
                  <thead>
                    <tr>
                      <th>Año de asignación</th>
                      <th>Línea</th>
                      <th>Monto asignado</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                @foreach($presupuestos as $presupuesto)
                    <tr>
                      <td class="col-md-1">{{ $presupuesto->year }}</td>
                      <td class="col-md-1">{{ $presupuesto->linea->nombre }}</td>
                      <td>${{ number_format($presupuesto->monto, 2, ',', '') }}</td>
                    </tr>
                @endforeach
                    
                  </tbody>
                </table>
              </div>
              
    <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/matrix.tables.js') }}"></script>
@stop
