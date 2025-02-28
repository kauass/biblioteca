<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaoLivro extends Model
{
    use HasFactory;

    const DISPONIVEL = 1;
    const EMPRESTADO = 2;
    
    protected $fillable = [
        'nome',
    ];
    
}
