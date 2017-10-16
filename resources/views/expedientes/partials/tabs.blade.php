<ul class="nav nav-tabs">
  <li role="presentation" @if (Request::is('expedientes')) class="active" @endif><a href="{{ url('/expedientes') }}">Principal</a></li>
  <li role="presentation" @if (Request::is('expedientes/archivo')) class="active" @endif id="exp-archivo"><a href="{{ url('/expedientes/archivo') }}">Archivo</a></li>
</ul>
