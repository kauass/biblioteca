<?php

use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui você pode registrar rotas da sua aplicação.
|
*/

Route::get('/', function () {
    return view('welcome');
    
});

/*
|--------------------------------------------------------------------------
| Rotas Usuário
|--------------------------------------------------------------------------
*/
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::patch('/user/restore/{id}', [UserController::class, 'restore'])->name('users.restore');


/*
|--------------------------------------------------------------------------
| Rotas Livro
|--------------------------------------------------------------------------
*/

Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
Route::get('/livros/create', [LivroController::class, 'create'])->name('livros.create');
Route::get('/livros/emprestar', [LivroController::class, 'emprestar'])->name('livros.emprestar');
Route::get('/livros/{id}', [LivroController::class, 'show'])->name('livros.show');
Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
Route::put('/livro/{id}', [LivroController::class, 'update'])->name('livros.update');
Route::delete('/livros/destroy/{id}', [LivroController::class, 'destroy'])->name('livro.destroy');
Route::patch('/livros/restore/{id}', [LivroController::class, 'restore'])->name('livro.restore');



Route::get('/emprestimos/create', [EmprestimoController::class, 'create'])->name('emprestimos.create');
Route::get('/emprestimos/index', [EmprestimoController::class, 'index'])->name('emprestimos.index');