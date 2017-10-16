<h3>Documentos</h3> <br>

<ul class="list-unstyled">
  @foreach($documentos as $document)
    <li><a href="{{ url('/expedientes/documento/'.$document->id) }}" target="_blank">{{ $document->nombre() }}</a></li>
  @endforeach
  
</ul>



