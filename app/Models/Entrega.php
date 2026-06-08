<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['assistido_id', 'alimento_id', 'quantidade_entregue', 'data_entrega'])]
class Entrega extends Model
{
    public function assistido() {
        return $this->belongsTo(Assistido::class);
    }

    public function alimento() {
        return $this->belongsTo(Alimento::class);
    }
}
