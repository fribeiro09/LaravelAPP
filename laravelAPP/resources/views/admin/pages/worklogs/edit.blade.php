@extends('adminlte::page')

@section('title', "Editar a Atividade" . $worklog->date)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('worklogs.index') }}" class="active">Atividade</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('worklogs.edit', $worklog->id) }}">{{ $worklog->employee->name . ' ' . $worklog->date }}</a></li>
    </ol>

    <h1>Editar a Atividade <b>{{ $worklog->first_name . ' ' . $worklog->last_name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('worklogs.update', $worklog->id) }}" class="form needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                @method('PUT')
                @include('admin.pages.worklogs._partials.form')
            </form>
        </div>
    </div>
@endsection

@section('footer')
@include('admin.includes.footer')
@stop
