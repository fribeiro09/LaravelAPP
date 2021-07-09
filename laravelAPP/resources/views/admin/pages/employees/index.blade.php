@extends('adminlte::page')

@section('title', "Funcionários")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('employees.index') }}" class="active">Funcionários</a></li>
    </ol>

    <h1>
        Funcionários
        <a href="{{ route('employees.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> Adicionar </a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('employees.search') }}" method="POST" class="form">
                @csrf
                <div class="form-row align-items-center">
                    <div class="form-group col-md-2">
                        <label>Nome</label>
                        <input type="text" name="filter_name" placeholder="Filtrar por Nome" class="form-control" value="{{ $filters['filter_name'] ?? '' }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Status</label>
                        <select name="filter_status" class="form-control" >
                            <option value="">Selecione o Status</option>
                            <option value="A" @if(isset($filters['filter_status']) && $filters['filter_status'] == 'A') selected @endif>Ativo</option>
                            <option value="I" @if(isset($filters['filter_status']) && $filters['filter_status'] == 'I') selected @endif>Inativo</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <button type="submit" name="search" class="btn btn-dark" style="margin-top: 25px;"><i class="fas fa-search"></i> Filtrar </button>
                        <button type="submit" name="export" class="btn btn-success" style="margin-top: 25px;"><i class="fas fa-file-excel"></i> Exportar </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="70">#</th>
                        <th width="100">Foto</th>
                        <th>Nome</th>
                        <th>Status</th>
                        <th width="170">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td><img src="{{ url("storage/{$employee->picture}") }}" alt="{{ $employee->title }}" style="max-width: 90px;"></td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->status == "A" ? "Ativo" : "Inativo" }}</td>
                            <td>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-dark minibtn" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-dark minibtn" title="Exibir Dados"><i class="far fa-list-alt"></i></a>

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Atenção</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Deseja mesmo remover o registro?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger">Remover</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fim Modal -->

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $employees->appends($filters)->links() !!}
            @else
                {!! $employees->links() !!}
            @endif
        </div>
    </div>
@stop

@section('footer')
@include('admin.includes.footer')
@stop
