@extends('layouts.app')

@section('title', 'Lista de Usuários')

@section('content')
    <h1 class="text-center mb-4">Lista de Usuários</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nome }}</td>
                        <td>{{ $user->cpf }}</td>
                        <td>{{ $user->data_nascimento->format('d/m/Y') }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telefone }}</td>
                        <td>
                            <!-- Botão Visualizar -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewUserModal"
                                    data-id="{{ $user->id }}" data-nome="{{ $user->nome }}"
                                    data-cpf="{{ $user->cpf }}" data-data_nascimento="{{ $user->data_nascimento->format('d/m/Y') }}"
                                    data-email="{{ $user->email }}" data-telefone="{{ $user->telefone }}"
                                    data-endereco="{{ $user->endereco }}" data-cidade="{{ $user->cidade }}"
                                    data-bairro="{{ $user->bairro }}" data-cep="{{ $user->cep }}"
                                    data-estado="{{ $user->estado }}">
                                Visualizar
                            </button>

                            <!-- Botão Editar -->
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <!-- Botão Excluir -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
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
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
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
    </script>
@endsection
