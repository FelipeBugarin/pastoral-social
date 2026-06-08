<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['paroquia_id', 'alimento_nome', 'quantidade_necessaria', 'unidade'])]

class CestaItem extends Model
{
    public function paroquia()
    {
        return $this->belongsTo(Paroquia::class);
    }
}
