@extends('adminlte::page')

@section('title', "Relatórios")

@section('js')
    <script src="{{ URL::asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ URL::asset('js/util.js') }}"></script>
@stop


@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('reports.index') }}" class="active">Relatórios</a></li>
    </ol>

    <h1>Relatórios</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('reports.store') }}" method="POST" class="form needs-validation" novalidate>
            @csrf
            <div class="card-header" style="background: #f7f7f7; border-bottom: unset;">

                @if(isset($error_msg))
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Atenção!</h5>
                        {{ $error_msg }}
                    </div>
                @endif
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Modelos</label>
                        <label class="mandatory">*</label>
                        <select name="model" class="form-control" required>
                            <option value="">Selecione o Modelo</option>
                            <option value="Rel" @if(isset($filters['model']) && $filters['model'] == 'Rel') selected @endif>Relatório de Horas</option>
                            <option value="Rec" @if(isset($filters['model']) && $filters['model'] == 'Rec') selected @endif>Recibo do Prestador</option>
                        </select>
                        <div class="invalid-feedback"> Por favor, selecione o Modelo </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h3>Filtros:</h3>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Funcionário</label>
                        <select name="filter_employee" class="form-control">
                            <option value="">Selecione o Funcionário</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ isset($filters['filter_employee']) && $filters['filter_employee'] == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Data Inicial</label>
                        <input type="text" name="filter_date_start" placeholder="Filtrar por Data" class="form-control mask_date" value="{{ $filters['filter_date_start'] ?? '' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Data Final</label>
                        <input type="text" name="filter_date_end" placeholder="Filtrar por Data" class="form-control mask_date" value="{{ $filters['filter_date_end'] ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <button type="submit" formtarget="_blank" class="btn btn-dark salvar validar" name="submit"><i class="fas fa-file"></i> Gerar Relatório </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('footer')
@include('admin.includes.footer')
@stop
