<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\Veiculo;
use App\Models\OrdemServico;
use App\Models\Mecanico;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, OrdemServico $ordemservico)
    { 
            $produto = new Produto();
            $produto->ordemservico_id = $ordemservico->id; 
            $produto->quantidade = $request->input('quantidade');
            $produto->descricao = $request->input('descricao');
            $produto->valor = $request->input('valor');
                $produto->valor = str_replace(".","", $produto->valor); 
                $produto->valor = str_replace(",",".", $produto->valor); 
            $produto->save();
        
            $produtos = Produto::where('ordemservico_id', '=', $ordemservico->id)->get();
            $total_produtos = $produtos->sum('valor');
     
            // popular o select na view com a lista de mecânicos
            $mecanicos = Mecanico::all();

            // atualiza o total do pedido (Total dos Produtos + Valor da mão de obra)
            $ordemservico->total = $total_produtos + $ordemservico->valor_mo;
            // atualiza no banco o valor total da ordem de serviço
            OrdemServico::wherein('id', [$ordemservico->id])->update(['total' => $ordemservico->total]);

            $ordemservicos = OrdemServico::with(['clientes', 'veiculos'])
            ->leftjoin('clientes', 'ordemservicos.cliente_id', '=', 'clientes.id')
            ->leftjoin('veiculos', 'ordemservicos.veiculo_id', '=', 'veiculos.id')
            ->leftjoin('mecanicos', 'ordemservicos.mecanico_id', '=', 'mecanicos.id')
            ->select('clientes.*', 'veiculos.*',  'mecanicos.nome as mecanico', 'ordemservicos.*')
            ->find($ordemservico->id);

            return view('ordemservico.create', [
                'ordemservico' => $ordemservicos,
                'produto' => $produtos,
                'total_produtos' => $total_produtos,
                'mecanicos' => $mecanicos
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exclui_produto(Request $request, OrdemServico $ordemservico){

        $produto = Produto::where('id', $request->input('produto_id'))->delete();

        $produtos = Produto::where('ordemservico_id', '=', $ordemservico->id)->get();
        $total_produtos = $produtos->sum('valor');

        // popular o select na view com a lista de mecânicos
        $mecanicos = Mecanico::all();

        // atualiza o total do pedido (Total dos Produtos + Valor da mão de obra)
        $ordemservico->total = $total_produtos + $ordemservico->valor_mo;
        // atualiza no banco o valor total da ordem de serviço
        OrdemServico::wherein('id', [$ordemservico->id])->update(['total' => $ordemservico->total]);
  
        $ordemservicos = OrdemServico::with(['clientes', 'veiculos'])
            ->leftjoin('clientes', 'ordemservicos.cliente_id', '=', 'clientes.id')
            ->leftjoin('veiculos', 'ordemservicos.veiculo_id', '=', 'veiculos.id')
            ->leftjoin('mecanicos', 'ordemservicos.mecanico_id', '=', 'mecanicos.id')
            ->select('clientes.*', 'veiculos.*',  'mecanicos.nome as mecanico', 'ordemservicos.*')
            ->find($ordemservico->id);

            return view('ordemservico.create', [
                'ordemservico' => $ordemservicos,
                'produto' => $produtos,
                'total_produtos' => $total_produtos,
                'mecanicos' => $mecanicos
            ]);
    }
   
}
