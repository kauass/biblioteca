<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\SituacaoEmprestimo;
use App\Models\SituacaoLivro;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{

    public function index()
    {
        try {
            $parametros = [
                "emprestimos" => Emprestimo::with([
                    'usuario' => function($query) {
                        $query->withTrashed();
                    },
                    'livro' => function($query) {
                        $query->withTrashed(); 
                    }
                ])->get(),
                "livros" => Livro::withTrashed()->get(),
                "situacoes_emprestimo" => SituacaoEmprestimo::all()
            ];
            
            
           
            return view('ver_emprestimos', $parametros);
        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao tentar carregar os dados. Por favor, tente novamente.');
        }
    }
    
    public function create()
    {
        try {
            $parametros = [
                "usuarios" => User::get(),
                "livros" => Livro::get(),
                "situacoes_emprestimo" => SituacaoEmprestimo::all()
            ];
            

            return view('emprestimos', $parametros);
        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao tentar carregar os dados. Por favor, tente novamente.');
        }
    }

    public function store(Request $request)
    {
        try {
            $livro = Livro::find($request->livro_id);
    
            if ($livro->situacao != SituacaoLivro::EMPRESTADO) {
                $validated = $request->validate([
                    'usuario_id' => 'required',
                    'livro_id' => 'required',
                    'situacao' => 'required',
                ]);

                $emprestimo = Emprestimo::create([
                    'usuario_id' => $request->usuario_id,
                    'livro_id' => $request->livro_id,
                    'situacao_id' => $request->situacao,
                    'data_devolucao' => $request->data_devolucao,
                ]);
                
                if($emprestimo->situacao_id !== SituacaoEmprestimo::DEVOLVIDO){
                    $livro->update([
                        'situacao' => SituacaoLivro::EMPRESTADO,
                    ]);
                }
                return response()->json([
                    'message' => 'Empréstimo cadastrado com sucesso!',
                ]);
            } else {
                return response()->json([
                    'message' => 'Este livro já está emprestado!',
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Erro ao tentar registrar empréstimo: '.$e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar carregar os dados. Por favor, tente novamente.');
        }
    }
    
    
    public function marcarDevolvido($id)
    {
        try {
            $emprestimo = Emprestimo::findOrFail($id);
            $situacaoEmprestimo = null;
    
            if(Carbon::now() > $emprestimo->data_devolucao){
                $situacaoEmprestimo = SituacaoEmprestimo::ATRASADO;
            } else {
                $situacaoEmprestimo = SituacaoEmprestimo::DEVOLVIDO;
            }
    
            $emprestimo->update([
                'situacao_id' => $situacaoEmprestimo,
                'data_devolucao' => Carbon::now()
            ]);
    
            $emprestimo->livro->update([
                'situacao' => SituacaoLivro::DISPONIVEL
            ]);
    
            return redirect()->route('emprestimos.index')->with('success', 'Livro devolvido com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao tentar atualizar o empréstimo. Por favor, tente novamente.');
        }
    }

    public function marcarAtrasado($id)
    {
        try {
            $emprestimo = Emprestimo::findOrFail($id);
            
            $emprestimo->update([
                'situacao_id' => SituacaoEmprestimo::ATRASADO
            ]);
            return redirect()->route('emprestimos.index')->with('success', 'Livro maracado como atrasado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao tentar atualizar o empréstimo. Por favor, tente novamente.');
        }
    }
    

}
