@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear indicador</h1>
@stop
<style>
    textarea {
      resize: none;
    }
</style>
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('guardar_indicador')}}" id="form-general" class="form-horizontal" method="POST" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Indicador:*</label>
                <input type="text" name="name" id="name" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Descripción:</label>
                <textarea rows="5" cols="60" name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="unit_measurement" class="form-label">Unidad de medida:*</label>
                <input type="text" name="unit_measurement" id="unit_measurement" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="unit_measuarement" class="form-label">Tipo dato:*</label>
                @if(isset($data))
                    <select id="data_type_id" name="data_type_id" class="form-control">
                        @foreach($data_types as $type => $index)
                            @if($data->data_type_id == $index)
                                <option selected value="{{ $index }}"  > {{$type}}</option>
                            @else
                                <option value="{{ $index }}"  > {{$type}}</option>
                            @endif
                        @endforeach
                    </select>   
                @else
                    <select id="data_type_id" name="data_type_id" class="form-control">
                        @foreach($data_types as $type => $index)
                            <option value="{{ $index }}" > {{$type}}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <div class="form-group">
                <label for="minimum_value" class="form-label">Valor minimo:*</label>
                <input type="number" name="minimum_value" id="minimum_value" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="expected_value" class="form-label">Valor esperado:*</label>
                <input type="number" name="expected_value" id="expected_value" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="excellent_value" class="form-label">Valor excelente:*</label>
                <input type="number" name="excellent_value" id="excellent_value" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="weighing" class="form-label">Ponderación:*</label>
                <input type="number" name="weighing" id="weighing" class="form-control" step="0.01" min="0" max="100" required/>
            </div>
           
    </div>
            <div class="box-footer">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    @include('includes.button-form-create')
                </div>
            </div>
        </form> 
</div>
@stop