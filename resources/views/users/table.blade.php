<div class="table-responsive">
  <table class="table table-bordered table-hover table-striped">
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
          <!-- Botão Visualizar com ícone -->
          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewUserModal"
            data-id="{{ $user->id }}" data-nome="{{ $user->nome }}" data-cpf="{{ $user->cpf }}"
            data-data_nascimento="{{ $user->data_nascimento->format('d/m/Y') }}" data-email="{{ $user->email }}"
            data-telefone="{{ $user->telefone }}" data-endereco="{{ $user->endereco }}"
            data-cidade="{{ $user->cidade }}" data-bairro="{{ $user->bairro }}" data-cep="{{ $user->cep }}"
            data-estado="{{ $user->estado }}">
            <i class="fas fa-eye"></i>
          </button>

          <!-- Link para Editar com ícone -->
          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i>
          </a>

          <!-- Formulário para Excluir com ícone -->
          <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"
              onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
              <i class="fas fa-trash-alt"></i>
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
