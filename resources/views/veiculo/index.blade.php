@extends('layouts.main')

@section('title', 'Veículos - Tanaka')

@section('content')
    <div class='container mt-3'>

        <h1>Veículos</h1>
        <hr>

        {{-- menu de navegação --}}
        @component('veiculo.menu')
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
                <form method="post" action="{{ route('listar_veiculo') }}">
                 @csrf
                    <div class="row">
                        <div class="col">
                            <input id="inputPlaca" name="inputPlaca" type="text" class="form-control" placeholder="Placa do Veículo"  pattern="[a-zA-Z0-9]+">
                            <small class="form-text text-muted">Digite apenas letras e números</small>
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
                5 Últimos Cadastros 
            </div>

            <div class="card-body">
            

                <table  class="table table-sm">
                    <thead>
                        <tr class="d-flex">
                            <th class="col col-4">Modelo</th>
                            <th class="col col-2">Placa</th>
                            <th class="col col-2">Marca</th>
                            <th class="col col-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($veiculos as $veiculo )
                            <tr class="d-flex">
                                <th class="col col-4">{{$veiculo->veiModelo}}</th>
                                <th class="col col-2">{{$veiculo->veiPlaca}}</th>
                                <th class="col col-2">{{$veiculo->veiMarca}}</th>
                                <th class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <a class="btn btn-primary btn-block btn-sm" href="{{ route('veiculo.show', ['veiculo' => $veiculo->id])}}">Detalhes</a>
                                        </div>
                                        <div class="col-4">
                                            <form method="post" action="{{ route('veiculo.destroy', ['veiculo' => $veiculo->id])}}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-block btn-sm">Excluir</button>
                                            </form>
                                        </div>
                                        <div class="col-4">
                                            <a class="btn btn-warning btn-block btn-sm" href="{{ route('veiculo.edit', ['veiculo' => $veiculo->id])}}">Alterar</a>
                                        </div>
                                    </div>
                                </th>
                                
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>    
        </div>
        </div>
      
    </div>

@endsection