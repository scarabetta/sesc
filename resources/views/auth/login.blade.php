@extends('layout_simple')

@section('content')

<br><br>
<div class="panel panel-default">
  <div class="panel-body">

    @if (count($errors) > 0)
       <div class="alert alert-error alert-block"> 
        <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading">Error!</h4>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form class="form-horizontal" method="POST" action="{{ url('/auth/login') }}" role="form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input name="email" type="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{ old('email') }}">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Contraseña</label>
        <div class="col-sm-10">
          <input name="password" type="password" placeholder="Contraseña" class="form-control" id="inputPassword3">
        </div>
      </div>
      @if (!App::environment(['testing']))
      <div class="form-group">
        <label for="botDetect" class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          {!! captcha_image_html('LoginCaptcha') !!}
          <input type="text" id="validation" name="captcha">
        </div>
      </div>
      @endif
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>
      </div>
    </form>

  </div>
</div>
                  
@endsection
