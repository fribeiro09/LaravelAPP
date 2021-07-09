@extends('adminlte::page')

@section('title', "Perfil do Usuário " . $user->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Usuários</li>
        <li class="breadcrumb-item active"> {{ $user->name }} </li>
    </ol>

    <h1>Perfil do Usuário <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $user->name }}
                </li>
                <li>
                    <strong>Email: </strong> {{ $user->email }}
                </li>
                <li>
                    <strong>Status: </strong> {{ $user->status == "A" ? "Ativo" : "Inativo" }}
                </li>
                <li>
                    <strong>Foto: </strong>
                </li>
                <img src="{{ url("storage/{$user->picture}") }}" alt="{{ $user->name }}" style="max-width: 300px;">
            </ul>
            <a href="{{ route('admin.index') }}" class="btn btn-dark">Voltar</a>
        </div>
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@stop
