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

    $usersByState = User::select('estado', DB::raw('count(*) as total'))
      ->groupBy('estado')
      ->orderBy('total', 'desc')
      ->take(3)
      ->pluck('total', 'estado');

    $averageAge = User::all()->avg(function ($user) {
      return Carbon::parse($user->data_nascimento)->age;
    });

    $usersByCity = User::select('cidade', DB::raw('count(*) as total'))
      ->groupBy('cidade')
      ->orderBy('total', 'desc')
      ->pluck('total', 'cidade');

    $ageDistributionData = [
      'Menos de 20' => User::whereYear('data_nascimento', '>=', now()->year - 20)->count(),
      '20-29' => User::whereBetween('data_nascimento', [now()->subYears(29)->toDateString(), now()->subYears(20)->toDateString()])->count(),
      '30-39' => User::whereBetween('data_nascimento', [now()->subYears(39)->toDateString(), now()->subYears(30)->toDateString()])->count(),
      '40-49' => User::whereBetween('data_nascimento', [now()->subYears(49)->toDateString(), now()->subYears(40)->toDateString()])->count(),
      '50+' => User::whereYear('data_nascimento', '<=', now()->year - 50)->count(),
    ];

    return view('home', [
      'totalUsers' => $totalUsers,
      'usersByState' => $usersByState,
      'averageAge' => round($averageAge),
      'usersByCity' => $usersByCity,
      'ageDistributionData' => $ageDistributionData,
    ]);
  }
}
