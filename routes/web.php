<?php

// Rota para a página inicial do dashboard
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', [DashboardController::class, 'index']);
Route::resource('users', UserController::class);
Route::get('/validate-cpf/{cpf}', [UserController::class, 'validateCpf'])->name('validate.cpf');
