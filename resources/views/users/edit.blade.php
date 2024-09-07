@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<h1 class="text-center mb-4">Editar Usuário</h1>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST" onsubmit="return validate()">
  @csrf
  @method('PUT')

  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" class="form-control" required maxlength="50" value="{{ old('nome', $user->nome) }}">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="cpf">CPF</label>
      <input type="text" id="cpf" name="cpf" class="form-control" required maxlength="14" value="{{ old('cpf', $user->cpf) }}">
    </div>
    <div class="form-group col-md-6">
        <label for="data_nascimento">Data de Nascimento</label>
        <input type="text" id="data_nascimento" name="data_nascimento" class="form-control" required
            placeholder="dd/mm/yyyy" maxlength="10" value="{{ old('data_nascimento', \Carbon\Carbon::parse($user->data_nascimento)->format('d/m/Y')) }}">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" class="form-control" required maxlength="50" value="{{ old('email', $user->email) }}">
    </div>
    <div class="form-group col-md-6">
      <label for="telefone">Telefone</label>
      <input type="text" id="telefone" name="telefone" class="form-control" required maxlength="11" value="{{ old('telefone', $user->telefone) }}">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="cep">CEP</label>
      <input type="text" id="cep" name="cep" class="form-control" required maxlength="9" value="{{ old('cep', $user->cep) }}">
    </div>
    <div class="form-group col-md-6">
      <label for="estado">Estado</label>
        <select id="estado" name="estado" class="form-control" required>
            <option value="" disabled {{ old('estado', $user->estado) ? '' : 'selected' }}>Selecione o estado</option>
            @foreach($estados as $sigla => $nome)
                <option value="{{ $sigla }}" {{ old('estado', $user->estado) == $sigla ? 'selected' : '' }}>
                    {{ $nome }} ({{ $sigla }})
                </option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-8">
      <label for="endereco">Endereço</label>
      <input type="text" id="endereco" name="endereco" class="form-control" required maxlength="50" value="{{ old('endereco', $user->endereco) }}">
    </div>
    <div class="form-group col-md-4">
      <label for="numero">Número</label>
      <input type="text" id="numero" name="numero" class="form-control" required maxlength="10" value="{{ old('numero', $user->numero) }}">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="cidade">Cidade</label>
      <input type="text" id="cidade" name="cidade" class="form-control" required maxlength="50" value="{{ old('cidade', $user->cidade) }}">
    </div>
    <div class="form-group col-md-6">
      <label for="bairro">Bairro</label>
      <input type="text" id="bairro" name="bairro" class="form-control" required maxlength="50" value="{{ old('bairro', $user->bairro) }}">
    </div>
  </div>

  <!-- Botão de salvar -->
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<script src="{{ asset('js/formUtils.js') }}"></script>
<script>
  $(document).ready(function () {
    applyCpfMask($('#cpf'));
    applyCepMask($('#cep'));
    applyDateMask($('#data_nascimento'));

    $('#cpf').on('blur', function() {
      var cpf = $(this).val();
      checkCpfExists(cpf, function(exists) {
        if (exists) {
          alert('Este CPF já está cadastrado.');
          $('#cpf').val('');
        }
      });
    });

    $('#cep').on('blur', function () {
      var cep = $(this).val().replace(/\D/g, '');

      if (cep.length === 8) {
        $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
          if (!data.erro) {
            $('#estado').val(data.uf); // Estado
            $('#cidade').val(data.localidade); // Cidade
            $('#bairro').val(data.bairro); // Bairro
            $('#endereco').val(data.logradouro); // Endereço
          } else {
            alert('CEP não encontrado.');
          }
        }).fail(function () {
          alert('Erro ao consultar o CEP. Tente novamente.');
        });
      } else {
        alert('Por favor, insira um CEP válido.');
      }
    });

  });

  function validate() {
    var cpf = $('#cpf').val();
    var email = $('#email').val();

    if (!validarCpf(cpf)) {
      alert('Por favor, insira um CPF válido.');
      $('#cpf').val('');
      return false;
    }

    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regex.test(email)) {
      alert('Por favor, insira um email válido.');
      $('#email').val('');
      return false;
    }

    return true;
  }
</script>

@endsection
