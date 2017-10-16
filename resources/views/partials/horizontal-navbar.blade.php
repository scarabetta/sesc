  <!-- NAVEGACIÓN PRINCIPAL -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="row">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
              <span class="sr-only">Cambiar navegación</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!--a class="navbar-brand" href="#" title="Gobierno Electrónico">Gobierno Electrónico</a-->
          </div>
          <div class="collapse navbar-collapse" id="main-nav">
            <ul class="nav navbar-nav navbar-right">
              @if(Auth::user() !== null)
                <li><a>Bienvenido, {{ Auth::user()->name }} {{ Auth::user()->surename }}</a></li>
              @endif
              <li><a href="{{ url('/auth/logout') }}">Salir</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- FIN DE NAVEGACIÓN PRINCIPAL -->
