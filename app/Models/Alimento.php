<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    // Adicione os campos que o banco deve aceitar
    protected $fillable = [
        'paroquia_id', 
        'nome', 
        'quantidade', 
        'unidade', 
        'excedente', 
        'validade'
    ];

    public function paroquia()
    {
        return $this->belongsTo(Paroquia::class);
    }
}
