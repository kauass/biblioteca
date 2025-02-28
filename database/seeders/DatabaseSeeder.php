<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\GeneroLivro;
use App\Models\SituacaoEmprestimo;
use App\Models\SituacaoLivro;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $situacoes = ['Disponível', 'Emprestado'];

        foreach($situacoes as $situacao){
            SituacaoLivro::create([
                'nome' => $situacao
            ]);
        }

        $generos = ['Ficção', 'Romance', 'Fantasia', 'Aventura'];
        
        foreach($generos as $genero){
            GeneroLivro::create([
                'nome' => $genero
            ]);
        }
        
        $situacoesEmprestimo = ['Devolvido', 'Atrasado','Emprestado'];
            foreach($situacoesEmprestimo as $situacao){
                SituacaoEmprestimo::create([
                    'situacao' => $situacao
                ]);
            }
    }
}
