<?php

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


Route::get('/livros/create', [LivroController::class, 'create'])->name('livros.create');
Route::post('livros', [LivroController::class, 'store'])->name('livros.store');