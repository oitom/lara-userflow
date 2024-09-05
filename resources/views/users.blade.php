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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
