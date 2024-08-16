<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleRifa extends Model
{
    use HasFactory;

    protected $fillable = ['rifa_id', 'user_id', 'numero', 'nome_comprador', 'data_compra'];

    public function rifa()
    {
        return $this->belongsTo(Rifa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
