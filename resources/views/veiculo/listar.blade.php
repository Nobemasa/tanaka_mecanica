@extends('layouts.main')

@section('title', 'Detalhe de Veículos - Tanaka')

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
        <div class="col col-12">
            <div class="row">
                <div class='col-6'>
                    <div class="card-header font-weight-bold">
                        Resultado da Pesquisa - Veículo
                    </div>

                    <div class="card-body">
                        @csrf
                        <div class="row mb-1">
                            <label for="inputNome" class="col-2">Placa</label>
                            <input type="text" name="veiPlaca" class="col form-control" value='{{ mb_strtoupper($veiculo->veiPlaca, "utf-8") }}' placeholder="placa do veículo">
                        </div>
                        <div class="row mb-1">
                            <label for="inputNome" class="col-2">Modelo</label>
                            <input type="text" name="veiModelo" class="col form-control" value='{{ mb_strtoupper($veiculo->veiModelo, "utf-8") }}' placeholder="modelo do veículo">
                        </div>
                        <div class="row mb-1">
                            <label for="inputNome" class="col-2">Marca</label>
                            <input type="text" name="veiMarca" class="col form-control" value='{{ mb_strtoupper($veiculo->veiMarca, "utf-8") }}' placeholder="marca do veículo">
                        </div>
                    </div>
                </div>
                <div class='col-6'>
                    <div class="card-header font-weight-bold">
                        Cliente
                    </div>

                    <div class="card-body">
                        <div class="row mb-1">
                            <label for="inputNome" class="col-2">Nome</label>
                            <input id="inputNome" type="text" class="col form-control" value="{{ mb_strtoupper($veiculo->nome, "utf-8") }}" >
                        </div>
                        <div class="row">
                            <label for="inputCel" class="col-2">Celular</label>
                            <input id="inputCel" type="text" class="col form-control" value="{{ mb_strtoupper($veiculo->celular1, "utf-8") }}" >
                        </div>
                        </div> 
                    </div>   
                </div>
            </div>

            <div class="col col-12">
                <div class="card-header font-weight-bold">
                    Histórico - Ordem de Serviços
                </div>
                <div class="card-body">
                    <div class="row">
                        
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Data</th>
                                <th scope="col">Valor</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($ordemservico as $os )
                                <tr>
                                <th scope="row">{{ $os->id }}</th>
                                <td>{{ date( 'd/m/Y' , strtotime($os->created_at)) }}</td>
                                <td>{{ 'R$ '.number_format($os->total, 2, ',', '.') }}</td>
                                <td><a class="btn btn-primary btn-sm btn-block" href=" {{ route('imprimir_pdf', ['id' => $os->id]) }}" target="_blank">Imprimir</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>

        </div>    
  
    </div>

@endsection