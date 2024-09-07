@extends('layouts.app')

@section('title', 'Lista de Usuários')

@section('content')
<h1 class="text-center mb-4">Usuários</h1>

<div class="d-flex mb-4">
  <div class="ml-auto">
    <a href="{{ route('users.create') }}" class="btn btn-success">
      <i class="fas fa-plus"></i>
      Cadastrar
    </a>
  </div>
</div>

<form id="searchForm" class="mb-4" method="GET" action="{{ route('users.index') }}">
  <div class="form-row align-items-center">
    <div class="col">
      <input type="text" id="searchInput" name="search" class="form-control" placeholder="Buscar por nome, CPF, email..."
        value="{{ request('search') }}">
    </div>
    <div class="col-auto">
    <button type="submit" class="btn btn-primary">
      <i class="fas fa-search"></i>
    </button>
    </div>
    <div class="col-auto">
      <a href="{{ route('users.exportCsv', ['search' => request()->get('search')]) }}" class="btn btn-secondary">
        <i class="fas fa-file-csv"></i>
        Exportar
      </a>
    </div>
  </div>
</form>

<div id="userTableContainer" class="table-responsive">
  @include('users.table')
</div>

<!-- Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewUserModalLabel">Detalhes do Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <dl class="row">
          <dt class="col-sm-3">Nome:</dt>
          <dd class="col-sm-9" id="modal-nome"></dd>
          <dt class="col-sm-3">CPF:</dt>
          <dd class="col-sm-9" id="modal-cpf"></dd>
          <dt class="col-sm-3">Data de Nascimento:</dt>
          <dd class="col-sm-9" id="modal-data_nascimento"></dd>
          <dt class="col-sm-3">Email:</dt>
          <dd class="col-sm-9" id="modal-email"></dd>
          <dt class="col-sm-3">Telefone:</dt>
          <dd class="col-sm-9" id="modal-telefone"></dd>
          <dt class="col-sm-3">Endereço:</dt>
          <dd class="col-sm-9" id="modal-endereco"></dd>
          <dt class="col-sm-3">Cidade:</dt>
          <dd class="col-sm-9" id="modal-cidade"></dd>
          <dt class="col-sm-3">Bairro:</dt>
          <dd class="col-sm-9" id="modal-bairro"></dd>
          <dt class="col-sm-3">CEP:</dt>
          <dd class="col-sm-9" id="modal-cep"></dd>
          <dt class="col-sm-3">Estado:</dt>
          <dd class="col-sm-9" id="modal-estado"></dd>
        </dl>
      </div>
      <div class="modal-footer">
        <a href="#" id="modal-edit-link" class="btn btn-warning">Editar</a>
        <form action="#" id="modal-delete-form" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger"
            onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#viewUserModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var modal = $(this);

      modal.find('#modal-nome').text(button.data('nome'));
      modal.find('#modal-cpf').text(button.data('cpf'));
      modal.find('#modal-data_nascimento').text(button.data('data_nascimento'));
      modal.find('#modal-email').text(button.data('email'));
      modal.find('#modal-telefone').text(button.data('telefone'));
      modal.find('#modal-endereco').text(button.data('endereco'));
      modal.find('#modal-cidade').text(button.data('cidade'));
      modal.find('#modal-bairro').text(button.data('bairro'));
      modal.find('#modal-cep').text(button.data('cep'));
      modal.find('#modal-estado').text(button.data('estado'));

      modal.find('#modal-edit-link').attr('href', '/users/' + button.data('id') + '/edit');
      modal.find('#modal-delete-form').attr('action', '/users/' + button.data('id'));
    });
  });
</script>
@endsection
