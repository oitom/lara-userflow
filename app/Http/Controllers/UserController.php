<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $users =  $this->getUsers($request);
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
      $dadosUsuario = $this->getUserDados($request);
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
    try {
      $request->validate(User::rules($user->id));
      $dadosUsuario = $this->getUserDados($request);
      $user->update($dadosUsuario);

      return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => 'Erro ao atualizar usuário: ' . $e->getMessage()])->withInput();
    }
  }

  public function destroy(User $user)
  {
    $user->status = 0;
    $user->save();
    $user->delete();

    return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso.');
  }

  public function exportCsv(Request $request)
  {
    $users = $this->getUsers($request);
    $response = new StreamedResponse(function () use ($users) {
        $handle = fopen('php://output', 'w');
        $model = new User();
        $headers = $model->getFillable();
        fputcsv($handle, $headers);

        foreach ($users as $user) {
            $data = array_map(function ($field) use ($user) {
                return $user->$field;
            }, $headers);
            fputcsv($handle, $data);
        }
        fclose($handle);
    });

    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set('Content-Disposition', 'attachment; filename="users.csv"');

    return $response;
  }

  private function getUsers(Request $request)
  {
    $query = $request->get('search');
    return User::query()
      ->when($query, function ($query, $search) {
          return $query->where('nome', 'like', "%{$search}%")
              ->orWhere('cpf', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
      })
      ->get();
  }

  private function getUserDados(Request $request)
  {
    return [
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
