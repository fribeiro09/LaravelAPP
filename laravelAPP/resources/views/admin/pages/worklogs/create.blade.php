@extends('adminlte::page')

@section('title', "Cadastrar Nova Atividade")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('worklogs.index') }}" class="active">Atividades</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('worklogs.create') }}">Nova Atividade</a></li>
    </ol>

    <h1>Cadastrar Nova Atividade</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('worklogs.store') }}" class="form needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                @include('admin.pages.worklogs._partials.form')
            </form>
        </div>
    </div>
@endsection

@section('footer')
@include('admin.includes.footer')
@stop
