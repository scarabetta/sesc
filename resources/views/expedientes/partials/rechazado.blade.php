@if($expediente->estadoActual() == App\Expediente::ESTADO_RECHAZADO_CIUDADANO)

<span style="color:red;"><b>Atencion: El expediente fue rechazado por el ciudadano.</b></span><br>

@if($expediente->getMotivoDeRechazo() != '')
<span style="color:red;"><b>Motivo del rechazo: "{{ $expediente->getMotivoDeRechazo() }}"</b></span>
@endif
<br><br>
@endif