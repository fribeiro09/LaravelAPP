@csrf
@include('admin.includes.alerts')

<div class="form-row">
    <div class="form-group  col-md-6">
        <label>Funcionário</label>
        <label class="mandatory">*</label>
        <select name="employee_id" class="form-control" required>
            <option value="">Selecione o Funcionário</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ $employee->id == ( $worklog->employee_id ?? old('employee_id') ) ? 'selected' : '' }}>{{ $employee->name }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback"> Por favor, infome o Funcionário </div>
    </div>
    <div class="form-group  col-md-6">
        <label>Data</label>
        <label class="mandatory">*</label>
        <input type="text" name="date" class="form-control mask_date" placeholder="Data" value="{{ $worklog->date ?? old('date') }}" maxlength="10" required>
        <div class="invalid-feedback"> Por favor, infome a Data </div>
    </div>
    <div class="form-group  col-md-6">
        <label>Hora</label>
        <label class="mandatory">*</label>
        <input type="text" name="time" class="form-control mask_time" placeholder="Hora" value="{{ $worklog->time ?? old('time') }}" maxlength="8" required>
        <div class="invalid-feedback"> Por favor, infome a Hora </div>
    </div>
    <div class="form-group  col-md-6">
        <label>Descrição</label>
        <label class="mandatory">*</label>
        <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{ $worklog->description ?? old('description') }}" maxlength="200" required>
        <div class="invalid-feedback"> Por favor, infome a Descrição </div>
    </div>

    <button type="submit" class="btn btn-dark salvar validar" name="submit"><i class="fas fa-save"></i> Salvar </button>
</div>

@section('js')
    <script src="{{ URL::asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ URL::asset('js/util.js') }}"></script>
@stop
