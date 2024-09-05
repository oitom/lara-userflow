<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'nome' => 'João Silva',
                'cpf' => '123.456.789-00',
                'data_nascimento' => '1985-05-10',
                'email' => 'joao.silva@example.com',
                'telefone' => '(11) 91234-5678',
                'cep' => '12345-678',
                'estado' => 'SP',
                'cidade' => 'São Paulo',
                'bairro' => 'Centro',
                'endereco' => 'Rua Exemplo',
                'numero' => '123',
                'status' => 1
            ],
            [
                'nome' => 'Maria Souza',
                'cpf' => '234.567.890-11',
                'data_nascimento' => '1990-08-22',
                'email' => 'maria.souza@example.com',
                'telefone' => '(21) 92345-6789',
                'cep' => '12345-678',
                'estado' => 'SP',
                'cidade' => 'São Paulo',
                'bairro' => 'Centro',
                'endereco' => 'Rua Exemplo',
                'numero' => '456',
                'status' => 1
            ],
            [
                'nome' => 'Carlos Pereira',
                'cpf' => '345.678.901-22',
                'data_nascimento' => '1978-12-15',
                'email' => 'carlos.pereira@example.com',
                'telefone' => '(31) 93456-7890',
                'cep' => '12345-678',
                'estado' => 'MG',
                'cidade' => 'Belo Horizonte',
                'bairro' => 'Centro',
                'endereco' => 'Rua Exemplo',
                'numero' => '78',
                'status' => 1
            ],
            [
                'nome' => 'Ana Oliveira',
                'cpf' => '456.789.012-33',
                'data_nascimento' => '1983-03-30',
                'email' => 'ana.oliveira@example.com',
                'telefone' => '(41) 94567-8901',
                'cep' => '12345-678',
                'estado' => 'MG',
                'cidade' => 'Belo Horizonte',
                'bairro' => 'Centro',
                'endereco' => 'Rua Exemplo',
                'numero' => '12',
                'status' => 1
            ],
            [
                'nome' => 'Pedro Lima',
                'cpf' => '567.890.123-44',
                'data_nascimento' => '1995-11-05',
                'email' => 'pedro.lima@example.com',
                'telefone' => '(51) 95678-9012',
                'cep' => '12345-678',
                'estado' => 'RJ',
                'cidade' => 'Rio de Janeiro',
                'bairro' => 'Centro',
                'endereco' => 'Rua Exemplo, 123',
                'numero' => '987',
                'status' => 1
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
