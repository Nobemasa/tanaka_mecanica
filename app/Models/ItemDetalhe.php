<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemDetalhe extends Model
{
    use HasFactory;

    protected $table = 'veiculos'; 
    protected $fillable = [ 'veiPlaca', 'veiModelo', 'veiMarca', 'cliente_id',
    ];

    public function cliente(){

        return $this->belongsTo('App\item', 'cliente_id', 'id');
    }
}
