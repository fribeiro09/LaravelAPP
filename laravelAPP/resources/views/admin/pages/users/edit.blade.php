@extends('adminlte::page')

@section('title', 'Editar o Usuário'.$user->name)

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="active">Usuários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a></li>
    </ol>

    <h1>Editar o Usuário <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" class="form needs-validation" method="POST"  enctype="multipart/form-data" novalidate>
                @method('PUT')
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@endsection

@section('footer')
@include('admin.includes.footer')
@stop
