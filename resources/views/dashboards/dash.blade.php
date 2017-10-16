@extends('layout')

@section('content')
    <section>
        <div class="container">
          <div class="row row-shortcut">
            <a class="col-md-2 col-sm-6 shortcut" href="{{ url('/pro-teatro') }}">
              <span class="bg-blue-lt">
                <span class="glyphicon glyphicon-eye-open"></span>
              </span>
              <h3>Pro Teatro</h3>
              <p></p>
            </a>
            <a class="col-md-2 col-sm-6 shortcut" href="{{ url('/pro-danza') }}">
              <span class="bg-violet-lt">
                <span class="glyphicon glyphicon-user"></span>
              </span>
              <h3>Pro Danza</h3>
              <p></p>
            </a>
            <a class="col-md-2 col-sm-6 shortcut" href="{{ url('/ba-musica') }}">
              <span class="bg-warning-lt">
                <span class="glyphicon glyphicon-music"></span>
              </span>
              <h3>BA Música</h3>
              <p></p>
            </a>
          </div>
          <br>
        </div>
      </section>
      <hr />
    <br>
    <hr class="visible-xs visible-sm">
@endsection
