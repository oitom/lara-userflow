<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
    {
    $users = User::all();
    return view('users.index', compact('users'));
  }

  public function create()
  {
    $estados = $this->getEstados();
    return view('users.create', compact('estados'));
  }

  public function validateCpf($cpf)
  {
    $exists = User::where('cpf', $cpf)->exists();
    return response()->json(['exists' => $exists]);
  }

  public function store(Request $request)
  {
    try {
      $request->validate(User::rules());

      $dadosUsuario = [
        'nome' => $request->nome,
        'cpf' => $request->cpf,
        'data_nascimento' => User::transformDate($request->data_nascimento),
        'email' => $request->email,
        'telefone' => $request->telefone,
        'cep' => $request->cep,
        'estado' => $request->estado,
        'cidade' => $request->cidade,
        'bairro' => $request->bairro,
        'endereco' => $request->endereco,
        'numero' => $request->numero,
      ];
      User::create($dadosUsuario);

      return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => 'Erro ao cadastrar usuário: ' . $e->getMessage()])->withInput();
    }
  }

  public function edit(User $user)
  {
    $estados = $this->getEstados();
    return view('users.edit', compact('user', 'estados'));
  }

  public function update(Request $request, User $user)
  {
    $request->validate([
      'nome' => 'required|string|max:255',
      'cpf' => 'required|string|max:14|unique:users,cpf,' . $user->id,
      'data_nascimento' => 'required|date',
      'email' => 'required|email|max:255|unique:users,email,' . $user->id,
      'telefone' => 'required|string|max:15',
      'cep' => 'required|string|max:9',
      'estado' => 'required|string|max:2',
      'cidade' => 'required|string|max:255',
      'bairro' => 'required|string|max:255',
      'endereco' => 'required|string|max:255',
      'numero' => 'required|string|max:10',
    ]);

    $user->update([
      'nome' => $request->nome,
      'cpf' => $request->cpf,
      'data_nascimento' => $request->data_nascimento,
      'email' => $request->email,
      'telefone' => $request->telefone,
      'cep' => $request->cep,
      'estado' => $request->estado,
      'cidade' => $request->cidade,
      'bairro' => $request->bairro,
      'endereco' => $request->endereco,
      'numero' => $request->numero,
    ]);

    return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
  }

  public function destroy(User $user)
  {
    $user->status = 0;
    $user->save();
    $user->delete();

    return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso.');
  }

  private function getEstados()
  {
    return [
      'AC' => 'Acre',
      'AL' => 'Alagoas',
      'AP' => 'Amapá',
      'AM' => 'Amazonas',
      'BA' => 'Bahia',
      'CE' => 'Ceará',
      'DF' => 'Distrito Federal',
      'ES' => 'Espírito Santo',
      'GO' => 'Goiás',
      'MA' => 'Maranhão',
      'MT' => 'Mato Grosso',
      'MS' => 'Mato Grosso do Sul',
      'MG' => 'Minas Gerais',
      'PA' => 'Pará',
      'PB' => 'Paraíba',
      'PR' => 'Paraná',
      'PE' => 'Pernambuco',
      'PI' => 'Piauí',
      'RJ' => 'Rio de Janeiro',
      'RN' => 'Rio Grande do Norte',
      'RS' => 'Rio Grande do Sul',
      'RO' => 'Rondônia',
      'RR' => 'Roraima',
      'SC' => 'Santa Catarina',
      'SP' => 'São Paulo',
      'SE' => 'Sergipe',
      'TO' => 'Tocantins',
    ];
  }
}
