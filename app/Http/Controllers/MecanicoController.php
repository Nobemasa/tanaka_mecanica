<?php

namespace App\Http\Controllers;

use App\Models\Mecanico;
use Illuminate\Http\Request;

class MecanicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $msg = '')
    {
    
        $mecanicos = Mecanico::paginate(4);

        return view('mecanico.index', ['msg' => $msg, 'mecanicos' => $mecanicos, 'request' => $request->all()]);
    }

    public function adicionar(Request $request){

        $msg = '';

        //inclusão
        if($request->input('_token') != ''  && ($request->input('id') == '')){
            // validação
            $regras = [
                'nome' => 'required|min:3|max:50',
                'porcentagem' => 'required'
            ];
            
            $feedback = [
                'required' => 'O campo deve ser preenchido',
                'nome.min' => 'O campo deve conter no mínimo 3 caracteres',
                'nome.max' => 'O campo deve conter no máximo 50 caracteres'
            ];

            $request->validate($regras, $feedback);

            $mecanico = new Mecanico();
            $mecanico->create($request->all());

            //dados para view
            $msg = 'Cadastro realizado com sucesso!';

        };   
        // Alteração
        if($request->input('_token') != ''  && ($request->input('id') != '')){
            $mecanico = Mecanico::find($request->input('id'));
            $mecanico->update($request->all());

            $msg = 'Alteração realizada com sucesso!';

            return redirect()->route('mecanico', ['msg' => $msg]);
        }
        
        return view('mecanico.adicionar', ['msg' => $msg]);
        
    }

    public function excluir($id){

        Mecanico::find($id)->delete();
        $msg ='Cadastro excluído com sucesso!';

        return redirect()->route('mecanico', ['msg' => $msg]);
    }

    public function alterar($id){

        $mecanico = Mecanico::find($id);

        return view('mecanico.adicionar', ['mecanicos' => $mecanico]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mecanico  $mecanico
     * @return \Illuminate\Http\Response
     */
    public function show(Mecanico $mecanico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mecanico  $mecanico
     * @return \Illuminate\Http\Response
     */
    public function edit(Mecanico $mecanico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mecanico  $mecanico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mecanico $mecanico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mecanico  $mecanico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mecanico $mecanico)
    {
        //
    }
}
