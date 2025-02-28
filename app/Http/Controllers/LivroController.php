<?php

namespace App\Http\Controllers;

use App\Models\GeneroLivro;
use App\Models\Livro;
use App\Models\SituacaoEmprestimo;
use App\Models\User;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parametros = [
            "livros" => Livro::all()
        ];

        return view('ver_livros', $parametros);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {  
        $ultimoLivro = Livro::max('id');
            
        $proximoId = $ultimoLivro + 1;

        $parametros = [
            "users" => User::all(),
            "proximo_id" => $proximoId
        ];
        $parametros = [
           "generos" => GeneroLivro::all(),
           "proximo_id" => $proximoId
        ];
        return view('livros', $parametros);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:livros,nome',
            'autor' => 'required|string|max:255',
        ], [
            'nome.unique' => 'Este livro já foi cadastrado.',
        ]);
        Livro::create([
            'nome' => $request->nome,
            'autor' =>  $request->autor,
            'genero' => $request->genero,
            'situacao'=> 1
        ]);
    
        return response()->json([
            'message' => 'Livro cadastrado com sucesso!',
        ]);
    }
 
    public function show(string $id)
    {
        try {
            $livro = Livro::withTrashed()->find($id);

            $parametros = [
                "livro" => $livro,
                "generos" => GeneroLivro::all()
            ];
       
            return view('ver_livro', $parametros);
        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao tentar carregar os dados. Por favor, tente novamente.');
        }
    }

    public function update(Request $request, string $id)
    {   
       
        $livro = Livro::withTrashed()->findOrFail($id); 
      
        $livro->nome = $request->nome;
        $livro->autor = $request->autor;
        $livro->genero = $request->genero;
        $livro->save();

        return response()->json([
            'message' => 'Livro atualizado com sucesso!'
        ]);
    }

    public function destroy($id)
    {
        try {
            $livro = Livro::findOrFail($id); 

            $livro->delete();
            
            return redirect()->route('livros.index')->with('success', 'Livro inativado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('livros.index')->with('error', 'Erro ao tentar inativar o Livro.');
        }
    }

    public function restore($id)
    {
        try {
            $livro = Livro::withTrashed()->findOrFail($id);   

            $livro->restore();

            return redirect()->route('livros.index')->with('success', 'Livro ativado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('livros.index')->with('error', 'Erro ao tentar ativar o Livro.');
        }
    }

    
    public function emprestar()
    {
        try {
            $parametros = [
                "livros" => Livro::all(),
                "usuarios" =>  User::all(),
                "situacoes_emprestimo" => SituacaoEmprestimo::all()
            ];
            return view('emprestimos', $parametros);
            return redirect()->route('livros.index')->with('success', 'Livro ativado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('livros.index')->with('error', 'Erro ao tentar ativar o Livro.');
        }
    }
}
