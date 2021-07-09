@extends('adminlte::page')

@section('title', "Click Home Office")

@section('content_header')
    <div>
        <img src="{{ URL::asset("img/logo.png") }}" style="max-width: 200px; ">
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group">
                    <a href="{{ route('users.index') }}" class="btn btn-dark" style="margin-left: 5px; width: 150px;">
                        <i class="fas fa-user fa-7x"></i>
                        Usuários
                    </a>
                </div>
                <div class="form-group">
                    <a href="{{ route('employees.index') }}" class="btn btn-dark" style="margin-left: 5px; width: 150px;">
                        <i class="fas fa-building fa-7x"></i>
                        Funcionários
                    </a>
                </div>
                <div class="form-group">
                    <a href="{{ route('worklogs.index') }}" class="btn btn-dark" style="margin-left: 5px; width: 150px;">
                        <i class="fas fa-list-alt fa-7x"></i>
                        Atividades
                    </a>
                </div>
                <div class="form-group">
                    <a href="{{ route('reports.index') }}" class="btn btn-dark" style="margin-left: 5px; width: 150px;">
                        <i class="fas fa-chart-pie fa-7x"></i>
                        Relatórios
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('admin.includes.footer')
@stop
