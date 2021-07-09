@csrf

@if ($errors->any())
    <div class="alert alert-warning">
    @foreach ($errors->all() as $error)
            @if($error=="validation.unique") O Email deve ser Unico @else {{$error}} @endif
        @endforeach
    </div>
@endif

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name">Nome</label>
        <label class="mandatory">*</label>
        <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $user->name ?? old('name') }}" minlength="5" maxlength="100" required>
        <div class="invalid-feedback"> Por favor, informe o Nome </div>
    </div>
    <div class="form-group col-md-6">
        <label for="email">Email</label>
        <label class="mandatory">*</label>
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email ?? old('email') }}" minlength="5" maxlength="100" required>
        <div class="invalid-feedback"> Por favor, informe o Email </div>
    </div>
    <div class="form-group col-md-6">
        <label>Senha</label>
        <label class="mandatory">*</label>
        <input type="password" name="password" class="form-control" placeholder="Senha" minlength="6" maxlength="20" @if(! isset($user)) required @endif>
        <div class="invalid-feedback"> Por favor, informe a Senha </div>
    </div>
    <div class="form-group col-md-6">
        <label>Status</label>
        <label class="mandatory">*</label>
        <select name="status" class="form-control" required>
            <option value="A" @if(isset($user) && $user->status == 'A') selected @elseif(null !== old('status') && old('status')  == 'A' ) selected @endif>Ativo</option>
            <option value="I" @if(isset($user) && $user->status == 'I') selected @elseif(null !== old('status') && old('status')  == 'I' ) selected @endif>Inativo</option>
        </select>
        <div class="invalid-feedback"> Por favor, informe o Status </div>
    </div>
    <div class="form-group col-md-3">
        <label>Foto</label>
        <label class="mandatory">*</label>
        <input type="file" class="form-control-file" name="picture" accept="image/*" onchange="ValidateSingleInput(this, 'picture');" @if(!isset($user)) required @endif>
        <div class="invalid-feedback"> Por favor, informe a Imagem </div>
    </div>
    <div class="form-group col-md-3">
        <img id="picture" src="{{ (isset($user) && $user->picture != null) ? url("storage/{$user->picture}") : "" }}" style="max-width: 300px;">
    </div>
    <div class="form-group col-md-6">
    </div>
    <button type="submit" class="btn btn-dark salvar validar" name="submit"><i class="fas fa-save"></i> Salvar</button>
</div>

@section('js')
    <script src="{{ URL::asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ URL::asset('js/util.js') }}"></script>
@stop
