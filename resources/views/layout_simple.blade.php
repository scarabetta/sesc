<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de Evaluación de Subsidios Culturales">
    <meta name="author" content="Gobierno de la Ciudad de Buenos Aires">
    <title>Sistema de Evaluación de Subsidios</title>
    <link href="{{ asset('css/bastrap3/favicon.ico') }}" rel="shortcut icon">
    <link href="{{ asset('css/bastrap3/favicon-mobile.png') }}" rel="shortcut icon">
    <link href="{{ asset('css/bastrap3/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bastrap3/bastrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">

    <!-- ESTILOS EXTRA -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
    @include('partials.header')

    <!-- CONTENIDO -->
    <main class="main-container no-padding-top" role="main">
      <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
            @yield('content')
            </div>
        </div>
      </div>
    </main>

    
    <!--Footer-part-->

    <footer>
      <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <a class="navbar-brand bac-footer" href="http://www.buenosaires.gob.ar" target="_blank"></a>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="sub-brand">
                <p>Sistema de Evaluación de Subsidios - Versión {{ Config::get('app.version') }}</p>
                <p>Dirección General Técnica Administrativa y Legal<br />
                <span class="text-muted">Ministerio de Cultura</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!--end-Footer-part-->
    
</body>
</html>
