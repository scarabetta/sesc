<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h3>Acta N° {{ $acta->nro_acta }}</h3>
        <p>
            En la Ciudad de Buenos Aires, a los {{ $fecha_actual['dia'] }} días del mes de {{ $fecha_actual['mes'] }} del año 
            {{ $fecha_actual['year'] }}, y siendo las {{ $fecha_actual['hora'] }} hs se reúne el Directorio del Instituto Proteatro 
            con la presencia de
            @foreach ($acta->users as $key=>$presente) 
              {{ $presente->titulo }} {{ $presente->name }} {{ $presente->surename }}
              @if ($key < $jueces_total-2) , @endif 
              @if ($key == $jueces_total-2) y @endif
            @endforeach
            @if ($jueces_ausentes_total>0)
                encontrándose ausentes
                @foreach($jueces_ausentes as $key=>$ausente) 
                    {{ $ausente->name }} {{ $ausente->surename }}
                    @if ($key < $jueces_ausentes_total-2) , @endif 
                    @if ($key == $jueces_ausentes_total-2) y @endif 
                @endforeach
            @endif.
        </p>
        <?php $i = 1; ?>
            @foreach($fondo->lineas as $linea)
              @if($acta->countExpedientesLinea($linea->id) > 0 and $acta->countAceptadosLinea($linea->id) > 0)
                @if($linea->acceptsPlus())
                  @foreach($linea->extraOptions() as $keyOpcion=>$text)
                    @if($acta->countLineaPlus($linea->id, $keyOpcion) > 0)
                    <p>
                      <strong>{{ $i }}.- Aprobación de Subsidios a @if($linea->nombre != 'Salas Teatrales') {{ $linea->nombre }} @else Salas @endif {{ $text }}:</strong>
                      @if(($linea->nombre == 'Grupos Eventuales' || $linea->nombre == 'Grupos Estables') && $keyOpcion>0) 
                            Se da lectura a los  siguientes proyectos aprobados cuyo plus del {{$keyOpcion}}% {{ $text }} está incluido en los montos finales otorgados, y el mismo deberá ser depositado en Argentores. A saber: 
                      @else 
                            Se da lectura a los  siguientes proyectos aprobados:
                      @endif
                      @foreach($acta->expedientes as $expediente) 
                            @if($expediente->pivot->estado == $expedientes_estado_aceptado 
                                and $expediente->linea->id == $linea->id 
                                and $expediente->pivot->plus == $keyOpcion
                                and $expediente->cantidadDeRechazosCiudadano() == 0)
                                Proyecto N° {{ $expediente->numero }},
                                @if($expediente->nro_registro != '-')
                                    @if($linea->nombre != 'Salas Teatrales')
                                        grupo
                                    @endif
                                   {{$expediente->nro_registro}},
                                @endif
                                
                                @if($expediente->nombre_grupo != '-')
                                    “{{ $expediente->nombre_grupo }}”,
                                @endif
                                
                                @if($expediente->proyecto_nombre != '')
                                     @if($linea->nombre != 'Salas Teatrales')
                                        proyecto
                                     @else
                                        sala teatral
                                     @endif
                                     “{{ $expediente->proyecto_nombre }}”,
                                @endif
                                 representante responsable/legal {{ $expediente->responsable_nombre }}, 
                                DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le concede un monto de pesos {{ $expediente->monto_otorgado_letras() }} ( ${{ $expediente->monto_otorgado }}-);
                                @if($expediente->pivot->observaciones != '')
                                  *Observaciones: {{ $expediente->pivot->observaciones }};
                                @endif
                                <br>
                            @endif
                      @endforeach
                      <?php $i++; ?>
                    </p>
                    @endif
                  @endforeach
                @else
                  <p>
                    <strong>{{ $i }}.- Aprobación de Subsidios a @if($linea->nombre != 'Salas Teatrales') {{ $linea->nombre }}: @else Salas: @endif</strong>
                    Se da lectura a los  siguientes proyectos aprobados:
                    @foreach($acta->expedientes as $key=>$expediente) 
                        @if($expediente->pivot->estado == $expedientes_estado_aceptado 
                            and $expediente->linea->id == $linea->id
                            and $expediente->cantidadDeRechazosCiudadano() == 0)
                            Proyecto N° {{ $expediente->numero }},
                            @if($expediente->nro_registro != '-')
                                @if($linea->nombre != 'Salas Teatrales')
                                    grupo
                                @endif
                               {{$expediente->nro_registro}},
                            @endif
                            
                            @if($expediente->nombre_grupo != '-')
                                “{{ $expediente->nombre_grupo }}”,
                            @endif
                            
                            @if($expediente->proyecto_nombre != '')
                                 @if($linea->nombre != 'Salas Teatrales')
                                    proyecto
                                 @else
                                    sala teatral
                                 @endif
                                 “{{ $expediente->proyecto_nombre }}”,
                            @endif
                             representante responsable/legal {{ $expediente->responsable_nombre }}, 
                            DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le concede un monto de pesos {{ $expediente->monto_otorgado_letras() }} ( ${{ $expediente->monto_otorgado }}-);
                            @if($expediente->pivot->observaciones != '')
                              *Observaciones: {{ $expediente->pivot->observaciones }};
                            @endif
                            <br>
                        @endif
                    @endforeach
                    <?php $i++; ?>
                  </p>
                @endif
              @endif
            @endforeach

        @if($acta->countRechazados() > 0)
        <p>
          <strong>{{ $i }}.- Proyectos Denegados:</strong>Atendiendo diversas falencias en la presentación de documentación, lógica presupuestaria 
          y/o fundamentación conceptual, El Directorio decide  denegar las solicitudes mencionadas a continuación: <br>
          @foreach($fondo->lineas as $linea)
            @if($acta->countRechazadosLinea($linea->id) > 0)
              @if($linea->nombre != 'Salas Teatrales') {{ $linea->nombre }} @else Salas @endif:
              @foreach($acta->expedientes as $expediente)
                @if($expediente->pivot->estado == $expedientes_estado_rechazado 
                    and $expediente->linea->id == $linea->id
                    and $expediente->cantidadDeRechazosCiudadano() == 0)
                    Proyecto N° {{ $expediente->numero }},
                    @if($expediente->nro_registro != '-')
                        @if($linea->nombre != 'Salas Teatrales')
                            grupo
                        @endif
                       {{$expediente->nro_registro}},
                    @endif
                    
                    @if($expediente->nombre_grupo != '-')
                        “{{ $expediente->nombre_grupo }}”,
                    @endif
                    
                    @if($expediente->proyecto_nombre != '')
                         @if($linea->nombre != 'Salas Teatrales')
                            proyecto
                         @else
                            sala 
                         @endif
                         “{{ $expediente->proyecto_nombre }}”,
                    @endif
                    representante responsable/legal {{ $expediente->responsable_nombre }}, DNI N° {{ $expediente->responsable_dni }};
                    @if($expediente->pivot->observaciones != '')
                        Observaciones: {{ $expediente->pivot->observaciones }};
                    @endif
                  <br>
                @endif
              @endforeach
            @endif
          @endforeach
          <?php $i++; ?>
        </p>
        @endif
        
        @if($acta->countRectificados() > 0)
            <strong>Rectificación de Acta:</strong><br>
            @if($acta->countAceptadosRectificados() > 0)
            <strong>Proyectos rectificados aprobados</strong>
                <!-- Inicio aprobados rectificados -->
                @foreach($fondo->lineas as $linea)
                  @if($acta->countExpedientesLineaRectificados($linea->id) > 0 and $acta->countAceptadosLineaRectificados($linea->id) > 0)
                    @if($linea->acceptsPlus())
                      @foreach($linea->extraOptions() as $keyOpcion=>$text)
                        @if($acta->countLineaPlusRectificados($linea->id, $keyOpcion) > 0)
                        <p>
                          <strong>@if($linea->nombre != 'Salas Teatrales') {{ $linea->nombre }} @else Salas @endif {{ $text }}:</strong>
                          @foreach($acta->expedientes as $expediente) 
                                @if($expediente->pivot->estado == $expedientes_estado_aceptado 
                                    and $expediente->linea->id == $linea->id 
                                    and $expediente->pivot->plus == $keyOpcion
                                    and $expediente->cantidadDeRechazosCiudadano() > 0)
                                    Proyecto N° {{ $expediente->numero }},
                                    @if($expediente->nro_registro != '-')
                                        @if($linea->nombre != 'Salas Teatrales')
                                            grupo
                                        @endif
                                       {{$expediente->nro_registro}},
                                    @endif
                                    
                                    @if($expediente->nombre_grupo != '-')
                                        “{{ $expediente->nombre_grupo }}”,
                                    @endif
                                    
                                    @if($expediente->proyecto_nombre != '')
                                         @if($linea->nombre != 'Salas Teatrales')
                                            proyecto
                                         @else
                                            sala teatral
                                         @endif
                                         “{{ $expediente->proyecto_nombre }}”,
                                    @endif
                                     representante responsable/legal {{ $expediente->responsable_nombre }}, 
                                    DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le conceden pesos {{ $expediente->monto_otorgado_rectificado_letras() }} ( ${{ $expediente->monto_otorgado_rectificado() }}-) mediante Acta N° {{ $expediente->nro_acta_rectificada() }} monto que se rectifica por el de pesos {{ $expediente->monto_otorgado_letras() }} ( ${{ $expediente->monto_otorgado }}-);
                                    @if($expediente->pivot->observaciones != '')
                                        Motivo: {{ $expediente->pivot->observaciones }};
                                    @endif
                                    <br>
                                @endif
                          @endforeach
                        </p>
                        @endif
                      @endforeach
                    @else
                      <p>
                        <strong>@if($linea->nombre != 'Salas Teatrales') {{ $linea->nombre }}: @else Salas: @endif</strong>
                        @foreach($acta->expedientes as $key=>$expediente) 
                            @if($expediente->pivot->estado == $expedientes_estado_aceptado 
                                and $expediente->linea->id == $linea->id
                                and $expediente->cantidadDeRechazosCiudadano() > 0)
                                Proyecto N° {{ $expediente->numero }},
                                @if($expediente->nro_registro != '-')
                                    @if($linea->nombre != 'Salas Teatrales')
                                        grupo
                                    @endif
                                   {{$expediente->nro_registro}},
                                @endif
                                
                                @if($expediente->nombre_grupo != '-')
                                    “{{ $expediente->nombre_grupo }}”,
                                @endif
                                
                                @if($expediente->proyecto_nombre != '')
                                     @if($linea->nombre != 'Salas Teatrales')
                                        proyecto
                                     @else
                                        sala teatral
                                     @endif
                                     “{{ $expediente->proyecto_nombre }}”,
                                @endif
                                 representante responsable/legal {{ $expediente->responsable_nombre }}, 
                                DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le conceden pesos {{ $expediente->monto_otorgado_rectificado_letras() }} ( ${{ $expediente->monto_otorgado_rectificado() }}-) mediante Acta N° {{ $expediente->nro_acta_rectificada() }} monto que se rectifica por el de pesos {{ $expediente->monto_otorgado_letras() }} ( ${{ $expediente->monto_otorgado }}-);
                                @if($expediente->pivot->observaciones != '')
                                  Motivo: {{ $expediente->pivot->observaciones }};
                                @endif
                                <br>
                            @endif
                        @endforeach
                        <?php $i++; ?>
                      </p>
                    @endif
                  @endif
                @endforeach
                <!-- Fin aprobados rectificados -->
            @endif
            
            <!-- Inicio rechazados rectificados -->
            @if($acta->countRechazadosRectificados() > 0)
                  <strong>Proyectos rechazados</strong>
                  <p>
                  @foreach($fondo->lineas as $linea)
                    @if($acta->countRechazadosLineaRectificados($linea->id) > 0)
                      <strong>@if($linea->nombre != 'Salas Teatrales') {{ $linea->nombre }} @else Salas @endif:</strong>
                      @foreach($acta->expedientes as $expediente)
                        @if($expediente->pivot->estado == $expedientes_estado_rechazado 
                            and $expediente->linea->id == $linea->id
                            and $expediente->cantidadDeRechazosCiudadano() > 0)
                            Proyecto N° {{ $expediente->numero }},
                            @if($expediente->nro_registro != '-')
                                @if($linea->nombre != 'Salas Teatrales')
                                    grupo
                                @endif
                               {{$expediente->nro_registro}},
                            @endif
                            
                            @if($expediente->nombre_grupo != '-')
                                “{{ $expediente->nombre_grupo }}”,
                            @endif
                            
                            @if($expediente->proyecto_nombre != '')
                                 @if($linea->nombre != 'Salas Teatrales')
                                    proyecto
                                 @else
                                    sala 
                                 @endif
                                 “{{ $expediente->proyecto_nombre }}”,
                            @endif
                            representante responsable/legal {{ $expediente->responsable_nombre }}, DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le conceden pesos {{ $expediente->monto_otorgado_rectificado_letras() }} ( ${{ $expediente->monto_otorgado_rectificado() }}-) mediante Acta N° {{ $expediente->nro_acta_rectificada() }} monto que no será otorgado.
                            @if($expediente->pivot->observaciones != '')
                                Observaciones: {{ $expediente->pivot->observaciones }};
                            @endif
                          <br>
                        @endif
                      @endforeach
                    @endif
                  @endforeach
                  </p>
            @endif
            <!-- Inicio rechazados rectificados -->
        @endif
        
        Siendo las {{ date('H:i') }} hs se levanta la sesión quedando en reunirse el Directorio en fecha y hora a determinar.
        
        @foreach($filas_jueces as $presente) 
          <p>&nbsp;</p> <p>&nbsp;</p>
          <p>
          {{ $presente['titulo'] }} {{ $presente['name'] }} {{ $presente['surename'] }}
          </p>
        @endforeach
    </body>
</html>
