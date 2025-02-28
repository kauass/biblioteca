<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'livro_id',
        'situacao_id',
        'data_devolucao'
    ];

    public function usuario() 
    {
        return $this->belongsTo(User::class);
    }
    public function livro() 
    {
        return $this->belongsTo(Livro::class);
    }
    public function situacao() 
    {
        return $this->belongsTo(SituacaoEmprestimo::class);
    }
    public function getDataDevolucaoBrAttribute()
    {
        if ($this->data_devolucao) {
            return Carbon::parse($this->data_devolucao)->format('d/m/Y');
        }
    }
}
