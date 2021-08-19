<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cliente;
use App\Models\Veiculo;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = 'ordemservicos';

    protected $fillable = [
        'id', 'cliente_id', 'veiculo_id', 'total', 'situacao', 'valor_mo', 'km', 'obs', 'mecanico_id',
    ];

    public function clientes(){
        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }

    public function veiculos(){
        return $this->belongsTo('App\Models\Veiculo', 'veiculo_id', 'id');
    }

    public function produtos(){
        return $this->hasMany('App\Models\Produto', 'ordemservico_id', 'id');
    }

                    
    public static function dadosGraficos(){
        // Dados do ano atual
        $anoAtual = date('Y'); 
        $dadosAtual = OrdemServico::whereYear('created_at', [$anoAtual]) 
        ->selectRaw('SUM(valor_mo) as valor_mo')
        ->groupBy(\DB::raw('MONTH(created_at)'))
        ->get(); 
       
        $arr2=[];
        $dadosAtual = json_decode($dadosAtual);
        
        foreach ($dadosAtual as $val){
            $Arrval = (array) $val;
            foreach ($Arrval as $k=>$v){   
                $arr2[]=$v;
            }
        }
        $dadosAtual = implode(",",$arr2);

        // Dados do ano passado
        $anoAnterior = ($anoAtual - 1);
        $dadosAnterior = OrdemServico::whereYear('created_at', [$anoAnterior]) 
        ->selectRaw('SUM(valor_mo) as valor_mo')
        ->groupBy(\DB::raw('MONTH(created_at)'))
        ->get(); 
       
        $arr2=[];
        
        $dadosAnterior = json_decode($dadosAnterior);
        
        foreach ($dadosAnterior as $val){
            $Arrval = (array) $val;
            foreach ($Arrval as $k=>$v){   
                $arr2[]=$v;
            }
        }
        $dadosAnterior = implode(",",$arr2);

        return compact('anoAtual', 'anoAnterior', 'dadosAtual', 'dadosAnterior');
    }
}
