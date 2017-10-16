<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h3>Acta N° {{ $acta->nro_acta }}</h3>
        <p>
            En la Ciudad de Buenos Aires, a los {{ $fecha_actual['dia'] }} días del mes de {{ $fecha_actual['mes'] }} del año 
            {{ $fecha_actual['year'] }}, y siendo las {{ $fecha_actual['hora'] }} hs., se reúne el Directorio del Instituto BAMUSICA 
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
                <p>
                    <strong>{{ $i }}.- Proyectos de 
                    @if($linea->nombre == 'Club de Música') 
                      Clubes de Música en vivo
                    @elseif($linea->nombre == 'Músico Solista')
                     Músicos Solistas
                    @elseif($linea->nombre == 'Grupo de Músicos estable')
                     Grupos de Músicos estables
                    @endif 
                    aprobados:</strong>
                     
                    
                    @if($linea->nombre == 'Club de Música')
                    Habiéndose evaluado las solicitudes de subsidios por gastos de funcionamiento de los Clubes de Música en vivo que se detallan a continuación, se aprueban con las observaciones que se estiman pertinentes, los que se detallan a continuación:
                    @elseif($linea->nombre == 'Músico Solista')
                    Habiéndose evaluado las solicitudes de subsidios presentados por los Músicos Solistas, se aprueban los que se detallan a continuación:
                    @elseif($linea->nombre == 'Grupo de Músicos estable')
                    Habiéndose evaluado las solicitudes de subsidios presentados por los Grupos de Músicos estables, se aprueban los que se detallan a continuación:
                    @endif


                    @foreach($acta->expedientes as $key=>$expediente) 
                      @if($expediente->pivot->estado == $expedientes_estado_aceptado and $expediente->linea->id == $linea->id)

                        @if($linea->nombre == 'Club de Música') 
                           Proyecto N° {{ $expediente->numero }}, código de registro en BAMUSICA {{ $expediente->nro_registro }}, establecimiento “{{ $expediente->nombre_grupo }}”, cuyo titular es “{{ $expediente->responsable_nombre }}”, DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le conceden pesos {{ $expediente->monto_otorgado_letras() }} ( ${{ $expediente->monto_otorgado }}-)
                          @if($expediente->pivot->observaciones != '')
                            Observaciones: {{ $expediente->pivot->observaciones }};
                          @endif
                        @endif

                        @if($linea->nombre == 'Músico Solista' || $linea->nombre == 'Grupo de Músicos estable') 
                           Proyecto N° {{ $expediente->numero }}, código de registro en BAMUSICA {{ $expediente->nro_registro }}, titular “{{ $expediente->nombre_grupo }}”, cuyo nombre es “{{ $expediente->responsable_nombre }}”, DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le conceden pesos {{ $expediente->monto_otorgado_letras() }} ( ${{ $expediente->monto_otorgado }}-)
                          @if($expediente->pivot->observaciones != '')
                            Observaciones: {{ $expediente->pivot->observaciones }};
                          @endif
                        @endif

                      @endif
                    @endforeach
                    <?php $i++; ?>
                </p>
              @endif
            @endforeach

        @if($acta->countRechazados() > 0)
        <p>
          <strong>{{ $i }}.- Proyectos desaprobados:</strong>A continuación se detallan los proyectos desaprobados: <br>
          @foreach($fondo->lineas as $linea)
            @if($acta->countRechazadosLinea($linea->id) > 0)
              @if($linea->nombre == 'Club de Música') 
                Clubes de Música en vivo
              @elseif($linea->nombre == 'Músico Solista')
               Músicos Solistas
              @elseif($linea->nombre == 'Grupo de Músicos estable')
               Grupos de Músicos estables
              @endif:
              @foreach($acta->expedientes as $expediente)
                @if($expediente->pivot->estado == $expedientes_estado_rechazado and $expediente->linea->id == $linea->id)

                  

                  @if($linea->nombre == 'Club de Música')
                    Proyecto N° {{ $expediente->numero }}, código de registro en BAMUSICA {{ $expediente->nro_registro }}, establecimiento “{{ $expediente->nombre_grupo }}”, cuyo titular es “{{ $expediente->responsable_nombre }}”, DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }};
                  @else
                    Proyecto N° {{ $expediente->numero }}, código de registro en BAMUSICA {{ $expediente->nro_registro }}, titular “{{ $expediente->nombre_grupo }}”, cuyo nombre es “{{ $expediente->responsable_nombre }}”, DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }};
                  @endif

                  @if($expediente->pivot->observaciones != '')
                    Motivo: {{ $expediente->pivot->observaciones }};
                  @endif

                @endif
              @endforeach
            @endif
          @endforeach
        </p>
        @endif
        
        <!-- Inicio rectificaciones -->
        @if($acta->countRectificados() > 0)
            <strong>Rectificación de Acta:</strong><br>
            @if($acta->countAceptadosRectificados() > 0)
                <strong>Proyectos rectificados aprobados</strong><br>
                <?php $i = 1; ?>
                    @foreach($fondo->lineas as $linea)
                      @if($acta->countExpedientesLineaRectificados($linea->id) > 0 and $acta->countAceptadosLineaRectificados($linea->id) > 0)
                        <p>
                            <strong>{{ $i }}.- Proyectos de 
                            @if($linea->nombre == 'Club de Música') 
                              Clubes de Música en vivo
                            @elseif($linea->nombre == 'Músico Solista')
                             Músicos Solistas
                            @elseif($linea->nombre == 'Grupo de Músicos estable')
                             Grupos de Músicos estables
                            @endif 
                            aprobados:</strong>
                             
                            
                            @if($linea->nombre == 'Club de Música')
                            Habiéndose evaluado las solicitudes de subsidios por gastos de funcionamiento de los Clubes de Música en vivo que se detallan a continuación, se aprueban con las observaciones que se estiman pertinentes, los que se detallan a continuación:
                            @elseif($linea->nombre == 'Músico Solista')
                            Habiéndose evaluado las solicitudes de subsidios presentados por los Músicos Solistas, se aprueban los que se detallan a continuación:
                            @elseif($linea->nombre == 'Grupo de Músicos estable')
                            Habiéndose evaluado las solicitudes de subsidios presentados por los Grupos de Músicos estables, se aprueban los que se detallan a continuación:
                            @endif


                            @foreach($acta->expedientes as $key=>$expediente) 
                              @if($expediente->pivot->estado == $expedientes_estado_aceptado and $expediente->linea->id == $linea->id and $expediente->cantidadDeRechazosCiudadano() > 0))

                                @if($linea->nombre == 'Club de Música') 
                                   Proyecto N° {{ $expediente->numero }}, código de registro en BAMUSICA {{ $expediente->nro_registro }}, establecimiento “{{ $expediente->nombre_grupo }}”, cuyo titular es “{{ $expediente->responsable_nombre }}”, DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le conceden pesos {{ $expediente->monto_otorgado_rectificado_letras() }} ( ${{ $expediente->monto_otorgado_rectificado() }}-) mediante Acta N° {{ $expediente->nro_acta_rectificada() }} monto que se rectifica por el de pesos {{ $expediente->monto_otorgado_letras() }} ( ${{ $expediente->monto_otorgado }}-)
                                  @if($expediente->pivot->observaciones != '')
                                    Motivo: {{ $expediente->pivot->observaciones }};
                                  @endif
                                @endif

                                @if($linea->nombre == 'Músico Solista' || $linea->nombre == 'Grupo de Músicos estable') 
                                   Proyecto N° {{ $expediente->numero }}, código de registro en BAMUSICA {{ $expediente->nro_registro }}, titular “{{ $expediente->nombre_grupo }}”, cuyo nombre es “{{ $expediente->responsable_nombre }}”, DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le conceden pesos {{ $expediente->monto_otorgado_rectificado_letras() }} ( ${{ $expediente->monto_otorgado_rectificado() }}-) mediante Acta N° {{ $expediente->nro_acta_rectificada() }} monto que se rectifica por el de pesos {{ $expediente->monto_otorgado_letras() }} ( ${{ $expediente->monto_otorgado }}-)
                                  @if($expediente->pivot->observaciones != '')
                                    Motivo: {{ $expediente->pivot->observaciones }};
                                  @endif
                                @endif

                              @endif
                            @endforeach
                            <?php $i++; ?>
                        </p>
                      @endif
                    @endforeach
                @endif
            @if($acta->countRechazados() > 0)
            <p>
              <strong>{{ $i }}.- Proyectos rechazados:</strong>
              @foreach($fondo->lineas as $linea)
                @if($acta->countRechazadosLineaRectificados($linea->id) > 0)
                  @if($linea->nombre == 'Club de Música') 
                    Clubes de Música en vivo
                  @elseif($linea->nombre == 'Músico Solista')
                   Músicos Solistas
                  @elseif($linea->nombre == 'Grupo de Músicos estable')
                   Grupos de Músicos estables
                  @endif:
                  @foreach($acta->expedientes as $expediente)
                    @if($expediente->pivot->estado == $expedientes_estado_rechazado and $expediente->linea->id == $linea->id)

                      

                      @if($linea->nombre == 'Club de Música')
                        Proyecto N° {{ $expediente->numero }}, código de registro en BAMUSICA {{ $expediente->nro_registro }}, establecimiento “{{ $expediente->nombre_grupo }}”, cuyo titular es “{{ $expediente->responsable_nombre }}”, DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le conceden pesos {{ $expediente->monto_otorgado_rectificado_letras() }} ( ${{ $expediente->monto_otorgado_rectificado() }}-) mediante Acta N° {{ $expediente->nro_acta_rectificada() }} monto que no será otorgado;
                      @else
                        Proyecto N° {{ $expediente->numero }}, código de registro en BAMUSICA {{ $expediente->nro_registro }}, titular “{{ $expediente->nombre_grupo }}”, cuyo nombre es “{{ $expediente->responsable_nombre }}”, DNI N° {{ $expediente->responsable_dni }}, CUIT/CUIL N° {{ $expediente->responsable_cuil }}, se le conceden pesos {{ $expediente->monto_otorgado_rectificado_letras() }} ( ${{ $expediente->monto_otorgado_rectificado() }}-) mediante Acta N° {{ $expediente->nro_acta_rectificada() }} monto que no será otorgado;
                      @endif

                      @if($expediente->pivot->observaciones != '')
                        Motivo: {{ $expediente->pivot->observaciones }};
                      @endif

                    @endif
                  @endforeach
                @endif
              @endforeach
            </p>
            @endif
        @endif
        <!-- Fin rectificaciones -->
        

        Siendo las {{ date('H:i') }} hs se levanta la sesión quedando en reunirse el Directorio en fecha y hora a determinar.
 
        @foreach($filas_jueces as $presente) 
          <p>&nbsp;</p> <p>&nbsp;</p>
          <p>
          {{ $presente['titulo'] }} {{ $presente['name'] }} {{ $presente['surename'] }}
          </p>
        @endforeach
        
    </body>
</html>
