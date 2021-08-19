<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mecanico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'porcentagem',
    ];

    public function ordemservico (){
        return $this->belongsTo('App\Models\OrdemServico', 'mecanico_id', 'id');
    }
}
