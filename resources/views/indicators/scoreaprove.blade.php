@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Indicadores por aprobar</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="accordion" id="accordionExample">
                <?php $contadorEmpleados = 0; ?>
                @foreach ($empleados as $empleado)
                {{--se utiliza la variable para checar si se colocan los botones de comentario --}}
                    <?php $hay_indicador = 0; ?>
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
                                                    <p class="card-text"><b>Comentario: </b> {{$comen[$data->idI]}}</p>
                                                    <p class="card-text"><b>Calificación: </b> {{$calif[$data->idI]}}</p>
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
                                            <p class="card-text">Comentarios: <input class='form-control' type="text" id="comentarios{{$empleado->idE}}" name="comentarios{{$empleado->idE}}"> </p>
                                            <button type="button" class="btn btn-success" onclick="aprobar({{$empleado->idE}})" id="apro{{$empleado->idE}}" name="apro{{$empleado->idE}}">
                                                Aprobar
                                            </button>
                                            <button type="button" class="btn btn-danger" onclick="rechazar({{$empleado->idE}})" id="recha{{$empleado->idE}}" name="recha{{$empleado->idE}}">
                                                Rechazar
                                            </button>   
                                            
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
    
@stop

@section('js')
    <script src="{{asset("assets/pages/scripts/score/acciones.js")}}" type="text/javascript"></script>  
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@stop