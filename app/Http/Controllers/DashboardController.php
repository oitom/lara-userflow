<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
  {
    $totalUsers = User::count();

    // Obtém o top 3 estados com mais usuários
    $usersByState = User::select('estado', DB::raw('count(*) as total'))
      ->groupBy('estado')
      ->orderBy('total', 'desc')
      ->take(3)
      ->pluck('total', 'estado');

    $averageAge = User::all()->avg(function ($user) {
      return Carbon::parse($user->data_nascimento)->age;
    });

    return view('home', [
      'totalUsers' => $totalUsers,
      'usersByState' => $usersByState,
      'averageAge' => round($averageAge),
    ]);
  }
}
