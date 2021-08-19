<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $table = 'clientes'; 

    protected $fillable = [ 'name', 'email', 'password', 'cpf', 'situacao', 'tipo',  'celular1',  'celular2',
        'endereco', 'obs',
    ];

    public function itemDetalhe(){

        return $this->hasMany('App\itemDetalhe', 'cliente_id', 'id');
    }
}
