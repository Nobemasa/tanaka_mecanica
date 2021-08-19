<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Item;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::with(['veiculos'])->orderBy('id', 'DESC')->take(5)->get();
        return view('cliente.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cliente::create($request->all());
        return redirect()->route('cliente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('cliente.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('cliente.index');
    }

    public function adicionarVeiculo(Request $request, $cliente_id){
        
           // verifica se a placa já é cadastrada 
           $veiculo = Veiculo::where('veiPlaca', '=', $request->input('veiPlaca'))
           ->first();
       
           $clientes = Cliente::with(['veiculos'])->orderBy('id', 'DESC')->paginate(5);

            if (isset($veiculo)){ // Se existir o veículo

                // atualiza o cadastro do veiculo
                Veiculo::wherein('id', [$veiculo->id])->update(['cliente_id' => $cliente_id]);

                
                $msg = 'Veículo adicionado com sucesso!' ;
                return redirect()->route('cliente.index', ['clientes' => $clientes, 'msg'=> $msg]);
            }else{
                $msg = 'Placa não encontrado, certifique-se o veículo esteja cadastrado!' ;
                return view('cliente.index', ['clientes' => $clientes, 'msg'=> $msg]);
            }
    }

    public function retirarVeiculo($veiculo_id){

        $clientes = Cliente::with(['veiculos'])->orderBy('id', 'DESC')->paginate(5);
    
        // atualiza o cadastro do veiculo
        Veiculo::wherein('id', [$veiculo_id])->update(['cliente_id' => 0]);

            
        $msg = 'Veículo retirado com sucesso!' ;
        return redirect()->route('cliente.index', ['clientes' => $clientes, 'msg'=> $msg]);
    }

    public function pesquisa(Request $request)
    {
        // regras de validação
        $regras = [
            'inputNome' => 'required'
        ];

        // msgs de feedback de validação
        $feedback = [
            'inputNome.required' => 'O campo NOME é obrigatório!'
        ];

        // validando os campos
        $request->validate($regras, $feedback);

        $clientes = Cliente::with(['veiculos'])
        ->where('nome', 'like', $request->input('inputNome').'%')
        ->get();


        if($clientes->count() != 0){
            $titulo_card = $clientes->count().' registro(s) encontrado(s)';
            return view('cliente.index', ['clientes' => $clientes, 'titulo_card'=> $titulo_card]);
        }else{
            $clientes = Cliente::with(['veiculos'])->orderBy('id', 'DESC')->take(5)->get();
            $msg = 'Cliente não encontrado!' ;
            return view('cliente.index', ['clientes' => $clientes, 'msg'=> $msg]);
        }
        
    }
}
