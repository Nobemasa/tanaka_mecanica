<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdemServico;
use App\Models\Veiculo;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Mecanico;
use PDF;

class OrdemServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordemservicos = OrdemServico::with(['clientes', 'veiculos'])
        ->leftJoin('clientes', 'ordemservicos.cliente_id', '=', 'clientes.id')
        ->leftJoin('veiculos', 'ordemservicos.veiculo_id', '=', 'veiculos.id')
        ->leftJoin('mecanicos', 'ordemservicos.mecanico_id', '=', 'mecanicos.id')
        ->select('ordemservicos.*', 'veiculos.veiModelo', 'clientes.nome', 'mecanicos.nome as mecanico')
        ->orderBy('ordemservicos.id', 'DESC')
        ->take(5)->get();

        return view('ordemservico.index', ['ordemservicos'=>$ordemservicos]);
    }
  
    /**
     * 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, OrdemServico $ordemservico)
    {  
        OrdemServico::wherein('id', [$ordemservico->id])->update(['km' => $request->input('km')]);
        OrdemServico::wherein('id', [$ordemservico->id])->update(['obs' => $request->input('obs')]);
        OrdemServico::wherein('id', [$ordemservico->id])->update(['mecanico_id' => $request->input('mecanico_id')]);
   
        return redirect()->route('ordemservico.index');
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
        $ordemservicos = OrdemServico::with(['clientes', 'veiculos'])
        ->leftJoin('clientes', 'ordemservicos.cliente_id', '=', 'clientes.id')
        ->leftJoin('veiculos', 'ordemservicos.veiculo_id', '=', 'veiculos.id')
        ->leftJoin('mecanicos', 'ordemservicos.mecanico_id', '=', 'mecanicos.id')
        ->select('clientes.*', 'veiculos.*',  'mecanicos.nome as mecanico', 'ordemservicos.*')
        ->find($id);

        $produtos = Produto::where('ordemservico_id', '=', $ordemservicos->id)->get();
        $total_produtos = $produtos->sum('valor');


        // popular o select na view com a lista de mecânicos
        $mecanicos = Mecanico::all();
        
        return view('ordemservico.create', [
            'ordemservico' => $ordemservicos,
            'produto' => $produtos,
            'total_produtos' => $total_produtos,
            'mecanicos' => $mecanicos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdemServico $ordemservico)
    {   
        $ordemservico->update($request->all());

        $produtos = Produto::where('ordemservico_id', '=', $ordemservico->id)->get();
        $total_produtos = $produtos->sum('valor');
     
        // atualiza o total do pedido (Total dos Produtos + Valor da mão de obra)
        $ordemservico->total = $total_produtos + $ordemservico->valor_mo;
        // atualiza no banco o valor total da ordem de serviço
        OrdemServico::wherein('id', [$ordemservico->id])->update(['total' => $ordemservico->total]);

        // popular o select na view com a lista de mecânicos
        $mecanicos = Mecanico::all();
        
        $ordemservicos = OrdemServico::with(['clientes', 'veiculos'])
            ->leftJoin('clientes', 'ordemservicos.cliente_id', '=', 'clientes.id')
            ->leftJoin('veiculos', 'ordemservicos.veiculo_id', '=', 'veiculos.id')
            ->leftJoin('mecanicos', 'ordemservicos.mecanico_id', '=', 'mecanicos.id')
            ->select('ordemservicos.*', 'veiculos.veiModelo', 'clientes.nome', 'mecanicos.nome as mecanico')
            ->find($ordemservico->id);

        return view('ordemservico.create', [
            'ordemservico' => $ordemservicos,
            'produto' => $produtos,
            'total_produtos' => $total_produtos,
            'mecanicos' => $mecanicos
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdemServico $ordemservico)
    {
        $ordemservico->delete();
        return redirect()->route('ordemservico.index');
    }

    public function search()
    {
        return view('ordemservico.search');
    }

    public function validar(Request $request)
    {
        // verifica se a placa já é cadastrada 
        $cliente_veiculo = Veiculo::with(['cliente'])
            ->join('clientes', 'veiculos.cliente_id', '=', 'clientes.id')
            ->select('clientes.id AS cli_id', 'clientes.nome', 'veiculos.id', 'veiculos.veiModelo', 'veiculos.veiPlaca')
            ->where('veiPlaca', '=', $request->input('veiPlaca'))
            ->first();

        // popular o select na view com a lista de mecânicos
        $mecanicos = Mecanico::all();

       if (isset($cliente_veiculo)){ // Se existir o veículo
            $ordemservico = new OrdemServico();
            $ordemservico->cliente_id = $cliente_veiculo->cli_id;
            $ordemservico->veiculo_id = $cliente_veiculo->id;
            $ordemservico->save(); // cria uma ordem de serviço

            $ordemservicos = OrdemServico::with(['clientes', 'veiculos'])
            ->leftJoin('clientes', 'ordemservicos.cliente_id', '=', 'clientes.id')
            ->leftJoin('veiculos', 'ordemservicos.veiculo_id', '=', 'veiculos.id')
            ->leftJoin('mecanicos', 'ordemservicos.mecanico_id', '=', 'mecanicos.id')
            ->select('ordemservicos.*', 'veiculos.veiModelo', 'veiculos.veiPlaca', 'clientes.nome', 'mecanicos.nome as mecanico')
            ->find($ordemservico->id);

            return view('ordemservico.create', 
            [
                'ordemservico' => $ordemservicos,
                'mecanicos' => $mecanicos
            ]); 
       }else{
        $msg = 'Placa não encontrado, certifique-se o veículo esteja cadastrado!' ;
        return view('ordemservico.search', ['msg'=> $msg]);
     }
    }

    public function imprimir($id){
        
        $ordemservicos = OrdemServico::with(['clientes', 'veiculos'])
        ->leftjoin('clientes', 'ordemservicos.cliente_id', '=', 'clientes.id')
        ->leftjoin('veiculos', 'ordemservicos.veiculo_id', '=', 'veiculos.id')
        ->leftjoin('mecanicos', 'ordemservicos.mecanico_id', '=', 'mecanicos.id')
        ->select('clientes.*', 'veiculos.*',  'mecanicos.nome as mecanico', 'ordemservicos.*')
        ->find($id);
        
        $produtos = Produto::where('ordemservico_id', '=', $ordemservicos->id)->get();
        $total_produtos = $produtos->sum('valor');

        $pdf = PDF::loadView('ordemservico.pdf', [  'ordemservico' => $ordemservicos,
                                                    'produto' => $produtos,
                                                    'total_produtos' => $total_produtos
                                                ]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('Ordem_Serviço.pdf');
    }

    public function pesquisa(Request $request)
    {
        $ordemservicos = OrdemServico::with(['clientes', 'veiculos'])
        ->leftJoin('clientes', 'ordemservicos.cliente_id', '=', 'clientes.id')
        ->leftJoin('veiculos', 'ordemservicos.veiculo_id', '=', 'veiculos.id')
        ->select('ordemservicos.*', 'veiculos.veiModelo', 'clientes.nome')
        ->where('ordemservicos.id', '=', $request->input('inputOs'))->get();

        return view('ordemservico.pesquisa', ['ordemservicos'=>$ordemservicos]);
    }

}
