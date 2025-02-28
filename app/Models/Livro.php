<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'autor',
        'situacao',
        'genero'
    ];
    
    public function generos() 
    {
        return $this->belongsTo(GeneroLivro::class,'genero');
    }
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = strtoupper($value);
    }
    public function setAutorAttribute($value)
    {
        $this->attributes['autor'] = strtoupper($value);
    }

}
