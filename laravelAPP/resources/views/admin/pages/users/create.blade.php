@extends('adminlte::page')

@section('title', 'Cadastrar Novo Usuário')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="active">Usuários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.create') }}">Novo Usuário</a></li>
    </ol>

    <h1>Cadastrar Novo Usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" class="form needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@endsection

@section('footer')
@include('admin.includes.footer')
@stop
