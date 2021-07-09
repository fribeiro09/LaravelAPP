@extends('adminlte::page')

@section('title', "Editar o Funcionário " . $employee->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}" class="active">Funcionários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('employees.edit', $employee->id) }}">{{ $employee->name }}</a></li>
    </ol>

    <h1>Editar o Funcionário <b>{{ $employee->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('employees.update', $employee->id) }}" class="form needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                @method('PUT')
                @include('admin.pages.employees._partials.form')
            </form>
        </div>
    </div>
@endsection

@section('footer')
@include('admin.includes.footer')
@stop
