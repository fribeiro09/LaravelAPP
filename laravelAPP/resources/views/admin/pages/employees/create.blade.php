@extends('adminlte::page')

@section('title', 'Cadastrar Novo Funcionário')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}" class="active">Funcionários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('employees.create') }}">Novo Funcionário</a></li>
    </ol>

    <h1>Cadastrar Novo Funcionário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('employees.store') }}" class="form needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                @include('admin.pages.employees._partials.form')
            </form>
        </div>
    </div>
@endsection

@section('footer')
@include('admin.includes.footer')
@stop
