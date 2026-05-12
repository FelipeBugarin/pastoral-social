<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assistido extends Model
{
    protected $fillable = ['nome', 'cpf', 'telefone', 'dependentes', 'observacoes'];

}
