<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
  use SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'nome', 'cpf', 'data_nascimento', 'email', 'telefone', 'cep', 'estado', 'cidade', 'bairro', 'endereco', 'numero'
  ];

  // Método para retornar as regras de validação
  public static function rules()
  {
    return [
      'nome' => 'required|string|max:255',
      'cpf' => 'required|string|max:14|unique:users',
      'data_nascimento' => 'required|string',
      'email' => 'required|email|max:255|unique:users',
      'telefone' => 'required|string|max:15',
      'cep' => 'required|string|max:9',
      'estado' => 'required|string|max:2',
      'cidade' => 'required|string|max:255',
      'bairro' => 'required|string|max:255',
      'endereco' => 'required|string|max:255',
      'numero' => 'required|string|max:10',
    ];
  }

  public static function transformDate($date)
  {
    return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
  }
  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'data_nascimento' => 'date',
  ];
}
