<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\OrdemServico;

class AdminController extends Controller
{
    public function index(){

        $clientes = Cliente::all();
        $clientes = count($clientes);

        $veiculos = Veiculo::all();
        $veiculos = count($veiculos);

        $dados_os = OrdemServico::dadosGraficos();

        return view('/admin/admin', ['clientes' => $clientes, 'veiculos' => $veiculos, 'dados_os' => $dados_os]);
    }
}
