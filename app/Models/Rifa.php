<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rifa extends Model
{
    use HasFactory;

    // Define o nome da tabela, se não seguir a convenção
    protected $table = 'rifas';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'user_id',
        'nome',
        'descricao',
        'preco',
        'total_rifas'
    ];
}
