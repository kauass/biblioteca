<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\User;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function create()
    {
        try {
            
            $parametros = [
                "usuarios" => User::all(),
                "livros" => Livro::all()
            ];
            return view('emprestimos', $parametros);

        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao tentar carregar os dados. Por favor, tente novamente.');
        }
    }
}
