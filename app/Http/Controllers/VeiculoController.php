<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Cliente;
use App\Models\OrdemServico;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veiculos = Veiculo::take(5)->orderBy('id', 'DESC')->get();
        $msg = '';
        return view('veiculo.index', ['msg' => $msg, 'veiculos' => $veiculos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('veiculo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Veiculo::create($request->all());
        return redirect()->route('veiculo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Veiculo $veiculo)
    {
        return view('veiculo.show', ['veiculo' => $veiculo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Veiculo $veiculo)
    {
        return view('veiculo.edit', ['veiculo' => $veiculo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        $veiculo->update($request->all());
        return redirect()->route('veiculo.show', ['veiculo' => $veiculo->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Veiculo  $veiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();
        return redirect()->route('veiculo.index');
    }

    public function listar(Request $request){
  
        $veiculo = Veiculo::where('veiculos.veiPlaca', '=', $request->input('inputPlaca'))
        ->leftjoin('clientes', 'veiculos.cliente_id', '=', 'clientes.id')
        ->select('veiculos.id', 'veiculos.veiPlaca', 'veiculos.veiModelo', 'veiculos.veiMarca', 'clientes.nome', 'clientes.celular1')
        ->first();

        if (isset($veiculo)){ // Se existir o veículo
            $ordemservicos = OrdemServico::where('veiculo_id', '=', $veiculo->id)
            ->orderBy('id', 'DESC')    
            ->get();
      
            return view('veiculo.listar', ['veiculo' => $veiculo, 'ordemservico' => $ordemservicos]);
        }else{
            $veiculos = Veiculo::paginate(5);
            $msg = 'Placa não encontrado!' ;
            return view('veiculo.index', ['msg' => $msg, 'veiculos' => $veiculos]);
        }
    }
}
