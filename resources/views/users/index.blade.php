@extends('layouts.app')

@section('title', 'Lista de Usuários')

@section('content')
<h1 class="text-center mb-4">Lista de Usuários</h1>


<!-- Botão de Adicionar Usuário -->
<div class="mb-3">
  <a href="{{ route('users.create') }}" class="btn btn-primary">Adicionar Usuário</a>
</div>

<!-- Barra de Pesquisa -->
<form id="searchForm" class="mb-4">
  <div class="form-group">
    <input type="text" id="searchInput" name="search" class="form-control" placeholder="Buscar por nome, CPF, email..."
      value="{{ request('search') }}">
  </div>
</form>

<div id="userTableContainer" class="table-responsive">
  <!-- Inclui a tabela de usuários -->
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
        <!-- Botões de Ação no Modal -->
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
    $('#searchInput').on('input', function () {
      var searchQuery = $(this).val();
      fetchUsers(searchQuery);
    });

    $('#viewUserModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Botão que acionou o modal
      var modal = $(this);

      // Preencher o modal com os dados do usuário
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

      // Configurar o link e o formulário de exclusão no modal
      modal.find('#modal-edit-link').attr('href', '/users/' + button.data('id') + '/edit');
      modal.find('#modal-delete-form').attr('action', '/users/' + button.data('id'));
    });
  });

  function fetchUsers(query) {
    $.ajax({
      url: "{{ route('users.index') }}",
      type: "GET",
      data: { search: query },
      success: function (response) {
        $('#userTableContainer').html(response);
      },
      error: function () {
        alert('Erro ao buscar usuários.');
      }
    });
  }
</script>
@endsection
