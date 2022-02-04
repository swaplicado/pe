@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Indicadores</h1>
@stop

@section('content')
@include('includes.mensaje')
    <div class="card">
        <input type="hidden" id="id_empleado" name="id_empleado" value="{{$user}}">
        <input type="hidden" id="anio" name="anio" value="2021">
        <div class="card-header">
            @if(count($datas) > 0)
                @switch($datas[0]->indicator_status_id)
                    @case(1)
                        <button onclick="window.location.href='{{route('crear_indicador')}}'" class="btn btn-success" id="crear" name="crear">
                            <i class="fa fa-fw fa-plus-circle"></i> Nuevo
                        </button>
                        <button type="button" class="btn btn-warning" onclick="agregar()" id="enviar" name="enviar">
                            <i class="fa fa-fw fa-share"></i> Enviar
                        </button>
                        <button type="button" class="btn btn-info" onclick="calificar()" id="calificar" name="calificar" disabled="disabled">
                            <i class="fa fa-fw fa-calculator"></i> Calificar
                        </button>
                        @break
                    @case(2)
                        <button onclick="window.location.href='{{route('crear_indicador')}}'" class="btn btn-success" id="crear" name="crear" disabled="disabled">
                            <i class="fa fa-fw fa-plus-circle"></i> Nuevo
                        </button>
                        <button type="button" class="btn btn-warning" onclick="agregar()" disabled="disabled" id="enviar" name="enviar">
                            <i class="fa fa-fw fa-share"></i> Enviar
                        </button>
                        <button type="button" class="btn btn-info" onclick="calificar()" id="calificar" name="calificar" disabled="disabled">
                            <i class="fa fa-fw fa-calculator"></i> Calificar
                        </button>
                        @break
                    @case(3)
                        <button onclick="window.location.href='{{route('crear_indicador')}}'" class="btn btn-success" id="crear" name="crear" disabled="disabled">
                            <i class="fa fa-fw fa-plus-circle"></i> Nuevo
                        </button>
                        <button type="button" class="btn btn-warning" onclick="agregar()" disabled="disabled" id="enviar" name="enviar">
                            <i class="fa fa-fw fa-share"></i> Enviar
                        </button>
                        <button type="button" class="btn btn-info" onclick="calificar()" id="calificar" name="calificar">
                            <i class="fa fa-fw fa-calculator"></i> Calificar
                        </button>
                        @break
                    @case(4)
                        <button onclick="window.location.href='{{route('crear_indicador')}}'" class="btn btn-success" id="crear" name="crear">
                            <i class="fa fa-fw fa-plus-circle"></i> Nuevo
                        </button>
                        <button type="button" class="btn btn-warning" onclick="agregar()" id="enviar" name="enviar">
                            <i class="fa fa-fw fa-share"></i> Enviar
                        </button>
                        <button type="button" class="btn btn-info" onclick="calificar()" id="calificar" name="calificar" disabled="disabled">
                            <i class="fa fa-fw fa-calculator"></i> Calificar
                        </button>
                        @break
                    @case(5)
                        <button onclick="window.location.href='{{route('crear_indicador')}}'" class="btn btn-success" id="crear" name="crear" disabled="disabled">
                            <i class="fa fa-fw fa-plus-circle"></i> Nuevo
                        </button>
                        <button type="button" class="btn btn-warning" onclick="agregar()" id="enviar" name="enviar" disabled="disabled">
                            <i class="fa fa-fw fa-share"></i> Enviar
                        </button>
                        <button type="button" class="btn btn-info" onclick="calificar()" id="calificar" name="calificar" disabled="disabled">
                            <i class="fa fa-fw fa-calculator"></i> Calificar
                        </button>
                        @break
                    @case(6)
                        <button onclick="window.location.href='{{route('crear_indicador')}}'" class="btn btn-success" id="crear" name="crear" disabled="disabled">
                            <i class="fa fa-fw fa-plus-circle"></i> Nuevo
                        </button>
                        <button type="button" class="btn btn-warning" onclick="agregar()" id="enviar" name="enviar" disabled="disabled">
                            <i class="fa fa-fw fa-share"></i> Enviar
                        </button>
                        <button type="button" class="btn btn-info" onclick="calificar()" id="calificar" name="calificar" disabled="disabled">
                            <i class="fa fa-fw fa-calculator"></i> Calificar
                        </button>
                        @break
                    @case(7)
                        <button onclick="window.location.href='{{route('crear_indicador')}}'" class="btn btn-success" id="crear" name="crear" disabled="disabled">
                            <i class="fa fa-fw fa-plus-circle"></i> Nuevo
                        </button>
                        <button type="button" class="btn btn-warning" onclick="agregar()" id="enviar" name="enviar" disabled="disabled">
                            <i class="fa fa-fw fa-share"></i> Enviar
                        </button>
                        <button type="button" class="btn btn-info" onclick="calificar()" id="calificar" name="calificar">
                            <i class="fa fa-fw fa-calculator"></i> Calificar
                        </button>
                        @break
                    @default
                        
                @endswitch
            @else
                <button onclick="window.location.href='{{route('crear_indicador')}}'" class="btn btn-success" id="crear" name="crear">
                    <i class="fa fa-fw fa-plus-circle"></i> Nuevo
                </button>
                <button type="button" class="btn btn-warning" onclick="agregar()" id="enviar" name="enviar" disabled="disabled">
                    <i class="fa fa-fw fa-share"></i> Enviar
                </button>
                <button type="button" class="btn btn-info" onclick="calificar()" id="calificar" name="calificar" disabled="disabled">
                    <i class="fa fa-fw fa-calculator"></i> Calificar
                </button>
            @endif
        </div>
        <div class="card-body">
            <?php $ponderacion = 0; ?>
            <table id="indicators" class="table table-stripped">
                <thead>
                    <tr>
                        <th>Indicador</th>
                        <th>Estado</th>
                        <th>Unidad de medida</th>
                        <th>Ponderación</th>
                        <th>Calificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->indicator_status->name}}</td>
                            <td>{{$data->unit_measurement}}</td>
                            <td>{{$data->weighing}}</td>
                            @if(isset($calif[$data->id_indicator]))
                                <td>{{$calif[$data->id_indicator]}}</td>
                            @else
                                <td>Sin calificación</td>
                            @endif
                            <td>
                                @if ( $datas[0]->indicator_status_id == 1 || $datas[0]->indicator_status_id == 4)
                                    <a href="{{route('editar_indicador', ['id' => $data->id_indicator])}}" class="btn btn-primary" title="Modificar este registro">
                                        <i class="fa fa-fw fa-wrench"></i>
                                    </a>
                                    <form action="{{route('eliminar_indicador', ['id' => $data->id_indicator])}}" class="d-inline form-eliminar" method="POST">
                                        @csrf @method("delete")
                                        <button type="submit" class="btn btn-primary" title="Eliminar este registro">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    @if ($datas[0]->indicator_status_id == 3 || $datas[0]->indicator_status_id == 7)   
                                        <a href="{{route('calificar_indicador', ['id' => $data->id_indicator])}}" class="btn btn-primary" title="Calificar este registro">
                                            <i class="fa fa-fw fa-calculator"></i>
                                        </a>
                                    @endif
                                @endif
                            </td>
                            <?php 
                            $ponderacion = $ponderacion + $data->weighing; 
                            ?>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <input type="hidden" value={{$ponderacion}} id="ponderacion" name="ponderacion">
        </div>
        <div class="card-footer text-muted">
            @if(count($datas) > 0)
                <p><b>Estatus indicadores:</b> {{$datas[0]->indicator_status->name}}</p>
            @else
                <p><b>Estatus indicadores:</b> Sin estatus</p>
            @endif
            @if($comentario == 1)
                <p class="card-text"><b>Comentario más reciente:</b><input class="form-control" type="text" value="{{$ultimo_comentario[0]->comment}}" disabled="disabled"></p>
            @else
                <p class="card-text"><b>Comentario más reciente:</b><input class="form-control" type="text" value="Sin comentarios" disabled="disabled"></p>
            @endif
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    
@stop

@section('js')
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

   <script>
    $(document).ready(function() {
        $('#indicators').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            "colReorder": true,
            "dom": 'Bfrtip',
            "lengthMenu": [
                [ 10, 25, 50, 100, -1 ],
                [ 'Mostrar 10', 'Mostrar 25', 'Mostrar 50', 'Mostrar 100', 'Mostrar todo' ]
            ],
        
            });
    } );
   </script>
   <script src="{{asset("assets/pages/scripts/indicators/revision.js")}}" type="text/javascript"></script>
   <script src="{{asset("assets/pages/scripts/indicators/index.js")}}" type="text/javascript"></script>
@stop