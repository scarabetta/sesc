<aside class="col-md-3">
  <div class="row">
      <ul class="nav nav-stacked nav-pills">
          @if(Auth::user()->hasDashboard())
          <li @if (Request::is('dashboard*')) class="active" @endif><a href="{{ url('dashboard') }}"><i class="glyphicon glyphicon-home"></i> <span>Dashboard</span></a> </li>
          @endif
          @if(Auth::user()->canViewBudget())
          <!--li @if (Request::is('presupuesto*')) class="active" @endif><a href="{{ url('/presupuesto') }}"><i class="glyphicon glyphicon-usd"></i> <span>Presupuesto</span></a> </li-->
          @endif
          @if(Auth::user()->canManageUsers())
            <li @if (Request::is('users*')) class="active" @endif><a href="{{ url('users') }}"><span class="glyphicon glyphicon-user"></span>&nbsp;  Usuarios</a></li>
          @endif
          
      </ul>
  </div>
</aside>
