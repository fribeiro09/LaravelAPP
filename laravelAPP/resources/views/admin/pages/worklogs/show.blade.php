@extends('adminlte::page')

@section('title', "Detalhes da Atividade " . $worklog->employee->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('worklogs.index') }}" class="active">Atividade</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('worklogs.show', $worklog->id) }}">{{ $worklog->employee->name . ' ' . $worklog->date }}</a></li>
    </ol>

    <h1>Detalhes da Atividade <b>{{ $worklog->employee->name . ' ' . $worklog->date }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $worklog->employee->name }}
                </li>
                <li>
                    <strong>Data: </strong> {{ $worklog->date }}
                </li>
                <li>
                    <strong>Hora: </strong> {{ $worklog->time }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $worklog->description }}
                </li>
            </ul>
            <a href="{{ route('worklogs.index') }}" class="btn btn-dark">Voltar</a>
        </div>
    </div>
@endsection

@section('footer')
@include('admin.includes.footer')
@stop
