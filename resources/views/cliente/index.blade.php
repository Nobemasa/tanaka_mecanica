@extends('layouts.main')

@section('title', 'Clientes - Tanaka')

@section('content')
    <div class='container mt-3'>

        <h1>Clientes</h1>
        <hr>

        {{-- menu de navegação --}}
        @component('cliente.menu')
        @endcomponent


        @if ($msg ?? '')
            <div class="text-center alert alert-primary"> {{ $msg }}</div>
        
        @endif
 
        <div class="col-12 mb-3">
            <div class="card">
            <div class="card-header">
                Pesquisa 
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('pesquisa_cliente') }}">
                 @csrf
                    <div class="row">
                        <div class="col">
                            <input id="inputNome" name="inputNome" type="text" class="form-control" placeholder="Nome">
                            {{ $errors->has('inputNome') ? $errors->first('inputNome') : '' }}
                        </div>
                        <div class="col">
                            <button type="submit" class="form-control btn btn-primary">Pesquisar</button>
                        </div>
                    </div> 
                </form>
            </div> 
            </div>  
        </div>
        
        <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header">
                {{ $titulo_card ?? '5 Últimos Cadastros' }} 
            </div>

            <div class="card-body">

                <table  class="table table-sm">
                    <thead>
                        <tr class="d-flex">
                            <th class="col col-4">Nome</th>
                            <th class="col col-2">Celular</th>
                            <th class="col col-2">Telefone</th>
                            <th class="col col-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente )
                            <tr class="d-flex table-secondary">
                                <td class="col-4">{{$cliente->nome}}</td>
                                <td class="col-2">{{$cliente->celular1}}</td>
                                <td class="col-2">{{$cliente->celular2}}</td>
                                <td class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <a class="btn btn-primary btn-sm btn-block" href="{{ route('cliente.show', ['cliente' => $cliente->id, 'veiculo'=>$cliente->veiculos])}}">Detalhes</a>
                                        </div>
                                        <div class="col-4">
                                            <form method="post" action="{{ route('cliente.destroy', ['cliente' => $cliente->id])}}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm btn-block">Excluir</button>
                                            </form>
                                        </div>
                                        <div class="col-4">
                                            <a class="btn btn-warning btn-sm btn-block" href="{{ route('cliente.edit', ['cliente' => $cliente->id])}}">Alterar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <!-- Botão para acionar modal -->
                                <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#modalAddVeiculo">
                                    <i class="far fa-plus-square"></i> Adicionar Veículo
                                </button>
                                

                                @foreach ($cliente->veiculos as $key => $carros )
                                <ul>
                                    <a class="btn btn-danger btn-sm" href="{{route('retirar_veiculo', ['veiculo_id' => $carros->id])}}">
                                        <i class="far fa-minus-square mr-2"></i> Retirar
                                    </a>
                                    {{ mb_strtoupper ($carros->veiModelo.' - Placa: '.$carros->veiPlaca,"utf-8" ) }} 
                                    </ul>
                                @endforeach
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modalAddVeiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Veículo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="{{route('adicionar_veiculo', ['cliente_id' => $cliente->id])}}">
                                    <div class="modal-body">

                                        @csrf
                                        <input type="text" name="veiPlaca" class="form-control" value='{{ old('veiPlaca') }}' placeholder="Placa do veículo">
                                        <small class="form-text text-muted">{{ $errors->has('veiPlaca') ? $errors->first('veiPlaca') : ''}}</small>      
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Adicionar</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>


                        @endforeach 
                    </tbody>
                </table>
            </div>    
        </div>
        </div>
     
    </div>
@endsection