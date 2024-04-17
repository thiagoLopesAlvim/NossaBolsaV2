<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('Login');
});

Route::get('/login', function () {
    return view('Login');
})->name('login');

Route::get('/Processar', function () {
    return view('Processar');
})->name('Processar');

Route::get('/Exportar', function () {
    return view('Exportar');
})->name('Exportar');

Route::get('/Exportar2', function () {
    return view('Exportar2');
})->name('Exportar2');

Route::post('/exportar', [MainController::class, 'downloadCSVDisciplina'])->name('RealizarExport');
Route::post('/exportar2', [MainController::class, 'downloadCSVDisciplina2'])->name('RealizarExport2');

Route::get('/menu', function () {
    return view('Menu');
})->name('voltar');

Route::post('/', [MainController::class, 'enviarDados'])->name('realizar');
Route::post('/menu', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Route::get('/processado', [MainController::class,'downloadTabela'])->name('planilha.download');
