@extends('adminlte::page')

@section('title', "Atividades")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('worklogs.index') }}" class="active">Atividade</a></li>
    </ol>

    <h1>
        Atividade
        <a href="{{ route('worklogs.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> Adicionar </a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('worklogs.search') }}" method="POST" class="form">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Funcionario</label>
                        <select name="filter_employee" class="form-control">
                            <option value="">Selecione o Funcionário</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ isset($filters['filter_employee']) && $filters['filter_employee'] == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Data</label>
                        <input type="text" name="filter_date" placeholder="Filtrar por Data" class="form-control mask_date" value="{{ $filters['filter_date'] ?? '' }}">
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-dark" style="margin-top: 22px;"><i class="fas fa-search"></i> Filtrar </button>
                        <button type="submit" name="export" class="btn btn-success" style="margin-top: 22px;"><i class="fas fa-file-excel"></i> Exportar </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="20%">Nome</th>
                        <th width="10%">Data</th>
                        <th width="10%">Hora</th>
                        <th>Descrição</th>
                        <th width="220">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($worklogs as $worklog)
                        <tr>
                            <td>{{ $worklog->employee->name }}</td>
                            <td>{{ formatDate($worklog->date, 'Y-m-d', 'd/m/Y') }}</td>
                            <td>{{ $worklog->time }}</td>
                            <td>{{ $worklog->description }}</td>
                            <td>
                                <form action="{{ route('worklogs.destroy', $worklog->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('worklogs.edit', $worklog->id) }}" class="btn btn-dark minibtn" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('worklogs.show', $worklog->id) }}" class="btn btn-dark minibtn" title="Exibir Dados"><i class="far fa-list-alt"></i></a>

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
                {!! $worklogs->appends($filters)->links() !!}
            @else
                {!! $worklogs->links() !!}
            @endif
        </div>
    </div>
@stop

@section('footer')
@include('admin.includes.footer')
@stop

@section('js')
    <script src="{{ URL::asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ URL::asset('js/util.js') }}"></script>
@stop
