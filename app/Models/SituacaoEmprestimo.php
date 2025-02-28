<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaoEmprestimo extends Model
{
    const DEVOLVIDO = 1;
    const ATRASADO = 2;
    const EMPRESTADO = 3;

    use HasFactory;

    protected $fillable = [
        'situacao',
    ];
}
