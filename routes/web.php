<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/validate-cpf/{cpf}', [UserController::class, 'validateCpf'])->name('validate.cpf');
Route::get('/users/export-csv', [UserController::class, 'exportCsv'])->name('users.exportCsv');
Route::resource('users', UserController::class);
