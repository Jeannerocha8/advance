<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReceitaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get('/', function () {
    return view('welcome');
     
 });

//Rotas de usuário
Route::get('cadastro', UsuariosController::class)->name('casdatro');
Route::post('criar', [UsuariosController::class,'insert'])->name('criar');
Route::post('edit', [UsuariosController::class, 'edit'])->name('usuarios.editar');
Route::delete('delete/{id}', [UsuariosController::class, 'delete'])->name('usuarios.delete');

//rotas de login
Route::get('login', [UsuariosController::class, 'index'])->name('login');
Route::post('login', [UsuariosController::class, 'login'])->name('usuarios.login');
Route::get('logout', [UsuariosController::class, 'logout'])->name('usuarios.logout');

//rotas dashboard 
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('mes', [DashboardController::class, 'verifica'])->name('mes');

//rotas de despesas
Route::post('create', [DespesaController::class, 'insert'])->name('despesa.insert');
Route::delete('deshboard/despesa/delete/{despesas}', [DespesaController::class, 'delete'])->name('despesa.delete');
Route::get('deshboard/despesa/edit/{despesa}', [DespesaController::class, 'show'])->name('despesa.edit');
Route::post('update/{despesa}', [DespesaController::class, 'edit'])->name('update.despesa');
//Route::post('deshboard/despesa/edit/{despesas}', [DespesaController::class, 'edit'])->name('despesa.edit');

//rotas de receita
Route::post('/receita', [ReceitaController::class, 'insert'])-> name('receita.insert');


