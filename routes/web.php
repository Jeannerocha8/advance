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

//Route::get('/', UsuariosController::class)->name('home');


//Rotas de usuário
Route::get('cadastro', UsuariosController::class)->name('casdatro');
Route::post('criar', [UsuariosController::class,'insert'])->name('criar');

//Route::post('edit', [UsuariosController::class, 'edit'])->name('usuarios.editar');
//Route::delete('delete', [UsuariosController::class, 'delete'])->name('usuarios.delete');

//rotas de login
Route::get('login', [UsuariosController::class, 'index'])->name('login');
Route::post('login', [UsuariosController::class, 'login'])->name('usuarios.login');
Route::get('logout', [UsuariosController::class, 'logout'])->name('usuarios.logout');

//rotas dashboard 
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

//rotas de despesas
Route::post('create', [DespesaController::class, 'insert'])->name('despesa.insert');

//rotas de receita
Route::post('/receita', [ReceitaController::class, 'insert'])->name('receita.insert');

//rotas de relatórios

