@csrf
@include('admin.includes.alerts')

@if ($errors->any())
    <div class="alert alert-warning">
        @foreach ($errors->all() as $error)
            @if($error=="validation.unique") O CNPJ deve ser Unico @endif
        @endforeach
    </div>
@endif
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Nome</label>
        <label class="mandatory">*</label>
        <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $employee->name ?? old('name') }}" minlength="5" maxlength="100" required>
        <div class="invalid-feedback"> Por favor, informe o Nome </div>
    </div>
    <div class="form-group col-md-6">
        <label>CPF</label>
        <label class="mandatory">*</label>
        <input type="text" name="document_number" class="form-control mask_cpf" placeholder="CPF" value="{{ $employee->document_number ?? old('document_number') }}" minlength="5" maxlength="20" required>
        <div class="invalid-feedback"> Por favor, informe o CPF </div>
    </div>
    <div class="form-group col-md-6">
        <label>CEP</label>
        <label class="mandatory">*</label>
        <input type="text" name="zipcode" class="form-control mask_cep" placeholder="CEP" value="{{ $employee->zipcode ?? old('zipcode') }}" minlength="8" maxlength="9" required>
        <div class="invalid-feedback"> Por favor, informe o CPF </div>
    </div>
    <div class="form-group col-md-6">
        <label>Endereço</label>
        <label class="mandatory">*</label>
        <input type="text" name="address" class="form-control" placeholder="Endereço" value="{{ $employee->address ?? old('address') }}" minlength="5" maxlength="100" required>
        <div class="invalid-feedback"> Por favor, informe o Endereço </div>
    </div>
    <div class="form-group col-md-6">
        <label>Complemento</label>
        <input type="text" name="complement" class="form-control" placeholder="Complemento" value="{{ $employee->complement ?? old('complement') }}" minlength="3" maxlength="100" >
        <div class="invalid-feedback"> Por favor, informe o Complemento </div>
    </div>
    <div class="form-group col-md-6">
        <label>Bairro</label>
        <label class="mandatory">*</label>
        <input type="text" name="district" class="form-control" placeholder="Bairro" value="{{ $employee->district ?? old('district') }}" minlength="5" maxlength="100" required>
        <div class="invalid-feedback"> Por favor, informe o Bairro </div>
    </div>
    <div class="form-group col-md-6">
        <label>Cidade</label>
        <label class="mandatory">*</label>
        <input type="text" name="city" class="form-control" placeholder="Cidade" value="{{ $employee->city ?? old('city') }}" minlength="5" maxlength="100" required>
        <div class="invalid-feedback"> Por favor, informe o Cidade </div>
    </div>
    <div class="form-group col-md-6">
        <label>Estado</label>
        <label class="mandatory">*</label>
        <select name="state" class="form-control" required>
            <option value="">Selecione o Estado</option>
            <option value="AC" @if(isset($employee) && $employee->state == "AC") selected @elseif(null !== old('state') && old('state') == "AC" ) selected @endif>Acre</option>
            <option value="AL" @if(isset($employee) && $employee->state == "AL") selected @elseif(null !== old('state') && old('state') == "AL" ) selected @endif>Alagoas</option>
            <option value="AP" @if(isset($employee) && $employee->state == "AP") selected @elseif(null !== old('state') && old('state') == "AP" ) selected @endif>Amapá</option>
            <option value="AM" @if(isset($employee) && $employee->state == "AM") selected @elseif(null !== old('state') && old('state') == "AM" ) selected @endif>Amazonas</option>
            <option value="BA" @if(isset($employee) && $employee->state == "BA") selected @elseif(null !== old('state') && old('state') == "BA" ) selected @endif>Bahia</option>
            <option value="CE" @if(isset($employee) && $employee->state == "CE") selected @elseif(null !== old('state') && old('state') == "CE" ) selected @endif>Ceará</option>
            <option value="DF" @if(isset($employee) && $employee->state == "DF") selected @elseif(null !== old('state') && old('state') == "DF" ) selected @endif>Distrito Federal</option>
            <option value="ES" @if(isset($employee) && $employee->state == "ES") selected @elseif(null !== old('state') && old('state') == "ES" ) selected @endif>Espírito Santo</option>
            <option value="GO" @if(isset($employee) && $employee->state == "GO") selected @elseif(null !== old('state') && old('state') == "GO" ) selected @endif>Goiás</option>
            <option value="MA" @if(isset($employee) && $employee->state == "MA") selected @elseif(null !== old('state') && old('state') == "MA" ) selected @endif>Maranhão</option>
            <option value="MT" @if(isset($employee) && $employee->state == "MT") selected @elseif(null !== old('state') && old('state') == "MT" ) selected @endif>Mato Grosso</option>
            <option value="MS" @if(isset($employee) && $employee->state == "MS") selected @elseif(null !== old('state') && old('state') == "MS" ) selected @endif>Mato Grosso do Sul</option>
            <option value="MG" @if(isset($employee) && $employee->state == "MG") selected @elseif(null !== old('state') && old('state') == "MG" ) selected @endif>Minas Gerais</option>
            <option value="PA" @if(isset($employee) && $employee->state == "PA") selected @elseif(null !== old('state') && old('state') == "PA" ) selected @endif>Pará</option>
            <option value="PB" @if(isset($employee) && $employee->state == "PB") selected @elseif(null !== old('state') && old('state') == "PB" ) selected @endif>Paraíba</option>
            <option value="PR" @if(isset($employee) && $employee->state == "PR") selected @elseif(null !== old('state') && old('state') == "PR" ) selected @endif>Paraná</option>
            <option value="PE" @if(isset($employee) && $employee->state == "PE") selected @elseif(null !== old('state') && old('state') == "PE" ) selected @endif>Pernambuco</option>
            <option value="PI" @if(isset($employee) && $employee->state == "PI") selected @elseif(null !== old('state') && old('state') == "PI" ) selected @endif>Piauí</option>
            <option value="RJ" @if(isset($employee) && $employee->state == "RJ") selected @elseif(null !== old('state') && old('state') == "RJ" ) selected @endif>Rio de Janeiro</option>
            <option value="RN" @if(isset($employee) && $employee->state == "RN") selected @elseif(null !== old('state') && old('state') == "RN" ) selected @endif>Rio Grande do Norte</option>
            <option value="RS" @if(isset($employee) && $employee->state == "RS") selected @elseif(null !== old('state') && old('state') == "RS" ) selected @endif>Rio Grande do Sul</option>
            <option value="RO" @if(isset($employee) && $employee->state == "RO") selected @elseif(null !== old('state') && old('state') == "RO" ) selected @endif>Rondônia</option>
            <option value="RR" @if(isset($employee) && $employee->state == "RR") selected @elseif(null !== old('state') && old('state') == "RR" ) selected @endif>Roraima</option>
            <option value="SC" @if(isset($employee) && $employee->state == "SC") selected @elseif(null !== old('state') && old('state') == "SC" ) selected @endif>Santa Catarina</option>
            <option value="SP" @if(isset($employee) && $employee->state == "SP") selected @elseif(null !== old('state') && old('state') == "SP" ) selected @endif>São Paulo</option>
            <option value="SE" @if(isset($employee) && $employee->state == "SE") selected @elseif(null !== old('state') && old('state') == "SE" ) selected @endif>Sergipe</option>
            <option value="TO" @if(isset($employee) && $employee->state == "TO") selected @elseif(null !== old('state') && old('state') == "TO" ) selected @endif>Tocantins</option>
        </select>
        <div class="invalid-feedback"> Por favor, informe o Estado </div>
    </div>
    <div class="form-group col-md-6">
        <label>Celular</label>
        <label class="mandatory">*</label>
        <input type="text" name="cellular" class="form-control mask_cellular" placeholder="Celular" value="{{ $employee->cellular ?? old('cellular') }}" minlength="10" maxlength="14" required>
        <div class="invalid-feedback"> Por favor, informe o Celular </div>
    </div>
    <div class="form-group col-md-6">
        <label>Email</label>
        <label class="mandatory">*</label>
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $employee->email ?? old('email') }}" minlength="5" maxlength="100" required>
        <div class="invalid-feedback"> Por favor, informe o Email </div>
    </div>
    <div class="form-group col-md-6">
        <label>Status</label>
        <label class="mandatory">*</label>
        <select name="status" class="form-control" required>
            <option value="A" @if(isset($employee) && $employee->status == 'A') selected @endif>Ativo</option>
            <option value="I" @if(isset($employee) && $employee->status == 'I') selected @endif>Inativo</option>
        </select>
        <div class="invalid-feedback"> Por favor, informe o Status </div>
    </div>
    <div class="form-group col-md-3">
        <label>Foto</label>
        <label class="mandatory">*</label>
        <input type="file" name="picture" class="form-control-file" accept="image/*" onchange="ValidateSingleInput(this, 'picture');" @if(!isset($employee)) required @endif>
        <div class="invalid-feedback"> Por favor, informe a Foto </div>
    </div>
    <div class="form-group col-md-3">
        <img id="picture" src="{{ (isset($employee) && $employee->picture != null) ? url("storage/{$employee->picture}") : "" }}" style="max-width: 300px;">
    </div>
    <button type="submit" class="btn btn-dark salvar validar" name="submit"><i class="fas fa-save"></i> Salvar</button>
</div>

@section('js')
    <script src="{{ URL::asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ URL::asset('js/util.js') }}"></script>
@stop
