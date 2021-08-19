<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Veiculo;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'celular1',
        'celular2',
        'endereco',
        'obs',
    ];

    public function veiculos(){

        return $this->hasMany('App\Models\Veiculo', 'cliente_id', 'id');
    }
}