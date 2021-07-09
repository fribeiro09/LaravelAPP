@extends('adminlte::page')

@section('title', "Detalhes do Funcionário " . $employee->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}" class="active">Funcionários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('employees.show', $employee->id) }}">{{ $employee->name }}</a></li>
    </ol>

    <h1>Detalhes do Funcionário <b>{{ $employee->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $employee->name }}
                </li>
                <li>
                    <strong>CPF: </strong> {{ formatCpf($employee->document_number) }}
                </li>
                <li>
                    <strong>CEP: </strong> {{ formatCep($employee->zipcode) }}
                </li>
                <li>
                    <strong>Endereço: </strong> {{ $employee->address }}
                </li>
                <li>
                    <strong>Complemento: </strong> {{ $employee->complement }}
                </li>
                <li>
                    <strong>Bairro: </strong> {{ $employee->district }}
                </li>
                <li>
                    <strong>Cidade: </strong> {{ $employee->city }}
                </li>
                <li>
                    <strong>Estado: </strong> {{ $employee->state }}
                </li>
                <li>
                    <strong>Celular: </strong> {{ formatCellular($employee->cellular) }}
                </li>
                <li>
                    <strong>Email: </strong> {{ $employee->email }}
                </li>
                <li>
                    <strong>Status: </strong> {{ $employee->status == 'A' ? "Ativo" : "Inativo" }}
                </li>
                <li>
                    <strong>Foto: </strong>
                </li>
                <img src="{{ url("storage/{$employee->picture}") }}" alt="{{ $employee->title }}" style="max-width: 300px;">
            </ul>
            <a href="{{ route('employees.index') }}" class="btn btn-dark">Voltar</a>
        </div>
    </div>
@endsection

@section('footer')
@include('admin.includes.footer')
@stop
