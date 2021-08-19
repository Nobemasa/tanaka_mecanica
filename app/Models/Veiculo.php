<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cliente;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiPlaca',
        'veiModelo',
        'veiMarca',
        'cliente_id',
    ];

    public function cliente (){
        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }

}
