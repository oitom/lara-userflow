@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-center mb-4">Dashboard</h1>

<div class="row">
  <div class="col-md-4 mb-4">
    <div class="card text-white bg-info">
      <div class="card-body">
        <h5 class="card-title">Total de Usuários</h5>
        <p class="card-text display-4">{{ $totalUsers }}</p>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card text-white bg-info">
      <div class="card-body">
        <h5 class="card-title">Top 3 Estados com mais usuários</h5>
        <ul class="list-group">
          @foreach ($usersByState as $state => $count)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="badge badge-light">{{ $state }} </span>
              <span class="badge badge-light">{{ $count }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card text-white bg-info">
      <div class="card-body">
        <h5 class="card-title">Média de Idade dos Usuários</h5>
        <p class="card-text display-4">{{ $averageAge }} anos</p>
      </div>
    </div>
  </div>
</div>

@include('home.charts', [
  'usersByState' => $usersByState,
  'ageDistributionData' => $ageDistributionData,
  'usersByCity' => $usersByCity
])

@endsection
