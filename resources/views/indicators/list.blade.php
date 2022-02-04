@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Indicadores</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                <?php $contadorEmpleados = 0; ?>
                @foreach ($empleados as $empleado)
                {{--se utiliza la variable para checar si se colocan los botones de comentario --}}
                    <?php $hay_indicador = 0; $total = 0;?>
                    <div class="card">
                        <div class="card-header" id="heading{{$contadorEmpleados}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$contadorEmpleados}}" aria-expanded="true" aria-controls="collapse{{$contadorEmpleados}}">
                                    {{$empleado->nombreE . ' - Departamento: ' . $empleado->nombreD}}
                                </button>
                            </h2>
                        </div>
                        @foreach($datas as $data)
                            @if($empleado->idE == $data->idU)
                            {{--si entro se pasa la bandera a 1 --}}
                                <?php $hay_indicador = 1; ?>
                                <div id="collapse{{$contadorEmpleados}}" class="collapse show" aria-labelledby="heading{{$contadorEmpleados}}" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card">
                                            <div class="card-header">
                                            {{$data->nameI}}
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text"><b>Descripcion:</b> {{$data->description}}</p>
                                                <p class="card-text"><b>Unidad de medida:</b> {{$data->unit}}</p>
                                                <p class="card-text"><b>Tipo de dato:</b> {{$data->nameD}}</p>
                                                <p class="card-text"><b>Valor minimo:</b> {{$data->minimum}}</p>
                                                <p class="card-text"><b>Valor esperado:</b> {{$data->expected}}</p>
                                                <p class="card-text"><b>Valor excelente:</b> {{$data->excelent}}</p>
                                                <p class="card-text"><b>Ponderación:</b> {{$data->weig}} %</p>
                                                @if(isset($comen[$data->idI]))
                                                    <?php 
                                                        $calificacionIndicador = 0 ;
                                                        $division = $data->weig / 100;
                                                        if( $calif[$data->idI] >= $data->excelent ){
                                                            $calificacionIndicador = $tablaCalif[2]->weighing;
                                                        }else if( $calif[$data->idI] > $data->minimum){
                                                            $calificacionIndicador = $tablaCalif[1]->weighing;
                                                        }else{
                                                            $calificacionIndicador = $tablaCalif[0]->weighing;
                                                        }
                                                    ?>
                                                    <p class="card-text"><b>Comentario: </b> {{$comen[$data->idI]}}</p>
                                                    <p class="card-text"><b>Calificación: </b> {{$calif[$data->idI]}}</p>
                                                    <p class="card-text"><b>Resultado: </b> {{$calificacionIndicador}}%</p>
                                                    <p class="card-text"><b>Resultado ponderado: </b> {{$calificacionIndicador*$division}}%</p>
                                                    <?php $total = $total + ($calificacionIndicador*$division); ?>
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if($hay_indicador == 1)
                            <div id="collapse{{$contadorEmpleados}}" class="collapse show" aria-labelledby="heading{{$contadorEmpleados}}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <?php 
                                            $nombretotal = 0 ;

                                                if( $total >= $tablaCalifTot[0]->lower_limit && $total <= $tablaCalifTot[0]->upper_limit ){
                                                    $nombretotal = $tablaCalifTot[0]->name;
                                                }else if( $total >= $tablaCalifTot[1]->lower_limit && $total <= $tablaCalifTot[1]->upper_limit ){
                                                    $nombretotal = $tablaCalifTot[1]->name;
                                                }else if( $total >= $tablaCalifTot[1]->lower_limit && $total <= $tablaCalifTot[1]->upper_limit ){
                                                    $nombretotal = $tablaCalifTot[2]->name;
                                                }else if( $total >= $tablaCalifTot[1]->lower_limit && $total <= $tablaCalifTot[1]->upper_limit ){
                                                    $nombretotal = $tablaCalifTot[3]->name;
                                                }else{
                                                    $nombretotal = $tablaCalifTot[4]->name;
                                                }
                                            ?>
                                            <p class="card-text"><b>Calificación total:</b> {{$total}}% - {{$nombretotal}}</p>  
                                              
                                            <?php 
                                                $total = 0; 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>  
                    <?php $contadorEmpleados++; ?> 
                @endforeach
                
                
            </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{asset("assets/pages/scripts/score/acciones.js")}}" type="text/javascript"></script>  
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@stop