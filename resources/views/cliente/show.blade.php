@extends('layouts.main')

@section('title', 'Detalhe do Cliente - Tanaka')

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

        {{-- Dados do cliente --}}
        <div class="card" style="width: 100%; margin-left:auto; margin-right:auto;">
            <div class="card-header">
                Detalhamento do Cliente
            </div>
            <div class="card-body">

                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" value='{{ $cliente->nome }}' readonly >
                        </div>
                        <div class="form-group col-md-2">
                            <label for="celular1">Celular</label>
                            <input type="text" class="form-control" id="celular1" value='{{ $cliente->celular1 }}' readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="celular2">Telefone</label>
                            <input type="text" class="form-control" id="celular2" value='{{ $cliente->celular2 }}' readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" value='{{ $cliente->endereco }}' readonly>
                    </div>

                    <div class="form-group">
                        <label for="obs">Observações</label>
                        <input type="text" class="form-control" id="obs" value='{{ $cliente->obs }}' readonly>
                    </div>
            </div>

        </div>

        {{-- Dados dos veiculos --}}
        <div class="card mt-2" style="width: 100%; margin-left:auto; margin-right:auto;">
            <div class="card-header">
                Veículos cadastrados
            </div>
            <div class="card-body">

                    @csrf
                    @foreach ($cliente->veiculos as $key => $carros )
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" id="modelo" value='{{ mb_strtoupper($carros->veiModelo, "utf-8")  }}' readonly >
                        </div>
                        <div class="form-group col-md-2">
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" id="marca" value='{{ mb_strtoupper($carros->veiMarca, "utf-8") }}' readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="placa">Placa</label>
                            <input type="text" class="form-control" id="placa" value='{{ mb_strtoupper($carros->veiPlaca, "utf-8") }}' readonly>
                        </div>
                    </div>
                    @endforeach
            </div>

        </div>

        <div class="col-12 mt-2 text-center mb-5">
            <a href="{{route('cliente.index')}}" class="btn btn-primary">Voltar</a>
        </div>
    </div>

@endsection